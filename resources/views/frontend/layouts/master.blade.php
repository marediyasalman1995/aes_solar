<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
</head>
<body>

<div id="publicSite">
  @include('frontend.layouts.header')

  <main id="page-content" class="page-fade">
      @yield('content')
  </main>

  @include('frontend.layouts.footer')
</div>

<div id="toast"></div>

<script src="{{ asset('js/frontend.js') }}"></script>
<script>
  // Initialize scroll and reveal effects
  document.addEventListener('DOMContentLoaded', function() {
    initScrollEffects();
  });
</script>
@stack('stackedScripts')
</body>
</html>
