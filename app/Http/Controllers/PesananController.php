<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                ->orWhere('customer', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pesanan = $query->orderBy('id', 'desc')->get();

        return view('backend.v_pesanan.index', [
            'judul' => 'Kelola Pesanan',
            'index' => $pesanan,
        ]);
    }

    public function create()
    {
        $produk = Produk::where('status', 1)
            ->where('stok', '>', 0)
            ->orderBy('nama_produk')
            ->get();

        return view('backend.v_pesanan.create', [
            'judul' => 'Tambah Pesanan',
            'produk' => $produk,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|string|max:255',
            'produk' => 'required|array',
            'produk.*' => 'required|integer|min:0',
        ], [
            'customer.required' => 'Nama customer harus diisi.',
            'produk.required' => 'Pilih minimal satu produk.',
        ]);

        // Ambil produk yang jumlahnya lebih dari 0
        $produkDipilih = collect($request->produk)
            ->filter(function ($jumlah) {
                return $jumlah > 0;
            });

        if ($produkDipilih->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors(['produk' => 'Pilih minimal satu produk.']);
        }

        DB::transaction(function () use ($request, $produkDipilih) {

            // Buat pesanan baru
            $pesanan = Pesanan::create([
                'customer' => $request->customer,
                'total' => 0,
                'status' => 'Dikemas',
            ]);

            $total = 0;

            foreach ($produkDipilih as $produkId => $jumlah) {

                // Ambil produk dan kunci data selama transaksi
                $produk = Produk::where('status', 1)
                    ->lockForUpdate()
                    ->find($produkId);

                if (!$produk || $produk->stok < $jumlah) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'produk' => 'Produk tidak tersedia atau stok tidak mencukupi.',
                    ]);
                }

                $harga = $produk->harga;
                $subtotal = $harga * $jumlah;

                // Simpan detail pesanan
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                ]);

                // Kurangi stok produk
                $produk->decrement('stok', $jumlah);

                $total += $subtotal;
            }

            // Simpan total seluruh pesanan
            $pesanan->update([
                'total' => $total,
            ]);
        });

        return redirect()
            ->route('backend.pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($id);

        return view('backend.v_pesanan.show', [
            'judul' => 'Detail Pesanan',
            'pesanan' => $pesanan,
        ]);
    }

    // Menampilkan struk pesanan
    public function struk(string $id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')
            ->findOrFail($id);

        return view('backend.v_pesanan.struk', [
            'judul' => 'Cetak Struk',
            'pesanan' => $pesanan,
        ]);
    }

    public function edit(string $id)
    {
        //
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:Dikemas,Dibatalkan,Diterima',
        ]);

        DB::transaction(function () use ($request, $id) {

            $pesanan = Pesanan::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            // Pesanan yang sudah dibatalkan tidak dapat diaktifkan kembali
            if (
                $pesanan->status === 'Dibatalkan' &&
                $request->status !== 'Dibatalkan'
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'status' => 'Pesanan yang sudah dibatalkan tidak dapat diaktifkan kembali.',
                ]);
            }

            // Kembalikan stok hanya saat pertama kali dibatalkan
            if (
                $pesanan->status !== 'Dibatalkan' &&
                $request->status === 'Dibatalkan'
            ) {
                $detailPesanan = $pesanan->detailPesanan;

                foreach ($detailPesanan as $detail) {
                    $produk = Produk::whereKey($detail->produk_id)
                        ->lockForUpdate()
                        ->first();

                    if ($produk) {
                        $produk->increment('stok', $detail->jumlah);
                    }
                }
            }

            $pesanan->update([
                'status' => $request->status,
            ]);
        });

        return redirect()
            ->route('backend.pesanan.show', $id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        //
    }

    // Menampilkan form laporan pesanan
    public function formPesanan()
    {
        return view('backend.v_pesanan.form', [
            'judul' => 'Laporan Data Pesanan',
        ]);
    }

    // Mencetak laporan pesanan berdasarkan periode tanggal
    public function cetakPesanan(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus sama atau setelah Tanggal Awal.',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $pesanan = Pesanan::whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_pesanan.cetak', [
            'judul' => 'Laporan Pesanan',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $pesanan,
        ]);
    }
}