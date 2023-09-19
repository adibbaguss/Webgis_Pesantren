<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    public function createActivities(Request $request)
    {

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi menambah data aktivitas. Periksa kembali isian Anda.');
        }

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
        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:254',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data aktivitas. Periksa kembali isian Anda.');
        }

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
}
