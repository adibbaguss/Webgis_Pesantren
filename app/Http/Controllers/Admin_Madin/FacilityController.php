<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\FacilityMadin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    // facility

    public function updateFacility(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'madin_id' => 'required|max:20|exists:madin,id',
            'mushola' => 'required|integer',
            'kelas_pengajaran' => 'required|integer',
            'perpustakaan' => 'required|integer',
            'ruang_guru' => 'required|integer',
            'fasilitas_audio_visual' => 'required|integer',
            'kamar_mandi' => 'required|integer',
            'ruangan_administrasi' => 'required|integer',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data fasilitas. Periksa kembali isian Anda.');
        }

        // Find the facility by ID
        $facility = FacilityMadin::find($id);

        // If facility not found, redirect back with an error message
        if (!$facility) {
            return redirect()->back()->with('error', 'facility not found.');
        }

        // Update the facility data
        $facility->update([
            'mushola' => $request->input('mushola'),
            'kelas_pengajaran' => $request->input('kelas_pengajaran'),
            'perpustakaan' => $request->input('perpustakaan'),
            'ruang_guru' => $request->input('ruang_guru'),
            'fasilitas_audio_visual' => $request->input('fasilitas_audio_visual'),
            'kamar_mandi' => $request->input('kamar_mandi'),
            'ruangan_administrasi' => $request->input('ruangan_administrasi'),
        ]);
        return redirect()->back()->with('success', 'Fasilitas Berhasil Diperbaharui');
    }
}
