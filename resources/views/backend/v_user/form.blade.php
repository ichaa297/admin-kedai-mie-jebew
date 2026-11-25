
@extends('backend.v_layouts.app')
@section('title', $judul)
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{ route('backend.laporan.cetakuser') }}"
                method="POST" target="_blank">

                @csrf

                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>

                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date"
                            name="tanggal_awal"
                            value="{{ old('tanggal_awal') }}"
                            class="form-control">
                        @error('tanggal_awal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date"
                            name="tanggal_akhir"
                            value="{{ old('tanggal_akhir') }}"
                            class="form-control">
                        @error('tanggal_akhir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">
                        Cetak 
                    </button>

                    <a href="{{ route('backend.user.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
