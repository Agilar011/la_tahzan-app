<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properti;
use App\Models\SpesifikasiProperti;
use App\Models\FotoProperti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertiController extends Controller
{
    public function index()
    {
        $properti = Properti::with('spesifikasi', 'fotos')->get();
        return view('admin.properti', compact('properti'));
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
        $spesifikasi->jenis_properti = $request->jenis_properti;
        $spesifikasi->luas_tanah = $request->luas_tanah;
        $spesifikasi->luas_bangunan = $request->luas_bangunan;
        $spesifikasi->jumlah_kamar_tidur = $request->jumlah_kamar_tidur;
        $spesifikasi->jumlah_kamar_mandi = $request->jumlah_kamar_mandi;
        $spesifikasi->fasilitas = $request->fasilitas;
        $spesifikasi->sertifikat = $request->sertifikat;
        $spesifikasi->save();

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('public/foto_properti');
                $foto = new FotoProperti();
                $foto->properti_id = $properti->id;
                $foto->path = $path;
                $foto->save();
            }
        }

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

        if ($request->hasFile('foto')) {
            $foto_existing = $request->input('foto_existing', []);
            foreach ($request->file('foto') as $key => $file) {
                if (isset($foto_existing[$key])) {
                    // Replace existing photo
                    $foto = FotoProperti::where('path', $foto_existing[$key])->first();
                    if ($foto) {
                        Storage::delete($foto->path);
                        $path = $file->store('public/foto_properti');
                        $foto->update(['path' => $path]);
                    }
                } else {
                    // Add new photo
                    $path = $file->store('public/foto_properti');
                    FotoProperti::create([
                        'properti_id' => $properti->id,
                        'path' => $path
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

        // Hapus data properti
        $properti->delete();

        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request, $id)
    {
        $properti = Properti::find($id);
        if (!$properti) {
            return response()->json(['success' => false, 'message' => 'Properti not found.'], 404);
        }

        $properti->status_payment = $request->input('status_payment');
        $properti->status_ads = $request->input('status_ads');
        $properti->save();

        return response()->json(['success' => true]);
    }
}

