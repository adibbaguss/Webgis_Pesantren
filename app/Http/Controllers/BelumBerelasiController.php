<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BelumBerelasiController extends Controller
{
    public function index()
    {
        return view('layouts.tidak_berelasi');
    }
}
