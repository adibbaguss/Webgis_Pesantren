<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function attemptLogin(Request $request)
    {
        return Auth::attempt($request->only('email', 'password', 'user_role', 'status'));
    }

    protected function authenticated(Request $request, $user)
    {

        if ($user->status === 'not confirmed') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun anda belum aktif, harap tunggu konfirmasi dari Admin');
        } elseif ($user->status === 'blocked') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun anda diblokir');
        } elseif ($user->status === 'active') {
            if ($user->user_role === 'admin kemenag') {
                return redirect()->route('admin_kemenag.dashboard')->with('success', 'Selamat anda berhasil login');
            } elseif ($user->user_role === 'admin pesantren') {
                return redirect()->route('admin_pesantren.dashboard', ['id' => $user->id])->with('success', 'Selamat anda berhasil login');
            } elseif ($user->user_role === 'pelapor') {
                return redirect()->route('pelapor.map_view', ['id' => $user->id])->with('success', 'Selamat anda berhasil login');
            } else {
                return redirect()->route('login')->with('error', 'Gagal masuk, ada kesalahan');
            }
        } else {
            return redirect()->route('login')->with('error', 'Gagal masuk, ada kesalahan');
        }

    }

// logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
