<?php

namespace App\Http\Controllers;

use App\Models\FotoProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoProdukController extends Controller
{
    // Menampilkan foto berdasarkan produk
    public function index($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);

        $fotoProduk = FotoProduk::where('produk_id', $produk_id)->get();

        return view('backend.v_foto_produk.index', [
            'judul' => 'Data Foto Produk',
            'produk' => $produk,
            'index' => $fotoProduk
        ]);
    }

    // Menyimpan foto tambahan produk
    public function store(Request $request, $produk_id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
        ]);

        $produk = Produk::findOrFail($produk_id);

        $foto = $request->file('foto')->store('foto-produk', 'public');

        FotoProduk::create([
            'produk_id' => $produk->id,
            'foto' => $foto,
        ]);

        return redirect()
            ->route('backend.foto_produk.index', $produk_id)
            ->with('success', 'Foto produk berhasil ditambahkan.');
    }

    // Menghapus foto produk
    public function destroy($id)
    {
        $foto = FotoProduk::findOrFail($id);
        $produk_id = $foto->produk_id;

        if ($foto->foto) {
            Storage::disk('public')->delete($foto->foto);
        }

        $foto->delete();

        return redirect()
            ->route('backend.foto_produk.index', $produk_id)
            ->with('success', 'Foto produk berhasil dihapus.');
}
}