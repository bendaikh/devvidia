@php
    $L = fn ($k) => __('landing.' . $k);
    $locale = app()->getLocale();
    $other = $locale === 'fr' ? 'en' : 'fr';
    $waDigits = preg_replace('/[^0-9]/', '', $whatsappPhone ?? '');
    $waLink = fn ($text) => $waDigits ? 'https://wa.me/' . $waDigits . '?text=' . rawurlencode($text) : '#contact';
    $series = [[38,52,46,61,58,72,66,80,74,90],[22,30,28,41,37,52,48,60,57,70],[60,48,66,54,72,58,76,62,84,70],[40,44,42,46,45,47,44,48,46,47],[48,62,55,70,64,78,71,86,80,92],[20,35,62,80,55,40,58,88,76,44],[50,58,63,70,76,80,84,86,88,90],[55,62,70,78,84,90,86,72,68,80]];
    $wordmark = '<svg class="logo-svg" width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor"/><path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $waIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2-1.41.25-.7.25-1.29.18-1.41-.08-.13-.27-.2-.57-.35M12.05 21.79h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.88 9.89-9.88a9.83 9.83 0 0 1 9.88 9.89c0 5.45-4.44 9.88-9.88 9.88M20.46 3.49A11.82 11.82 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.14 1.59 5.95L.06 24l6.3-1.65a11.88 11.88 0 0 0 5.68 1.45h.01c6.55 0 11.89-5.34 11.89-11.89 0-3.18-1.24-6.16-3.48-8.41"/></svg>';
    $arrow = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $L('meta.title') }}</title>
    <meta name="description" content="{{ $L('meta.description') }}">
    <link rel="canonical" href="{{ url('/') . ($locale === 'en' ? '/?lang=en' : '/') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('/') }}/?lang=fr">
    <link rel="alternate" hreflang="en" href="{{ url('/') }}/?lang=en">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Devvidia">
    <meta property="og:title" content="{{ $L('meta.title') }}">
    <meta property="og:description" content="{{ $L('meta.description') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:locale" content="{{ $L('meta.og_locale') }}">
    @if($projects->first()?->image_path)<meta property="og:image" content="{{ asset('storage/' . $projects->first()->image_path) }}">@endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#0B1B3F">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&family=inter-tight:500,600,700&family=jetbrains-mono:400,500&display=swap" rel="stylesheet">
    <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'Devvidia', 'url' => url('/'), 'description' => $L('meta.description'), 'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Agadir', 'addressCountry' => 'MA']] + ($waDigits ? ['telephone' => '+' . $waDigits] : []), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @include('landing.partials.styles')
</head>
<body>
<a class="skip" href="#main">{{ $L('nav.skip') }}</a>

{{-- ============ HEADER ============ --}}
<header class="site-header" id="top">
    <div class="wrap header-in">
        <a href="#top" class="logo" aria-label="{{ $L('nav.home') }}">{!! $wordmark !!}<span>Devvidia</span></a>
        <nav class="main-nav" id="mainNav" aria-label="Navigation">
            <ul>
                <li><a href="#services">{{ $L('nav.services') }}</a></li>
                <li><a href="#solutions">{{ $L('nav.solutions') }}</a></li>
                <li><a href="#realisations">{{ $L('nav.work') }}</a></li>
                <li><a href="#approche">{{ $L('nav.approach') }}</a></li>
                <li><a href="#faq">{{ $L('nav.faq') }}</a></li>
            </ul>
            <div class="nav-mobile-extra">
                <a href="#contact" class="btn btn-primary">{{ $L('nav.cta') }} {!! $arrow !!}</a>
            </div>
        </nav>
        <div class="header-actions">
            <div class="lang" role="group" aria-label="{{ $L('nav.lang') }}">
                <a href="?lang=fr" hreflang="fr" lang="fr" @if($locale==='fr') aria-current="true" class="on" @endif>FR</a>
                <a href="?lang=en" hreflang="en" lang="en" @if($locale==='en') aria-current="true" class="on" @endif>EN</a>
            </div>
            <a href="#contact" class="btn btn-primary btn-sm hide-sm">{{ $L('nav.cta') }}</a>
            <button class="burger" type="button" aria-expanded="false" aria-controls="mainNav" data-open="{{ $L('nav.open') }}" data-close="{{ $L('nav.close') }}" aria-label="{{ $L('nav.open') }}"><span></span><span></span></button>
        </div>
    </div>
