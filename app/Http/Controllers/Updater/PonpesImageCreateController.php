<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\ImagePonpes;
use App\Models\Ponpes;
use Illuminate\Http\Request;

class PonpesImageCreateController extends Controller
{
    protected function index($id)
    {
        $ponpes = Ponpes::findOrFail($id);

        return view('updater.ponpes_image_create', compact('ponpes'));
    }

    public function stepTwo(Request $request)
    {
        // Validate the form input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules if needed
            'title' => 'nullable|string|max:255',
            'ponpes_id' => 'required|integer',
            'type' => 'required|string',
        ]);

        // Handle the file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/ponpes');
        }

        // Create a new entry in the database
        $ponpesData = [
            'image' => $imagePath,
            'title' => $request->input('title'),
            'ponpes_id' => $request->input('ponpes_id'),
            'type' => $request->input('type'),
        ];

        // Save the data to the database (assuming you have an Eloquent model for 'ponpes')
        dd($ponpesData);
        Ponpes::create($ponpesData);

        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $rules = [
            'image-1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title-1' => 'nullable|string|max:255',
            'ponpes_id-1' => 'required|integer',
            'type-1' => 'required|string',
        ];

        for ($i = 2; $i <= 7; $i++) {
            $rules['image-' . $i] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['title-' . $i] = 'nullable|string|max:255';
            $rules['ponpes_id-' . $i] = 'required|integer';
            $rules['type-' . $i] = 'required|string';
        }

        $request->validate($rules);

        // Preconditions checking before saving images
        if (!$request->hasFile('image-1') && $request->input('type-1') === 'jumbotron') {
            // Jumbotron image is required, show error message or handle accordingly.
            return redirect()->back()->withErrors(['image-1' => 'Jumbotron image is required.']);
        }

        // Handle the Jumbotron image
        if ($request->hasFile('image-1')) {
            $jumbotronImage = $request->file('image-1');
            $jumbotronImagePath = $jumbotronImage->store('public/images/ponpes');
            ImagePonpes::create([
                'ponpes_id' => $request->input('ponpes_id-1'),
                'type' => 'jumbotron',
                'title' => $request->input('title-1'),
                'image_path' => $jumbotronImagePath,
            ]);
        }

        // Handle the regular content images (image 2 to 7)
        for ($i = 2; $i <= 7; $i++) {
            if ($request->hasFile('image-' . $i)) {
                $regularImage = $request->file('image-' . $i);
                $regularImagePath = $regularImage->store('public/images/ponpes');
                ImagePonpes::create([
                    'ponpes_id' => $request->input('ponpes_id-' . $i),
                    'type' => 'regular',
                    'title' => $request->input('title-' . $i),
                    'image_path' => $regularImagePath,
                ]);

            } else {
                // Regular image is missing, show error message or handle accordingly.
                return redirect()->back()->withErrors(['image-' . $i => 'Regular image ' . $i . ' is missing.']);
            }
        }

        // Redirect or return a response after saving the images
        // For example:
        return redirect()->back()->with('success', 'Image submitted successfully!');
    }
}
