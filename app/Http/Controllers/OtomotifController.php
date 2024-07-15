<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otomotif;
use App\Models\SpesifikasiOtomotif;
use App\Models\FotoOtomotif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OtomotifController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        if ($request->min_price == null && $request->max_price == null) {
            # code...
            if (Auth::user()->role == 'admin') {
                $otomotif = Otomotif::with('spesifikasi', 'fotos')->get();
                // dd('masuk sini');

            return view('admin.otomotif', compact('otomotif'));
            }
            else {
                $otomotif = Otomotif::with('spesifikasi', 'fotos')
                    ->get();
                        // dd($otomotif);
                return view('customer.otomotif', compact('otomotif'));
            }

        } else {
            # code...
                        // $otomotif = Otomotif::where('category', 'automotive')
            // ->whereBetween('price', [$minPrice, $maxPrice])
            // ->get();

            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price'); // Default max price
            if ($maxPrice == null) {
                $maxPrice = Otomotif::max('harga');
                $maxPrice = $maxPrice + 1;
            }
            elseif ($minPrice == null) {
                $minPrice = Otomotif::min('harga');
                $minPrice = $minPrice - 1;
            }

            // $minPrice = $minPrice + 1;

            // $maxPrice = $maxPrice + 1;

            // dd($minPrice, $maxPrice);


            $otomotif = Otomotif::with('spesifikasi', 'fotos')
                    ->whereBetween('otomotif.harga', [$minPrice, $maxPrice])
                    ->get();

                    // dd($otomotif);

            return view('customer.otomotif', compact('otomotif'));

        }

        // dd($request->all());

        // $otomotif = Otomotif::with('spesifikasi', 'fotos')->get();
        // return view('admin.otomotif', compact('otomotif'));
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

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('public/foto_otomotif');
                $foto = new FotoOtomotif();
                $foto->otomotif_id = $otomotif->id;
                $foto->path = $path;
                $foto->save();
            }
        }

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
                if (isset($foto_existing[$key])) {
                    // Replace existing photo
                    $foto = FotoOtomotif::where('path', $foto_existing[$key])->first();
                    if ($foto) {
                        Storage::delete($foto->path);
                        $path = $file->store('public/foto_otomotif');
                        $foto->update(['path' => $path]);
                    }
                } else {
                    // Add new photo
                    $path = $file->store('public/foto_otomotif');
                    FotoOtomotif::create([
                        'otomotif_id' => $otomotif->id,
                        'path' => $path
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
        $otomotif = Otomotif::join('spesifikasi_otomotif', 'otomotif.id', '=', 'spesifikasi_otomotif.otomotif_id')
            ->with('spesifikasi', 'fotos')->findOrFail($id);
        return view('customer.spesifikasi-otomotif', compact('otomotif'));
    }



}
