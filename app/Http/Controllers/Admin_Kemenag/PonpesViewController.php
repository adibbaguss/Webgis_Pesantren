<?php

namespace App\Http\Controllers\Admin_Kemenag;

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
        // Mengambil data ponpes berdasarkan ID
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'studentCount', 'instructors', 'images', 'school', 'ProgramTakhasus')
            ->find($id);
        $user = User::all();

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
            return view('admin_kemenag.ponpes_view', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount', 'jumbotronImage', 'regulerImages', 'school', 'attributeTable', 'attributeNames', 'takhasus'));

        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {

        $ponpes = Ponpes::findOrFail($id);

        if (!$ponpes) {

            return redirect()->route('admin_kemenag.data_ponpes')->with('error', 'Ponpes not found.');
        }

        if ($ponpes->photo_profil) {
            if (file_exists(public_path('images/ponpes/profile/' . $ponpes->photo_profil))) {
                unlink(public_path('images/ponpes/profile/' . $ponpes->photo_profil));
            } else {
                dd('File does not exists.');
            }
        }
        $ponpes->delete();

        return redirect()->route('admin_kemenag.data_ponpes')->with('success', 'Ponpes deleted successfully.');
    }

}
