<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::User();

        // Mengarahkan redirect berdasarkan role pengguna
        if ($user->user_role === 'admin_kemenag') {
            return route('admin_kemenag.dashboard');
        } elseif ($user->user_role === 'admin_pesantren') {
            return route('admin_pesantren.dashboard', ['id' => $user->id]);
        } elseif ($user->user_role === 'pelapor') {
            return route('pelapor.map_view');
        } else {
            return route('pengunjung.map_view');
        }
    }
}
