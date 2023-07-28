<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use App\Models\User;
use Illuminate\Http\Request;

class UpdatePonpesController extends Controller
{
    public function index($id)
    {
        $ponpes = Ponpes::all()
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

        return view('admin.update_ponpes', compact('ponpes', 'kecamatanOptions', 'user'));

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'user_id' => ['required', 'unique:ponpes,user_id,' . $id],
            'nspp' => ['required', 'numeric', 'digits_between:10,20', 'unique:ponpes,nspp,' . $id],
            'name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:ponpes,phone_number,' . $id],
            'website' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:ponpes,email,' . $id],
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

        // Find the ponpes data
        $ponpes = Ponpes::findOrFail($id);

        // Update the ponpes data directly using the update method
        $ponpes->update($request->all());

        return redirect()->route('admin.ponpes_view', ['id' => $id])->with('success', 'Pondok Pesantren updated successfully!');
    }
}
