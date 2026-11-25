<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengaturanProfilController extends Controller
{
    public function index()
    {
        return view('backend.v_pengaturan_profil.index', [
            'judul' => 'Pengaturan Profil',
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email')->ignore($user->id),
            ],
            'hp' => 'nullable|max:13',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
        ];

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('foto-profil', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('backend.pengaturan_profil.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
