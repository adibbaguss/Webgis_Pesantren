<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class MapTakhasusController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::all();
        return view('admin_kemenag.map_takhasus', compact('ponpes'));
    }
}
