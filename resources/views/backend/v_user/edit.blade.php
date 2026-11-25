@extends('backend.v_layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Edit User</h3>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Form Edit User</div>
    </div>

    <div class="card-body">

        <form action="{{ route('backend.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama User</label>
                <input type="text" name="nama"
                    value="{{ old('nama', $user->nama) }}"
                    class="form-control @error('nama') is-invalid @enderror">

                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="form-control @error('email') is-invalid @enderror">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>Super Admin</option>
                    <option value="0" {{ old('role', $user->role) == '0' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" name="hp"
                    value="{{ old('hp', $user->hp) }}"
                    class="form-control @error('hp') is-invalid @enderror">

                @error('hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">

                <small class="form-text text-muted">
                    Kosongkan jika tidak ingin mengganti password.
                </small>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Perbarui
            </button>

            <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection