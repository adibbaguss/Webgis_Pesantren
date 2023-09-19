<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorsController extends Controller
{
    public function createInstructors(Request $request)
    {
        // Validate the form data

        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'nik' => 'required|string|max:20|unique:instructors,nik',
            'name' => 'required|string|max:100',
            'gender' => 'required|string',
            'expertise' => 'required|string',
            'status' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Send the validation errors to the view
                ->withInput() // Keep the input values in the form
                ->with('error', 'Terjadi kesalahan validasi menambah data pengajar. Periksa kembali isian Anda.');
            // You can also use ->with('error', 'Terjadi kesalahan validasi. Periksa kembali isian Anda.');
        }
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
        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'nik' => 'required|string|max:20|unique:instructors,nik,' . $id,
            'name' => 'required|string|max:100',
            'gender' => 'required|string',
            'expertise' => 'required|string',
            'status' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Send the validation errors to the view
                ->withInput() // Keep the input values in the form
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data pengajar. Periksa kembali isian Anda.');
            // You can also use ->with('error', 'Terjadi kesalahan validasi. Periksa kembali isian Anda.');
        }

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

}
