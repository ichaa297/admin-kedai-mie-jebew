<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan data kategori
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_kategori.index', [
            'judul' => 'Kategori',
            'index' => $kategori
        ]);
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'Tambah Kategori'
        ]);
    }

    // Menyimpan kategori
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah tersedia.',
        ]);

        Kategori::create($validatedData);

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data kategori berhasil tersimpan.');
    }

    // Menampilkan form edit kategori
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('backend.v_kategori.edit', [
            'judul' => 'Edit Kategori',
            'edit' => $kategori
        ]);
    }

    // Memperbarui kategori
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori,' . $id,
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);

        Kategori::where('id', $id)->update($validatedData);

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data kategori berhasil dihapus.');
    }
}