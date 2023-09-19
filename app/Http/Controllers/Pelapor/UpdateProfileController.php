<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends Controller
{
    public function index($id)
    {
        // Mengambil data ponpes berdasarkan ID
        $user = User::findOrFail($id);

        // Mengirim data ponpes ke halaman view_ponpes.blade.php
        return view('pelapor.update_profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'min:11', 'max:13'],
        ]);

        $avatarPath = null;

        if ($request->has('base64image') && $request->input('base64image') !== '0') {
            $folderPath = public_path('images/profile_photos');
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

        $user = User::find($id);

        if (!$user) {
            // Handle the case where the user with the given ID is not found
            return null;
        }

        // Update the user data
        $user->photo_profil = $avatarPath ?? $user->photo_profil;
        $user->username = $request->username;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->route('pelapor.profile', ['id' => $id])->with('success', 'Akun Berhasil Diperbaharui');
    }

    public function update_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi mengubah password. Periksa kembali isian Anda.');
        }

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('pelapor.profile', ['id' => $id])->with('success', 'Password Berhasil Diperbaharui');
    }

}
