<?php

namespace App\Http\Controllers\Admin_Pesantren;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index($id)
    {
        // Mengambil data ponpes berdasarkan ID
        $user = User::findOrFail($id);

        // Mengirim data ponpes ke halaman view_ponpes.blade.php
        return view('admin_pesantren.profile', compact('user'));

    }
}
