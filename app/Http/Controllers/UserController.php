<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $data = User::orderBy('id', 'desc')->get();

        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'data' => $data
        ]);
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User'
        ]);
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:user,email',
            'role' => 'required|in:0,1,2',
            'status' => 'required|in:0,1',
            'password' => 'required|min:6',
            'hp' => 'nullable|max:13',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'hp' => $request->hp,
        ]);

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    // Menampilkan form edit user
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.v_user.edit', [
            'judul' => 'Edit User',
            'user' => $user
        ]);
    }

    // Memperbarui data user
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email')->ignore($user->id),
            ],
            'role' => 'required|in:0,1,2',
            'status' => 'required|in:0,1',
            'password' => 'nullable|min:6',
            'hp' => 'nullable|max:13',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'hp' => $request->hp,
        ];

        // Password hanya diganti jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // Menghapus user
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id()) {
            return redirect()
                ->route('backend.user.index')
                ->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
        // Menampilkan form laporan user
    public function formUser()
    {
        return view('backend.v_user.form', [
            'judul' => 'Laporan Data User',
        ]);
    }

    // Mencetak laporan user berdasarkan periode tanggal
    public function cetakUser(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $user = User::whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_user.cetak', [
            'judul' => 'Laporan User',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $user
        ]);
    }
}