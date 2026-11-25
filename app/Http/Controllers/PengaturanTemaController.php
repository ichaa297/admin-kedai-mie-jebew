<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanTemaController extends Controller
{
    public function index()
    {
        return view('backend.v_pengaturan_tema.index', [
            'judul' => 'Pengaturan Tema',
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'tema' => 'required|in:biru,hijau,ungu,gelap,custom',
            'warna_utama' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'warna_latar' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $user = Auth::user();

        $user->update([
            'tema' => $request->tema,
            'warna_utama' => $request->warna_utama,
            'warna_latar' => $request->warna_latar,
        ]);

        return redirect()
            ->route('backend.pengaturan_tema.index')
            ->with('success', 'Pengaturan tema berhasil disimpan.');
    }
}
