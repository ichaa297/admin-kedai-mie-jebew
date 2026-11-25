@extends('backend.v_layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Edit Kategori</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="card-title">Form Edit Kategori</div>
            </div>

            <div class="card-body">

                <form action="{{ route('backend.kategori.update', $edit->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Kategori</label>

                        <input
                            type="text"
                            name="nama_kategori"
                            value="{{ old('nama_kategori', $edit->nama_kategori) }}"
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
                        Perbarui
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