<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\CategoryReport;
use App\Models\Ponpes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PonpesViewController extends Controller
{
    public function index($id)
    {
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount')
            ->find($id);
        // $user = User::all();

        $category_report = CategoryReport::all();

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $studentCount = $ponpes->studentCount->sortBy('year');

            $viewer = Auth::User();

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('viewer.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'viewer', 'category_report'));

        } else {
            abort(404);
        }
    }
}
