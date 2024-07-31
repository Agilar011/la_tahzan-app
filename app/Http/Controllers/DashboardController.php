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

        $otomotif = Otomotif::orderBy('created_at', 'desc')->take(12)->get();

        $properti = properti::orderBy('created_at', 'desc')->take(12)->get();


        return view('welcome', compact('umrah', 'otomotif', 'properti'));
    }
}
