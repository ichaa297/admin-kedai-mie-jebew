@extends('backend.v_layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Tambah Kategori</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="card-title">Form Tambah Kategori</div>
            </div>

            <div class="card-body">

                <form action="{{ route('backend.kategori.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama Kategori</label>

                        <input
                            type="text"
                            name="nama_kategori"
                            value="{{ old('nama_kategori') }}"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            placeholder="Masukkan Nama Kategori">

                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>

                    <a href="{{ route('backend.kategori.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection