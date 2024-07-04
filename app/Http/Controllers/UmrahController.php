<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umrah;
use App\Models\SpesifikasiUmrah;
use App\Models\FotoUmrah;
use Illuminate\Support\Facades\Storage;

class UmrahController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga' => 'required|numeric',
            'agen_travel' => 'required|string|max:255',
            'nomor_telefon_agen' => 'required|string|max:15',
            'maskapai' => 'required|string|max:255',
            'hotel' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'durasi' => 'required|integer',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Simpan data ke tabel umrah
        $umrah = Umrah::create([
            'judul_produk' => $request->judul_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga' => $request->harga
        ]);

        // Simpan data ke tabel spesifikasi_umrah
        $spesifikasi = SpesifikasiUmrah::create([
            'umrah_id' => $umrah->id,
            'agen_travel' => $request->agen_travel,
            'nomor_telefon_agen' => $request->nomor_telefon_agen,
            'maskapai' => $request->maskapai,
            'hotel' => $request->hotel,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'durasi' => $request->durasi
        ]);

        // Simpan data ke tabel foto_umrah
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('public/foto_umrah');
                FotoUmrah::create([
                    'umrah_id' => $umrah->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.umrah.index')->with('success', 'Data umrah berhasil disimpan');
    }

    public function edit($id)
    {
        $umrah = Umrah::with('spesifikasi', 'fotos')->findOrFail($id);
        return view('admin.update.update-umrah', compact('umrah'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'judul_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga' => 'required|numeric',
            'agen_travel' => 'required|string|max:255',
            'nomor_telefon_agen' => 'required|string|max:15',
            'maskapai' => 'required|string|max:255',
            'hotel' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'durasi' => 'required|integer',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Update data di tabel umrah
        $umrah = Umrah::findOrFail($id);
        $umrah->update([
            'judul_produk' => $request->judul_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga' => $request->harga
        ]);

        // Update data di tabel spesifikasi_umrah
        $spesifikasi = SpesifikasiUmrah::where('umrah_id', $id)->first();
        $spesifikasi->update([
            'agen_travel' => $request->agen_travel,
            'nomor_telefon_agen' => $request->nomor_telefon_agen,
            'maskapai' => $request->maskapai,
            'hotel' => $request->hotel,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'durasi' => $request->durasi
        ]);

        // Update data di tabel foto_umrah jika ada file baru yang diupload
        if ($request->hasFile('foto')) {
            // Simpan foto baru
            foreach ($request->file('foto') as $file) {
                $path = $file->store('public/foto_umrah');
                FotoUmrah::create([
                    'umrah_id' => $umrah->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('admin.umrah.index')->with('success', 'Data umrah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umrah = Umrah::findOrFail($id);

        // Hapus foto yang terkait dari storage
        $fotos = FotoUmrah::where('umrah_id', $id)->get();
        foreach ($fotos as $foto) {
            Storage::delete($foto->path);
            $foto->delete();
        }

        // Hapus spesifikasi yang terkait
        SpesifikasiUmrah::where('umrah_id', $id)->delete();

        // Hapus data otomotif
        $umrah->delete();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $umrahs = Umrah::with('spesifikasi', 'fotos')->get();
        return view('admin.umrah', compact('umrahs'));
    }

    public function toggleStatus($id, Request $request)
    {
        $umrah = Umrah::findOrFail($id);
        $umrah->status_ads = $request->status;
        $umrah->save();

        return response()->json(['success' => true]);
    }
}
