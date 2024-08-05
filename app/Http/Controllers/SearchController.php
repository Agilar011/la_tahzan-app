<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataWareHouse;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $query = request()->input('query');

        $results = dataWareHouse::with('umrah', 'otomotif', 'properti', 'spesifikasiumrah', 'spesifikasiotomotif', 'spesifikasiproperti')
            ->where(function($q) use ($query) {
                $q->where('judul_produk', 'LIKE', "%{$query}%")
                  ->orWhere('deskripsi_produk', 'LIKE', "%{$query}%")
                  ->orWhere('jenis_produk', 'LIKE', "%{$query}%")
                  ->orWhere('agen', 'LIKE', "%{$query}%")
                  ->orWhere('maskapai', 'LIKE', "%{$query}%")
                  ->orWhere('hotel', 'LIKE', "%{$query}%")
                  ->orWhere('durasi', 'LIKE', "%{$query}%")
                  ->orWhere('subtype', 'LIKE', "%{$query}%")
                  ->orWhere('cc', 'LIKE', "%{$query}%")
                  ->orWhere('tahun_pembuatan', 'LIKE', "%{$query}%")
                  ->orWhere('brand', 'LIKE', "%{$query}%")
                  ->orWhere('kota', 'LIKE', "%{$query}%")
                  ->orWhere('provinsi', 'LIKE', "%{$query}%")
                  ->orWhere('luas_tanah', 'LIKE', "%{$query}%")
                  ->orWhere('luas_bangunan', 'LIKE', "%{$query}%")
                  ->orWhere('kamar_tidur', 'LIKE', "%{$query}%")
                  ->orWhere('kamar_mandi', 'LIKE', "%{$query}%");
            })
            ->get();



            // dd($results);

        return view('searchPage', compact('results'));
    }
}
