<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Portal Login — {{ config('app.name', 'AES Solar Energy') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('build/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/toastr_2.1.3/toastr.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d1b2a 0%, #1b263b 50%, #0d3b66 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .admin-login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            max-width: 440px;
            width: 100%;
            padding: 40px 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .admin-login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #f59e0b, #0ea5e9, #10b981);
        }
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(14, 165, 233, 0.12);
            color: #0284c7;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 5px 14px;
            border-radius: 30px;
            margin-bottom: 16px;
        }
        .admin-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }
        .admin-sub {
            color: #64748b;
            font-size: 0.88rem;
            margin-bottom: 26px;
        }
        .form-floating label {
            color: #94a3b8;
            font-size: 0.88rem;
        }
        .form-control {
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            padding: 12px 16px;
            font-size: 0.92rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }
        .btn-admin-login {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-admin-login:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.35);
            transform: translateY(-1px);
            color: #fff;
        }
        .demo-creds {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 12px;
            margin-top: 24px;
            font-size: 0.8rem;
            color: #475569;
            text-align: left;
        }
        .back-web {
            display: inline-block;
            margin-top: 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .back-web:hover {
            color: #0ea5e9;
        }
    </style>
</head>
<body>

<div class="admin-login-card">
    <div class="admin-badge">⚡ Management Console</div>
    <h2 class="admin-title">Admin Sign In</h2>
    <p class="admin-sub">Enter your credentials to access AES Admin Panel</p>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger text-start py-2 px-3 mb-3" style="font-size:0.85rem; border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label fw-semibold text-secondary" style="font-size:0.85rem;">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="admin@admin.com" value="{{ old('email', 'admin@admin.com') }}" required autofocus>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label fw-semibold text-secondary" style="font-size:0.85rem;">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                <label class="form-check-label text-muted" for="rememberMe" style="font-size:0.82rem;">Remember session</label>
            </div>
        </div>

        <button type="submit" class="btn btn-admin-login">Authenticate Admin →</button>
    </form>

    <div class="demo-creds">
        <b>💡 Default Admin Credentials:</b><br>
        Email: <code>admin@admin.com</code><br>
        Password: <i>(Your administrator password)</i>
    </div>

    <a href="{{ route('home') }}" class="back-web">← Return to Public Website</a>
</div>

<script src="{{ asset('assets/jquery_3.5.1/jquery.min.js') }}"></script>
<script src="{{ asset('assets/toastr_2.1.3/toastr.min.js') }}"></script>
<script>
    @if (Session::has('message'))
        toastr.{{ Session::get('alert-type', 'info') }}("{{ Session::get('message') }}");
    @endif
</script>
</body>
</html>
