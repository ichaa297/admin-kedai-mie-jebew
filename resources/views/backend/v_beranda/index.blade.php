@extends('backend.v_layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- JUDUL HALAMAN -->
<div class="page-header">
    <h3 class="fw-bold mb-3">Dashboard</h3>

    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="{{ route('backend.beranda') }}">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('backend.beranda') }}">Beranda</a>
        </li>
    </ul>
</div>


<!-- UCAPAN SELAMAT DATANG -->
<div class="alert alert-info">
    Selamat datang,
    <strong>{{ Auth::user()->nama }}</strong>.

    Anda login sebagai
    <strong>
        @if (Auth::user()->role == 1)
            Super Admin
        @elseif (Auth::user()->role == 0)
            Admin
        @else
            Customer
        @endif
    </strong>
    di aplikasi Kedai Mie Jebew.
</div>



<!-- KARTU INFORMASI -->
<div class="row">

    @if (Auth::user()->role == 1)
    <!-- KARTU TOTAL USER -->
    <div class="col-sm-6 col-md-{{ Auth::user()->role == 1 ? 3 : 4 }}">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">

                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total User</p>
                            <h4 class="card-title">{{ $totalUser }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- KARTU TOTAL PRODUK -->
    <div class="col-sm-6 col-md-{{ Auth::user()->role == 1 ? 3 : 4 }}">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Produk</p>
                            <h4 class="card-title">{{ $totalProduk }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KARTU TOTAL KATEGORI -->
    <div class="col-sm-6 col-md-{{ Auth::user()->role == 1 ? 3 : 4 }}">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Kategori</p>
                            <h4 class="card-title">{{ $totalKategori }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KARTU TOTAL PESANAN -->
    <div class="col-sm-6 col-md-{{ Auth::user()->role == 1 ? 3 : 4 }}">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>

                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Pesanan</p>
                            <h4 class="card-title">{{ $totalPesanan }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- GRAFIK -->
<div class="row">

    <div class="col-md-12">
        <div class="card card-round">

            <div class="card-header">
                <div class="card-title">
                    Grafik Penjualan Kedai Mie Jebew
                </div>
            </div>

            <div class="card-body">
                <div class="chart-container" style="min-height: 300px;">
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection



@push('scripts')
<script>
    const ctx = document.getElementById('grafikPenjualan');

    const dataPenjualan = @json($grafikPenjualan);

    const namaBulan = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    const nilaiPenjualan = [];

    for (let i = 1; i <= 12; i++) {
        nilaiPenjualan.push(Number(dataPenjualan[i] ?? 0));
    }

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: namaBulan,

            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: nilaiPenjualan,
                borderColor: '#d83434ff',
                borderWidth: 2,
                fill: false,
                tension: 0.3
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        suggestedMax: 1000000,
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }]
            }
        }
    });
</script>
@endpush
