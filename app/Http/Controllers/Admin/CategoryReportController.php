<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryReportController extends Controller
{
    public function index()
    {
        $category_report = CategoryReport::all();

        return view('admin.category_report', compact('category_report'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi menambah Kategori. Periksa kembali isian Anda.');
        }

        CategoryReport::create($request->only('name'));

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi saat mengupdate Kategori. Periksa kembali isian Anda.');
        }

        $category = CategoryReport::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->back()->with('success', 'Kategori berhasil diupdate.');
    }

    public function delete($id)
    {
        $category = CategoryReport::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
