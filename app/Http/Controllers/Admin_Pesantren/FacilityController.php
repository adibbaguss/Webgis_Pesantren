<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    // facility

    public function updateFacility(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'ponpes_id' => 'required|max:20|exists:ponpes,id',
            'asrama_lk' => 'required|integer',
            'asrama_pr' => 'required|integer',
            'masjid' => 'required|integer',
            'aula_kegiatan' => 'required|integer',
            'ruang_pembelajaran' => 'required|integer',
            'perpustakaan' => 'required|integer',
            'kantor_pengajar' => 'required|integer',
            'dapur' => 'required|integer',
            'kantin' => 'required|integer',
            'tempat_olahraga' => 'required|integer',
            'kamar_mandi' => 'required|integer',
            'ruang_kesehatan' => 'required|integer',
            'kamar_pengajar' => 'required|integer',
            'lab_komputer' => 'required|integer',
            'lapangan_pertanian' => 'required|integer',
            'lapangan_pertenakan' => 'required|integer',
            'laundry' => 'required|integer',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi memperbaharui data fasilitas. Periksa kembali isian Anda.');
        }

        // Find the facility by ID
        $facility = Facility::find($id);

        // If facility not found, redirect back with an error message
        if (!$facility) {
            return redirect()->back()->with('error', 'facility not found.');
        }

        // Update the facility data
        $facility->update([
            'asrama_lk' => $request->input('asrama_lk'),
            'asrama_pr' => $request->input('asrama_pr'),
            'masjid' => $request->input('masjid'),
            'aula_kegiatan' => $request->input('aula_kegiatan'),
            'ruang_pembelajaran' => $request->input('ruang_pembelajaran'),
            'perpustakaan' => $request->input('perpustakaan'),
            'kantor_pengajar' => $request->input('kantor_pengajar'),
            'dapur' => $request->input('dapur'),
            'kantin' => $request->input('kantin'),
            'tempat_olahraga' => $request->input('tempat_olahraga'),
            'kamar_mandi' => $request->input('kamar_mandi'),
            'ruang_kesehatan' => $request->input('ruang_kesehatan'),
            'kamar_pengajar' => $request->input('kamar_pengajar'),
            'lab_komputer' => $request->input('lab_komputer'),
            'lapangan_pertanian' => $request->input('lapangan_pertanian'),
            'lapangan_pertenakan' => $request->input('lapangan_pertenakan'),
            'laundry' => $request->input('laundry'),
        ]);
        return redirect()->back()->with('success', 'Fasilitas Berhasil Diperbaharui');
    }
}
