<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use App\Models\User;

class MadinViewController extends Controller
{

    public function view($id)
    {

        $admin_madin = User::findOrFail($id);

        // Get the user's ID
        $admin_madin_id = $admin_madin->id;
        // dd($admin_madin_id);

        // Fetch the madin data based on the user_id column
        $madin = Madin::with('activities_madin', 'facility_madin', 'learning_madin', 'studentCount_madin', 'instructors_madin', 'images_madin')
            ->where('user_id', $admin_madin_id)
            ->first(); // Use first() instead of find()
        // dd($madin);
        if ($madin) {
            $activities = $madin->activities_madin;
            $facility = $madin->facility_madin;
            $learning = $madin->learning_madin;
            $instructors = $madin->instructors_madin;
            $image = $madin->images_madin;
            $school = $madin->school_madin;
            $studentCount = $madin->studentCount_madin->sortBy('year');
            $takhasus = $madin->programTakhasus_madin;
            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // dd($school);
            // Mengirim data madin ke halaman view_madin.blade.php
            // dd($studentCount);
            return view('admin_madin.madin_view', compact('madin', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages'));

        } else {
            abort(404);
        }
    }

}
