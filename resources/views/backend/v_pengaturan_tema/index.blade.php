
@extends('backend.v_layouts.app')

@section('title', 'Pengaturan Tema')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Pengaturan Tema</h3>
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
            <a href="#">Pengaturan Tema</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Atur Tampilan Website</h4>
                <p class="text-muted mb-0">
                    Pilih tema atau tentukan warna sesuai keinginanmu.
                </p>
            </div>

            <form action="{{ route('backend.pengaturan_tema.update') }}"
                  method="POST">
                @csrf

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="fw-bold">Pilihan Tema</label>

                        <div class="row mt-2">
                            @php
                                $pilihanTema = [
                                    'biru' => ['Biru', '#1572E8'],
                                    'hijau' => ['Hijau', '#16A34A'],
                                    'ungu' => ['Ungu', '#9333EA'],
                                    'gelap' => ['Gelap', '#1F2937'],
                                    'custom' => ['Custom', '#E85D75'],
                                ];
                            @endphp

                            @foreach ($pilihanTema as $key => $tema)
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="w-100 border rounded p-3"
                                           style="cursor:pointer;">
                                        <input type="radio"
                                               name="tema"
                                               value="{{ $key }}"
                                               class="pilihan-tema"
                                               {{ old('tema', $user->tema) == $key ? 'checked' : '' }}>

                                        <span class="fw-bold ms-1">
                                            {{ $tema[0] }}
                                        </span>

                                        <div class="mt-2 rounded"
                                             style="height:25px; background:{{ $tema[1] }};">
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        @error('tema')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="fw-bold">Warna Utama</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color"
                                   name="warna_utama"
                                   id="warna_utama"
                                   value="{{ old('warna_utama', $user->warna_utama) }}"
                                    style="width: 55px; height: 38px; padding: 3px; cursor: pointer;"
                                   required>

                            <span id="kode_utama">
                                {{ old('warna_utama', $user->warna_utama) }}
                            </span>
                        </div>
                        @error('warna_utama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label class="fw-bold">Warna Latar Belakang</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color"
                                   name="warna_latar"
                                   id="warna_latar"
                                   value="{{ old('warna_latar', $user->warna_latar) }}"
                                   style="width: 55px; height: 38px; padding: 3px; cursor: pointer;"
                                   required>
                                   
                            <span id="kode_latar">
                                {{ old('warna_latar', $user->warna_latar) }}
                            </span>
                        </div>
                        @error('warna_latar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Pengaturan
                    </button>

                    <a href="{{ route('backend.beranda') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pratinjau Warna</h4>
            </div>
            <div class="card-body">
                <div id="pratinjau"
                     class="rounded p-3"
                     style="background:{{ $user->warna_latar }};">

                    <div id="pratinjau-header"
                         class="rounded p-3 text-white"
                         style="background:{{ $user->warna_utama }};">
                        <strong>Kedai Mie Jebew</strong>
                    </div>

                    <div class="bg-white rounded p-3 mt-3">
                        <strong>Dashboard</strong>
                        <p class="text-muted mb-2">
                            Contoh tampilan halaman.
                        </p>
                        <button type="button"
                                id="pratinjau-tombol"
                                class="btn btn-primary">
                            Tombol
                        </button>
                    </div>
                </div>
                <small class="text-muted d-block mt-3">
                    Pratinjau ini hanya contoh warna.
                </small>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const warnaTema = {
        biru: ['#1572E8', '#F5F7FD'],
        hijau: ['#16A34A', '#F0FDF4'],
        ungu: ['#9333EA', '#FAF5FF'],
        pink: ['#E85D75', '#FFF5F7'],
        gelap: ['#1F2937', '#E5E7EB']
    };

    const pilihanTema = document.querySelectorAll('.pilihan-tema');
    const warnaUtama = document.getElementById('warna_utama');
    const warnaLatar = document.getElementById('warna_latar');

    const kodeUtama = document.getElementById('kode_utama');
    const kodeLatar = document.getElementById('kode_latar');

    const pratinjau = document.getElementById('pratinjau');
    const pratinjauHeader = document.getElementById('pratinjau-header');
    const pratinjauTombol = document.getElementById('pratinjau-tombol');

    function perbaruiPratinjau() {
        kodeUtama.textContent = warnaUtama.value;
        kodeLatar.textContent = warnaLatar.value;

        pratinjau.style.backgroundColor = warnaLatar.value;
        pratinjauHeader.style.backgroundColor = warnaUtama.value;
        pratinjauTombol.style.backgroundColor = warnaUtama.value;
        pratinjauTombol.style.borderColor = warnaUtama.value;
    }

    pilihanTema.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (warnaTema[this.value]) {
                warnaUtama.value = warnaTema[this.value][0];
                warnaLatar.value = warnaTema[this.value][1];
                perbaruiPratinjau();
            }
        });
    });

    warnaUtama.addEventListener('input', perbaruiPratinjau);
    warnaLatar.addEventListener('input', perbaruiPratinjau);

    perbaruiPratinjau();
</script>
@endpush

