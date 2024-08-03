<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umrah;
use App\Models\Otomotif;
use App\Models\Properti;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $umrah = Umrah::orderBy('created_at', 'desc')->take(3)->get();

        $otomotif = Otomotif::select('otomotif.*')
        ->join('spesifikasi_otomotif', 'otomotif.id', '=', 'spesifikasi_otomotif.otomotif_id')
        ->with('spesifikasi', 'fotos')
        ->orderBy('spesifikasi_otomotif.status_seller', 'asc') // Ganti `some_column` dengan kolom yang benar
        ->take(12)
        ->get();




        $properti = Properti::orderBy('created_at', 'desc')->take(12)->get();


        return view('welcome', compact('umrah', 'otomotif', 'properti'));
    }
}
