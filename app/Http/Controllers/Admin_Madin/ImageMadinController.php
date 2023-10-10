<?php

namespace App\Http\Controllers\Admin_Madin;

use App\Http\Controllers\Controller;
use App\Models\ImageMadin;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageMadinController extends Controller
{
    public function create_jumbotron(Request $request)
    {
        try {
            $request->validate([
                'madin_id' => 'required',
                'jumbotron' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('jumbotron')) {
                $jumbotron = $request->file('jumbotron');
                $imageName = uniqid() . '.' . $jumbotron->getClientOriginalExtension();
                // cek data jumbroton untuk id madin tertentu, kalau sudah ada yang lama dihapus
                $jumbotronAda = ImageMadin::where('madin_id', $request->input('madin_id'))
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
                $this->compressImage($jumbotron, '/images/ponpes/image', $imageName);
                ImageMadin::create([
                    'madin_id' => $request->input('madin_id'),
                    'image_name' => $imageName,
                    'type' => 'jumbotron',
                ]);
            } else {
                return redirect()->back()->with('error', 'Tidak ada gambar yang diunggah');
            }

            return redirect()->back()->with('success', 'Gambar berhasil diunggah');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah gambar');
        }
    }

    public function create_reguler(Request $request)
    {
        try {
            $request->validate([
                'madin_id' => 'required',
                'reguler.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $madinId = $request->input('madin_id');

            // Check the total number of images associated with the given 'madin_id'
            $totalRegulerImagesForMadin = ImageMadin::where('madin_id', $madinId)
                ->where('type', 'reguler')
                ->count();

            if ($request->hasFile('reguler')) {
                $regulerFiles = $request->file('reguler');
                if ($totalRegulerImagesForMadin + count($request->file('reguler')) <= 6) {
                    if ($request->hasFile('reguler')) {
                        $gambarReguler = $request->file('reguler');
                        $arrGambarReguler = [];

                        foreach ($gambarReguler as $reguler) {
                            $imageName = uniqid() . '.' . $reguler->getClientOriginalExtension();
                            $this->compressImage($reguler, 'images/ponpes/image', $imageName);
                            $arrGambarReguler[] = $imageName;

                            ImageMadin::create([
                                'madin_id' => $madinId,
                                'image_name' => $imageName,
                                'type' => 'reguler',
                            ]);
                        }

                        return redirect()->back()->with('success', 'Gambar berhasil diunggah');
                    } else {
                        return redirect()->back()->with('error', 'Tidak ada gambar yang diunggah');
                    }
                } else {
                    return redirect()->back()->with('error', 'Anda hanya dapat mengunggah maksimal 6 gambar');
                }
            } else {
                return redirect()->back()->with('error', 'Tidak ada gambar yang diunggah');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah gambar');
        }
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
        $gambar = ImageMadin::findOrFail($id);
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
