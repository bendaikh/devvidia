@extends('admin.layout')

@section('title', 'Landing Systems')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title">Landing Systems</h1>
    <a href="{{ route('admin.landing-systems.create') }}" class="btn btn-success">+ Create New Landing Page</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div style="margin-bottom: 1.5rem;">
        <p style="color: #64748b; font-size: 0.95rem;">
            Manage your landing pages, track performance, and monitor conversions. Each landing page captures leads independently.
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Template</th>
                <th>Status</th>
                <th>Views</th>
                <th>Submissions</th>
                <th>Conversion Rate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($landingPages as $page)
            <tr>
                <td>
                    <strong>{{ $page->name }}</strong>
                    <br>
                    <small style="color: #64748b;">{{ $page->title }}</small>
                </td>
                <td>
                    <code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">
                        /landing/{{ $page->slug }}
                    </code>
                </td>
                <td>
                    <span style="padding: 0.4rem 0.8rem; background: linear-gradient(135deg, #42b883 0%, #35495e 100%); color: white; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                        {{ ucfirst($page->template) }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $page->is_active ? 'active' : 'inactive' }}">
                        {{ $page->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    @if(!empty($page->settings['tiktok_pixel_id']))
                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; margin-left: 0.5rem; padding: 0.25rem 0.5rem; background: #000; color: #fff; border-radius: 4px; font-size: 0.75rem; font-weight: 500;" title="TikTok Pixel: {{ $page->settings['tiktok_pixel_id'] }}">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        </svg>
                        Pixel
                    </span>
                    @endif
                </td>
                <td>{{ number_format($page->views) }}</td>
                <td>{{ number_format($page->submissions) }}</td>
                <td>
                    <strong style="color: {{ $page->conversion_rate > 5 ? '#27ae60' : ($page->conversion_rate > 2 ? '#f39c12' : '#e74c3c') }};">
                        {{ $page->conversion_rate }}%
                    </strong>
                </td>
                <td>
                    <a href="{{ url('/landing/' . $page->slug) }}" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                    <a href="{{ route('admin.landing-systems.edit', $page) }}" class="btn btn-warning" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.landing-systems.destroy', $page) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Are you sure you want to delete this landing page?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 3rem; color: #64748b;">
                    No landing pages yet. Create your first landing page to start capturing leads.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $landingPages->links() }}
    </div>
</div>

<div class="card" style="margin-top: 2rem; background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%); color: white;">
    <h3 style="margin-bottom: 1rem; font-size: 1.25rem;">Quick Stats</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
        <div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">
                {{ $landingPages->sum('views') }}
            </div>
            <div style="opacity: 0.9; font-size: 0.9rem;">Total Views</div>
        </div>
        <div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">
                {{ $landingPages->sum('submissions') }}
            </div>
            <div style="opacity: 0.9; font-size: 0.9rem;">Total Submissions</div>
        </div>
        <div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">
                {{ $landingPages->where('is_active', true)->count() }}
            </div>
            <div style="opacity: 0.9; font-size: 0.9rem;">Active Pages</div>
        </div>
        <div>
            <div style="font-size: 2rem; font-weight: bold; margin-bottom: 0.25rem;">
                @php
                    $totalViews = $landingPages->sum('views');
                    $totalSubs = $landingPages->sum('submissions');
                    $avgConversion = $totalViews > 0 ? round(($totalSubs / $totalViews) * 100, 2) : 0;
                @endphp
                {{ $avgConversion }}%
            </div>
            <div style="opacity: 0.9; font-size: 0.9rem;">Avg Conversion Rate</div>
        </div>
    </div>
</div>
@endsection
