{{-- Realistic CSS dashboard mockup. $d = ['module','kpis','cols','rows','chart','side'], $series = int[] --}}
@php($max = max($series))
<div class="dash" role="img" aria-label="{{ __('landing.common.demo') }} · {{ $d['module'] }}">
    <aside class="dash-side" aria-hidden="true">
        <div class="dash-brand"><span class="logo-mark sm"></span>Devvidia</div>
        @foreach($d['side'] as $i => $item)
            <div class="dash-nav {{ $i === 1 ? 'is-on' : '' }}"><i></i>{{ $item }}</div>
        @endforeach
    </aside>
    <div class="dash-main" aria-hidden="true">
        <div class="dash-top">
            <div><strong>{{ $d['module'] }}</strong><span>{{ __('landing.common.period') }}</span></div>
            <div class="dash-tools"><span class="dash-search">{{ __('landing.common.search') }}</span><span class="chip">{{ __('landing.common.filter') }}</span><span class="chip chip-blue">{{ __('landing.common.export') }}</span></div>
        </div>
        <div class="dash-kpis">
            @foreach($d['kpis'] as $k)
                <div class="kpi"><span>{{ $k[0] }}</span><b>{{ $k[1] }}</b></div>
            @endforeach
        </div>
        <div class="dash-grid">
            <div class="panel">
                <div class="panel-h">{{ $d['chart'] }}</div>
                <div class="bars">
                    @foreach($series as $j => $v)
                        <span style="--h: {{ round($v / $max * 100) }}%" class="{{ $j === count($series) - 2 ? 'hi' : '' }}"></span>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-table">
                <div class="panel-h">{{ $d['module'] }} · {{ __('landing.common.today') }}<span>{{ __('landing.common.see_all') }}</span></div>
                <table>
                    <thead><tr>@foreach($d['cols'] as $c)<th>{{ $c }}</th>@endforeach</tr></thead>
                    <tbody>
                    @foreach($d['rows'] as $r)
                        <tr><td class="mono">{{ $r[0] }}</td><td>{{ $r[1] }}</td><td>{{ $r[2] }}</td><td><em class="badge b-{{ $r[4] }}">{{ $r[3] }}</em></td></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <span class="demo-tag">{{ __('landing.common.demo') }}</span>
</div>
