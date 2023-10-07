<?php

namespace App\Http\Controllers\Admin_Kemenag\Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateMadinController extends Controller
{
    public function index($id)
    {
        $madin = Madin::all()
            ->find($id);

        $kecamatanOptions = [
            'Limpung',
            'Pecalungan',
            'Bandar',
            'Banyuputih',
            'Batang',
            'Bawang',
            'Blado',
            'Gringsing',
            'Kandeman',
            'Reban',
            'Subah',
            'Tersono',
            'Tulis',
            'Warungasem',
            'Wonotunggal',
        ];

        $user = User::all();

        return view('admin_kemenag.madin.update_madin', compact('madin', 'kecamatanOptions', 'user'));

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'user_id' => ['required', 'unique:madin,user_id,' . $id],
            'nsdt' => ['required', 'numeric', 'digits_between:10,20', 'unique:madin,nsdt,' . $id],
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:madin,phone_number,' . $id],
            'website' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:madin,email,' . $id],
            'standing_date' => ['required', 'date'],
            'pimpinan' => ['required', 'string'],
            'surface_area' => ['required', 'integer'],
            'building_area' => ['required', 'integer'],
            'city' => ['string'],
            'subdistrict' => ['required', 'string'],
            'postal_code' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);
        // dd($request->all());

        // Find the madin data
        $madin = Madin::findOrFail($id);

        // Update the madin data directly using the update method
        $madin->update($request->all());

        return redirect()->route('admin_kemenag.madin.madin_view', ['id' => $id])->with('success', 'Madarasah  Diniyah/TPQ updated successfully!');
    }
}
