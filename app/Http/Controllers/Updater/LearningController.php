<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Learning;
use Illuminate\Http\Request;

class LearningController extends Controller
{
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
}