</header>

<main id="main">
{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="wrap hero-in">
        <div class="hero-copy reveal">
            <p class="eyebrow">{{ $L('hero.eyebrow') }}</p>
            <h1 class="display">
                <span>{{ $L('hero.l1') }}</span>
                <span>{{ $L('hero.l2') }}</span>
                <span><em class="hl">{{ $L('hero.l3_a') }}</em> {{ $L('hero.l3_b') }}</span>
            </h1>
            <p class="lead">{{ $L('hero.desc') }}</p>
            <div class="cta-row">
                <a href="#contact" class="btn btn-primary btn-lg">{{ $L('hero.cta1') }} {!! $arrow !!}</a>
                <a href="#services" class="btn btn-ghost btn-lg">{{ $L('hero.cta2') }}</a>
            </div>
            <p class="loc"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg>{{ $L('hero.location') }}</p>
        </div>

        <div class="hero-visual reveal" role="img" aria-label="{{ $L('hero.dash_label') }}">
            <div class="hv-scale">
                <div class="window">
                    <div class="win-bar" aria-hidden="true"><i></i><i></i><i></i><span>app.devvidia · {{ strtolower($L('hero.title')) }}</span></div>
                    <div class="hero-dash" aria-hidden="true">
                        <aside class="dash-side">
                            <div class="dash-brand"><span class="logo-mark sm"></span>Devvidia</div>
                            @foreach($L('hero.nav') as $i => $n)<div class="dash-nav {{ $i===0?'is-on':'' }}"><i></i>{{ $n }}</div>@endforeach
                        </aside>
                        <div class="dash-main">
                            <div class="dash-top"><div><strong>{{ $L('hero.title') }}</strong><span>{{ $L('hero.subtitle') }}</span></div><div class="dash-tools"><span class="dash-search">{{ $L('common.search') }}</span><span class="avatar">DV</span></div></div>
                            <div class="dash-kpis">
                                @foreach($L('hero.kpis') as $k)
                                    <div class="kpi"><span>{{ $k[0] }}</span><b>{{ $k[1] }}</b><small class="{{ str_starts_with($k[2], '+') ? 'up' : 'down' }}">{{ $k[2] }}</small></div>
                                @endforeach
                            </div>
                            <div class="dash-grid">
                                <div class="panel">
                                    <div class="panel-h">{{ $L('hero.chart') }}</div>
                                    <svg class="line" viewBox="0 0 300 110" preserveAspectRatio="none">
                                        <defs><linearGradient id="ga" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#2563FF" stop-opacity=".22"/><stop offset="1" stop-color="#2563FF" stop-opacity="0"/></linearGradient></defs>
                                        <g stroke="#E6EBF5" stroke-width="1"><line x1="0" y1="27" x2="300" y2="27"/><line x1="0" y1="55" x2="300" y2="55"/><line x1="0" y1="83" x2="300" y2="83"/></g>
                                        <path d="M0 88 L33 80 L66 84 L100 66 L133 70 L166 52 L200 58 L233 38 L266 42 L300 20 L300 110 L0 110Z" fill="url(#ga)"/>
                                        <path class="draw" d="M0 88 L33 80 L66 84 L100 66 L133 70 L166 52 L200 58 L233 38 L266 42 L300 20" fill="none" stroke="#2563FF" stroke-width="2.2" stroke-linejoin="round"/>
                                        <path d="M0 96 L33 92 L66 94 L100 86 L133 88 L166 78 L200 82 L233 70 L266 74 L300 62" fill="none" stroke="#7C5CFF" stroke-width="1.5" stroke-dasharray="3 3" opacity=".7"/>
                                    </svg>
                                    <div class="months">@foreach($L('hero.months') as $m)<span>{{ $m }}</span>@endforeach</div>
                                </div>
                                <div class="panel">
                                    <div class="panel-h">{{ $L('hero.stock') }}</div>
                                    @foreach($L('hero.stock_items') as $s)<div class="stock-row"><span>{{ $s[0] }}</span><em class="badge b-warn">{{ $s[1] }}</em></div>@endforeach
                                    <div class="panel-h mt">{{ $L('hero.hr') }}</div>
                                    <div class="stock-row"><span>{{ $L('hero.hr_present') }}</span><b>{{ $L('hero.hr_value') }}</b></div>
                                    <div class="meter"><span style="width:86%"></span></div>
                                </div>
                                <div class="panel panel-table span2">
                                    <div class="panel-h">{{ $L('hero.orders') }}<span>{{ $L('common.see_all') }}</span></div>
                                    <table><thead><tr>@foreach($L('hero.cols') as $c)<th>{{ $c }}</th>@endforeach</tr></thead>
                                        <tbody>@foreach($L('hero.rows') as $r)<tr><td class="mono">{{ $r[0] }}</td><td>{{ $r[1] }}</td><td>{{ $r[2] }}</td><td><em class="badge b-{{ $r[4] }}">{{ $r[3] }}</em></td></tr>@endforeach</tbody></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="phone float-a" aria-hidden="true">
                    <div class="phone-notch"></div>
                    <p class="ph-t">{{ $L('hero.mobile_title') }}</p>
                    <em class="badge b-info">{{ $L('hero.mobile_status') }}</em>
                    <ol class="ph-steps">@foreach($L('hero.mobile_steps') as $i => $s)<li class="{{ $i < 2 ? 'done' : '' }}">{{ $s }}</li>@endforeach</ol>
                    <div class="ph-bars"><span style="height:40%"></span><span style="height:65%"></span><span style="height:50%"></span><span style="height:85%"></span><span style="height:70%"></span></div>
                </div>
                <div class="toast float-b" aria-hidden="true"><span class="dot-ok"></span><div><b>{{ $L('hero.notif') }}</b><small>{{ $L('hero.notif_sub') }}</small></div></div>
                <span class="demo-tag hero-tag" aria-hidden="true">{{ $L('common.demo') }}</span>
            </div>
        </div>
    </div>
    <div class="wrap">
        <ul class="values reveal">
            @foreach($L('values') as $i => $v)
                <li><span class="v-ico" aria-hidden="true">@if($i===0)<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5" fill="currentColor"/></svg>@elseif($i===1)<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M13 2 4 14h7l-1 8 9-12h-7z" stroke-linejoin="round"/></svg>@else<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 17l6-6 4 4 8-8M15 7h6v6" stroke-linecap="round" stroke-linejoin="round"/></svg>@endif</span><div><b>{{ $v[0] }}</b><p>{{ $v[1] }}</p></div></li>
            @endforeach
        </ul>
    </div>
</section>

{{-- ============ EXPERTISES ============ --}}
<section class="sec" id="services" aria-labelledby="exp-title">
    <div class="wrap split-head reveal">
        <div>
            <p class="eyebrow">{{ $L('exp.eyebrow') }}</p>
            <h2 class="h2" id="exp-title">{{ $L('exp.title_a') }}<br>{{ $L('exp.title_b') }} <em class="hl">{{ $L('exp.title_hl') }}</em></h2>
        </div>
        <p class="sub">{{ $L('exp.desc') }}</p>
    </div>
    <div class="wrap">
        <ol class="exp-grid">
            @foreach($L('exp.items') as $i => $it)
                <li class="reveal" style="--d: {{ $i * 60 }}ms">
                    <a href="{{ $it[2] }}" class="exp-item">
                        <span class="exp-num">{{ sprintf('%02d', $i + 1) }}</span>
                        <h3>{{ $it[0] }}</h3>
                        <p>{{ $it[1] }}</p>
                        <span class="exp-tags">{{ $it[3] }}</span>
                        <span class="exp-go" aria-hidden="true">{!! $arrow !!}</span>
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ============ SOLUTIONS ============ --}}
<section class="sec sec-tint" id="solutions" aria-labelledby="sol-title">
    <div class="wrap sol-layout">
        <div class="sol-left reveal">
            <p class="eyebrow">{{ $L('sol.eyebrow') }}</p>
            <h2 class="h2" id="sol-title">{{ $L('sol.title_a') }} <em class="hl">{{ $L('sol.title_hl') }}</em> {{ $L('sol.title_b') }}</h2>
            <p class="sub">{{ $L('sol.desc') }}</p>
            <div class="tabs" role="tablist" aria-label="{{ $L('sol.tablist') }}" aria-orientation="vertical">
                @foreach($L('sol.tabs') as $i => $t)
                    <button role="tab" type="button" id="tab-{{ $i }}" aria-controls="panel-{{ $i }}" aria-selected="{{ $i===0 ? 'true' : 'false' }}" tabindex="{{ $i===0 ? '0' : '-1' }}"><span class="mono">{{ sprintf('%02d', $i + 1) }}</span>{{ $t['name'] }}</button>
                @endforeach
            </div>
        </div>
        <div class="sol-right reveal">
            @foreach($L('sol.tabs') as $i => $t)
                <div class="tab-panel" role="tabpanel" id="panel-{{ $i }}" aria-labelledby="tab-{{ $i }}" tabindex="0" @if($i) hidden @endif>
                    <div class="tp-head">
                        <div><h3>{{ $t['title'] }}</h3><p>{{ $t['desc'] }}</p></div>
                        <a href="#contact" class="link" data-project-type="{{ $i===1 ? 1 : 4 }}">{{ $L('sol.cta') }} {!! $arrow !!}</a>
                    </div>
                    <div class="dash-frame">@include('landing.partials.dash', ['d' => $t['dash'], 'series' => $series[$i]])</div>
                    <ul class="tp-points">@foreach($t['points'] as $p)<li>{{ $p }}</li>@endforeach</ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ APPROCHE ============ --}}
