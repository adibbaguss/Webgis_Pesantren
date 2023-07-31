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
        return Auth::attempt($request->only('email', 'password', 'user_role'));
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->user_role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->user_role === 'updater') {
            return redirect()->route('updater.dashboard', ['id' => $user->id]);
        } elseif ($user->user_role === 'viewer') {
            return redirect()->route('viewer.map_view', ['id' => $user->id]);
        } else {
            return redirect()->route('login');
        }
    }

// logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
