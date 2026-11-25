@extends('backend.v_layouts.app')
@section('title', 'Data Foto Produk')
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Data Foto Produk</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Foto Produk: {{ $produk->nama_produk }}
                </h4>
            </div>

            <div class="card-body">

                <p>Daftar foto untuk produk ini.</p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- UPLOAD FOTO TAMBAHAN --}}
                <form action="{{ route('backend.foto_produk.store', $produk->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mb-4">

                    @csrf

                    <div class="form-group">
                        <label>Upload Foto Tambahan</label>
                        <input type="file"
                            name="foto"
                            class="form-control"
                            accept="image/*"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fa fa-upload"></i> Upload Foto
                    </button>

                    <a href="{{ route('backend.produk.index') }}"
                        class="btn btn-secondary mt-3">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </form>

                <hr>

                {{-- FOTO UTAMA --}}
                <h5 class="mb-3">Foto Utama Produk</h5>

                @if ($produk->foto)
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <img
                                src="{{ asset('storage/' . $produk->foto) }}"
                                class="img-fluid rounded"
                                alt="Foto Utama Produk">
                            <span class="badge badge-success mt-2">
                                Foto Utama
                            </span>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        Belum ada foto utama untuk produk ini.
                    </div>
                @endif

                <hr>

                {{-- FOTO TAMBAHAN --}}
                <h5 class="mb-3">Foto Tambahan Produk</h5>

                @if ($index->isEmpty())
                    <div class="alert alert-info">
                        Belum ada foto tambahan untuk produk ini.
                    </div>
                @else
                    <div class="row">
                        @foreach ($index as $foto)
                            <div class="col-md-3 mb-3">
                                <img
                                    src="{{ asset('storage/' . $foto->foto) }}"
                                    class="img-fluid rounded"
                                    alt="Foto Produk">

                                <form action="{{ route('backend.foto_produk.destroy', $foto->id) }}"
                                    method="POST"
                                    class="mt-2"
                                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus Foto
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection