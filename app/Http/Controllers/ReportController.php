<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();

        return view('admin.dashboard', compact('reports'));
    }

}
