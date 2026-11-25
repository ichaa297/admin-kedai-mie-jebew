
@extends('backend.v_layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Pengaturan Profil</h3>
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
            <a href="#">Pengaturan Profil</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Informasi Profil Saya</div>
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

                <form action="{{ route('backend.pengaturan_profil.update') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama', $user->nama) }}"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Nomor HP</label>
                        <input type="text"
                               name="hp"
                               class="form-control"
                               value="{{ old('hp', $user->hp) }}"
                               maxlength="13">
                    </div>

                    <div class="form-group mb-3">
                        <label>Foto Profil</label>

                        @if($user->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $user->foto) }}"
                                     alt="Foto Profil"
                                     width="120"
                                     height="120"
                                     style="object-fit: cover; border-radius: 50%;">
                            </div>
                        @else
                            <div class="mb-3">
                                <i class="fas fa-user-circle"
                                   style="font-size: 100px; color: #ccc;"></i>
                            </div>
                        @endif

                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept="image/png,image/jpeg">
                        <small class="text-muted">
                            Format JPG/PNG, maksimal 2 MB.
                        </small>
                    </div>

                    <hr>

                    <h5 class="mb-3">Ganti Password</h5>
                    <p class="text-muted">
                        Kosongkan jika tidak ingin mengganti password.
                    </p>

                    <div class="form-group mb-3">
                        <label>Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               autocomplete="new-password">
                    </div>

                    <div class="form-group mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               autocomplete="new-password">
                    </div>

                    
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('backend.beranda') }}"
                           class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CARD PROFIL DI SEBELAH KANAN -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Profil Saya</div>
            </div>

            <div class="card-body text-center">

                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}"
                         alt="Foto Profil"
                         class="rounded-circle mb-3"
                         width="130"
                         height="130"
                         style="object-fit: cover;">
                @else
                    <i class="fas fa-user-circle mb-3"
                       style="font-size: 130px; color: #ccc;"></i>
                @endif

                <h4 class="fw-bold mb-1">
                    {{ $user->nama }}
                </h4>

                <span class="badge badge-primary mb-3">
                    {{ $user->role == 1 ? 'Super Admin' : 'Admin' }}
                </span>

                <hr>

                <div class="text-start mb-3">
                    <small class="text-muted">Email</small>
                    <div class="fw-bold">
                        <i class="fas fa-envelope me-2"></i>
                        {{ $user->email }}
                    </div>
                </div>

                <div class="text-start mb-3">
                    <small class="text-muted">Nomor HP</small>
                    <div class="fw-bold">
                        <i class="fas fa-phone me-2"></i>
                        {{ $user->hp ?? '-' }}
                    </div>
                </div>

                <div class="text-start mb-3">
                    <small class="text-muted">Status Akun</small>
                    <div>
                        @if($user->status == 1)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Tidak Aktif</span>
                        @endif
                    </div>
                </div>

                <hr>

                <small class="text-muted">
                    Profil akun Kedai Mie Jebew
                </small>

            </div>
        </div>
    </div>
</div>

@endsection
