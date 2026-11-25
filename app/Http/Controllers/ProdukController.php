<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $produk = Produk::with(['kategori', 'fotoProduk'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('backend.v_produk.index', [
            'judul' => 'Data Produk',
            'index' => $produk,
        ]);
    }

    // Form tambah produk
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.create', [
            'judul' => 'Tambah Produk',
            'kategori' => $kategori
        ]);
    }

    // Menyimpan produk
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_produk' => 'required|max:255|unique:produk,nama_produk',
            'detail' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['status'] = $request->status ?? 0;

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')
                ->store('img-produk', 'public');
        }

        Produk::create($validatedData);

        return redirect()
            ->route('backend.produk.index')
            ->with('success', 'Data produk berhasil ditambahkan.');
    }

    // Form edit produk
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.edit', [
            'judul' => 'Edit Produk',
            'edit' => $produk,
            'kategori' => $kategori
        ]);
    }

    // Memperbarui produk
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_produk' => [
                'required',
                'max:255',
                Rule::unique('produk', 'nama_produk')->ignore($produk->id),
            ],
            'detail' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }

            $validatedData['foto'] = $request->file('foto')
                ->store('img-produk', 'public');
        }

        $validatedData['user_id'] = $produk->user_id;

        $produk->update($validatedData);

        return redirect()
            ->route('backend.produk.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }
    // Menghapus produk
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('backend.produk.index')
            ->with('success', 'Data produk berhasil dihapus.');
    }

    // Form laporan produk
    public function formProduk()
    {
        return view('backend.v_produk.form', [
            'judul' => 'Laporan Data Produk',
        ]);
    }

    // Proses cetak laporan produk
    public function cetakProduk(Request $request)
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

        $produk = Produk::whereDate('updated_at', '>=', $tanggalAwal)
            ->whereDate('updated_at', '<=', $tanggalAkhir)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_produk.cetak', [
            'judul' => 'Laporan Produk',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $produk
        ]);
    }
}