<section class="sec" id="approche" aria-labelledby="app-title">
    <div class="wrap split-head reveal">
        <div>
            <p class="eyebrow">{{ $L('app.eyebrow') }}</p>
            <h2 class="h2" id="app-title">{{ $L('app.title_a') }}<br><em class="hl">{{ $L('app.title_b') }}</em></h2>
        </div>
        <p class="sub">{{ $L('app.desc') }}</p>
    </div>
    <div class="wrap">
        <ol class="timeline">
            @foreach($L('app.steps') as $i => $s)
                <li class="reveal" style="--d: {{ $i * 90 }}ms">
                    <span class="tl-dot" aria-hidden="true"></span>
                    <span class="tl-num mono">{{ sprintf('%02d', $i + 1) }}</span>
                    <h3>{{ $s[0] }}</h3>
                    <p>{{ $s[1] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ============ REALISATIONS (data-driven: admin > Projects) ============ --}}
<section class="sec sec-tint" id="realisations" aria-labelledby="work-title">
    <div class="wrap split-head reveal">
        <div>
            <p class="eyebrow">{{ $L('work.eyebrow') }}</p>
            <h2 class="h2" id="work-title">{{ $L('work.title_a') }}<br>{{ $L('work.title_b') }}</h2>
        </div>
        <p class="sub">{{ $L('work.desc') }}</p>
    </div>
    <div class="wrap">
        <div class="work-grid">
            @foreach($projects as $i => $project)
                @php($desc = $locale === 'en' ? ($project->description_en ?: $project->description_fr) : ($project->description_fr ?: $project->description_en))
                <article class="work reveal {{ $i === 0 ? 'work-lg' : '' }} {{ $i >= 6 ? 'is-extra' : '' }}" style="--d: {{ ($i % 3) * 70 }}ms">
                    <div class="work-media">
                        @if($project->image_path)
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->name }}" loading="lazy" decoding="async" width="1200" height="800">
                        @else
                            <div class="work-ph" aria-hidden="true">{{ $project->icon }}</div>
                        @endif
                    </div>
                    <div class="work-body">
                        <span class="mono work-idx">{{ $L('work.project') }} {{ sprintf('%02d', $i + 1) }}</span>
                        <h3>{{ $project->name }}</h3>
                        @if($desc)<p>{{ $desc }}</p>@endif
                        <a class="link" href="{{ $waLink($L('work.wa') . ' ' . $project->name) }}" target="_blank" rel="noopener">{{ $L('work.cta') }} {!! $arrow !!}</a>
                    </div>
                </article>
            @endforeach
        </div>
        @if($projects->count() > 6)
            <div class="center"><button type="button" class="btn btn-ghost" id="moreWork" aria-expanded="false">{{ $L('work.more') }} ({{ $projects->count() }})</button></div>
        @endif
    </div>
