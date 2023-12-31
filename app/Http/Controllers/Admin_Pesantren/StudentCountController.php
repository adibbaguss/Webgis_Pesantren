<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\StudentCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentCountController extends Controller
{
    // studentcount

    public function createStudentCount(Request $request)
    {
        // Validate the form data
        // dd($request);

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male_resident_count' => 'required|integer|min:0',
            'female_resident_count' => 'required|integer|min:0',
            'male_non_resident_count' => 'required|integer|min:0',
            'female_non_resident_count' => 'required|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi menambah data jumlah santri. Periksa kembali isian Anda.');
        }

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

        return redirect()->back()->with('success', 'Student Count Tahun ' . $studentCount->year . ' Berhasil Dibuat');

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
        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male_resident_count' => 'required|integer|min:0',
            'female_resident_count' => 'required|integer|min:0',
            'male_non_resident_count' => 'required|integer|min:0',
            'female_non_resident_count' => 'required|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data jumlah santri. Periksa kembali isian Anda.');
        }

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

        return redirect()->back()->with('success', 'Student Count Tahun ' . $studentCount->year . ' Berhasil Diperbaharui');
    }
}
