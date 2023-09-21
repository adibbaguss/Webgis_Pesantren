<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CreatePonpesController extends Controller
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

        return view('admin_kemenag.create_ponpes', compact('kecamatanOptions'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'nspp' => ['required', 'numeric', 'unique:ponpes', 'digits_between:10,20'],
            'name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'phone_number' => ['required', 'unique:ponpes'],
            'website' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:ponpes'],
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

        $ponpes = Ponpes::create([
            'photo_profil' => $avatarPath,
            'nspp' => $data['nspp'],
            'name' => $data['name'],
            'category' => $data['category'],
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
            'ponpes_id' => $ponpes->id,
            'asrama_lk' => 0,
            'asrama_pr' => 0,
            'masjid' => 0,
            'aula_kegiatan' => 0,
            'ruang_pembelajaran' => 0,
            'perpustakaan' => 0,
            'kantor_pengajar' => 0,
            'dapur' => 0,
            'kantin' => 0,
            'tempat_olahraga' => 0,
            'kamar_mandi' => 0,
            'ruang_kesehatan' => 0,
            'kamar_pengajar' => 0,
            'lab_komputer' => 0,
            'lapangan_pertanian' => 0,
            'lapangan_pertenakan' => 0,
            'laundry' => 0,
        ];

        $ponpes->facility()->create($facilityData);

        $namePonpes = $ponpes->name;
        return Redirect::route('admin_kemenag.data_ponpes')->with('success', 'Berhasil Menambahkan ' . $namePonpes);

    }

}
