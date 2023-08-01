<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

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
            'phone_number' => ['required', 'string', 'max:255'],
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
        return User::create([
            'photo_profil' => $avatarPath,
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan masuk ke akun Anda.');

    }

}
