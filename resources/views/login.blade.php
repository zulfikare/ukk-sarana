<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2E86DE 0%, #1E7BC4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 380px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            padding: 30px 25px 25px;
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            border-bottom: 1px solid #e8ecf1;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
            display: inline-block;
            border-radius: 50%;
            background: white;
            padding: 5px;
        }

        .login-header h1 {
            font-size: 22px;
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .login-content {
            padding: 25px;
        }

        .login-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e8ecf1;
            padding-bottom: 0;
        }

        .login-tab {
            flex: 1;
            background: none;
            border: none;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
            color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            margin-bottom: -1px;
            position: relative;
        }

        .login-tab:hover {
            color: #2E86DE;
        }

        .login-tab.active {
            color: white;
            background-color: #2E86DE;
            border-bottom-color: #2E86DE;
            border-radius: 8px 8px 0 0;
            margin-bottom: 0;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 13px;
            font-family: 'Nunito', sans-serif;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: #2E86DE;
            background: white;
            box-shadow: 0 0 0 3px rgba(46, 134, 222, 0.1);
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #2E86DE 0%, #1E7BC4 100%);
            border: none;
            padding: 11px 15px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-top: 5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(46, 134, 222, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check {
            margin-bottom: 12px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-right: 6px;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #2E86DE;
            border-color: #2E86DE;
        }

        .form-check-label {
            font-size: 12px;
            color: #666;
            cursor: pointer;
            user-select: none;
        }

        .login-footer {
            text-align: center;
            padding: 15px 25px 20px;
            border-top: 1px solid #e8ecf1;
        }

        .forgot-password {
            text-decoration: none;
            color: #2E86DE;
            font-size: 12px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #1E7BC4;
            text-decoration: underline;
        }

        .alert {
            border-radius: 6px;
            border: none;
            margin-bottom: 20px;
            padding: 12px 15px;
            font-size: 13px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 576px) {
            .login-header {
                padding: 30px 20px 20px;
            }

            .login-content {
                padding: 25px 20px;
            }

            .logo-img {
                width: 60px;
                height: 60px;
            }

            .login-header h1 {
                font-size: 22px;
            }

            .login-tabs {
                gap: 10px;
            }

            .login-tab {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>

</head>

<body>

    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <img src="{{ asset('sbadmin2/img/logo-SMK8.png') }}" alt="Logo" class="logo-img">
                <h1>Login Sekarang</h1>
            </div>

            <!-- Content -->
            <div class="login-content">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                <!-- Tabs -->
                <div class="login-tabs">
                    <button type="button" class="login-tab active" data-tab="admin">
                        Admin
                    </button>
                    <button type="button" class="login-tab" data-tab="siswa">
                        Siswa
                    </button>
                </div>

                <!-- Admin Form -->
                <div class="tab-pane active" id="admin-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="login_type" value="admin">

                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}"
                                placeholder="Username" required autocomplete="username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="admin-remember" name="remember">
                            <label class="form-check-label" for="admin-remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn-login">Login</button>
                    </form>
                </div>

                <!-- Siswa Form -->
                <div class="tab-pane" id="siswa-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="login_type" value="siswa">

                        <div class="form-group">
                            <label class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                name="nis" value="{{ old('nis') }}"
                                placeholder="Contoh: 12001" required>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="siswa-remember" name="remember">
                            <label class="form-check-label" for="siswa-remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn-login">Login</button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <a href="#" class="forgot-password">Lupa Password?</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Tab switching
        document.querySelectorAll('.login-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const tabName = this.getAttribute('data-tab');

                // Remove active class
                document.querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

                // Add active class
                this.classList.add('active');
                document.getElementById(tabName + '-form').classList.add('active');
            });
        });
    </script>

</body>

</html>
