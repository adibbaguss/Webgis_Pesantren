<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\madin;

class UpdateMadinEtcController extends Controller
{

    public function index($id)
    {

        // Fetch the madin data based on the user_id column
        $madin = Madin::with('activities_madin', 'facility_madin', 'learning_madin', 'studentCount_madin', 'instructors_madin', 'images_madin')
            ->find($id);

        if ($madin) {
            $activities = $madin->activities_madin;
            $facility = $madin->facility_madin;
            $learning = $madin->learning_madin;
            $instructors = $madin->instructors_madin;
            $image = $madin->images_madin->sortBy('type');
            $studentCount = $madin->studentCount_madin->sortBy('year');

            // Mengirim data madin ke halaman view_madin.blade.php
            return view('admin_madin.update_madin_etc', compact('madin', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount'));
        } else {
            abort(404);
        }
    }

}
