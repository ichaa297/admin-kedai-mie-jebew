
@extends('backend.v_layouts.app')

@section('title', 'Pengaturan Font')

@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">Pengaturan Font</h3>
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
            <a href="#">Pengaturan</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Pengaturan Font</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Atur Tampilan Font</div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('backend.pengaturan_font.update') }}"
                    method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Jenis Font</label>
                        <select name="font_family" id="font_family"
                            class="form-control" required>
                            @foreach(['Poppins', 'Arial', 'Georgia', 'Verdana', 'Tahoma'] as $font)
                                <option value="{{ $font }}"
                                    {{ old('font_family', $user->font_family) == $font ? 'selected' : '' }}>
                                    {{ $font }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Warna Tulisan</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" name="font_color"
                            id="font_color"
                            value="{{ old('font_color', $user->font_color ?? '#333333') }}"
                            style="width: 55px; height: 38px; padding: 3px; cursor: pointer;"
                            required>
                            <span id="warnaLabel">
                                {{ old('font_color', $user->font_color ?? '#333333') }}
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label>Ukuran Font</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" name="font_size"
                                id="font_size"
                                min="12" max="20"
                                value="{{ old('font_size', $user->font_size ?? 14) }}"
                                class="form-range">
                            <span id="ukuranLabel">
                                {{ old('font_size', $user->font_size ?? 14) }} px
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Pengaturan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Preview Font</div>
            </div>
            <div class="card-body">
                <div id="previewFont"
                    style="padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                    <h4>Contoh Tampilan</h4>
                    <p>Admin Kedai Mie Jebew</p>
                    <p>Pengaturan jenis, warna, dan ukuran tulisan.</p>
                    <button type="button" class="btn btn-primary">
                        Contoh Tombol
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const fontFamily = document.getElementById('font_family');
    const fontColor = document.getElementById('font_color');
    const fontSize = document.getElementById('font_size');

    const preview = document.getElementById('previewFont');
    const warnaLabel = document.getElementById('warnaLabel');
    const ukuranLabel = document.getElementById('ukuranLabel');

    function ubahPreview() {
        preview.style.fontFamily = fontFamily.value + ', sans-serif';
        preview.style.color = fontColor.value;
        preview.style.fontSize = fontSize.value + 'px';

        warnaLabel.textContent = fontColor.value;
        warnaLabel.style.setProperty('color', fontColor.value, 'important');

        ukuranLabel.textContent = fontSize.value + ' px';
    }

    fontFamily.addEventListener('change', ubahPreview);
    fontColor.addEventListener('input', ubahPreview);
    fontSize.addEventListener('input', ubahPreview);

    ubahPreview();
</script>
@endsection