</section>

{{-- ============ TRUST (dark) ============ --}}
<section class="sec sec-dark" aria-labelledby="trust-title">
    <div class="wrap trust-layout">
        <div class="trust-head reveal">
            <p class="eyebrow eyebrow-light">{{ $L('trust.eyebrow') }}</p>
            <h2 class="h2" id="trust-title">{{ $L('trust.title') }}</h2>
            <p class="sub">{{ $L('trust.desc') }}</p>
            <div class="terminal" aria-hidden="true">
                <div class="win-bar dark"><i></i><i></i><i></i><span>{{ $L('trust.code_title') }}</span></div>
<pre><span class="c-mut">$</span> git push origin main
<span class="c-blue">→</span> tests <span class="c-ok">✓ passed</span>
<span class="c-blue">→</span> build <span class="c-ok">✓</span>
<span class="c-blue">→</span> migrations <span class="c-ok">✓</span>
<span class="c-blue">→</span> deploy <span class="c-vio">production</span> <span class="c-ok">✓ online</span><span class="caret"></span></pre>
            </div>
        </div>
        <ul class="trust-grid">
            @foreach($L('trust.items') as $i => $it)
                <li class="reveal" style="--d: {{ $i * 50 }}ms"><span class="mono">{{ sprintf('%02d', $i + 1) }}</span><h3>{{ $it[0] }}</h3><p>{{ $it[1] }}</p></li>
            @endforeach
        </ul>
    </div>
