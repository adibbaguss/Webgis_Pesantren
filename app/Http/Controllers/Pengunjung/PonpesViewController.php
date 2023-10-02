<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

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

    public function ponpesView($id)
    {
        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount', 'school', 'ProgramTakhasus')
            ->find($id);
        // $user = User::all();

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

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('pengunjung.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'school', 'attributeTable', 'attributeNames', 'takhasus'));

        } else {
            abort(404);
        }
    }

}
