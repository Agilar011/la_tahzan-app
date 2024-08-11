<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Properti;
use App\Models\SpesifikasiProperti;
use App\Models\FotoProperti;
use App\Models\dataWareHouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertiController extends Controller
{
    public function index(Request $request)
    {
        $query = Properti::query();

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);
            $query->whereBetween('harga', [$minPrice, $maxPrice]);
        }

        if ($request->filled('jenis_properti')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('jenis_properti', $request->input('jenis_properti'));
            });
        }

        if ($request->filled('kota')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('kota', $request->input('kota'));
            });
        }

        if ($request->filled('provinsi')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('provinsi', $request->input('provinsi'));
            });
        }

        // Check if no filters are applied
        if (!$request->filled('min_price') && !$request->filled('max_price')) {
            // Check if the user is authenticated
            if (Auth::check()) {
                // Check the user's role
                if (Auth::user()->role == 'admin') {
                    // Get property data with related specifications and photos for admin
                    $properti = Properti::with('spesifikasi', 'fotos')->get();
                    return view('admin.properti', compact('properti'));
                } else {
                    // Get property data with related specifications and photos for customers
                    $properti = Properti::with('spesifikasi', 'fotos')->get();
                    return view('customer.properti', compact('properti'));
                }
            } else {
                // For unauthenticated users, get property data with related specifications and photos
                $properti = Properti::with('spesifikasi', 'fotos')->get();
                $jenis_properti = SpesifikasiProperti::select('jenis_properti')->distinct()->get();
                $kota = SpesifikasiProperti::select('kota')->distinct()->get();
                $provinsi = SpesifikasiProperti::select('provinsi')->distinct()->get();
                return view('customer.properti', compact('properti', 'jenis_properti', 'kota', 'provinsi'));
            }
        } else {
            // Get properties within the price range and with other filters
            $properties = $query->with('spesifikasi', 'fotos')->get();
            return view('customer.properti', compact('properti'));
        }
    }


    public function create()
    {
        return view('admin.input.input-properti');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required',
            'harga' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'jenis_properti' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'nullable|string|max:255',
            'jumlah_kamar_tidur' => 'nullable|integer',
            'jumlah_kamar_mandi' => 'nullable|integer',
            'fasilitas' => 'required',
            'sertifikat' => 'required|in:ya,tidak',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $properti = new Properti();
        $properti->judul_produk = $request->judul_produk;
        $properti->deskripsi_produk = $request->deskripsi_produk;
        $properti->harga = $request->harga;
        $properti->status_ads = 'pending';
        $properti->status_payment = 'unpaid';
        $properti->save();

        $spesifikasi = new SpesifikasiProperti();
        $spesifikasi->properti_id = $properti->id;
        $spesifikasi->user_id = Auth::id();
        $spesifikasi->alamat = $request->alamat;
        $spesifikasi->kota = $request->kota;
        $spesifikasi->provinsi = $request->provinsi;
        $spesifikasi->seller = Auth::user()->name;
        $spesifikasi->phone = Auth::user()->phone;
        $spesifikasi->address = Auth::user()->address;
        $spesifikasi->address = Auth::user()->address;
        $spesifikasi->status_seller = Auth::user()->status_seller;
        $spesifikasi->jenis_properti = $request->jenis_properti;
        $spesifikasi->luas_tanah = $request->luas_tanah;
        $spesifikasi->luas_bangunan = $request->luas_bangunan;
        $spesifikasi->jumlah_kamar_tidur = $request->jumlah_kamar_tidur;
        $spesifikasi->jumlah_kamar_mandi = $request->jumlah_kamar_mandi;
        $spesifikasi->fasilitas = $request->fasilitas;
        $spesifikasi->sertifikat = $request->sertifikat;
        $spesifikasi->save();

        $warehouse = new dataWareHouse();
        $warehouse->properti_id = $properti->id;
        $warehouse->id_spesifikasi_properti = $spesifikasi->id;
        $warehouse->judul_produk = $properti->judul_produk;
        $warehouse->deskripsi_produk = $properti->deskripsi_produk;
        $warehouse->jenis_produk = 'properti';
        $warehouse->subtype = $spesifikasi->jenis_properti;
        $warehouse->kota = $spesifikasi->kota;
        $warehouse->provinsi = $spesifikasi->provinsi;
        $warehouse->luas_tanah = $spesifikasi->luas_tanah;
        $warehouse->luas_bangunan = $spesifikasi->luas_bangunan;
        $warehouse->status_seller = Auth::user()->status_seller;
        $warehouse->kamar_tidur = $spesifikasi->jumlah_kamar_tidur;
        $warehouse->kamar_mandi = $spesifikasi->jumlah_kamar_mandi;
        $warehouse->pathOto = '';
        $warehouse->save();

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_properti', $filename); // Menyimpan file dengan nama yang dihasilkan

                $foto = new FotoProperti();
                $foto->properti_id = $properti->id;
                $foto->path = $filename; // Menyimpan nama file saja di database
                $foto->save();

                // Set pathOto for the first photo
                if ($index == 0) {
                    $warehouse->pathProp = $filename;
                }
            }
        }

        $warehouse->save();

        return redirect()->route('admin.properti.index')->with('success', 'Properti created successfully.');
    }

    public function edit($id)
    {
        $properti = Properti::with('spesifikasi', 'fotos')->findOrFail($id);
        return view('admin.update.update-properti', compact('properti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required',
            'harga' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'jenis_properti' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'nullable|string|max:255',
            'jumlah_kamar_tidur' => 'nullable|integer',
            'jumlah_kamar_mandi' => 'nullable|integer',
            'fasilitas' => 'required',
            'sertifikat' => 'required|in:ya,tidak',
            'foto.*' => 'image|mimes:jpeg,png,jpg,svg|max:5120' // Validasi file foto
        ]);

        $properti = Properti::findOrFail($id);
        $properti->judul_produk = $request->judul_produk;
        $properti->deskripsi_produk = $request->deskripsi_produk;
        $properti->harga = $request->harga;
        $properti->save();

        $spesifikasi = SpesifikasiProperti::where('properti_id', $properti->id)->first();
        $spesifikasi->alamat = $request->alamat;
        $spesifikasi->kota = $request->kota;
        $spesifikasi->provinsi = $request->provinsi;
        $spesifikasi->jenis_properti = $request->jenis_properti;
        $spesifikasi->luas_tanah = $request->luas_tanah;
        $spesifikasi->luas_bangunan = $request->luas_bangunan;
        $spesifikasi->jumlah_kamar_tidur = $request->jumlah_kamar_tidur;
        $spesifikasi->jumlah_kamar_mandi = $request->jumlah_kamar_mandi;
        $spesifikasi->fasilitas = $request->fasilitas;
        $spesifikasi->sertifikat = $request->sertifikat;
        $spesifikasi->save();

        $warehouse = new dataWareHouse();
        $warehouse->properti_id = $properti->id;
        $warehouse->judul_produk = $properti->judul_produk;
        $warehouse->deskripsi_produk = $properti->deskripsi_produk;
        $warehouse->jenis_produk = 'properti';
        $warehouse->subtype = $spesifikasi->jenis_properti;
        $warehouse->kota = $spesifikasi->kota;
        $warehouse->provisi = $spesifikasi->provisi;
        $warehouse->luas_tanah = $spesifikasi->luas_tanah;
        $warehouse->luas_bangunan = $spesifikasi->luas_bangunan;
        $warehouse->kamar_tidur = $spesifikasi->jumlah_kamar_tidur;
        $warehouse->kamar_mandi = $spesifikasi->jumlah_kamar_mandi;
        $warehouse->save();

        if ($request->hasFile('foto')) {
            $foto_existing = $request->input('foto_existing', []);
            foreach ($request->file('foto') as $key => $file) {
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_properti', $filename); // Menyimpan file dengan nama yang dihasilkan

                if (isset($foto_existing[$key])) {
                    // Replace existing photo
                    $foto = FotoProperti::where('path', $foto_existing[$key])->first();
                    if ($foto) {
                        Storage::delete('public/foto_properti/' . $foto->path); // Menghapus file lama
                        $foto->update(['path' => $filename]); // Memperbarui dengan nama file baru
                    }
                } else {
                    // Add new photo
                    FotoProperti::create([
                        'properti_id' => $properti->id,
                        'path' => $filename // Menyimpan nama file saja di database
                    ]);
                }
            }
        }

        return redirect()->route('admin.properti.index')->with('success', 'Properti updated successfully.');
    }

    public function destroy($id)
    {
        $properti = Properti::findOrFail($id);

        // Hapus foto yang terkait dari storage
        $fotos = FotoProperti::where('properti_id', $id)->get();
        foreach ($fotos as $foto) {
            Storage::delete($foto->path);
            $foto->delete();
        }

        // Hapus spesifikasi yang terkait
        SpesifikasiProperti::where('properti_id', $id)->delete();

        // Hapus warehouse yang terkait
        dataWareHouse::where('properti_id', $id)->delete();

        // Hapus data properti
        $properti->delete();

        return response()->json(['success' => true]);
    }

    public function spesifikasi($id)
    {

    $properti = Properti::with('fotos') // Pastikan fotos di-load
        ->join('spesifikasi_properti', 'properti.id', '=', 'spesifikasi_properti.properti_id')
        ->join('users', 'spesifikasi_properti.user_id', '=', 'users.id')
        ->findOrFail($id);

    // Hitung jumlah produk dan tanggal bergabung seller
    $properti->jumlahProduk = SpesifikasiProperti::where('user_id', $properti->user_id)->count();
    $properti->sellerBergabung = SpesifikasiProperti::where('user_id', $properti->user_id)
        ->min('created_at');
    $properti->sellerBergabung = (new DateTime($properti->sellerBergabung))->format('d F Y');



    $photo = Properti::with('fotos') // Pastikan fotos di-load
        ->join('spesifikasi_properti', 'properti.id', '=', 'spesifikasi_properti.properti_id')
        ->findOrFail($id);

    // Hitung jumlah produk dan tanggal bergabung seller
    $photo->jumlahProduk = SpesifikasiProperti::where('user_id', $properti->user_id)->count();
    $photo->sellerBergabung = SpesifikasiProperti::where('user_id', $properti->user_id)
        ->min('created_at');
    $photo->sellerBergabung = (new DateTime($properti->created_at))->format('d F Y');

    return view('customer.spesifikasi-properti', compact('properti', 'photo'));
    }


    public function show($id)
    {
    $properti = Properti::with('fotos')->findOrFail($id);
    // Debugging
    dd($properti->fotos);
    return view('customer.spesifikasi-properti', compact('properti'));
    }
}

