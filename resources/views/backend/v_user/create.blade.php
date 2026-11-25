@extends('backend.v_layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Tambah User</h3>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Form Tambah User</div>
    </div>

    <div class="card-body">

        <form action="{{ route('backend.user.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama User</label>
                <input type="text" name="nama"
                    value="{{ old('nama') }}"
                    class="form-control @error('nama') is-invalid @enderror">

                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="">-- Pilih Role --</option>
                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Super Admin</option>
                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Customer</option>
                </select>

                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>

                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="hp"
                    value="{{ old('hp') }}"
                    class="form-control @error('hp') is-invalid @enderror">

                @error('hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>

            <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection