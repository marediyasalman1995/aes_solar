<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login — {{ config('app.name', 'AES Energy') }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="{{ asset('build/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --blue-900: #0b3d5c;
            --blue-700: #0f6aa8;
            --blue-500: #2e9cdb;
            --amber: #ffb020;
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
            background: #081b29;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .customer-auth-container {
            width: 100%;
            max-width: 1060px;
            min-height: 620px;
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
            background: url('{{ asset('images/hero-solar.jpg') }}') center center / cover no-repeat;
            padding: 48px 42px;
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
            background: linear-gradient(140deg, rgba(11, 61, 92, 0.90) 0%, rgba(15, 106, 168, 0.80) 55%, rgba(6, 23, 36, 0.95) 100%);
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
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
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
            margin: 30px 0;
        }

        .showcase-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.28);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #fef08a;
            margin-bottom: 16px;
        }

        .showcase-hero h2 {
            font-size: 2.1rem;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 12px;
            color: #ffffff;
        }

        .showcase-hero p {
            color: #e0f2fe;
            font-size: 0.92rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        /* Feature List */
        .feature-bullets {
            display: grid;
            gap: 12px;
        }

        .feature-bullet {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 0.88rem;
            font-weight: 500;
            color: #ffffff;
            transition: transform 0.25s ease;
        }

        .feature-bullet:hover {
            transform: translateX(4px);
            background: rgba(255, 255, 255, 0.18);
        }

        .feature-bullet i {
            font-size: 1.2rem;
            color: #fef08a;
        }

        .showcase-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
            color: #bae6fd;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 18px;
        }

        /* RIGHT FORM PANEL */
        .auth-form-panel {
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
        }

        .form-header {
            margin-bottom: 26px;
        }

        .portal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #0284c7;
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
            padding-top: 18px;
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
            margin-top: 12px;
            font-size: 0.75rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        /* RESPONSIVENESS */
        @media (max-width: 900px) {
            .customer-auth-container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }
            .solar-showcase-panel {
                display: none;
            }
            .auth-form-panel {
                padding: 40px 28px;
            }
        }
    </style>
</head>
<body>

<div class="customer-auth-container">
    
    <!-- LEFT SOLAR SHOWCASE PANEL -->
    <div class="solar-showcase-panel">
        <div class="solar-showcase-content">
            
            <!-- Top Branding -->
            <div class="brand-header">
                <img src="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('footer_logo') }}" alt="AES Energy" style="height: 63px; width: auto; object-fit: contain; display: block;">
            </div>

            <!-- Center Headline & Details -->
            <div class="showcase-hero">
                <div class="showcase-tag">
                    <i class="ri-shield-flash-line"></i> 25-Year Clean Energy Warranty
                </div>
                <h2>Your Rooftop Solar Hub &amp; Earnings</h2>
                <p>
                    Log in to monitor your solar plant generation, check referral wallet rewards, raise priority maintenance requests &amp; download digital warranties.
                </p>

                <!-- Feature Bullets -->
                <div class="feature-bullets">
                    <div class="feature-bullet">
                        <i class="ri-flashlight-line"></i>
                        <span>Live Generation &amp; Monthly Savings Breakdown</span>
                    </div>
                    <div class="feature-bullet">
                        <i class="ri-wallet-3-line"></i>
                        <span>Referral Wallet &amp; Direct Bank Payouts</span>
                    </div>
                    <div class="feature-bullet">
                        <i class="ri-customer-service-2-line"></i>
                        <span>24×7 AMC Support &amp; Fast Panel Cleaning</span>
                    </div>
                    <div class="feature-bullet">
                        <i class="ri-file-shield-line"></i>
                        <span>Instant Warranty &amp; Net-Metering Certificates</span>
                    </div>
                </div>
            </div>

            <!-- Footer Meta -->
            <div class="showcase-footer">
                <i class="ri-leaf-line text-warning fs-18"></i>
                <span>Designed exclusively for AES Energy solar rooftop owners.</span>
            </div>

        </div>
    </div>

    <!-- RIGHT FORM PANEL -->
    <div class="auth-form-panel">
        
        <div>
            <div class="form-header">
                <div class="portal-badge">
                    <i class="ri-user-star-line"></i> Customer Portal
                </div>
                <h3>Welcome Back</h3>
                <p>Sign in to access your AES One solar dashboard</p>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-lock-2-line"></i></span>
                        <input type="password" id="customerPassword" name="password" class="form-control" placeholder="Enter your password" required>
                        <button type="button" class="btn-toggle-pwd" onclick="togglePassword()" title="Toggle password visibility">
                            <i id="eyeIcon" class="ri-eye-line"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="remember" style="font-size:0.82rem; cursor:pointer;">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Login to AES One</span>
                    <i class="ri-arrow-right-line"></i>
                </button>
            </form>
        </div>

        <div class="form-footer">
            <a href="{{ route('home') }}" class="back-link">
                <i class="ri-arrow-left-line"></i>
                <span>← Return to Public Website</span>
            </a>
            <div class="security-badge">
                <i class="ri-shield-keyhole-line text-success"></i>
                <span>Protected Customer Session</span>
            </div>
        </div>

    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('customerPassword');
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
</script>
</body>
</html>
