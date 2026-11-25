<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanFontController extends Controller
{
    public function index()
    {
        return view('backend.v_pengaturan_font.index', [
            'judul' => 'Pengaturan Font',
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'font_family' => 'required|in:Poppins,Arial,Georgia,Verdana,Tahoma',
            'font_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'font_size' => 'required|integer|min:12|max:20',
        ]);

        $user = Auth::user();

        $user->update([
            'font_family' => $request->font_family,
            'font_color' => $request->font_color,
            'font_size' => $request->font_size,
        ]);

        return redirect()
            ->route('backend.pengaturan_font.index')
            ->with('success', 'Pengaturan font berhasil disimpan.');
    }
}
