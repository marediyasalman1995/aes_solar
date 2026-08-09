<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Portal Login — {{ config('app.name', 'AES Solar Energy') }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="{{ asset('build/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets/toastr_2.1.3/toastr.min.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f6aa8;
            --primary-dark: #0b3d5c;
            --accent: #f59e0b;
            --emerald: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #0b1e2e;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 1080px;
            min-height: 640px;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
            display: grid;
            grid-template-columns: 1.15fr 1fr;
        }

        /* LEFT SOLAR SHOWCASE PANEL */
        .solar-showcase-panel {
            position: relative;
            background: url('{{ asset('images/admin-login-bg.jpg') }}') center center / cover no-repeat;
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            overflow: hidden;
        }

        .solar-showcase-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(145deg, rgba(11, 61, 92, 0.88) 0%, rgba(15, 106, 168, 0.75) 50%, rgba(11, 30, 46, 0.94) 100%);
            z-index: 1;
        }

        .solar-showcase-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo-circle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
        }

        .brand-text h4 {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .brand-text span {
            font-size: 0.75rem;
            color: #bae6fd;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 600;
        }

        .showcase-hero {
            margin: 35px 0;
        }

        .showcase-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fef08a;
            margin-bottom: 18px;
        }

        .showcase-hero h2 {
            font-size: 2.1rem;
            font-weight: 700;
            line-height: 1.28;
            margin-bottom: 14px;
            color: #ffffff;
        }

        .showcase-hero p {
            color: #e0f2fe;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 24px;
            max-width: 440px;
        }

        /* Glassmorphism Stats Cards */
        .glass-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .glass-stat-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 16px;
            transition: transform 0.3s ease;
        }

        .glass-stat-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.18);
        }

        .glass-stat-card .num {
            font-size: 1.45rem;
            font-weight: 700;
            color: #ffffff;
            display: block;
        }

        .glass-stat-card .label {
            font-size: 0.78rem;
            color: #bae6fd;
            font-weight: 500;
        }

        .showcase-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
            color: #bae6fd;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 20px;
        }

        /* RIGHT FORM PANEL */
        .auth-form-panel {
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .portal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 5px 12px;
            border-radius: 30px;
            margin-bottom: 12px;
        }

        .form-header h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-header p {
            color: #64748b;
            font-size: 0.88rem;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-group {
            border-radius: 12px;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .input-group:focus-within {
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
        }

        .input-group-text {
            background: #f8fafc;
            border: none;
            color: #64748b;
            padding-left: 14px;
            padding-right: 12px;
            font-size: 1.1rem;
        }

        .form-control {
            border: none;
            padding: 12px 14px;
            font-size: 0.92rem;
            color: #0f172a;
        }

        .form-control:focus {
            box-shadow: none;
            border: none;
        }

        .btn-toggle-pwd {
            background: #f8fafc;
            border: none;
            color: #64748b;
            padding-right: 14px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .btn-toggle-pwd:hover {
            color: #0284c7;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0284c7 0%, #0f6aa8 100%);
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.96rem;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.25);
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0369a1 0%, #0b3d5c 100%);
            box-shadow: 0 14px 26px rgba(2, 132, 199, 0.35);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .form-footer {
            margin-top: 25px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #0284c7;
        }

        .security-badge {
            margin-top: 14px;
            font-size: 0.75rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        /* RESPONSIVENESS */
        @media (max-width: 900px) {
            .auth-container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }
            .solar-showcase-panel {
                display: none;
            }
            .auth-form-panel {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

<div class="auth-container">
    
    <!-- LEFT SOLAR SHOWCASE PANEL -->
    <div class="solar-showcase-panel">
        <div class="solar-showcase-content">
            
            <!-- Top Branding -->
            <div class="brand-header">
                <div class="brand-logo-circle">
                    <i class="ri-sun-fill"></i>
                </div>
                <div class="brand-text">
                    <h4>AES Energy</h4>
                    <span>Rooftop Solar EPC</span>
                </div>
            </div>

            <!-- Center Headline & Details -->
            <div class="showcase-hero">
                <div class="showcase-tag">
                    <i class="ri-shield-check-fill"></i> MNRE Empanelled Channel Partner
                </div>
                <h2>Next-Gen Solar Management System</h2>
                <p>
                    Engineered to streamline solar plant deployments, real-time generation monitoring, customer referral wallets &amp; 24×7 AMC maintenance.
                </p>

                <!-- Glassmorphism Stats -->
                <div class="glass-stats-grid">
                    <div class="glass-stat-card">
                        <span class="num">38 MW+</span>
                        <span class="label">Installed Capacity</span>
                    </div>
                    <div class="glass-stat-card">
                        <span class="num">4,200+</span>
                        <span class="label">Solar Rooftops</span>
                    </div>
                    <div class="glass-stat-card">
                        <span class="num">25 Years</span>
                        <span class="label">Linear Warranty</span>
                    </div>
                    <div class="glass-stat-card">
                        <span class="num">₹78,000</span>
                        <span class="label">Surya Ghar Subsidy</span>
                    </div>
                </div>
            </div>

            <!-- Footer Meta -->
            <div class="showcase-footer">
                <i class="ri-leaf-line text-warning fs-18"></i>
                <span>Powering Indian households with clean, zero-emission solar energy.</span>
            </div>

        </div>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="auth-form-panel">
        
        <div>
            <div class="form-header">
                <div class="portal-badge">
                    <i class="ri-dashboard-3-line"></i> Admin Console
                </div>
                <h3>Executive Sign In</h3>
                <p>Enter your administrator credentials to access the AES Control Panel</p>
            </div>

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger py-2 px-3 mb-3" style="font-size:0.85rem; border-radius:10px;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="admin@admin.com" value="{{ old('email', 'admin@admin.com') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-lock-2-line"></i></span>
                        <input type="password" id="adminPassword" name="password" class="form-control" placeholder="••••••••" required>
                        <button type="button" class="btn-toggle-pwd" onclick="togglePassword()" title="Toggle password visibility">
                            <i id="eyeIcon" class="ri-eye-line"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                        <label class="form-check-label text-muted" for="rememberMe" style="font-size:0.82rem; cursor:pointer;">
                            Keep me signed in
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Authenticate Admin</span>
                    <i class="ri-arrow-right-line"></i>
                </button>
            </form>
        </div>

        <div class="form-footer">
            <a href="{{ route('home') }}" class="back-link">
                <i class="ri-arrow-left-line"></i>
                <span>Return to Public Website</span>
            </a>
            <div class="security-badge">
                <i class="ri-shield-keyhole-line text-success"></i>
                <span>256-Bit SSL Encrypted Enterprise Session</span>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('assets/jquery_3.5.1/jquery.min.js') }}"></script>
<script src="{{ asset('assets/toastr_2.1.3/toastr.min.js') }}"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('adminPassword');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        } else {
            input.type = 'password';
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        }
    }

    @if (Session::has('message'))
        toastr.{{ Session::get('alert-type', 'info') }}("{{ Session::get('message') }}");
    @endif
</script>
</body>
</html>