</section>

{{-- ============ FAQ ============ --}}
<section class="sec" id="faq" aria-labelledby="faq-title">
    <div class="wrap faq-layout">
        <div class="reveal">
            <p class="eyebrow">{{ $L('faq.eyebrow') }}</p>
            <h2 class="h2" id="faq-title">{{ $L('faq.title') }}</h2>
            <p class="sub">{{ $L('faq.desc') }}</p>
            <a href="#contact" class="btn btn-primary">{{ $L('faq.cta') }} {!! $arrow !!}</a>
        </div>
        <div class="faq-list reveal">
            @foreach($L('faq.items') as $i => $q)
                <div class="faq-item">
                    <h3><button type="button" aria-expanded="false" aria-controls="faq-a-{{ $i }}" id="faq-q-{{ $i }}"><span class="mono">{{ sprintf('%02d', $i + 1) }}</span><span class="q">{{ $q[0] }}</span><span class="pm" aria-hidden="true"></span></button></h3>
                    <div class="faq-a" id="faq-a-{{ $i }}" role="region" aria-labelledby="faq-q-{{ $i }}"><div><p>{{ $q[1] }}</p></div></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ CONTACT ============ --}}
<section class="sec sec-tint" id="contact" aria-labelledby="contact-title">
    <div class="wrap contact-layout">
        <div class="reveal">
            <p class="eyebrow">{{ $L('contact.eyebrow') }}</p>
            <h2 class="h2" id="contact-title">{{ $L('contact.title') }}</h2>
            <p class="sub">{{ $L('contact.desc') }}</p>
            <ul class="c-info">
                <li><span class="c-ico" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span><div><b>{{ $L('contact.location') }}</b><small>{{ $L('contact.location_sub') }}</small></div></li>
                @if($waDigits)
                <li><span class="c-ico" aria-hidden="true">{!! $waIcon !!}</span><div><b><a href="{{ $waLink($L('contact.wa_text')) }}" target="_blank" rel="noopener">{{ $whatsappPhone }}</a></b><small>{{ $L('contact.wa_sub') }}</small></div></li>
                @endif
            </ul>
        </div>
        <form class="form reveal" id="contactForm" action="{{ route('contact.store') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="locale" value="{{ $locale }}">
            <div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="f-row">
                <div class="field"><label for="f-name">{{ $L('contact.name') }} <span class="req">*</span></label><input id="f-name" name="name" type="text" autocomplete="name" required maxlength="255" placeholder="{{ $L('contact.name_ph') }}"><p class="err" id="e-name"></p></div>
                <div class="field"><label for="f-email">{{ $L('contact.email') }} <span class="req">*</span></label><input id="f-email" name="email" type="email" autocomplete="email" required maxlength="255" placeholder="{{ $L('contact.email_ph') }}"><p class="err" id="e-email"></p></div>
            </div>
            <div class="f-row">
                <div class="field"><label for="f-phone">{{ $L('contact.phone') }} <span class="req">*</span></label><input id="f-phone" name="phone" type="tel" autocomplete="tel" required maxlength="50" placeholder="{{ $L('contact.phone_ph') }}"><p class="err" id="e-phone"></p></div>
                <div class="field"><label for="f-type">{{ $L('contact.type') }} <span class="req">*</span></label>
                    <select id="f-type" name="project_type" required><option value="">{{ $L('contact.type_ph') }}</option>@foreach($L('contact.types') as $i => $t)<option value="{{ \App\Http\Controllers\LandingController::PROJECT_TYPES[$i] }}">{{ $t }}</option>@endforeach</select><p class="err" id="e-project_type"></p></div>
            </div>
            <div class="field"><label for="f-budget">{{ $L('contact.budget') }} <span class="opt">({{ $L('contact.optional') }})</span></label>
                <select id="f-budget" name="budget"><option value="">{{ $L('contact.budget_ph') }}</option>@foreach($L('contact.budgets') as $b)<option value="{{ $b }}">{{ $b }}</option>@endforeach</select><p class="err" id="e-budget"></p></div>
            <div class="field"><label for="f-desc">{{ $L('contact.desc_label') }} <span class="req">*</span></label><textarea id="f-desc" name="project_idea" rows="5" required minlength="10" maxlength="5000" placeholder="{{ $L('contact.desc_ph') }}"></textarea><p class="err" id="e-project_idea"></p></div>
            <p class="req-note"><span class="req">*</span> {{ $L('contact.required') }}</p>
            <div class="f-actions">
                <button type="submit" class="btn btn-primary btn-lg" data-sending="{{ $L('contact.sending') }}"><span>{{ $L('contact.submit') }}</span> {!! $arrow !!}</button>
                @if($waDigits)<a class="btn btn-wa btn-lg" href="{{ $waLink($L('contact.wa_text')) }}" target="_blank" rel="noopener">{!! $waIcon !!} {{ $L('contact.wa_btn') }}</a>@endif
            </div>
            <div class="form-msg" id="formMsg" role="status" aria-live="polite" hidden></div>
        </form>
    </div>
