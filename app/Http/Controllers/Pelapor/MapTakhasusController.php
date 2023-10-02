<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class MapTakhasusController extends Controller
{

    public function index()
    {
        $ponpes = Ponpes::all();
        return view('pelapor.map_takhasus', compact('ponpes'));
    }
}
