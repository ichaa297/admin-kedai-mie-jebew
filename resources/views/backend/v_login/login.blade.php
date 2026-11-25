<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $judul }} - Kedai Mie Jebew</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('image/logo-mie-jebew.png') }}">

    <!-- CSS Kaiadmin Lite -->
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/kaiadmin.min.css') }}">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f6fb;
        }

        .login-wrapper {
            width: 100%;
            max-width: 460px;
            padding: 20px;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .login-header {
            text-align: center;
            padding: 25px 25px 15px;
            background: white;
        }

        .login-logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .login-body {
            padding: 25px 30px 30px;
        }

        .password-group {
            position: relative;
        }

        .password-group .form-control {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 45px;
            border: none;
            background: transparent;
            color: #6c757d;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
        }

        .toggle-password:hover {
            color: #1572E8;
        }

        .toggle-password:focus {
            outline: none;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="card login-card">

            <!-- HEADER LOGIN -->
            <div class="login-header">

                <img src="{{ asset('image/logo-mie-jebew.png') }}"
                    alt="Logo Kedai Mie Jebew"
                    class="login-logo">

                <h3 class="mb-1">{{ $judul }}</h3>
                <p class="text-muted mb-0">Kedai Mie Jebew</p>

            </div>

            <!-- FORM LOGIN -->
            <div class="login-body">

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('backend.login.submit') }}" method="POST">
                    @csrf

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan Email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>Password</label>

                        <div class="password-group">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan Password">

                            <button
                                type="button"
                                class="toggle-password"
                                id="tombolPassword"
                                onclick="lihatPassword()"
                                aria-label="Lihat password"
                                title="Lihat password">

                                <svg id="ikonPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"/>
                                    <circle cx="12" cy="12" r="3"/>

                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- TOMBOL LOGIN -->
                    <div class="form-group pt-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LIHAT PASSWORD -->
    <script>
        function lihatPassword() {
            const password = document.getElementById('password');
            const ikon = document.getElementById('ikonPassword');
            const tombol = document.getElementById('tombolPassword');

            if (password.type === 'password') {

                password.type = 'text';

                ikon.innerHTML = `
                    <path d="M3 3l18 18"/>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a15.8 15.8 0 0 1-4 4.7"/>
                    <path d="M6.2 6.2C3.5 8.1 2 12 2 12s3.6 7 10 7c1 0 2-.2 2.9-.5"/>
                `;

                tombol.setAttribute('aria-label', 'Sembunyikan password');
                tombol.setAttribute('title', 'Sembunyikan password');

            } else {

                password.type = 'password';

                ikon.innerHTML = `
                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;

                tombol.setAttribute('aria-label', 'Lihat password');
                tombol.setAttribute('title', 'Lihat password');
            }
        }
    </script>

    <!-- JS Kaiadmin Lite -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/kaiadmin.min.js') }}"></script>

</body>
</html>
