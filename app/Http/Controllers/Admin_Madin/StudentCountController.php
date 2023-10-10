<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\StudentCountMadin;
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
            'madin_id' => 'required|max:20|exists:madin,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male' => 'required|integer|min:0',
            'female' => 'required|integer|min:0',

        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi menambah data jumlah santri. Periksa kembali isian Anda.');
        }

        // Create a new Instructor instance
        $studentCount = new StudentCountMadin([
            'madin_id' => $request->input('madin_id'),
            'year' => $request->input('year'),
            'male' => $request->input('male'),
            'female' => $request->input('female'),

        ]);

        // Save the instructor data to the database
        $studentCount->save();

        return redirect()->back()->with('success', 'Student Count Tahun ' . $studentCount->year . ' Berhasil Dibuat');

    }

    public function destroyStudentCount($id)
    {

        $studentCount = StudentCountMadin::findOrFail($id);

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
            'madin_id' => 'required|max:20|exists:madin,id',
            'year' => 'required|integer|min:1900|max:3000',
            'male' => 'required|integer|min:0',
            'female' => 'required|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data jumlah murid. Periksa kembali isian Anda.');
        }

        // Find the StudentCount by ID
        $studentCount = StudentCountMadin::find($id);

        // If StudentCount not found, redirect back with an error message
        if (!$studentCount) {
            return redirect()->back()->with('error', 'Student Count not found.');
        }

        // Update the StudentCount data

        $studentCount->madin_id = $request->input('madin_id');
        $studentCount->year = $request->input('year');
        $studentCount->male = $request->input('male');
        $studentCount->female = $request->input('female');

        // Save the updated StudentCount data to the database
        $studentCount->save();

        return redirect()->back()->with('success', 'Student Count Tahun ' . $studentCount->year . ' Berhasil Diperbaharui');
    }
}
