<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Learning;
use App\Models\Ponpes;
use App\Models\StudentCount;

class UpdatePonpesEtcController extends Controller
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

    public function index($id)
    {

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        // Fetch the ponpes data based on the user_id column
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount', 'school', 'programTakhasus')
            ->find($id);

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images->sortBy('type');
            $studentCount = $ponpes->studentCount->sortBy('year');
            $school = $ponpes->school;
            $programTakhasus = $ponpes->programTakhasus;

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            return view('admin_pesantren.update_ponpes_etc', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'school', 'attributeTable', 'attributeNames', 'programTakhasus'));
        } else {
            abort(404);
        }
    }

}
