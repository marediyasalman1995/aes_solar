<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error') — {{ config('app.name', 'AES Energy') }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- RemixIcons & Bootstrap -->
    <link href="{{ asset('build/assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --blue-900: #0b3d5c;
            --blue-700: #0f6aa8;
            --blue-500: #2e9cdb;
            --amber: #f59e0b;
            --emerald: #10b981;
            --rose: #f43f5e;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #061521 0%, #0b253a 50%, #081827 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
            position: relative;
            padding: 30px 20px;
        }

        /* Ambient glowing background orbs */
        .ambient-glow-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(15, 106, 168, 0.25) 0%, rgba(15, 106, 168, 0) 70%);
            top: -150px;
            left: -150px;
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.18) 0%, rgba(245, 158, 11, 0) 70%);
            bottom: -100px;
            right: -100px;
            pointer-events: none;
            z-index: 0;
        }

        .error-header {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
        }

        .brand-logo-circle {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
        }

        .brand-link h3 {
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .error-container {
            position: relative;
            z-index: 2;
            max-width: 780px;
            width: 100%;
            margin: auto;
            text-align: center;
            padding: 40px 24px;
        }

        .error-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            border-radius: 28px;
            padding: 50px 40px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.5);
        }

        .error-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #fef08a;
            padding: 6px 18px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 24px;
        }

        .error-code-glitch {
            font-size: clamp(4.5rem, 12vw, 7.5rem);
            font-weight: 900;
            line-height: 1;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #ffffff 0%, #bae6fd 40%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.04em;
            text-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .error-title {
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 14px;
        }

        .error-desc {
            color: #cbd5e1;
            font-size: 1rem;
            line-height: 1.7;
            max-width: 540px;
            margin: 0 auto 32px;
        }

        /* Action Buttons */
        .error-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .btn-home {
            background: linear-gradient(135deg, #0284c7 0%, #0f6aa8 100%);
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 24px rgba(2, 132, 199, 0.35);
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background: linear-gradient(135deg, #0369a1 0%, #0b3d5c 100%);
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(2, 132, 199, 0.45);
            color: #ffffff;
        }

        .btn-support {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            padding: 12px 26px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-support:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #fef08a;
            transform: translateY(-2px);
        }

        /* Quick Navigation Strip */
        .quick-links-strip {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .quick-link-item {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .quick-link-item:hover {
            color: #38bdf8;
        }

        .error-footer {
            position: relative;
            z-index: 2;
            text-align: center;
            font-size: 0.82rem;
            color: #64748b;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .error-card {
                padding: 35px 20px;
            }
            .error-actions {
                flex-direction: column;
            }
            .btn-home, .btn-support {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<div class="ambient-glow-1"></div>
<div class="ambient-glow-2"></div>

<!-- HEADER BRANDING -->
<div class="error-header">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('footer_logo') }}" alt="AES Energy" style="height: 63px; width: auto; object-fit: contain; display: block;">
    </a>
</div>

<!-- MAIN ERROR CONTAINER -->
<div class="error-container">
    <div class="error-card">
        
        <div class="error-badge-pill">
            <i class="@yield('badge_icon', 'ri-alert-line')"></i>
            <span>@yield('badge_text', 'Solar Grid Notice')</span>
        </div>

        <div class="error-code-glitch">
            @yield('code', '404')
        </div>

        <h1 class="error-title">
            @yield('headline', 'Rooftop Pathway Not Found')
        </h1>

        <p class="error-desc">
            @yield('message', 'The page or resource you are looking for has been moved, disconnected, or does not exist on our solar network.')
        </p>

        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn-home">
                <i class="ri-home-4-line"></i>
                <span>Return to Homepage</span>
            </a>
            <a href="{{ route('contact') }}" class="btn-support">
                <i class="ri-customer-service-2-line"></i>
                <span>Contact 24×7 Support Desk</span>
            </a>
        </div>

        <!-- QUICK HELPFUL LINKS -->
        <div class="quick-links-strip">
            <a href="{{ route('solutions') }}" class="quick-link-item">
                <i class="ri-sun-line"></i> Solar Solutions
            </a>
            <a href="{{ route('products') }}" class="quick-link-item">
                <i class="ri-flashlight-line"></i> Products &amp; Specs
            </a>
            <a href="{{ route('suryaghar') }}" class="quick-link-item">
                <i class="ri-government-line"></i> PM Surya Ghar
            </a>
            <a href="{{ route('faqs') }}" class="quick-link-item">
                <i class="ri-questionnaire-line"></i> Solar FAQs
            </a>
            <a href="{{ route('login') }}" class="quick-link-item">
                <i class="ri-user-smile-line"></i> Customer Portal
            </a>
        </div>

    </div>
</div>

<!-- FOOTER -->
<div class="error-footer">
    <span>© {{ date('Y') }} AES Energy (AES Solar Energy Pvt Ltd) · MNRE Empanelled Solar EPC Partner</span>
</div>

</body>
</html>
