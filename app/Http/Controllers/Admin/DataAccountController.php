<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DataAccountController extends Controller
{
    public function index()
    {
        $account = User::all();

        return view('admin.data_account', compact('account'));
    }
    public function destroy($id)
    {

        $account = User::findOrFail($id);

        if (!$account) {

            return redirect()->route('admin.data_account')->with('error', 'Akun Tidak Ditemukan.');
        }

        if ($account->photo_profil) {
            if (file_exists(public_path('images/profile_photos' . $account->photo_profil))) {
                unlink(public_path('images/profile_photos' . $account->photo_profil));
            } else {
                dd('File does not exists.');
            }
        }
        $account->delete();

        return redirect()->route('admin.data_account')->with('success', 'Akun ' . $account->name . ' Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        // Lakukan validasi data yang diupdate, misalnya:
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
        ]);

        // Lakukan proses update data berdasarkan ID yang diterima
        // Misalnya, jika menggunakan model Eloquent:
        $account = User::find($id);
        $account->name = $request->name;
        $account->email = $request->email;
        $account->username = $request->username;
        $account->phone_number = $request->phone_number;
        $account->save();

        // Tindakan setelah berhasil mengupdate data

        return redirect()->back()->with('success', 'Data pengguna berhasil diupdate.');
    }

    public function export()
    {
        return Excel::download(new UserExport, 'Data Akun-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'phone_number' => 'nullable|string|max:255',
            'user_role' => 'required|string|in:admin,updater,viewer',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'user_role' => $request->user_role,
            'password' => Hash::make($request->password),
        ]);

        // Tindakan setelah berhasil menyimpan data
        return redirect()->route('admin.data_account')->with('success', 'Data pengguna berhasil ditambahkan.');
    }
}
