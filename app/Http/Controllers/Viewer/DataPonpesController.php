<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Illuminate\Http\Request;

class DataPonpesController extends Controller
{
    public function index()
    {
        $ponpes = Ponpes::all();

        return view('viewer.data_ponpes', compact('ponpes'));

    }

    public function ponpesSearch(Request $request)
    {
        $query = $request->input('query');

        $ponpes = Ponpes::where('name', 'like', '%' . $query . '%')
            ->orWhere('city', 'like', '%' . $query . '%')
            ->orWhere('subdistrict', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();

        return view('viewer.data_ponpes', compact('ponpes'));
    }
}
