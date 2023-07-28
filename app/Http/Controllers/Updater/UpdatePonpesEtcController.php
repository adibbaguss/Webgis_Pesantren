<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Facility;
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
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
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

        return redirect()->back()->with('success', 'Instructor ' . $instructor->name . ' created successfully.');

    }

    public function destroyInstructors($id)
    {

        $instructors = Instructor::findOrFail($id);

        if (!$instructors) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $instructors->delete();

        return redirect()->back()->with('success', 'Data ' . $instructors->name . ' Berhasil Dihapus');
    }

    public function updateInstructors(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'nik' => 'required|unique:instructors,nik,' . $id,
            'name' => 'required|string|max:100',
            'gender' => 'required|string',
            'expertise' => 'required|string',
            'status' => 'required|string',
        ]);

        // Find the instructor by ID
        $instructor = Instructor::find($id);

        // If instructor not found, redirect back with an error message
        if (!$instructor) {
            return redirect()->back()->with('error', 'Instructor not found.');
        }

        // Update the instructor data
        $instructor->ponpes_id = $request->input('ponpes_id');
        $instructor->nik = $request->input('nik');
        $instructor->name = $request->input('name');
        $instructor->gender = $request->input('gender');
        $instructor->expertise = $request->input('expertise');
        $instructor->status = $request->input('status');

        // Save the updated instructor data to the database
        $instructor->save();

        return redirect()->back()->with('success', 'Instructor ' . $instructor->name . ' updated successfully.');
    }

    // facility

    public function createFacility(Request $request)
    {
        // Validate the form data

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'count' => 'required|integer',
        ]);

        // Create a new Instructor instance
        $facility = new Facility([
            'ponpes_id' => $request->input('ponpes_id'),
            'name' => $request->input('name'),
            'count' => $request->input('count'),

        ]);

        // Save the instructor data to the database
        $facility->save();

        return redirect()->back()->with('success', 'facility ' . $facility->name . ' created successfully.');

    }

    public function destroyFacility($id)
    {

        $facility = Facility::findOrFail($id);

        if (!$facility) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $facility->delete();

        return redirect()->back()->with('success', 'Data ' . $facility->name . ' Berhasil Dihapus');
    }

    public function updateFacility(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'count' => 'required|integer',
        ]);

        // Find the facility by ID
        $facility = Facility::find($id);

        // If facility not found, redirect back with an error message
        if (!$facility) {
            return redirect()->back()->with('error', 'facility not found.');
        }

        // Update the facility data

        $facility->ponpes_id = $request->input('ponpes_id');
        $facility->name = $request->input('name');
        $facility->count = $request->input('count');

        // Save the updated facility data to the database
        $facility->save();

        return redirect()->back()->with('success', 'facility ' . $facility->name . ' updated successfully.');
    }

}
