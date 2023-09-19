<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photo_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:11', 'max:15'],
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            'selfie_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ]);
    }

    protected function create(array $data)
    {
        $avatarPath = null;
        if (isset($data['base64image']) && $data['base64image'] != '0') {
            $folderPath = public_path('images/profile_photos');
            $image_parts = explode(";base64,", $data['base64image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = time() . '.' . $image_type;
            $file = $folderPath . '/' . $filename;
            file_put_contents($file, $image_base64);

            $avatarPath = $filename;
        }

        // Compress and save 'foto_ktp' in the 'ktp' subdirectory
        $fotoKtpPath = $this->saveCompressedImage($data['foto_ktp'], 'foto_ktp', 'ktp');

        // Compress and save 'selfie_ktp' in the 'selfie_ktp' subdirectory
        $selfieKtpPath = $this->saveCompressedImage($data['selfie_ktp'], 'selfie_ktp', 'selfie_ktp');

        // Create user
        $user = User::create([
            'photo_profil' => $avatarPath,
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'foto_ktp' => $fotoKtpPath,
            'selfie_ktp' => $selfieKtpPath,
        ]);

        return $user;
    }

    // Helper function to compress and save an image
    protected function saveCompressedImage($imageData, $imageName, $subdirectory)
    {
        $folderPath = public_path('images/' . $subdirectory);
        $image = Image::make($imageData);

        // You can adjust the width and quality as needed
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Generate a unique filename
        $filename = time() . '_' . $imageName . '.jpg';

        // Save the compressed image in the specified subdirectory
        $image->save($folderPath . '/' . $filename, 80);

        return $filename;
    }

    protected function registered($request, $user)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Harap tunggu konfirmasi dari Admin sebelum dapat mengakses akun Pelapor (2x24 jam)');
    }
}
