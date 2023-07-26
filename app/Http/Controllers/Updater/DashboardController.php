<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('updater.dashboard');
    }
}
