<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\User;

class PonpesViewController extends Controller
{
    public function view($id)
    {

        $updater = User::findOrFail($id);

        // Get the user's ID
        $updater_id = $updater->id;
        // dd($updater_id);

        // Fetch the ponpes data based on the user_id column
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'studentCount', 'instructors', 'images')
            ->where('user_id', $updater_id)
            ->first(); // Use first() instead of find()

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $studentCount = $ponpes->studentCount;

            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('updater.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages'));
        } else {
            abort(404);
        }
    }

    // public function destroy($id)
    // {

    //     $ponpes = Ponpes::findOrFail($id);

    //     if (!$ponpes) {

    //         return redirect()->route('updater.data_ponpes')->with('error', 'Ponpes not found.');
    //     }

    //     if ($ponpes->photo_profil) {
    //         if (file_exists(public_path('images/ponpes/profile/' . $ponpes->photo_profil))) {
    //             unlink(public_path('images/ponpes/profile/' . $ponpes->photo_profil));
    //         } else {
    //             dd('File does not exists.');
    //         }
    //     }
    //     $ponpes->delete();

    //     return redirect()->route('updater.data_ponpes')->with('success', 'Ponpes deleted successfully.');
    // }

}
