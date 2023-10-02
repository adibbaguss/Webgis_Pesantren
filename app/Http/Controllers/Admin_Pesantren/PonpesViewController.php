<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\User;

class PonpesViewController extends Controller
{

    private $attributeNames = [
        'sd' => 'SD/MI',
        'smp' => 'SMP/MTs',
        'sma' => 'SMA/MA',
        'smk' => 'SMK',
        'pt' => 'Perguruan Tinggi',
    ];

    private $attributeTable = [
        'sd', 'smp', 'sma', 'smk', 'pt',
    ];

    public function view($id)
    {
        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        $admin_pesantren = User::findOrFail($id);

        // Get the user's ID
        $admin_pesantren_id = $admin_pesantren->id;
        // dd($admin_pesantren_id);

        // Fetch the ponpes data based on the user_id column
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'studentCount', 'instructors', 'images', 'school', 'programTakhasus')
            ->where('user_id', $admin_pesantren_id)
            ->first(); // Use first() instead of find()

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $school = $ponpes->school;
            $studentCount = $ponpes->studentCount->sortBy('year');
            $takhasus = $ponpes->programTakhasus;
            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // dd($school);
            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('admin_pesantren.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'school', 'attributeTable', 'attributeNames', 'takhasus'));
        } else {
            abort(404);
        }
    }

}
