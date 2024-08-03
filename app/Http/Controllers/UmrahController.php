<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use App\Models\Umrah;
use App\Models\SpesifikasiUmrah;
use App\Models\FotoUmrah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmrahController extends Controller
{

    public function index(Request $request)
    {
        $query = Umrah::query();

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', PHP_INT_MAX);
            $query->whereBetween('harga', [$minPrice, $maxPrice]);
        }

        if ($request->filled('agen_travel')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('agen_travel', $request->input('agen_travel'));
            });
        }

        if ($request->filled('durasi')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('durasi', $request->input('durasi'));
            });
        }

        if ($request->filled('maskapai')) {
            $query->whereHas('spesifikasi', function ($q) use ($request) {
                $q->whereIn('maskapai', $request->input('maskapai'));
            });
        }

        // Check if no filters are applied
        if (!$request->filled('min_price') && !$request->filled('max_price')) {
            // Check if the user is authenticated
            if (Auth::check()) {
                // Check the user's role
                if (Auth::user()->role == 'admin') {
                    // Get property data with related specifications and photos for admin
                    $umrah = Umrah::with('spesifikasi', 'fotos')->get();
                    return view('admin.umrah', compact('umrah'));
                } else {
                    // Get property data with related specifications and photos for customers
                    $umrah = Umrah::with('spesifikasi', 'fotos')->get();
                    return view('customer.umrah', compact('umrah'));
                }
            } else {
                // For unauthenticated users, get property data with related specifications and photos
                $umrah = Umrah::with('spesifikasi', 'fotos')->get();
                $agen_travel = SpesifikasiUmrah::select('agen_travel')->distinct()->get();
                $durasi = SpesifikasiUmrah::select('durasi')->distinct()->get();
                $maskapai = SpesifikasiUmrah::select('maskapai')->distinct()->get();
                return view('customer.umrah', compact('umrah', 'agen_travel', 'durasi', 'maskapai'));
            }
        } else {
            // Get properties within the price range and with other filters
            $umrah = $query->with('spesifikasi', 'fotos')->get();
            return view('customer.umrah', compact('umrah'));
        }
    }

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
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_umrah', $filename); // Menyimpan file dengan nama yang dihasilkan

                $foto = new FotoUmrah();
                $foto->umrah_id = $umrah->id;
                $foto->path = $filename; // Menyimpan nama file saja di database
                $foto->save();
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
            $foto_existing = $request->input('foto_existing', []);
            foreach ($request->file('foto') as $key => $file) {
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_umrah', $filename); // Menyimpan file dengan nama yang dihasilkan

                if (isset($foto_existing[$key])) {
                    // Replace existing photo
                    $foto = FotoUmrah::where('path', $foto_existing[$key])->first();
                    if ($foto) {
                        Storage::delete('public/foto_umrah/' . $foto->path); // Menghapus file lama
                        $foto->update(['path' => $filename]); // Memperbarui dengan nama file baru
                    }
                } else {
                    // Add new photo
                    FotoUmrah::create([
                        'umrah_id' => $umrah->id,
                        'path' => $filename // Menyimpan nama file saja di database
                    ]);
                }
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

    // public function index()
    // {
    //     $umrahs = Umrah::with('spesifikasi', 'fotos')->get();
    //     return view('admin.umrah', compact('umrahs'));
    // }

    public function toggleStatus($id, Request $request)
    {
        $umrah = Umrah::findOrFail($id);
        $umrah->status_ads = $request->status;
        $umrah->save();

        return response()->json(['success' => true]);
    }

    public function spesifikasi($id)
    {
        $umrah = Umrah::join('spesifikasi_umrah', 'umrah.id', '=', 'spesifikasi_umrah.umrah_id')
            ->with('spesifikasi', 'fotos')
            ->findOrFail($id);

        $umrah->jumlahProduk = SpesifikasiUmrah::where('umrah_id', $umrah->id)->count();
        $umrah->sellerBergabung = SpesifikasiUmrah::where('umrah_id', $umrah->id)
            ->min('created_at');
        $umrah->sellerBergabung = (new DateTime($umrah->sellerBergabung))->format('d F Y');

        return view('customer.spesifikasi-umrah', compact('umrah'));
    }

}
