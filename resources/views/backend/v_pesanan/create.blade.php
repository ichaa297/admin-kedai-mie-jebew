@extends('backend.v_layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Kasir - Tambah Pesanan</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Transaksi Pesanan</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('backend.pesanan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Customer</label>
                        <input type="text" name="customer"
                            class="form-control"
                            placeholder="Masukkan nama customer"
                            value="{{ old('customer') }}"
                            required>
                        @error('customer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <hr>

                    <h5 class="mb-3">Pilih Produk</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produk as $item)
                                    <tr>
                                        <td class="text-center">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                    alt="{{ $item->nama_produk }}"
                                                    width="65"
                                                    height="65"
                                                    style="object-fit: cover; border-radius: 8px;">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td style="width: 130px;">
                                            <input
                                                type="number"
                                                name="produk[{{ $item->id }}]"
                                                class="form-control jumlah-produk"
                                                min="0"
                                                max="{{ $item->stok }}"
                                                value="0"
                                                data-harga="{{ $item->harga }}">
                                        </td>
                                        <td class="subtotal-produk">Rp 0</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada produk aktif dengan stok tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total Belanja</th>
                                    <th id="total-belanja">Rp 0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @error('produk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Pesanan
                        </button>

                        <a href="{{ route('backend.pesanan.index') }}"
                            class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function hitungTotal() {
        let total = 0;

        document.querySelectorAll('.jumlah-produk').forEach(function(input) {
            let harga = parseFloat(input.dataset.harga) || 0;
            let jumlah = parseInt(input.value) || 0;
            let stok = parseInt(input.max) || 0;

            // Batasi jumlah sesuai stok
            if (jumlah > stok) {
                jumlah = stok;
                input.value = stok;
            }

            if (jumlah < 0) {
                jumlah = 0;
                input.value = 0;
            }

            let subtotal = harga * jumlah;
            total += subtotal;

            input.closest('tr').querySelector('.subtotal-produk').textContent =
                formatRupiah(subtotal);
        });

        document.getElementById('total-belanja').textContent =
            formatRupiah(total);
    }

    document.querySelectorAll('.jumlah-produk').forEach(function(input) {
        input.addEventListener('input', hitungTotal);
    });

    hitungTotal();
</script>
@endpush