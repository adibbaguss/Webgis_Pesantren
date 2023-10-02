<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class MapTakhasusController extends Controller
{

    public function index()
    {
        $ponpes = Ponpes::all();
        return view('pengunjung.map_takhasus', compact('ponpes'));
    }
}
