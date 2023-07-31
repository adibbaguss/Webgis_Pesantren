<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\CategoryReport;
use App\Models\Ponpes;
use App\Models\User;

class PonpesViewController extends Controller
{
    public function index($id)
    {
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount', 'user')
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
            $user = $ponpes->user;

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            return view('viewer.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'user', 'category_report'));
        } else {
            abort(404);
        }
    }
}
