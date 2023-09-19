<?php

namespace App\Http\Controllers\Admin_Kemenag;

use App\Exports\PelaporExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DataPelaporController extends Controller
{
    public function index()
    {
        $account = User::where('user_role', 'pelapor')
            ->get()
            ->sortBy(function ($user) {
                // Menggunakan fungsi ini untuk mengurutkan berdasarkan status
                switch ($user->status) {
                    case 'not confirmed':
                        return 1;
                    case 'active':
                        return 2;
                    case 'blocked':
                        return 3;
                    default:
                        return 4; // Jika ada status lain, tetapkan urutan terakhir
                }
            });

        $report = Report::with('ponpes')
            ->with('reportHistories')
            ->get();
        return view('admin_kemenag.data_pelapor', compact('account', 'report'));
    }
    public function destroy($id)
    {

        $account = User::findOrFail($id);

        if (!$account) {

            return redirect()->route('admin_kemenag.data_pelapor')->with('error', 'Akun Tidak Ditemukan.');
        }

        if ($account->photo_profil) {
            if (file_exists(public_path('images/profile_photos' . $account->photo_profil))) {
                unlink(public_path('images/profile_photos' . $account->photo_profil));
            } else {
                dd('File does not exists.');
            }
        }
        $account->delete();

        return redirect()->route('admin_kemenag.data_pelapor')->with('success', 'Akun ' . $account->name . ' Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        // Lakukan validasi data yang diupdate, misalnya:
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'status' => 'required|string|in:not confirmed,active,blocked',
            'phone_number' => 'nullable|string|min:11|max:15',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi mengubah akun. Periksa kembali isian Anda.');
        }

        // Lakukan proses update data berdasarkan ID yang diterima
        // Misalnya, jika menggunakan model Eloquent:
        $account = User::find($id);
        $account->name = $request->name;
        $account->email = $request->email;
        $account->status = $request->status;
        $account->username = $request->username;
        $account->phone_number = $request->phone_number;
        $account->save();
        // Tindakan setelah berhasil mengupdate data

        return redirect()->back()->with('success', 'Data pengguna berhasil diupdate.');
    }

    public function export()
    {
        return Excel::download(new PelaporExport, 'Data Akun Pelapor-' . Carbon::now()->timestamp . '.xlsx');
    }

    // public function create(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'username' => 'required|string|max:255|unique:users,username',
    //         'phone_number' => 'nullable|string|min:11|max:15',
    //         'user_role' => 'required|string|in:pelapor',
    //         'password' => 'required|string|min:8',
    //         'status' => 'required|string|in:not confirmed,active,blocked',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan validasi menambah akun. Periksa kembali isian Anda.');
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'username' => $request->username,
    //         'phone_number' => $request->phone_number,
    //         'user_role' => $request->user_role,
    //         'password' => Hash::make($request->password),
    //         'status' => $request->status,
    //     ]);

    //     // Tindakan setelah berhasil menyimpan data
    //     return redirect()->route('admin_kemenag.data_pelapor')->with('success', 'Data pengguna berhasil ditambahkan.');
    // }
}
