<?php

namespace App\Http\Controllers\Admin_Kemenag\Madin;

use App\Http\Controllers\Controller;
use App\Models\Madin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CreateMadinController extends Controller
{
    public function index()
    {
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

        return view('admin_kemenag.madin.create_madin', compact('kecamatanOptions'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'nsdt' => ['required', 'numeric', 'unique:madin', 'digits_between:10,20'],
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'unique:madin'],
            'website' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:madin'],
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
    }

    //create tabel ponpes
    protected function create(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $avatarPath = null;
        if (isset($data['base64image']) && $data['base64image'] != '0') {
            $folderPath = public_path('images/ponpes/profile');
            $image_parts = explode(";base64,", $data['base64image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = time() . '.' . $image_type;
            $file = $folderPath . '/' . $filename;
            file_put_contents($file, $image_base64);

            $avatarPath = $filename;
        }

        $madin = Madin::create([
            'photo_profil' => $avatarPath,
            'nsdt' => $data['nsdt'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'website' => $data['website'],
            'email' => $data['email'],
            'standing_date' => $data['standing_date'],
            'pimpinan' => $data['pimpinan'],
            'surface_area' => $data['surface_area'],
            'building_area' => $data['building_area'],
            'city' => $data['city'],
            'subdistrict' => $data['subdistrict'],
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        $facilityData = [
            'madin_id' => $madin->id,
            'mushola' => 0,
            'kelas_pengajaran' => 0,
            'perpustakaan' => 0,
            'ruang_guru' => 0,
            'fasilitas_audio_visual' => 0,
            'kamar_mandi' => 0,
            'ruangan_administrasi' => 0,
        ];

        $madin->facility_madin()->create($facilityData);

        $nameMadin = $madin->name;
        return Redirect::route('admin_kemenag.data_madin')->with('success', 'Berhasil Menambahkan ' . $nameMadin);

    }

}