</section>
</main>

{{-- ============ FOOTER ============ --}}
<footer class="footer">
    <div class="wrap foot-grid">
        <div class="foot-brand">
            <a href="#top" class="logo logo-light" aria-label="{{ $L('nav.home') }}">{!! $wordmark !!}<span>Devvidia</span></a>
            <p>{{ $L('footer.intro') }}</p>
        </div>
        <nav aria-label="{{ $L('footer.services') }}"><h3>{{ $L('footer.services') }}</h3><ul>@foreach($L('exp.items') as $it)<li><a href="{{ $it[2] }}">{{ $it[0] }}</a></li>@endforeach</ul></nav>
        <nav aria-label="{{ $L('footer.solutions') }}"><h3>{{ $L('footer.solutions') }}</h3><ul>@foreach($L('sol.tabs') as $i => $t)<li><a href="#solutions" data-tab="{{ $i }}">{{ $t['name'] }}</a></li>@endforeach</ul></nav>
        <nav aria-label="{{ $L('footer.company') }}"><h3>{{ $L('footer.company') }}</h3><ul><li><a href="#approche">{{ $L('nav.approach') }}</a></li><li><a href="#realisations">{{ $L('nav.work') }}</a></li><li><a href="#faq">{{ $L('nav.faq') }}</a></li><li><a href="#contact">{{ $L('nav.cta') }}</a></li></ul></nav>
        <div><h3>{{ $L('footer.contact') }}</h3><ul class="foot-contact"><li>{{ $L('contact.location') }}</li>@if($waDigits)<li><a href="{{ $waLink($L('contact.wa_text')) }}" target="_blank" rel="noopener">WhatsApp · {{ $whatsappPhone }}</a></li>@endif</ul></div>
    </div>
    <div class="wrap foot-bottom">
        <p>&copy; {{ date('Y') }} Devvidia. {{ $L('footer.rights') }}</p>
        <a href="#top">{{ $L('footer.top') }} ↑</a>
    </div>
</footer>

@if($waDigits)<a class="wa-float" href="{{ $waLink($L('contact.wa_text')) }}" target="_blank" rel="noopener" aria-label="{{ $L('contact.wa_btn') }}">{!! $waIcon !!}</a>@endif

<script>window.DV_I18N = {!! json_encode(['required' => $L('contact.v_required'), 'email' => $L('contact.v_email'), 'phone' => $L('contact.v_phone'), 'min' => $L('contact.v_min'), 'success' => $L('contact.success'), 'error' => $L('contact.error'), 'network' => $L('contact.network')], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!};</script>
@include('landing.partials.script')
</body>
</html>
