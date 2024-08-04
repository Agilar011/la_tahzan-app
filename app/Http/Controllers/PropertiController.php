<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\Properti;
use App\Models\Warehouse;
use App\Models\SpesifikasiProperti;
use App\Models\FotoProperti;
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

        // Tempat data warehouse
        $warehouse = new Warehouse();
        $warehouse->judul_produk = $request->judul_produk;
        $warehouse->kategori = 'properti';
        $warehouse->deskripsi_produk = $request->deskripsi_produk;
        $warehouse->harga = $request->harga;
        $warehouse->status_ads = 'pending';
        $warehouse->status_payment = 'unpaid';
        $warehouse->save();

        $spesifikasi = new SpesifikasiProperti();
        $spesifikasi->properti_id = $properti->id;
        $spesifikasi->warehouse_id = $warehouse->id;
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
                $filename = $file->hashName(); // Menghasilkan nama file acak unik
                $file->storeAs('public/foto_properti', $filename); // Menyimpan file dengan nama yang dihasilkan

                $foto = new FotoProperti();
                $foto->properti_id = $properti->id;
                $foto->path = $filename; // Menyimpan nama file saja di database
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

    // Update Properti
    $properti = Properti::findOrFail($id);
    $properti->judul_produk = $request->judul_produk;
    $properti->deskripsi_produk = $request->deskripsi_produk;
    $properti->harga = $request->harga;
    $properti->save();

    // Update Warehouse
    $warehouse = Warehouse::find($properti->warehouse_id); // Asumsi ada field warehouse_id di tabel Properti
    if ($warehouse) {
        $warehouse->judul_produk = $request->judul_produk;
        $warehouse->deskripsi_produk = $request->deskripsi_produk;
        $warehouse->harga = $request->harga;
        $warehouse->save();
    }

    // Update Spesifikasi Properti
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

    // Handle Foto Properti
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

    public function spesifikasi($id)
    {
        $properti = Properti::join('spesifikasi_properti', 'properti.id', '=', 'spesifikasi_properti.properti_id')
        ->join('users', 'spesifikasi_properti.user_id', '=', 'users.id')
        ->with('spesifikasi', 'fotos')->findOrFail($id);

        $properti->jumlahProduk = SpesifikasiProperti::where('user_id', $properti->user_id)->count();
        $properti->sellerBergabung = SpesifikasiProperti::where('user_id', $properti->user_id)
                ->min('created_at');
                $properti->sellerBergabung = (new DateTime($properti->sellerBergabung))->format('d F Y');

        return view('customer.spesifikasi-properti', compact('properti'));
    }
}

