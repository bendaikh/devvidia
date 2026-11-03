@extends('legal.layout')
@section('title', 'Pricing')
@section('description', 'Devvidia pricing for custom software, scripts, SaaS, websites and digital products.')
@section('content')
<h1>Pricing</h1>
<p class="updated">Last updated: November 3, 2026</p>
<p>Every project is different, so DEVVIDIA LLC prices its work per project. Tell us what you need and we will send you a written quote with the scope, timeline and total price before any work starts or any payment is taken.</p>
<div class="price-grid">
@foreach ([
    ['Custom software development', 'Web applications, business platforms and management software built to your requirements.'],
    ['Scripts', 'Ready-made and custom scripts, automations and integrations.'],
    ['SaaS', 'Software-as-a-service products, including subscription access to our hosted tools.'],
    ['Websites', 'Business websites, landing pages and e-commerce sites.'],
    ['Digital products', 'Downloadable software, templates, source code and other digital goods.'],
] as [$name, $desc])
    <div class="price-card"><h2>{{ $name }}</h2><p>{{ $desc }}</p><p class="amt">Custom quote / contact us</p></div>
@endforeach
</div>
<p>Where a fixed price is shown on a product or checkout page, that price applies. Prices are shown before checkout, and taxes may be added depending on your location. Payments may be processed by our merchant-of-record partners (Paddle, Lemon Squeezy or Polar), who appear as the seller on your receipt.</p>
<div class="legal-cta">
    <h2>Get a quote</h2>
    <p>Email us with a short description of your project and we will reply with a quote.</p>
    <a class="btn btn-primary" href="mailto:support@devvidia.com?subject=Quote%20request">support@devvidia.com</a>
</div>
<p>See also our <a href="{{ url('/terms') }}">Terms of Service</a> and <a href="{{ url('/refund') }}">Refund Policy</a>.</p>
@endsection
