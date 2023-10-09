<?php

namespace App\Http\Controllers\Pelapor\Madin;

use App\Http\Controllers\Controller;
use App\Models\CategoryReportMadin;
use App\Models\Madin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MadinViewController extends Controller
{

    public function index($id)
    {

        // Mengambil data ponpes berdasarkan ID
        $madin = Madin::with('activities_madin', 'facility_madin', 'learning_madin', 'studentCount_madin', 'instructors_madin', 'images_madin')
            ->find($id);
        $user = User::all();

        if ($madin) {
            $activities = $madin->activities_madin;
            $facility = $madin->facility_madin;
            $learning = $madin->learning_madin;
            $instructors = $madin->instructors_madin;
            $image = $madin->images_madin;
            $studentCount = $madin->studentCount_madin->sortBy('year');

            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');
            $pelapor = Auth::User();
            $category_report = CategoryReportMadin::all();

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('pelapor.madin.madin_view', compact('madin', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'pelapor', 'category_report'));

        } else {
            abort(404);
        }
    }
}
