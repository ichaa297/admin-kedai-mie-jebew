<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        $tahun = date('Y');

        $data = [
            'judul' => 'Halaman Beranda',
            'totalProduk' => Produk::count(),
            'totalKategori' => Kategori::count(),
            'totalPesanan' => Pesanan::count(),

            // Total penjualan setiap bulan
            'grafikPenjualan' => Pesanan::select(
                    DB::raw('MONTH(created_at) as bulan'),
                    DB::raw('SUM(total) as total_penjualan')
                )
                ->whereYear('created_at', $tahun)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('bulan')
                ->pluck('total_penjualan', 'bulan'),
        ];

        // Statistik user hanya untuk Super Admin
        if (Auth::user()->role == 1) {
            $data['totalUser'] = User::count();
        }

        return view('backend.v_beranda.index', $data);
    }
}
