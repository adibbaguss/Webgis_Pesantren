<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function updateSchool(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'sd' => 'nullable|string|max:254',
            'smp' => 'nullable|string|max:254',
            'sma' => 'nullable|string|max:254',
            'smk' => 'nullable|string|max:254',
            'pt' => 'nullable|string|max:254',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data fasilitas. Periksa kembali isian Anda.');
        }

        // Find the facility by ID
        $school = School::find($id);

        // If school not found, redirect back with an error message
        if (!$school) {
            return redirect()->back()->with('error', 'school not found.');
        }

        // Update the school data
        $school->update([
            'sd' => $request->input('sd'),
            'smp' => $request->input('smp'),
            'sma' => $request->input('sma'),
            'smk' => $request->input('smk'),
            'pt' => $request->input('pt'),
        ]);
        return redirect()->back()->with('success', 'Sekolah Berhasil Diperbaharui');
    }
}
