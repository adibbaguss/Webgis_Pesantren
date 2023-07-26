<?php

namespace App\Http\Controllers;

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

        return view('admin.create_ponpes', compact('kecamatanOptions'));
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

        $namePonpes = $ponpes->name;
        return Redirect::route('admin.data_ponpes')->with('success', 'Berhasil Menambahkan ' . $namePonpes);

        // dd($ponpes);
        // $newPonpesId = $ponpes->id;

        // Session::flash('success', 'Langkah 1 Berhasil');

        // return redirect()->route('create_ponpes_2', ['id' => $newPonpesId]);
    }

    //create table image
    // protected function ShowStepTwo($id)
    // {
    //     $ponpes = Ponpes::findOrFail($id);

    //     return view('admin.create_ponpes_2', compact('ponpes'));
    // }

    // public function stepTwo(Request $request)
    // {
    //     // Validate the form input
    //     $request->validate([
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules if needed
    //         'title' => 'nullable|string|max:255',
    //         'ponpes_id' => 'required|integer',
    //         'type' => 'required|string',
    //     ]);

    //     // Handle the file upload
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('images/ponpes');
    //     }

    //     // Create a new entry in the database
    //     $ponpesData = [
    //         'image' => $imagePath,
    //         'title' => $request->input('title'),
    //         'ponpes_id' => $request->input('ponpes_id'),
    //         'type' => $request->input('type'),
    //     ];

    //     // Save the data to the database (assuming you have an Eloquent model for 'ponpes')
    //     dd($ponpesData);
    //     Ponpes::create($ponpesData);

    //     // Redirect back or return a response as needed
    //     return redirect()->back()->with('success', 'Form submitted successfully!');
    // }

    // public function stepTwo(Request $request)
    // {
    //     // Validate the incoming request data
    //     $rules = [
    //         'image-1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'title-1' => 'nullable|string|max:255',
    //         'ponpes_id-1' => 'required|integer',
    //         'type-1' => 'required|string',
    //     ];

    //     for ($i = 2; $i <= 7; $i++) {
    //         $rules['image-' . $i] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    //         $rules['title-' . $i] = 'nullable|string|max:255';
    //         $rules['ponpes_id-' . $i] = 'required|integer';
    //         $rules['type-' . $i] = 'required|string';
    //     }

    //     $request->validate($rules);

    //     // Preconditions checking before saving images
    //     if (!$request->hasFile('image-1') && $request->input('type-1') === 'jumbotron') {
    //         // Jumbotron image is required, show error message or handle accordingly.
    //         return redirect()->back()->withErrors(['image-1' => 'Jumbotron image is required.']);
    //     }

    //     // Handle the Jumbotron image
    //     if ($request->hasFile('image-1')) {
    //         $jumbotronImage = $request->file('image-1');
    //         $jumbotronImagePath = $jumbotronImage->store('public/images/ponpes');
    //         ImagePonpes::create([
    //             'ponpes_id' => $request->input('ponpes_id-1'),
    //             'type' => 'jumbotron',
    //             'title' => $request->input('title-1'),
    //             'image_path' => $jumbotronImagePath,
    //         ]);
    //     }

    //     // Handle the regular content images (image 2 to 7)
    //     for ($i = 2; $i <= 7; $i++) {
    //         if ($request->hasFile('image-' . $i)) {
    //             $regularImage = $request->file('image-' . $i);
    //             $regularImagePath = $regularImage->store('public/images/ponpes');
    //             ImagePonpes::create([
    //                 'ponpes_id' => $request->input('ponpes_id-' . $i),
    //                 'type' => 'regular',
    //                 'title' => $request->input('title-' . $i),
    //                 'image_path' => $regularImagePath,
    //             ]);

    //         } else {
    //             // Regular image is missing, show error message or handle accordingly.
    //             return redirect()->back()->withErrors(['image-' . $i => 'Regular image ' . $i . ' is missing.']);
    //         }
    //     }

    //     // Redirect or return a response after saving the images
    //     // For example:
    //     return redirect()->route('your_next_route')->with('success', 'Images saved successfully.');
    // }
}
