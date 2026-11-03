<footer class="footer">
    <div class="wrap foot-grid">
        <div class="foot-brand">
            <a href="{{ $base ?? '' }}#top" class="logo logo-light" aria-label="{{ $L('nav.home') }}">{!! $wordmark !!}<span>Devvidia</span></a>
            <p>{{ $L('footer.intro') }}</p>
        </div>
        <nav aria-label="{{ $L('footer.services') }}"><h3>{{ $L('footer.services') }}</h3><ul>@foreach($L('exp.items') as $it)<li><a href="{{ str_starts_with($it[2], '#') ? ($base ?? '') . $it[2] : $it[2] }}">{{ $it[0] }}</a></li>@endforeach</ul></nav>
        <nav aria-label="{{ $L('footer.solutions') }}"><h3>{{ $L('footer.solutions') }}</h3><ul>@foreach($L('sol.tabs') as $i => $t)<li><a href="{{ $base ?? '' }}#solutions" data-tab="{{ $i }}">{{ $t['name'] }}</a></li>@endforeach</ul></nav>
        <nav aria-label="{{ $L('footer.company') }}"><h3>{{ $L('footer.company') }}</h3><ul><li><a href="{{ $base ?? '' }}#approche">{{ $L('nav.approach') }}</a></li><li><a href="{{ $base ?? '' }}#realisations">{{ $L('nav.work') }}</a></li><li><a href="{{ $base ?? '' }}#faq">{{ $L('nav.faq') }}</a></li><li><a href="{{ $base ?? '' }}#contact">{{ $L('nav.cta') }}</a></li></ul></nav>
        <div><h3>{{ $L('footer.contact') }}</h3><ul class="foot-contact"><li>{{ $L('contact.location') }}</li><li><a href="mailto:support@devvidia.com">support@devvidia.com</a></li>@if($waDigits)<li><a href="{{ $waLink($L('contact.wa_text')) }}" target="_blank" rel="noopener">WhatsApp · {{ $whatsappPhone }}</a></li>@endif</ul></div>
    </div>
    <div class="wrap foot-bottom">
        <p>&copy; {{ date('Y') }} Devvidia. {{ $L('footer.rights') }}</p>
        @include('landing.partials.legal-links')
        <a href="{{ $base ?? '' }}#top">{{ $L('footer.top') }} ↑</a>
    </div>
</footer>
