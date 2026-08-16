<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('favicon') }}" type="image/x-icon">
<title>@yield('meta_title', 'AES Energy — Solar for Every Rooftop')</title>
<meta name="description" content="@yield('meta_description', '')">
<meta name="keywords" content="@yield('meta_keyword', '')">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
