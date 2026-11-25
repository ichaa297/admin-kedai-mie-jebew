@extends('backend.v_layouts.app')
@section('title', $judul)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $judul }}</h4>
            </div>

            <div class="card-body">
                <h5>Informasi Pesanan</h5>

                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID Pesanan</th>
                        <td>#{{ $pesanan->id }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>{{ $pesanan->customer }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <form action="{{ route('backend.pesanan.update', $pesanan->id) }}"
                                method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PUT')

                                <select name="status" class="form-control" style="max-width: 200px;">
                                    <option value="Dikemas"
                                        {{ $pesanan->status == 'Dikemas' ? 'selected' : '' }}>
                                        Dikemas
                                    </option>
                                    <option value="Dibatalkan"
                                        {{ $pesanan->status == 'Dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                    <option value="Diterima"
                                        {{ $pesanan->status == 'Diterima' ? 'selected' : '' }}>
                                        Diterima
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-primary btn-sm">
                                    Simpan Status
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $pesanan->created_at->format('d-m-Y') }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Rincian Produk</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan->detailPesanan as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada rincian produk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <a href="{{ route('backend.pesanan.struk', $pesanan->id) }}"
                        target="_blank"
                        class="btn btn-success">
                        <i class="fas fa-print"></i> Cetak Struk
                    </a>

                    <a href="{{ route('backend.pesanan.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection