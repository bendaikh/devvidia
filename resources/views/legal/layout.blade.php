@php
    $wordmark = '<svg class="logo-svg" width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor"/><path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · Devvidia</title>
    <meta name="description" content="@yield('description')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#05070D">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&family=inter-tight:500,600,700&family=jetbrains-mono:400,500&display=swap" rel="stylesheet">
    @include('landing.partials.styles')
</head>
<body>
<header class="site-header scrolled" id="top">
    <div class="wrap header-in">
        <a href="{{ url('/') }}" class="logo" aria-label="Devvidia home">{!! $wordmark !!}<span>Devvidia</span></a>
        <nav class="main-nav" id="mainNav" aria-label="Navigation">
            <ul>
                <li><a href="{{ url('/?lang=en') }}#services">Services</a></li>
                <li><a href="{{ url('/pricing') }}">Pricing</a></li>
                <li><a href="{{ url('/?lang=en') }}#realisations">Work</a></li>
                <li><a href="{{ url('/?lang=en') }}#faq">FAQ</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="mailto:support@devvidia.com" class="btn btn-primary btn-sm">Contact us</a>
        </div>
    </div>
</header>
<main id="main" class="legal-main">
    <div class="wrap"><article class="legal-doc">@yield('content')</article></div>
</main>
<footer class="footer">
    <div class="wrap foot-grid">
        <div class="foot-brand">
            <a href="{{ url('/') }}" class="logo logo-light">{!! $wordmark !!}<span>Devvidia</span></a>
            <p>DEVVIDIA LLC · 127 N Higgins Ave Ste 307D #2711, Missoula, MT 59802-4486, USA</p>
        </div>
        <nav aria-label="Legal"><h3>Legal</h3><ul><li><a href="{{ url('/pricing') }}">Pricing</a></li><li><a href="{{ url('/terms') }}">Terms of Service</a></li><li><a href="{{ url('/privacy') }}">Privacy Policy</a></li><li><a href="{{ url('/refund') }}">Refund Policy</a></li></ul></nav>
        <div><h3>Contact</h3><ul class="foot-contact"><li><a href="mailto:support@devvidia.com">support@devvidia.com</a></li><li><a href="{{ url('/') }}">devvidia.com</a></li></ul></div>
    </div>
    <div class="wrap foot-bottom">
        <p>&copy; {{ date('Y') }} DEVVIDIA LLC. All rights reserved.</p>
        @include('landing.partials.legal-links')
    </div>
</footer>
</body>
</html>
