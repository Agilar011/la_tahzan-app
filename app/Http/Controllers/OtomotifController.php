<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Otomotif;
use App\Models\SpesifikasiOtomotif;
use App\Models\FotoOtomotif;
use App\Models\dataWareHouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OtomotifController extends Controller
{
    public function index(Request $request)
    {
        $query = Otomotif::query();

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);
            $query->whereBetween('harga', [$minPrice, $maxPrice]);
        }

        if ($request->filled('merks')) {
            $query->whereIn('merk_id', $request->input('merks'));
        }

        if ($request->filled('jenis')) {
            $query->whereIn('jenis_id', $request->input('jenis'));
        }

        if ($request->filled('subjenis')) {
            $query->whereIn('subjenis_id', $request->input('subjenis'));
        }

        if (is_null($request->min_price) && is_null($request->max_price)) {
            if (Auth::check()) {
                if (Auth::user()->role == 'admin') {
                    $otomotif = Otomotif::with('spesifikasi', 'fotos')->orderBy('created_at', 'asc')->get();
                    return view('admin.otomotif', compact('otomotif'));
                } else {
                    $otomotif = Otomotif::with('spesifikasi', 'fotos')->orderBy('created_at', 'asc')->get();
                    $transmisi = SpesifikasiOtomotif::select('transmisi')->distinct()->get();
                    return view('customer.otomotif', compact('otomotif', 'transmisi'));
                }
            } else {
                $otomotif = Otomotif::with('spesifikasi', 'fotos')->orderBy('created_at', 'desc')->get();
                $transmisi = SpesifikasiOtomotif::select('transmisi')->distinct()->get();
                $type = SpesifikasiOtomotif::select('type')->distinct()->get();
                $subtype = SpesifikasiOtomotif::select('subtype')->distinct()->get();
                $brand = SpesifikasiOtomotif::select('brand')->distinct()->get();
                return view('customer.otomotif', compact('otomotif', 'transmisi', 'type', 'subtype', 'brand'));
            }
        } else {
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price', Otomotif::max('harga'));

            $otomotif = Otomotif::with('spesifikasi', 'fotos')
                ->whereBetween('harga', [$minPrice, $maxPrice])
                ->orderBy('status_seller', 'asc')
                ->get();

            return view('customer.otomotif', compact('otomotif'));
        }
    }


    public function create()
    {
        return view('admin.input.input-otomotif');
    }

    public function store(Request $request)
    {
    $request->validate([
        'judul_produk' => 'required|string|max:255',
        'deskripsi_produk' => 'required',
        'harga' => 'required|numeric',
        'transmisi' => 'required|in:manual,matic',
        'type' => 'required|string|max:255',
        'subtype' => 'required|string|max:255',
        'kilometer' => 'required|string|max:255',
        'kapasitas_mesin' => 'required|string|max:255',
        'tahun_pembuatan' => 'required|date',
        'brand' => 'required|string|max:255',
        'stnk' => 'required|in:ya,tidak',
        'bpkb' => 'required|in:ya,tidak',
        'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $otomotif = new Otomotif();
    $otomotif->judul_produk = $request->judul_produk;
    $otomotif->deskripsi_produk = $request->deskripsi_produk;
    $otomotif->harga = $request->harga;
    $otomotif->status_ads = 'pending';
    $otomotif->status_payment = 'unpaid';
    $otomotif->save();

    $spesifikasi = new SpesifikasiOtomotif();
    $spesifikasi->otomotif_id = $otomotif->id;
    $spesifikasi->user_id = Auth::id();
    $spesifikasi->seller = Auth::user()->name;
    $spesifikasi->phone = Auth::user()->phone;
    $spesifikasi->address = Auth::user()->address;
    $spesifikasi->status_seller = Auth::user()->status_seller;
    $spesifikasi->transmisi = $request->transmisi;
    $spesifikasi->type = $request->type;
    $spesifikasi->subtype = $request->subtype;
    $spesifikasi->kilometer = $request->kilometer;
    $spesifikasi->kapasitas_mesin = $request->kapasitas_mesin;
    $spesifikasi->tahun_pembuatan = $request->tahun_pembuatan;
    $spesifikasi->brand = $request->brand;
    $spesifikasi->stnk = $request->stnk;
    $spesifikasi->bpkb = $request->bpkb;
    $spesifikasi->save();

    $warehouse = new dataWareHouse();
    $warehouse->id_otomotif = $otomotif->id;
    $warehouse->id_spesifikasi_otomotif = $spesifikasi->id;
    $warehouse->judul_produk = $otomotif->judul_produk;
    $warehouse->deskripsi_produk = $otomotif->deskripsi_produk;
    $warehouse->jenis_produk = 'otomotif';
    $warehouse->subtype = $spesifikasi->type;
    $warehouse->cc = $spesifikasi->kapasitas_mesin;
    // $warehouse->tahun_pembuatan = $spesifikasi->tahun_pembuatan;
    $warehouse->brand = $spesifikasi->brand;
    // Default value for pathOto, will be updated if foto is present
    $warehouse->pathOto = '';

    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $index => $file) {
            $filename = $file->hashName(); // Menghasilkan nama file acak unik
            $file->storeAs('public/foto_otomotif', $filename); // Menyimpan file dengan nama yang dihasilkan

            $foto = new FotoOtomotif();
            $foto->otomotif_id = $otomotif->id;
            $foto->path = $filename; // Menyimpan nama file saja di database
            $foto->save();

            // Set pathOto for the first photo
            if ($index == 0) {
                $warehouse->pathOto = $filename;
            }
        }
    }

    $warehouse->save();

    return redirect()->route('admin.otomotif.index')->with('success', 'Otomotif created successfully.');
    }


    public function edit($id)
    {
        $otomotif = Otomotif::with('spesifikasi', 'fotos')->findOrFail($id);
        return view('admin.update.update-otomotif', compact('otomotif'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required',
            'harga' => 'required|numeric',
            'transmisi' => 'required|in:manual,matic',
            'type' => 'required|string|max:255',
            'subtype' => 'required|string|max:255',
            'kilometer' => 'required|string|max:255',
            'kapasitas_mesin' => 'required|string|max:255',
            'tahun_pembuatan' => 'required|date',
            'brand' => 'required|string|max:255',
            'stnk' => 'required|in:ya,tidak',
            'bpkb' => 'required|in:ya,tidak',
            'foto.*' => 'image|mimes:jpeg,png,jpg,svg|max:5120' // Validasi file foto
        ]);

        $otomotif = Otomotif::findOrFail($id);
        $otomotif->update([
            'judul_produk' => $request->judul_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga' => $request->harga,
        ]);

        $spesifikasi = SpesifikasiOtomotif::where('otomotif_id', $otomotif->id)->first();
        $spesifikasi->update([
            'transmisi' => $request->transmisi,
            'type' => $request->type,
            'subtype' => $request->subtype,
            'kilometer' => $request->kilometer,
            'kapasitas_mesin' => $request->kapasitas_mesin,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'brand' => $request->brand,
            'stnk' => $request->stnk,
            'bpkb' => $request->bpkb,
        ]);

        if ($request->hasFile('foto')) {
            $foto_existing = $request->input('foto_existing', []);
            foreach ($request->file('foto') as $key => $file) {
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_otomotif', $filename); // Menyimpan file dengan nama yang dihasilkan

                if (isset($foto_existing[$key])) {
                    // Replace existing photo
                    $foto = FotoOtomotif::where('path', $foto_existing[$key])->first();
                    if ($foto) {
                        Storage::delete('public/foto_otomotif/' . $foto->path); // Menghapus file lama
                        $foto->update(['path' => $filename]); // Memperbarui dengan nama file baru
                    }
                } else {
                    // Add new photo
                    FotoOtomotif::create([
                        'otomotif_id' => $otomotif->id,
                        'path' => $filename // Menyimpan nama file saja di database
                    ]);
                }
            }
        }

        return redirect()->route('admin.otomotif.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $otomotif = Otomotif::findOrFail($id);

        // Hapus foto yang terkait dari storage
        $fotos = FotoOtomotif::where('otomotif_id', $id)->get();
        foreach ($fotos as $foto) {
            Storage::delete($foto->path);
            $foto->delete();
        }

        // Hapus spesifikasi yang terkait
        SpesifikasiOtomotif::where('otomotif_id', $id)->delete();

        // Hapus data otomotif
        $otomotif->delete();

        return response()->json(['success' => true]);
    }


    public function changeStatus(Request $request, $id)
    {
        $otomotif = Otomotif::find($id);
        if (!$otomotif) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        $otomotif->status_payment = $request->input('status_payment');
        $otomotif->status_ads = $request->input('status_ads');
        $otomotif->save();

        return response()->json(['success' => true]);
    }

    public function spesifikasi($id)
    {
    $otomotif = Otomotif::with('fotos') // Pastikan fotos di-load
        ->join('spesifikasi_otomotif', 'otomotif.id', '=', 'spesifikasi_otomotif.otomotif_id')
        ->join('users', 'spesifikasi_otomotif.user_id', '=', 'users.id')
        ->findOrFail($id);

    // Hitung jumlah produk dan tanggal bergabung seller
    $otomotif->jumlahProduk = SpesifikasiOtomotif::where('user_id', $otomotif->user_id)->count();
    $otomotif->sellerBergabung = SpesifikasiOtomotif::where('user_id', $otomotif->user_id)
        ->min('created_at');
    $otomotif->sellerBergabung = (new DateTime($otomotif->sellerBergabung))->format('d F Y');

    return view('customer.spesifikasi-otomotif', compact('otomotif'));
    }


    public function show($id)
    {
    $otomotif = Otomotif::with('fotos')->findOrFail($id);
    // Debugging
    dd($otomotif->fotos);
    return view('customer.spesifikasi-otomotif', compact('otomotif'));
    }



}
