<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Learning;
use App\Models\Ponpes;
use App\Models\StudentCount;

class UpdatePonpesEtcController extends Controller
{
    public function index($id)
    {
        // Fetch the ponpes data based on the user_id column
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount')
            ->find($id);

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images->sortBy('type');
            $studentCount = $ponpes->studentCount->sortBy('year');

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            return view('updater.update_ponpes_etc', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount'));
        } else {
            abort(404);
        }
    }

}
