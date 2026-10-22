<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }
        .header {
            background-color: #0b3d5c;
            padding: 30px;
            text-align: center;
        }
        .header img {
            max-height: 60px;
            width: auto;
        }
        .header-title {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            margin: 10px 0 0 0;
            letter-spacing: -0.02em;
        }
        .content {
            padding: 40px 30px;
        }
        .content h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .content p {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 15px;
            color: #475569;
        }
        .card {
            background-color: #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
            border: 1px solid #e2e8f0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #0284c7 0%, #0f6aa8 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.2);
            text-align: center;
        }
        .btn:hover {
            opacity: 0.95;
        }
        .footer {
            background-color: #0f172a;
            padding: 30px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }
        .footer p {
            margin: 0 0 10px 0;
        }
        .footer a {
            color: #38bdf8;
            text-decoration: none;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
        }
        .badge-info {
            background-color: #e0f2fe;
            color: #0369a1;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header Block -->
            <div class="header">
                @php
                    $headerLogo = \App\MyClasses\GeneralHelperFunctions::getSetting('header_logo');
                    if (empty($headerLogo)) {
                        $headerLogo = asset('images/logo.png');
                    }
                    if (!empty($headerLogo) && !preg_match('/^https?:\/\//i', $headerLogo)) {
                        $headerLogo = url($headerLogo);
                    }
                    if (str_contains($headerLogo, 'localhost') || str_contains($headerLogo, '127.0.0.1')) {
                        $appUrl = config('app.url') && config('app.url') !== 'http://localhost' ? config('app.url') : 'https://aesenergy.in';
                        $headerLogo = preg_replace('/^https?:\/\/[^\/]+/', $appUrl, $headerLogo);
                    }

                    $contactEmail = \App\MyClasses\GeneralHelperFunctions::getSetting('email');
                    if (empty($contactEmail)) {
                        $contactEmail = \App\MyClasses\GeneralHelperFunctions::getSetting('mail_from_address');
                    }
                    if (empty($contactEmail)) {
                        $contactEmail = 'info@aesenergy.in';
                    }
                @endphp
                @if(!empty($headerLogo))
                    <img src="{{ $headerLogo }}" alt="AES Energy" style="max-height: 55px; width: auto; display: block; margin: 0 auto; object-fit: contain;">
                @else
                    <div class="header-title">AES ENERGY</div>
                @endif
            </div>

            <!-- Content Block -->
            <div class="content">
                @yield('email_content')
            </div>

            <!-- Footer Block -->
            <div class="footer">
                <p>&copy; {{ date('Y') }} AES Energy. All rights reserved.</p>
                <p>Need support? Contact us at <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
