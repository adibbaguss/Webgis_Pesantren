<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\Ponpes;

class PonpesImageCreateController extends Controller
{
    protected function index($id)
    {
        $ponpes = Ponpes::findOrFail($id);

        return view('updater.ponpes_image_create', compact('id', 'ponpes'));
    }

    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'ponpes_id' => 'required|exists:ponpes,id',
    //         'jumbotron' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_4' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_5' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'reguler_6' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);
    //     dd($request);

    //     // Save the original jumbotron image
    //     $jumbotronImage = $request->file('jumbotron');
    //     $jumbotronPath = $jumbotronImage->store('public/ponpes');

    //     // Create a record for the jumbotron image in the database
    //     ImagePonpes::create([
    //         'ponpes_id' => $request->input('ponpes_id'),
    //         'image_path' => $jumbotronPath,
    //     ]);

    //     // Save the cropped regular images
    //     for ($i = 1; $i <= 6; $i++) {
    //         $inputName = 'reguler_' . $i;
    //         if ($request->hasFile($inputName)) {
    //             $regularImage = $request->file($inputName);
    //             $regularPath = $regularImage->store('public/ponpes');

    //             // Use Intervention Image to crop or resize the regular image if needed
    //             $croppedPath = 'public/ponpes/cropped_' . $regularImage->getClientOriginalName();
    //             InterventionImage::make($regularImage)->fit(800, 600)->save(storage_path('app/' . $croppedPath));

    //             // Create a record for the cropped regular image in the database
    //             ImagePonpes::create([
    //                 'ponpes_id' => $request->input('ponpes_id'),
    //                 'image_path' => $croppedPath,
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Images uploaded successfully.');
    // }

}
