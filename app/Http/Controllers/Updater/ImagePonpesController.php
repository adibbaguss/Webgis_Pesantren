<?php

namespace App\Http\Controllers\Updater;

use App\Http\Controllers\Controller;
use App\Models\ImagePonpes;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagePonpesController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'ponpes_id' => 'required',
            'jumbotron' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reguler.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($request->hasFile('jumbotron')) {
            $jumbotron = $request->file('jumbotron');
            $imageName = uniqid() . '.' . $jumbotron->getClientOriginalExtension();
            // cek data jumbroton untuk id ponpes tertentu, kalau sudah ada yang lama dihapus
            $jumbotronAda = ImagePonpes::where('ponpes_id', $request->input('ponpes_id'))
                ->where('type', 'jumbotron')
                ->first();
            // hapus data + gambar jumbroton lama
            if ($jumbotronAda) {
                $jumbotronAda->delete();
                if (file_exists(public_path('images/ponpes/image/' . $jumbotronAda->image_name))) {
                    unlink(public_path('images/ponpes/image/' . $jumbotronAda->image_name));
                }
            }
            // tambah data jumbroton baru
            $this->compressImage($jumbotron, '\images\ponpes\image', $imageName);
            ImagePonpes::create([
                'ponpes_id' => $request->input('ponpes_id'),
                'image_name' => $imageName,
                'type' => 'jumbotron',
            ]);
        }

        if ($request->hasFile('reguler')) {
            $gambarReguler = $request->file('reguler');
            $arrGambarReguler = [];

            foreach ($gambarReguler as $reguler) {
                $imageName = uniqid() . '.' . $reguler->getClientOriginalExtension();
                $this->compressImage($reguler, '\images\ponpes\image', $imageName);
                $arrGambarReguler[] = $imageName;

                ImagePonpes::create([
                    'ponpes_id' => $request->input('ponpes_id'),
                    'image_name' => $imageName,
                    'type' => 'reguler',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    private function compressImage($image, $imagePath, $imageName)
    {
        $terkompresi = Image::make($image)
            ->encode('jpg', 75) // dikompres ke bentuk jpg, total diambil 75% dari gambar asli
            ->save(public_path($imagePath . '/' . $imageName));
    }

    // Fungsi hapus Gambar

    public function deleteImage($id)
    {
        $gambar = ImagePonpes::findOrFail($id);
        // hapus data + gambar jumbroton lama
        if ($gambar) {
            if (file_exists(public_path('images/ponpes/image/' . $gambar->image_name))) {
                unlink(public_path('images/ponpes/image/' . $gambar->image_name));
            }
            $gambar->delete();
        } else {
            return redirect()->back()->with('error', 'Gambar Tidak Ditemukan.');
        }

        return redirect()->back()->with('success', 'Gambar ' . $gambar->name . ' Berhasil Dihapus');
    }
}