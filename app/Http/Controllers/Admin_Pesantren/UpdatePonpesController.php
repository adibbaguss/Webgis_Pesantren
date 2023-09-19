<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
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

        // $user = User::all();

        return view('admin_pesantren.update_ponpes', compact('ponpes', 'kecamatanOptions'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
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

        // Find the ponpes data
        $ponpes = Ponpes::find($id);

        // Update the ponpes data directly using the update method
        $ponpes->update($request->all());

        // Update the user data
        $ponpes->photo_profil = $avatarPath ?? $ponpes->photo_profil;
        $ponpes->nspp = $request->nspp;
        $ponpes->nspp = $request->nspp;
        $ponpes->name = $request->name;
        $ponpes->category = $request->category;
        $ponpes->phone_number = $request->phone_number;
        $ponpes->website = $request->website;
        $ponpes->email = $request->email;
        $ponpes->standing_date = $request->standing_date;
        $ponpes->pimpinan = $request->pimpinan;
        $ponpes->surface_area = $request->surface_area;
        $ponpes->building_area = $request->building_area;
        $ponpes->city = $request->city;
        $ponpes->subdistrict = $request->subdistrict;
        $ponpes->postal_code = $request->postal_code;
        $ponpes->address = $request->address;
        $ponpes->latitude = $request->latitude;
        $ponpes->longitude = $request->longitude;

        $ponpes->save();

        return redirect()->route('admin_pesantren.ponpes_view', ['id' => $ponpes->user_id])->with('success', 'Pondok Pesantren updated successfully!');
    }
}
