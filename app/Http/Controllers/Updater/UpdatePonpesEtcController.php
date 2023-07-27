<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Ponpes;
use Illuminate\Http\Request;

class UpdatePonpesEtcController extends Controller
{
    public function index($id)
    {
        // Fetch the ponpes data based on the user_id column
        $ponpes = Ponpes::with('activities', 'facility', 'learning', 'instructors', 'images', 'studentCount')
            ->find($id);

        if ($ponpes) {
            $activities = $ponpes->activities;
            $facility = $ponpes->facility;
            $learning = $ponpes->learning;
            $instructors = $ponpes->instructors;
            $image = $ponpes->images;
            $studentCount = $ponpes->studentCount; // Typo fixed here

            // Mengirim data ponpes ke halaman view_ponpes.blade.php
            return view('updater.update_ponpes_etc', compact('ponpes', 'activities', 'facility', 'learning', 'instructors', 'image', 'studentCount'));
        } else {
            abort(404);
        }
    }

    public function createInstructors(Request $request)
    {
        // Validate the form data

        $request->validate([
            'ponpes_id' => 'required|exists:ponpes,id',
            'nik' => 'required|unique:instructors,nik',
            'name' => 'required|string|max:100',
            'gender' => 'required|string',
            'expertise' => 'required|string',
            'status' => 'required|string',
        ]);

        // Create a new Instructor instance
        $instructor = new Instructor([
            'ponpes_id' => $request->input('ponpes_id'),
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'expertise' => $request->input('expertise'),
            'status' => $request->input('status'),
        ]);

        // Save the instructor data to the database
        $instructor->save();

        return redirect()->back()->with('success', 'Instructor created successfully.');

    }

}
