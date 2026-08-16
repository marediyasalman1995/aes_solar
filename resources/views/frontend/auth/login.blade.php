<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Login &amp; Portal — {{ config('app.name', 'AES Energy') }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & RemixIcons -->
    <link href="{{ asset('build/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    
    <style>
        :root {
            --blue-900: #0b3d5c;
            --blue-700: #0f6aa8;
            --blue-500: #2e9cdb;
            --amber: #f59e0b;
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

        .customer-portal-container {
            width: 100%;
            max-width: 1100px;
            min-height: 660px;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 35px 85px rgba(0, 0, 0, 0.45);
            display: grid;
            grid-template-columns: 1.2fr 1fr;
        }

        /* LEFT SOLAR SHOWCASE PANEL */
        .solar-showcase-panel {
            position: relative;
            background: url('{{ asset('images/hero-solar.jpg') }}') center center / cover no-repeat;
            padding: 45px 40px;
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
            background: linear-gradient(145deg, rgba(11, 61, 92, 0.92) 0%, rgba(15, 106, 168, 0.82) 55%, rgba(6, 23, 36, 0.96) 100%);
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
            margin: 25px 0;
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
            margin-bottom: 14px;
        }

        .showcase-hero h2 {
            font-size: 1.95rem;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .showcase-hero p {
            color: #e0f2fe;
            font-size: 0.9rem;
            line-height: 1.55;
            margin-bottom: 20px;
        }

        /* 4 Marketing Cards */
        .marketing-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .marketing-card {
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(10px);
            border-radius: 14px;
            padding: 14px;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .marketing-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.18);
        }

        .marketing-card .m-icon {
            font-size: 1.4rem;
            margin-bottom: 6px;
            display: block;
        }

        .marketing-card h6 {
            font-size: 0.88rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 3px;
        }

        .marketing-card span {
            font-size: 0.76rem;
            color: #bae6fd;
            line-height: 1.35;
            display: block;
        }

        .showcase-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            color: #bae6fd;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 16px;
        }

        .trust-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #fef08a;
            font-weight: 600;
            font-size: 0.84rem;
        }

        /* RIGHT FORM PANEL */
        .auth-form-panel {
            padding: 45px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #ffffff;
        }

        .form-header {
            margin-bottom: 22px;
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
            margin-bottom: 10px;
        }

        .form-header h3 {
            font-size: 1.65rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .form-header p {
            color: #64748b;
            font-size: 0.86rem;
        }

        .form-label {
            font-size: 0.84rem;
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

        .otp-badge-btn {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px dashed #0284c7;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.74rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .otp-badge-btn:hover {
            background: #0284c7;
            color: #ffffff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0284c7 0%, #0f6aa8 100%);
            color: #ffffff;
            border: none;
            padding: 13px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 20px rgba(2, 132, 199, 0.25);
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0369a1 0%, #0b3d5c 100%);
            box-shadow: 0 14px 26px rgba(2, 132, 199, 0.35);
            transform: translateY(-2px);
            color: #ffffff;
        }

        /* NEW CUSTOMER MARKETING BOX */
        .new-customer-promo {
            background: #fffbeb;
            border: 1.5px dashed #fcd34d;
            border-radius: 14px;
            padding: 14px 16px;
            margin-top: 18px;
            text-align: left;
        }

        .new-customer-promo h6 {
            color: #92400e;
            font-size: 0.84rem;
            font-weight: 700;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .new-customer-promo p {
            color: #78350f;
            font-size: 0.78rem;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .promo-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f59e0b;
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .promo-cta-btn:hover {
            background: #d97706;
            color: #ffffff;
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #0284c7;
        }

        /* RESPONSIVENESS */
        @media (max-width: 900px) {
            .customer-portal-container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }
            .solar-showcase-panel {
                display: none;
            }
            .auth-form-panel {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>

<div class="customer-portal-container">
    
    <!-- LEFT SOLAR MARKETING SHOWCASE PANEL -->
    <div class="solar-showcase-panel">
        <div class="solar-showcase-content">
            
            <!-- Top Branding -->
            <div class="brand-header">
                <img src="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('footer_logo') }}" alt="AES Energy" style="height: 63px; width: auto; object-fit: contain; display: block;">
            </div>

            <!-- Center Headline & Details -->
            <div class="showcase-hero">
                <div class="showcase-tag">
                    <i class="ri-shield-check-fill"></i> MNRE Approved Solar EPC Partner
                </div>
                <h2>Turn Your Rooftop into a Clean Power Plant</h2>
                <p>
                    Join 4,200+ Indian homeowners generating zero-emission electricity, tracking real-time units &amp; earning direct referral rewards.
                </p>

                <!-- 4 Marketing Value Cards -->
                <div class="marketing-grid">
                    <div class="marketing-card">
                        <span class="m-icon text-warning">⚡</span>
                        <h6>Zero Electricity Bills</h6>
                        <span>Cut monthly DISCOM bills by up to 90% with Tier-1 Mono PERC panels.</span>
                    </div>

                    <div class="marketing-card">
                        <span class="m-icon text-info">🏛️</span>
                        <h6>₹78,000 DBT Subsidy</h6>
                        <span>Direct government bank subsidy under PM Surya Ghar Yojana.</span>
                    </div>

                    <div class="marketing-card">
                        <span class="m-icon text-success">💰</span>
                        <h6>Refer &amp; Earn ₹500+</h6>
                        <span>Direct wallet cash rewards when friends &amp; neighbours go solar.</span>
                    </div>

                    <div class="marketing-card">
                        <span class="m-icon text-primary">🛡️</span>
                        <h6>25-Yr Peace of Mind</h6>
                        <span>Linear performance warranty + 5-year free proactive maintenance.</span>
                    </div>
                </div>
            </div>

            <!-- Footer Trust Rating -->
            <div class="showcase-footer">
                <div class="trust-rating">
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <i class="ri-star-fill"></i>
                    <span>4.9 / 5.0 Rating</span>
                </div>
                <span>4,200+ Rooftops Live</span>
            </div>

        </div>
    </div>

    <!-- RIGHT LOGIN & NEW CUSTOMER ONBOARDING FORM -->
    <div class="auth-form-panel">
        
        <div>
            <div class="form-header">
                <div class="portal-badge">
                    <i class="ri-user-smile-line"></i> Customer Sign In
                </div>
                <h3>Welcome Back</h3>
                <p id="authSubtitle">Enter your email address to access your solar plant &amp; wallet</p>
            </div>

            <form id="customerLoginForm" method="POST" action="{{ route('login.otp') }}">
                @csrf
                
                <!-- Email Section -->
                <div id="emailSection">
                    <div class="mb-3">
                        <label class="form-label">Registered Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-mail-line"></i></span>
                            <input type="email" name="email" id="emailInput" class="form-control" placeholder="e.g. rohan.sharma@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <button type="button" class="btn-submit" id="sendOtpBtn" onclick="handleSendOtp()">
                        <span>Send Verification Code</span>
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>

                <!-- OTP Verification Section -->
                <div id="otpSection" style="display: none;">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0">Enter OTP</label>
                            <span style="font-size:0.75rem; color:#64748b;" id="otpHint">
                                Code: <b id="testOtpVal">xxxx</b>
                                <button type="button" class="otp-badge-btn ms-1" onclick="fillTestOtp()">Auto-Fill</button>
                            </span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-key-2-line"></i></span>
                            <input type="text" name="otp" id="otpInput" class="form-control" placeholder="Enter 4-digit OTP" maxlength="4">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span id="countdownText" style="font-size:0.8rem; color:#64748b;">
                            Resend code in <b id="timerCount">30</b>s
                        </span>
                        <button type="button" id="resendOtpBtn" class="btn btn-link p-0 text-primary fw-bold text-decoration-none" style="display:none; font-size:0.8rem;" onclick="handleSendOtp()">
                            Resend Code
                        </button>
                    </div>

                    <button type="submit" class="btn-submit" id="loginSubmitBtn">
                        <span>Login to AES One</span>
                        <i class="ri-arrow-right-line"></i>
                    </button>
                </div>
            </form>

            <!-- NEW CUSTOMER MARKETING CALLOUT -->
            <div class="new-customer-promo">
                <h6><i class="ri-sun-line text-warning"></i> New to Rooftop Solar?</h6>
                <p>Book a free shadow audit, load assessment &amp; claim up to ₹78,000 subsidy.</p>
                <a href="{{ route('contact') }}" class="promo-cta-btn">
                    <span>Book Free Site Survey</span>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('home') }}" class="back-link">
                <i class="ri-arrow-left-line"></i>
                <span>Return to Public Website</span>
            </a>
        </div>

    </div>

</div>

<div id="toast"></div>

<script src="{{ asset('assets/jquery_3.5.1/jquery.min.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script>
    let countdownInterval;

    function startTimer() {
        clearInterval(countdownInterval);
        let seconds = 30;
        document.getElementById('timerCount').innerText = seconds;
        document.getElementById('countdownText').style.display = 'inline';
        document.getElementById('resendOtpBtn').style.display = 'none';

        countdownInterval = setInterval(() => {
            seconds--;
            document.getElementById('timerCount').innerText = seconds;
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdownText').style.display = 'none';
                document.getElementById('resendOtpBtn').style.display = 'inline';
            }
        }, 1000);
    }

    function handleSendOtp() {
        const email = document.getElementById('emailInput').value;
        if (!email || !email.includes('@')) {
            showToast('Please enter a valid email address.', 'error');
            return;
        }

        const btn = document.getElementById('sendOtpBtn');
        btn.disabled = true;
        btn.innerHTML = '<span>Sending Code...</span> <i class="ri-loader-4-line ri-spin"></i>';

        fetch("{{ route('login.sendOtp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email: email })
        })
        .then(res => {
            if (!res.ok) {
                return res.json().then(err => { throw err; });
            }
            return res.json();
        })
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<span>Send Verification Code</span> <i class="ri-arrow-right-line"></i>';
            if (data.success) {
                showToast(data.message, 'success');
                document.getElementById('testOtpVal').innerText = data.otp;
                document.getElementById('emailSection').style.display = 'none';
                document.getElementById('otpSection').style.display = 'block';
                document.getElementById('authSubtitle').innerText = 'Verification code has been sent to ' + email;
                startTimer();
            } else {
                showToast(data.message || 'Verification failed.', 'error');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<span>Send Verification Code</span> <i class="ri-arrow-right-line"></i>';
            showToast(err.message || 'Error occurred while sending code.', 'error');
        });
    }

    function fillTestOtp() {
        const code = document.getElementById('testOtpVal').innerText;
        document.getElementById('otpInput').value = code;
        showToast('Test OTP ' + code + ' applied!', 'info');
    }

    document.getElementById('customerLoginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('loginSubmitBtn');
        const form = this;
        const email = document.getElementById('emailInput').value;
        const otp = document.getElementById('otpInput').value;

        btn.disabled = true;
        btn.innerHTML = '<span>Verifying Code...</span> <i class="ri-loader-4-line ri-spin"></i>';

        fetch("{{ route('login.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email: email, otp: otp })
        })
        .then(res => {
            if (!res.ok) {
                return res.json().then(err => { throw err; });
            }
            return res.json();
        })
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 800);
            } else {
                btn.disabled = false;
                btn.innerHTML = '<span>Login to AES One</span> <i class="ri-arrow-right-line"></i>';
                showToast(data.message || 'Invalid code. Please try again.', 'error');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<span>Login to AES One</span> <i class="ri-arrow-right-line"></i>';
            showToast(err.message || 'Login failed. Please enter the correct OTP.', 'error');
        });
    });
</script>
</body>
</html>
