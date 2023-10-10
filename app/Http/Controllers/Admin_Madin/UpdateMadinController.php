<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
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

        // $user = User::all();

        return view('admin_madin.update_madin', compact('madin', 'kecamatanOptions'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
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

        $avatarPath = null;

        if ($request->has('base64image') && $request->input('base64image') !== '0') {
            $folderPath = public_path('images/ponpes/profile');
            $image_parts = explode(";base64,", $request->input('base64image'));

            // Check if the image data exists before decoding
            if (count($image_parts) > 1) {
                $image_data = $image_parts[1];
                $image_base64 = base64_decode($image_data);

                // Generate a unique filename for the image
                $filename = time() . '.jpg'; // You can use other image formats as well

                $file = $folderPath . '/' . $filename;
                file_put_contents($file, $image_base64);

                $avatarPath = $filename;
            }
        }

        // Find the madin data
        $madin = Madin::find($id);

        // Update the madin data directly using the update method
        $madin->update($request->all());

        // Update the user data
        $madin->photo_profil = $avatarPath ?? $madin->photo_profil;
        $madin->nsdt = $request->nsdt;
        $madin->name = $request->name;
        $madin->phone_number = $request->phone_number;
        $madin->website = $request->website;
        $madin->email = $request->email;
        $madin->standing_date = $request->standing_date;
        $madin->pimpinan = $request->pimpinan;
        $madin->surface_area = $request->surface_area;
        $madin->building_area = $request->building_area;
        $madin->city = $request->city;
        $madin->subdistrict = $request->subdistrict;
        $madin->postal_code = $request->postal_code;
        $madin->address = $request->address;
        $madin->latitude = $request->latitude;
        $madin->longitude = $request->longitude;

        $madin->save();

        return redirect()->route('admin_madin.madin_view', ['id' => $madin->user_id])->with('success', 'Pondok madin updated successfully!');
    }
}
