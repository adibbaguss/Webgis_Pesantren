<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Takhasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramTakhasusController extends Controller
{
    public function createTakhasus(Request $request)
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
        $programTakhasus = new Takhasus([
            'ponpes_id' => $request->input('ponpes_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),

        ]);

        // Save the instructor data to the database
        $programTakhasus->save();

        return redirect()->back()->with('success', 'takhasus ' . $programTakhasus->name . ' Berhasil Dibuat');

    }

    public function destroyTakhasus($id)
    {

        $programTakhasus = Takhasus::findOrFail($id);

        if (!$programTakhasus) {

            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }

        $programTakhasus->delete();

        return redirect()->back()->with('success', 'Data ' . $programTakhasus->name . ' Berhasil Dihapus');
    }

    public function updateTakhasus(Request $request, $id)
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

        // Find the programTakhasus by ID
        $programTakhasus = Takhasus::find($id);

        // If programTakhasus not found, redirect back with an error message
        if (!$programTakhasus) {
            return redirect()->back()->with('error', 'program takhasus not found.');
        }

        // Update the programTakhasus data

        $programTakhasus->ponpes_id = $request->input('ponpes_id');
        $programTakhasus->name = $request->input('name');
        $programTakhasus->description = $request->input('description');

        // Save the updated programTakhasus data to the database
        $programTakhasus->save();

        return redirect()->back()->with('success', 'programTakhasus ' . $programTakhasus->name . ' Berhasil Diperbaharui');
    }
}
