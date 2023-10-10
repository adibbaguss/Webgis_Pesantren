<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\LearningMadin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningController extends Controller
{
    // learning

    public function createLearning(Request $request)
    {

        // dd($request);

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'madin_id' => 'required|max:20|exists:madin,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi menambah data pembelajaran. Periksa kembali isian Anda.');
        }

        // Create a new Instructor instance
        $learning = new LearningMadin([
            'madin_id' => $request->input('madin_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),

        ]);

        // Save the instructor data to the database
        $learning->save();

        return redirect()->back()->with('success', 'learning ' . $learning->name . ' Berhasil Dibuat');

    }

    public function destroyLearning($id)
    {

        $learning = LearningMadin::findOrFail($id);

        if (!$learning) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $learning->delete();

        return redirect()->back()->with('success', 'Data ' . $learning->name . ' Berhasil Dihapus');
    }

    public function updateLearning(Request $request, $id)
    {
        // Validate the form data

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'madin_id' => 'required|max:20|exists:madin,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data pembelajaran. Periksa kembali isian Anda.');
        }
        // Find the learning by ID
        $learning = LearningMadin::find($id);

        // If learning not found, redirect back with an error message
        if (!$learning) {
            return redirect()->back()->with('error', 'learning not found.');
        }

        // Update the learning data

        $learning->madin_id = $request->input('madin_id');
        $learning->name = $request->input('name');
        $learning->description = $request->input('description');

        // Save the updated learning data to the database
        $learning->save();

        return redirect()->back()->with('success', 'learning ' . $learning->name . ' Berhasil Diperbaharui');
    }
}
