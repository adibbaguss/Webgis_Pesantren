<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Facility;
use App\Models\Instructor;
use App\Models\Learning;
use App\Models\Ponpes;
use App\Models\StudentCount;
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
            $image = $ponpes->images->sortBy('type');
            $studentCount = $ponpes->studentCount->sortBy('year');

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

        return redirect()->back()->with('success', 'Instructor ' . $instructor->name . ' Berhasil Dibuat');

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

        return redirect()->back()->with('success', 'Instructor ' . $instructor->name . ' Berhasil Diperbaharui');
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

        return redirect()->back()->with('success', 'facility ' . $facility->name . ' Berhasil Dibuat');

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

        return redirect()->back()->with('success', 'facility ' . $facility->name . ' Berhasil Diperbaharui');
    }

    public function createActivities(Request $request)
    {
        // Validate the form data

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Create a new Instructor instance
        $activities = new Activity([
            'ponpes_id' => $request->input('ponpes_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),

        ]);

        // Save the instructor data to the database
        $activities->save();

        return redirect()->back()->with('success', 'activities ' . $activities->name . ' Berhasil Dibuat');

    }

    public function destroyActivities($id)
    {

        $activities = Activity::findOrFail($id);

        if (!$activities) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $activities->delete();

        return redirect()->back()->with('success', 'Data ' . $activities->name . ' Berhasil Dihapus');
    }

    public function updateActivities(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Find the activities by ID
        $activities = Activity::find($id);

        // If activities not found, redirect back with an error message
        if (!$activities) {
            return redirect()->back()->with('error', 'activities not found.');
        }

        // Update the activities data

        $activities->ponpes_id = $request->input('ponpes_id');
        $activities->name = $request->input('name');
        $activities->description = $request->input('description');

        // Save the updated activities data to the database
        $activities->save();

        return redirect()->back()->with('success', 'activities ' . $activities->name . ' Berhasil Diperbaharui');
    }

    // learning

    public function createLearning(Request $request)
    {
        // Validate the form data
        // dd($request);

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Create a new Instructor instance
        $learning = new Learning([
            'ponpes_id' => $request->input('ponpes_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),

        ]);

        // Save the instructor data to the database
        $learning->save();

        return redirect()->back()->with('success', 'learning ' . $learning->name . ' Berhasil Dibuat');

    }

    public function destroyLearning($id)
    {

        $learning = Learning::findOrFail($id);

        if (!$learning) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $learning->delete();

        return redirect()->back()->with('success', 'Data ' . $learning->name . ' Berhasil Dihapus');
    }

    public function updateLearning(Request $request, $id)
    {
        // Validate the form data

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Find the learning by ID
        $learning = Learning::find($id);

        // If learning not found, redirect back with an error message
        if (!$learning) {
            return redirect()->back()->with('error', 'learning not found.');
        }

        // Update the learning data

        $learning->ponpes_id = $request->input('ponpes_id');
        $learning->name = $request->input('name');
        $learning->description = $request->input('description');

        // Save the updated learning data to the database
        $learning->save();

        return redirect()->back()->with('success', 'learning ' . $learning->name . ' Berhasil Diperbaharui');
    }

    // studentcount

    public function createStudentCount(Request $request)
    {
        // Validate the form data
        // dd($request);

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male_resident_count' => 'required|integer|min:0',
            'female_resident_count' => 'required|integer|min:0',
            'male_non_resident_count' => 'required|integer|min:0',
            'female_non_resident_count' => 'required|integer|min:0',
        ]);

        // Create a new Instructor instance
        $studentCount = new StudentCount([
            'ponpes_id' => $request->input('ponpes_id'),
            'year' => $request->input('year'),
            'male_resident_count' => $request->input('male_resident_count'),
            'female_resident_count' => $request->input('female_resident_count'),
            'male_non_resident_count' => $request->input('male_non_resident_count'),
            'female_non_resident_count' => $request->input('female_non_resident_count'),

        ]);

        // Save the instructor data to the database
        $studentCount->save();

        return redirect()->back()->with('success', 'Student Count Tahun' . $studentCount->year . ' Berhasil Dibuat');

    }

    public function destroyStudentCount($id)
    {

        $studentCount = StudentCount::findOrFail($id);

        if (!$studentCount) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $studentCount->delete();

        return redirect()->back()->with('success', 'Data Tahun ' . $studentCount->year . ' Berhasil Dihapus');
    }

    public function updateStudentCount(Request $request, $id)
    {
        // Validate the form data

        $request->validate([
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male_resident_count' => 'required|integer|min:0',
            'female_resident_count' => 'required|integer|min:0',
            'male_non_resident_count' => 'required|integer|min:0',
            'female_non_resident_count' => 'required|integer|min:0',
        ]);

        // Find the StudentCount by ID
        $studentCount = StudentCount::find($id);

        // If StudentCount not found, redirect back with an error message
        if (!$studentCount) {
            return redirect()->back()->with('error', 'Student Count not found.');
        }

        // Update the StudentCount data

        $studentCount->ponpes_id = $request->input('ponpes_id');
        $studentCount->year = $request->input('year');
        $studentCount->male_resident_count = $request->input('male_resident_count');
        $studentCount->female_resident_count = $request->input('female_resident_count');
        $studentCount->male_non_resident_count = $request->input('male_non_resident_count');
        $studentCount->female_non_resident_count = $request->input('female_non_resident_count');

        // Save the updated StudentCount data to the database
        $studentCount->save();

        return redirect()->back()->with('success', 'StudentCount Tahun ' . $studentCount->year . ' Berhasil Diperbaharui');
    }

}
