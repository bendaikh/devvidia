<header class="site-header" id="top">
    <div class="wrap header-in">
        <a href="{{ $base ?? '' }}#top" class="logo" aria-label="{{ $L('nav.home') }}">{!! $wordmark !!}<span>Devvidia</span></a>
        <nav class="main-nav" id="mainNav" aria-label="Navigation">
            <ul>
                <li><a href="{{ $base ?? '' }}#services">{{ $L('nav.services') }}</a></li>
                <li><a href="{{ $base ?? '' }}#solutions">{{ $L('nav.solutions') }}</a></li>
                <li><a href="{{ $base ?? '' }}#realisations">{{ $L('nav.work') }}</a></li>
                <li><a href="{{ $base ?? '' }}#approche">{{ $L('nav.approach') }}</a></li>
                <li><a href="{{ $base ?? '' }}#faq">{{ $L('nav.faq') }}</a></li>
            </ul>
            <div class="nav-mobile-extra">
                <a href="{{ $base ?? '' }}#contact" class="btn btn-primary">{{ $L('nav.cta') }} {!! $arrow !!}</a>
            </div>
        </nav>
        <div class="header-actions">
            @unless($legal ?? false)<div class="lang" role="group" aria-label="{{ $L('nav.lang') }}">
                <a href="?lang=fr" hreflang="fr" lang="fr" @if($locale==='fr') aria-current="true" class="on" @endif>FR</a>
                <a href="?lang=en" hreflang="en" lang="en" @if($locale==='en') aria-current="true" class="on" @endif>EN</a>
            </div>@endunless
            <a href="{{ $base ?? '' }}#contact" class="btn btn-primary btn-sm hide-sm">{{ $L('nav.cta') }}</a>
            <button class="burger" type="button" aria-expanded="false" aria-controls="mainNav" data-open="{{ $L('nav.open') }}" data-close="{{ $L('nav.close') }}" aria-label="{{ $L('nav.open') }}"><span></span><span></span></button>
        </div>
    </div>
</header>
