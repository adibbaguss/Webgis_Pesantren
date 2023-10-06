<?php

namespace App\Http\Controllers\Admin_Kemenag\Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use App\Models\User;

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

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('admin_kemenag.madin.madin_view', compact('madin', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages'));

        } else {
            abort(404);
        }
    }

    // public function destroy($id)
    // {

    //     $madin = Madin::findOrFail($id);

    //     if (!$madin) {

    //         // return redirect()->route('admin_kemenag.madin.data_madin')->with('error', 'madin not found.');
    //     }

    //     if ($madin->photo_profil) {
    //         if (file_exists(public_path('images/ponpes/profile/' . $madin->photo_profil))) {
    //             unlink(public_path('images/ponpes/profile/' . $madin->photo_profil));
    //         } else {
    //             dd('File does not exists.');
    //         }
    //     }
    //     $madin->delete();

    //     return redirect()->route('admin_kemenag.madin.data_madin')->with('success', 'Madin deleted successfully.');
    // }

}
