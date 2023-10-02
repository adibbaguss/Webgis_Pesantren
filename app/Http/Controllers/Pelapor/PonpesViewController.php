<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\CategoryReport;
use App\Models\Ponpes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function index($id)
    {

        $attributeNames = $this->attributeNames;
        $attributeTable = $this->attributeTable;
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount', 'school', 'ProgramTakhasus')
            ->find($id);
        // $user = User::all();

        $category_report = CategoryReport::all();

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $school = $ponpes->school;
            $studentCount = $ponpes->studentCount->sortBy('year');
            $takhasus = $ponpes->programTakhasus;
            $pelapor = Auth::User();

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            $jumbotronImage = $image->where('type', 'jumbotron')->first();
            $regulerImages = $image->where('type', 'reguler');

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            // dd($studentCount);
            return view('pelapor.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'pelapor', 'category_report', 'school', 'attributeTable', 'attributeNames', 'takhasus'));

        } else {
            abort(404);
        }
    }
}
