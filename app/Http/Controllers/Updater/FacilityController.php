<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
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
}
