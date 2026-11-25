@extends('backend.v_layouts.app')
@section('title', $judul)
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Tambah Produk</h3>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Form Tambah Produk</div>
    </div>

    <div class="card-body">

        <form action="{{ route('backend.produk.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Kategori</label>

                <select name="kategori_id"
                        class="form-control @error('kategori_id') is-invalid @enderror">

                    <option value="">-- Pilih Kategori --</option>

                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach

                </select>

                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Produk</label>

                <input type="text"
                       name="nama_produk"
                       value="{{ old('nama_produk') }}"
                       class="form-control @error('nama_produk') is-invalid @enderror"
                       placeholder="Masukkan Nama Produk">

                @error('nama_produk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Detail Produk</label>

                <textarea name="detail"
                          rows="4"
                          class="form-control @error('detail') is-invalid @enderror"
                          placeholder="Masukkan Detail Produk">{{ old('detail') }}</textarea>

                @error('detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga</label>

                <input type="number"
                       name="harga"
                       value="{{ old('harga') }}"
                       class="form-control @error('harga') is-invalid @enderror"
                       placeholder="Contoh: 15000">

                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>

                <input type="number"
                       name="stok"
                       value="{{ old('stok') }}"
                       class="form-control @error('stok') is-invalid @enderror"
                       placeholder="Masukkan Jumlah Stok">

                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Berat Produk (gram)</label>
                <input type="number" name="berat" class="form-control"
                    value="{{ old('berat') }}" min="0" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Foto Produk</label>

                <input type="file"
                       name="foto"
                       accept="image/*"
                       class="form-control @error('foto') is-invalid @enderror"
                       onchange="previewFoto(this)">

                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <img id="fotoPreview"
                     src="#"
                     alt="Preview Foto"
                     style="display:none; width:180px; margin-top:15px; border-radius:8px;">
            </div>

            <div class="form-group">
                <label>Status Produk</label>

                <select name="status" class="form-control">
                    <option value="0" selected>Blok</option>
                    <option value="1">Publis</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>

            <a href="{{ route('backend.produk.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewFoto(input) {
        const preview = document.getElementById('fotoPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush