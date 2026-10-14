<style>
:root{
  --navy:#0B1B3F; --navy-2:#0F2554; --ink:#0E1730; --text:#3B4660; --muted:#6B7690;
  --blue:#2563FF; --blue-d:#1A4FE0; --blue-50:#EEF3FF; --violet:#7C5CFF;
  --bg:#FFFFFF; --tint:#F5F7FB; --line:#E3E8F2; --line-2:#EDF1F7;
  --ok:#12A37A; --warn:#D98A0B; --bad:#E0475B;
  --r:10px; --r-sm:6px; --sh:0 1px 2px rgba(14,23,48,.04),0 12px 32px -12px rgba(14,23,48,.14);
  --f-head:"Inter Tight","Inter",system-ui,sans-serif; --f-body:"Inter",system-ui,-apple-system,"Segoe UI",sans-serif; --f-mono:"JetBrains Mono",ui-monospace,Menlo,monospace;
  --wrap:1240px; --hh:72px;
}
*,*::before,*::after{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:calc(var(--hh) + 12px);-webkit-text-size-adjust:100%}
body{margin:0;font-family:var(--f-body);color:var(--text);background:var(--bg);font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;overflow-x:hidden}
img{max-width:100%;display:block}
a{color:inherit;text-decoration:none}
button,input,select,textarea{font:inherit;color:inherit}
h1,h2,h3{font-family:var(--f-head);color:var(--ink);margin:0;letter-spacing:-.02em}
p{margin:0}
ul,ol{margin:0;padding:0;list-style:none}
.wrap{max-width:var(--wrap);margin:0 auto;padding:0 32px}
.mono{font-family:var(--f-mono);font-size:.78em;letter-spacing:0}
.hl{font-style:normal;color:var(--blue)}
.skip{position:absolute;left:-999px;top:8px;background:var(--navy);color:#fff;padding:8px 14px;border-radius:6px;z-index:100}
.skip:focus{left:12px}
:focus-visible{outline:2px solid var(--blue);outline-offset:3px;border-radius:4px}
.eyebrow{font-family:var(--f-mono);font-size:12px;font-weight:500;letter-spacing:.14em;color:var(--blue);text-transform:uppercase;display:flex;align-items:center;gap:10px;margin-bottom:20px}
.eyebrow::before{content:"";width:22px;height:1px;background:currentColor}
.eyebrow-light{color:#8FB0FF}
.h2{font-size:clamp(30px,3.6vw,48px);line-height:1.08;font-weight:700}
.sub{font-size:17px;color:var(--muted);max-width:440px}

/* buttons */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:8px;padding:12px 20px;font-weight:600;font-size:15px;border:1px solid transparent;cursor:pointer;transition:background .2s,border-color .2s,color .2s,transform .2s,box-shadow .2s;white-space:nowrap;min-height:44px}
.btn svg{transition:transform .2s}
.btn:hover svg{transform:translateX(3px)}
.btn-primary{background:var(--blue);color:#fff;box-shadow:0 6px 16px -6px rgba(37,99,255,.55)}
.btn-primary:hover{background:var(--blue-d)}
.btn-ghost{background:#fff;border-color:var(--line);color:var(--ink)}
.btn-ghost:hover{border-color:var(--ink)}
.btn-wa{background:#fff;color:#128C4B;border-color:#BFE6CF}
.btn-wa:hover{background:#F0FAF4;border-color:#128C4B}
.btn-wa svg{transform:none!important}
.btn-sm{padding:9px 16px;font-size:14px;min-height:40px}
.btn-lg{padding:15px 24px;font-size:15.5px}
.btn[disabled]{opacity:.65;cursor:progress}
.link{display:inline-flex;align-items:center;gap:8px;color:var(--blue);font-weight:600;font-size:15px}
.link:hover svg{transform:translateX(3px)}
.link svg{transition:transform .2s}
.center{text-align:center;margin-top:40px}

/* header */
.site-header{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.88);backdrop-filter:saturate(1.6) blur(12px);-webkit-backdrop-filter:saturate(1.6) blur(12px);border-bottom:1px solid transparent;transition:border-color .2s,box-shadow .2s}
.site-header.scrolled{border-color:var(--line);box-shadow:0 4px 18px -12px rgba(14,23,48,.18)}
.header-in{height:var(--hh);display:flex;align-items:center;gap:32px}
.logo{display:inline-flex;align-items:center;gap:10px;font-family:var(--f-head);font-weight:700;font-size:21px;color:var(--ink);letter-spacing:-.02em}
.logo .logo-svg{color:var(--blue)}
.logo-light{color:#fff}.logo-light .logo-svg{color:#6E95FF}
.main-nav{margin-left:auto}
.main-nav ul{display:flex;gap:4px}
.main-nav ul a{position:relative;display:block;padding:8px 14px;font-size:14.5px;font-weight:500;color:var(--text);transition:color .2s}
.main-nav ul a::after{content:"";position:absolute;left:14px;right:14px;bottom:2px;height:2px;background:var(--blue);transform:scaleX(0);transform-origin:left;transition:transform .25s}
.main-nav ul a:hover,.main-nav ul a.active{color:var(--ink)}
.main-nav ul a:hover::after,.main-nav ul a.active::after{transform:scaleX(1)}
.nav-mobile-extra{display:none}
.header-actions{display:flex;align-items:center;gap:14px}
.lang{display:flex;border:1px solid var(--line);border-radius:8px;padding:3px;gap:2px}
.lang a{font-family:var(--f-mono);font-size:12px;font-weight:500;padding:5px 9px;border-radius:5px;color:var(--muted);min-width:34px;text-align:center}
.lang a.on{background:var(--navy);color:#fff}
.lang a:not(.on):hover{color:var(--ink);background:var(--tint)}
.burger{display:none;width:44px;height:44px;border:1px solid var(--line);border-radius:8px;background:#fff;cursor:pointer;position:relative}
.burger span{position:absolute;left:12px;right:12px;height:1.6px;background:var(--ink);transition:transform .25s,top .25s}
.burger span:first-child{top:17px}.burger span:last-child{top:25px}
.burger[aria-expanded=true] span:first-child{top:21px;transform:rotate(45deg)}
.burger[aria-expanded=true] span:last-child{top:21px;transform:rotate(-45deg)}

/* hero */
.hero{position:relative;padding:72px 0 0;overflow:hidden}
.hero-grid-bg{position:absolute;inset:0;background-image:linear-gradient(var(--line-2) 1px,transparent 1px),linear-gradient(90deg,var(--line-2) 1px,transparent 1px);background-size:56px 56px;mask-image:radial-gradient(ellipse 70% 60% at 75% 35%,#000 20%,transparent 75%);-webkit-mask-image:radial-gradient(ellipse 70% 60% at 75% 35%,#000 20%,transparent 75%);pointer-events:none}
.hero-in{position:relative;display:grid;grid-template-columns:minmax(0,5fr) minmax(0,7fr);gap:56px;align-items:center}
.display{font-size:clamp(40px,5.4vw,74px);line-height:1;font-weight:700;letter-spacing:-.035em;margin-bottom:28px}
.display span{display:block}
.lead{font-size:18px;max-width:520px;color:var(--text);margin-bottom:34px}
.cta-row{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:28px}
.loc{display:flex;align-items:center;gap:8px;color:var(--muted);font-size:14px}
.loc svg{color:var(--blue);flex:none}
.hero-visual{position:relative;padding:28px 0 56px 28px}
.hv-scale{position:relative}
.window{background:#fff;border:1px solid var(--line);border-radius:12px;box-shadow:0 40px 80px -40px rgba(11,27,63,.35),0 1px 2px rgba(11,27,63,.05);overflow:hidden}
.win-bar{display:flex;align-items:center;gap:6px;height:34px;padding:0 14px;border-bottom:1px solid var(--line-2);background:#FAFBFD}
.win-bar i{width:9px;height:9px;border-radius:50%;background:#DCE2EC}
.win-bar span{margin-left:12px;font-family:var(--f-mono);font-size:11px;color:var(--muted)}
.win-bar.dark{background:#0A1633;border-color:#1B2C55}.win-bar.dark i{background:#22355F}.win-bar.dark span{color:#7D8BB0}
.demo-tag{position:absolute;top:10px;right:10px;font-family:var(--f-mono);font-size:10px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);background:#fff;border:1px solid var(--line);padding:3px 8px;border-radius:4px;z-index:3}
.hero-tag{top:7px;right:12px}
.dash .demo-tag{top:auto;bottom:10px;right:10px}
.dash .dash-grid{grid-template-columns:1fr}
.dash .bars{height:72px}

/* shared dashboard */
.hero-dash,.dash{display:grid;grid-template-columns:150px 1fr;font-size:11.5px;color:var(--text);min-height:0}
.dash{position:relative;background:#fff;border:1px solid var(--line);border-radius:12px;overflow:hidden;box-shadow:var(--sh)}
.dash-side{background:var(--navy);color:#AEB9D6;padding:14px 10px;display:flex;flex-direction:column;gap:2px}
.dash-brand{display:flex;align-items:center;gap:8px;color:#fff;font-family:var(--f-head);font-weight:700;font-size:13px;padding:2px 6px 14px}
.logo-mark{display:inline-block;width:14px;height:14px;border-radius:3px;background:linear-gradient(135deg,#4F7BFF,var(--violet))}
.dash-nav{display:flex;align-items:center;gap:8px;padding:7px 8px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.dash-nav i{width:12px;height:12px;border-radius:3px;border:1.5px solid currentColor;opacity:.6;flex:none}
.dash-nav.is-on{background:rgba(255,255,255,.08);color:#fff}
.dash-nav.is-on i{background:var(--blue);border-color:var(--blue);opacity:1}
.dash-main{padding:14px 16px 16px;min-width:0;background:#FBFCFE}
.dash-top{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:12px}
.dash-top strong{display:block;font-family:var(--f-head);font-size:14px;color:var(--ink)}
.dash-top span{font-size:10.5px;color:var(--muted)}
.dash-tools{display:flex;gap:6px;align-items:center}
.dash-search{border:1px solid var(--line);background:#fff;border-radius:6px;padding:4px 10px;min-width:110px;color:#9AA4BB}
.chip{border:1px solid var(--line);background:#fff;border-radius:6px;padding:4px 8px}
.chip-blue,.dash-top .chip-blue{background:var(--blue);color:#fff;border-color:var(--blue)}
.avatar{width:24px;height:24px;border-radius:50%;background:var(--blue-50);color:var(--blue);display:grid;place-items:center;font-weight:600;font-size:9.5px}
.dash-kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:8px;margin-bottom:10px}
.kpi{background:#fff;border:1px solid var(--line-2);border-radius:8px;padding:9px 10px;min-width:0}
.kpi span{display:block;color:var(--muted);font-size:10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.kpi b{display:block;font-family:var(--f-head);font-size:15px;color:var(--ink);white-space:nowrap;letter-spacing:-.01em}
.kpi small{font-size:10px;font-weight:600}.kpi .up{color:var(--ok)}.kpi .down{color:var(--bad)}
.dash-grid{display:grid;grid-template-columns:1.5fr 1fr;gap:10px}
.panel{background:#fff;border:1px solid var(--line-2);border-radius:8px;padding:10px 12px;min-width:0}
.panel.span2{grid-column:span 2}
.panel-h{display:flex;justify-content:space-between;font-weight:600;color:var(--ink);font-size:11px;margin-bottom:8px}
.panel-h span{color:var(--blue);font-weight:500}
.panel-h.mt{margin-top:10px}
.line{width:100%;height:96px;display:block}
.months{display:flex;justify-content:space-between;font-size:9px;color:#9AA4BB;margin-top:4px}
.stock-row{display:flex;justify-content:space-between;align-items:center;padding:4px 0;border-bottom:1px dashed var(--line-2)}
.stock-row b{color:var(--ink)}
.meter{height:5px;background:var(--line-2);border-radius:3px;margin-top:8px;overflow:hidden}.meter span{display:block;height:100%;background:var(--blue)}
table{width:100%;border-collapse:collapse}
th{text-align:left;font-weight:500;color:var(--muted);font-size:10px;padding:5px 6px;border-bottom:1px solid var(--line-2);white-space:nowrap}
td{padding:6px;border-bottom:1px solid var(--line-2);white-space:nowrap;color:var(--ink)}
tr:last-child td{border-bottom:0}
td.mono{font-size:10px;color:var(--muted)}
.badge{font-style:normal;display:inline-block;font-size:9.5px;font-weight:600;padding:2px 7px;border-radius:20px;white-space:nowrap}
.b-ok{background:#E6F6F0;color:#0B805F}.b-info{background:var(--blue-50);color:var(--blue-d)}.b-warn{background:#FDF3E1;color:#A2650A}.b-bad{background:#FDECEE;color:#C22F45}
.bars{height:110px;display:flex;align-items:flex-end;gap:6px;border-bottom:1px solid var(--line-2);padding-top:6px}
.bars span{flex:1;height:var(--h);background:#D7E2FF;border-radius:3px 3px 0 0;transition:height .6s cubic-bezier(.2,.7,.2,1)}
.bars span.hi{background:var(--blue)}
.bars span:nth-child(3n){background:#C9D7FF}
.tab-panel:not([hidden]) .bars span{animation:grow .7s cubic-bezier(.2,.7,.2,1) both}
@keyframes grow{from{height:0}}
/* phone + toast */
.phone{position:absolute;left:-6px;bottom:8px;width:150px;background:#fff;border:1px solid var(--line);border-radius:22px;padding:22px 12px 14px;box-shadow:0 30px 60px -28px rgba(11,27,63,.45);font-size:11px;z-index:2}
.phone-notch{position:absolute;top:8px;left:50%;transform:translateX(-50%);width:44px;height:5px;border-radius:3px;background:var(--line)}
.ph-t{font-family:var(--f-head);font-weight:700;color:var(--ink);margin-bottom:6px;font-size:12.5px}
.ph-steps{margin:12px 0;display:grid;gap:6px;counter-reset:s}
.ph-steps li{display:flex;align-items:center;gap:7px;color:var(--muted)}
.ph-steps li::before{content:"";width:9px;height:9px;border-radius:50%;border:1.5px solid var(--line)}
.ph-steps li.done{color:var(--ink)}.ph-steps li.done::before{background:var(--blue);border-color:var(--blue)}
.ph-bars{display:flex;align-items:flex-end;gap:5px;height:40px}.ph-bars span{flex:1;background:var(--blue-50);border-radius:2px}.ph-bars span:nth-child(4){background:var(--violet)}
.toast{position:absolute;right:-12px;bottom:18px;display:flex;align-items:center;gap:10px;background:var(--navy);color:#fff;padding:11px 16px 11px 12px;border-radius:10px;box-shadow:0 20px 40px -20px rgba(11,27,63,.6);font-size:12px;z-index:2}
.toast b{display:block;font-size:12.5px}.toast small{color:#9FB0D8;font-size:11px}
.dot-ok{width:26px;height:26px;border-radius:50%;background:rgba(18,163,122,.18);position:relative;flex:none}
.dot-ok::after{content:"";position:absolute;left:9px;top:6px;width:6px;height:11px;border:solid #3BD3A2;border-width:0 2px 2px 0;transform:rotate(45deg)}
.float-a{animation:floatY 7s ease-in-out infinite}.float-b{animation:floatY 8s ease-in-out -3s infinite}
@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
.draw{stroke-dasharray:420;stroke-dashoffset:420;animation:draw 1.8s .3s ease-out forwards}
@keyframes draw{to{stroke-dashoffset:0}}

/* values strip */
.values{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid var(--line);margin-top:24px}
.values li{display:flex;gap:16px;padding:30px 28px 34px 0}
.values li+li{padding-left:28px;border-left:1px solid var(--line)}
.v-ico{width:38px;height:38px;flex:none;border-radius:8px;background:var(--blue-50);color:var(--blue);display:grid;place-items:center}
.v-ico svg{width:20px;height:20px}
.values b{display:block;font-family:var(--f-head);color:var(--ink);font-size:16px;margin-bottom:2px}
.values p{font-size:14.5px;color:var(--muted)}

/* sections */
.sec{padding:120px 0}
.sec-tint{background:var(--tint);border-top:1px solid var(--line-2);border-bottom:1px solid var(--line-2)}
.split-head{display:grid;grid-template-columns:1.3fr 1fr;gap:48px;align-items:end;margin-bottom:64px}
.split-head .sub{justify-self:end}

/* expertises: editorial numbered grid */
.exp-grid{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid var(--ink)}
.exp-grid li{border-bottom:1px solid var(--line);min-width:0}
.exp-grid li:not(:nth-child(3n+1)){border-left:1px solid var(--line)}
.exp-item{position:relative;display:flex;flex-direction:column;height:100%;padding:36px 36px 40px;transition:background .25s}
.exp-item::before{content:"";position:absolute;left:0;top:-1px;height:2px;width:0;background:var(--blue);transition:width .35s ease}
.exp-item:hover{background:var(--tint)}
.exp-item:hover::before{width:100%}
.exp-num{font-family:var(--f-mono);font-size:13px;color:var(--blue);margin-bottom:40px}
.exp-item h3{font-size:22px;line-height:1.2;margin-bottom:12px;max-width:16ch}
.exp-item p{color:var(--muted);font-size:15px;margin-bottom:24px}
.exp-tags{margin-top:auto;font-family:var(--f-mono);font-size:11.5px;color:#8A94AC}
.exp-go{position:absolute;top:34px;right:32px;width:36px;height:36px;border-radius:50%;border:1px solid var(--line);display:grid;place-items:center;color:var(--ink);transition:all .25s}
.exp-item:hover .exp-go{background:var(--blue);border-color:var(--blue);color:#fff;transform:rotate(-45deg)}

/* solutions */
.sol-layout{display:grid;grid-template-columns:minmax(0,4fr) minmax(0,8fr);gap:56px;align-items:start}
.sol-left{position:sticky;top:calc(var(--hh) + 32px)}
.sol-left .sub{margin:18px 0 32px}
.tabs{display:flex;flex-direction:column;border-top:1px solid var(--line)}
.tabs button{display:flex;align-items:center;gap:14px;text-align:left;padding:13px 14px;border:0;border-bottom:1px solid var(--line);background:transparent;cursor:pointer;font-weight:500;font-size:15px;color:var(--text);position:relative;transition:color .2s,background .2s;min-height:48px}
.tabs button .mono{color:#9AA4BB}
.tabs button:hover{color:var(--ink);background:#fff}
.tabs button[aria-selected=true]{color:var(--ink);background:#fff;font-weight:600}
.tabs button[aria-selected=true]::before{content:"";position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--blue)}
.tabs button[aria-selected=true] .mono{color:var(--blue)}
.tab-panel{animation:fadeUp .4s ease both}
.tab-panel:focus-visible{outline-offset:8px}
.tp-head{display:flex;justify-content:space-between;align-items:flex-end;gap:24px;margin-bottom:24px}
.tp-head h3{font-size:26px;margin-bottom:6px}
.tp-head p{color:var(--muted);max-width:520px}
.tp-points{display:grid;grid-template-columns:repeat(3,1fr);gap:0;margin-top:24px;border-top:1px solid var(--line)}
.tp-points li{padding:16px 16px 0 22px;position:relative;font-size:14.5px;color:var(--ink)}
.tp-points li::before{content:"";position:absolute;left:2px;top:23px;width:10px;height:6px;border:solid var(--blue);border-width:0 0 2px 2px;transform:rotate(-45deg)}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

/* timeline */
.timeline{display:grid;grid-template-columns:repeat(4,1fr);position:relative}
.timeline::before{content:"";position:absolute;left:0;right:0;top:7px;height:1px;background:linear-gradient(90deg,var(--blue),var(--violet) 70%,var(--line))}
.timeline li{position:relative;padding:44px 32px 0 0}
.tl-dot{position:absolute;top:0;left:0;width:15px;height:15px;border-radius:50%;background:#fff;border:2px solid var(--blue);box-shadow:0 0 0 5px #fff}
.timeline li:last-child .tl-dot{border-color:var(--violet)}
.tl-num{display:block;color:var(--blue);margin-bottom:14px;font-size:13px}
.timeline h3{font-size:21px;margin-bottom:10px}
.timeline p{color:var(--muted);font-size:15px}

/* work */
.work-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.work{background:#fff;border:1px solid var(--line);border-radius:var(--r);overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .3s,transform .3s}
.work:hover{box-shadow:var(--sh);transform:translateY(-3px)}
.work-lg{grid-column:span 2;grid-row:span 2}
.work-media{aspect-ratio:16/10;background:var(--tint);overflow:hidden;border-bottom:1px solid var(--line)}
.work-lg .work-media{aspect-ratio:auto;flex:1;min-height:320px}
.work-media img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
.work:hover .work-media img{transform:scale(1.03)}
.work-ph{height:100%;display:grid;place-items:center;font-size:48px}
.work-body{padding:22px 24px 24px}
.work-idx{color:var(--blue);display:block;margin-bottom:8px}
.work-body h3{font-size:19px;margin-bottom:8px}
.work-lg .work-body h3{font-size:24px}
.work-body p{color:var(--muted);font-size:14.5px;margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
.work.is-extra{display:none}
.work-grid.show-all .work.is-extra{display:flex}

/* dark trust */
.sec-dark{background:var(--navy);color:#B7C2DE;position:relative;overflow:hidden}
.sec-dark::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px);background-size:56px 56px;pointer-events:none}
.sec-dark .h2,.sec-dark h3{color:#fff}
.sec-dark .sub{color:#9AA8CC;margin:18px 0 32px}
.trust-layout{position:relative;display:grid;grid-template-columns:minmax(0,5fr) minmax(0,7fr);gap:72px;align-items:start}
.terminal{border:1px solid #1B2C55;border-radius:10px;overflow:hidden;background:#071230}
.terminal pre{margin:0;padding:18px 20px;font-family:var(--f-mono);font-size:13px;line-height:1.9;color:#C9D3EE;white-space:pre-wrap}
.c-mut{color:#5E6E98}.c-blue{color:#6E95FF}.c-ok{color:#3BD3A2}.c-vio{color:#A895FF}
.caret{display:inline-block;width:8px;height:15px;background:#6E95FF;margin-left:6px;vertical-align:-2px;animation:blink 1.1s steps(1) infinite}
@keyframes blink{50%{opacity:0}}
.trust-grid{display:grid;grid-template-columns:repeat(2,1fr);border-top:1px solid #22335E}
.trust-grid li{padding:30px 28px 32px 0;border-bottom:1px solid #22335E}
.trust-grid li:nth-child(even){padding-left:28px;border-left:1px solid #22335E}
.trust-grid .mono{color:#6E95FF;display:block;margin-bottom:16px;font-size:12px}
.trust-grid h3{font-size:18px;margin-bottom:8px}
.trust-grid p{font-size:14.5px;color:#9AA8CC}

/* faq */
.faq-layout{display:grid;grid-template-columns:minmax(0,4fr) minmax(0,8fr);gap:72px;align-items:start}
.faq-layout .sub{margin:18px 0 28px}
.faq-list{border-top:1px solid var(--ink)}
.faq-item{border-bottom:1px solid var(--line)}
.faq-item h3{font-size:inherit;letter-spacing:0}
.faq-item button{width:100%;display:flex;align-items:center;gap:18px;text-align:left;padding:22px 4px;background:none;border:0;cursor:pointer;font-family:var(--f-head);font-weight:600;font-size:18px;color:var(--ink)}
.faq-item button .mono{color:var(--blue);font-family:var(--f-mono);font-weight:400;font-size:12px}
.faq-item .q{flex:1}
.faq-item button:hover .q{color:var(--blue)}
.pm{width:28px;height:28px;border:1px solid var(--line);border-radius:50%;position:relative;flex:none;transition:transform .3s,background .3s,border-color .3s}
.pm::before,.pm::after{content:"";position:absolute;left:50%;top:50%;width:10px;height:1.5px;background:var(--ink);transform:translate(-50%,-50%)}
.pm::after{transform:translate(-50%,-50%) rotate(90deg);transition:transform .3s}
.faq-item button[aria-expanded=true] .pm{background:var(--blue);border-color:var(--blue)}
.faq-item button[aria-expanded=true] .pm::before,.faq-item button[aria-expanded=true] .pm::after{background:#fff}
.faq-item button[aria-expanded=true] .pm::after{transform:translate(-50%,-50%) rotate(0)}
.faq-a{display:grid;grid-template-rows:0fr;transition:grid-template-rows .35s ease}
.faq-a>div{overflow:hidden}
.faq-a p{padding:0 48px 24px 46px;color:var(--text);max-width:720px}
.faq-item.open .faq-a{grid-template-rows:1fr}

/* contact */
.contact-layout{display:grid;grid-template-columns:minmax(0,5fr) minmax(0,7fr);gap:72px;align-items:start}
.contact-layout .sub{margin:18px 0 36px}
.c-info{display:grid;gap:0;border-top:1px solid var(--line)}
.c-info li{display:flex;gap:14px;align-items:center;padding:18px 0;border-bottom:1px solid var(--line)}
.c-ico{width:40px;height:40px;border-radius:8px;background:#fff;border:1px solid var(--line);display:grid;place-items:center;color:var(--blue);flex:none}
.c-info b{display:block;color:var(--ink);font-weight:600}
.c-info b a:hover{color:var(--blue)}
.c-info small{color:var(--muted);font-size:13.5px}
.form{background:#fff;border:1px solid var(--line);border-radius:12px;padding:36px;box-shadow:var(--sh)}
.f-row{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.field{margin-bottom:16px;min-width:0}
.field label{display:block;font-size:14px;font-weight:600;color:var(--ink);margin-bottom:7px}
.req{color:var(--blue)}.opt{color:var(--muted);font-weight:400}
.field input,.field select,.field textarea{width:100%;border:1px solid var(--line);border-radius:8px;padding:12px 14px;background:#fff;font-size:15.5px;transition:border-color .2s,box-shadow .2s;min-height:48px}
.field select{appearance:none;-webkit-appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none' stroke='%236B7690' stroke-width='1.6'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:38px}
.field textarea{resize:vertical;min-height:130px}
.field input::placeholder,.field textarea::placeholder{color:#A3ACC0}
.field input:focus,.field select:focus,.field textarea:focus{outline:0;border-color:var(--blue);box-shadow:0 0 0 4px rgba(37,99,255,.12)}
.field.invalid input,.field.invalid select,.field.invalid textarea{border-color:var(--bad)}
.err{color:var(--bad);font-size:13px;margin-top:5px;min-height:0}
.err:empty{display:none}
.req-note{font-size:13px;color:var(--muted);margin:-2px 0 20px}
.f-actions{display:flex;flex-wrap:wrap;gap:12px}
.f-actions .btn{flex:1 1 220px}
.form-msg{margin-top:18px;padding:14px 16px;border-radius:8px;font-size:15px;border:1px solid}
.form-msg.ok{background:#E9F8F2;color:#0B6E51;border-color:#B5E6D3}
.form-msg.ko{background:#FDEFF1;color:#A3283B;border-color:#F4C3CB}
.hp{position:absolute!important;left:-9999px;width:1px;height:1px;overflow:hidden}

/* footer */
.footer{background:var(--navy);color:#9AA8CC;padding:80px 0 0;font-size:14.5px}
.foot-grid{display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr 1fr;gap:40px;padding-bottom:56px}
.foot-brand p{margin-top:18px;max-width:320px;line-height:1.7}
.footer h3{color:#fff;font-size:14px;font-family:var(--f-body);font-weight:600;margin-bottom:16px;letter-spacing:0}
.footer ul{display:grid;gap:9px}
.footer ul a{transition:color .2s}
.footer ul a:hover{color:#fff}
.foot-bottom{display:flex;justify-content:space-between;gap:16px;border-top:1px solid #1E2F5A;padding-top:22px;padding-bottom:26px;font-size:13px}
.foot-bottom a:hover{color:#fff}
.wa-float{position:fixed;right:22px;bottom:22px;width:54px;height:54px;border-radius:50%;background:#25D366;color:#fff;display:grid;place-items:center;box-shadow:0 12px 28px -10px rgba(18,140,75,.6);z-index:40;transition:transform .2s}
.wa-float svg{width:26px;height:26px}
.wa-float:hover{transform:scale(1.06)}

/* reveal */
.js .reveal{opacity:0;transform:translateY(18px);transition:opacity .7s ease var(--d,0ms),transform .7s cubic-bezier(.2,.7,.2,1) var(--d,0ms)}
.js .reveal.in{opacity:1;transform:none}

/* ================= DARK THEME ================= */
:root{--ink:#F2F5FC;--text:#C3CBDD;--muted:#8E99B3;--bg:#05070D;--tint:#0A0D16;--line:rgba(255,255,255,.09);--line-2:rgba(255,255,255,.06);--blue:#3B74FF;--blue-d:#2D63F0;--blue-50:rgba(59,116,255,.14)}
html{color-scheme:dark}
body{background:#05070D}
.hl{color:#5B8CFF}
.eyebrow{color:#6E95FF}
.site-header{background:rgba(5,7,13,.78)}
.site-header.scrolled{box-shadow:0 8px 24px -16px rgba(0,0,0,.8)}
.logo .logo-svg{color:#5B8CFF}
.lang a.on{background:var(--blue);color:#fff}
.lang a:not(.on):hover{background:rgba(255,255,255,.06)}
.burger{background:transparent}
.btn-primary{box-shadow:0 8px 24px -8px rgba(59,116,255,.6)}
.btn-ghost{background:rgba(255,255,255,.03);border-color:rgba(255,255,255,.14);color:var(--ink)}
.btn-ghost:hover{border-color:rgba(255,255,255,.4);background:rgba(255,255,255,.06)}
.btn-wa{background:rgba(37,211,102,.08);color:#4BE08A;border-color:rgba(37,211,102,.35)}
.btn-wa:hover{background:rgba(37,211,102,.14);border-color:#4BE08A}
.link{color:#6E95FF}
/* hero glow + grid */
.hero{background:radial-gradient(900px 520px at 78% 30%,rgba(59,116,255,.16),transparent 65%),radial-gradient(600px 400px at 95% 80%,rgba(124,92,255,.10),transparent 70%),#05070D}
.hero-grid-bg{background-image:linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px)}
.values{border-color:var(--line)}
/* sections: subtle navy variation */
.sec{background:#05070D}
.sec-tint{background:#0A0E1A;border-color:var(--line-2)}
.sec-dark{background:linear-gradient(180deg,#081022,#060B18)}
.exp-grid,.faq-list{border-top-color:rgba(255,255,255,.22)}
.exp-item:hover{background:rgba(255,255,255,.025)}
.exp-tags{color:#7E89A3}
.exp-go{color:var(--ink)}
.tabs button .mono{color:#6F7A94}
.tabs button:hover,.tabs button[aria-selected=true]{background:rgba(255,255,255,.04)}
.tl-dot{background:#05070D;box-shadow:0 0 0 5px #05070D}
.work{background:#0D1220;border-color:var(--line)}
.work:hover{box-shadow:0 24px 48px -24px rgba(0,0,0,.9);border-color:rgba(255,255,255,.16)}
.work-media{background:#0A0E1A}
.pm::before,.pm::after{background:var(--ink)}
.faq-item button:hover .q{color:#6E95FF}
.c-ico{background:rgba(255,255,255,.04)}
.form{background:#0B101D;border-color:var(--line);box-shadow:0 30px 60px -30px rgba(0,0,0,.9)}
.field input,.field select,.field textarea{background-color:#070A13;border-color:rgba(255,255,255,.12);color:var(--ink)}
.field select option{background:#0B101D;color:#F2F5FC}
.field input::placeholder,.field textarea::placeholder{color:#6F7A94}
.field input:focus,.field select:focus,.field textarea:focus{box-shadow:0 0 0 4px rgba(59,116,255,.22)}
.field select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none' stroke='%238E99B3' stroke-width='1.6'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center}
.req{color:#6E95FF}
.err{color:#FF7A8A}
.field.invalid input,.field.invalid select,.field.invalid textarea{border-color:#FF7A8A}
.form-msg.ok{background:rgba(18,163,122,.12);color:#5FE0B4;border-color:rgba(18,163,122,.4)}
.form-msg.ko{background:rgba(224,71,91,.12);color:#FF8D9B;border-color:rgba(224,71,91,.4)}
.footer{background:#03050A;border-top:1px solid var(--line-2)}
.foot-bottom{border-color:var(--line-2)}
.main-nav ul a{color:var(--text)}
@media (max-width:1060px){.main-nav{background:#070A13;box-shadow:0 24px 40px -24px rgba(0,0,0,.9)}}
/* dashboards: dark app windows */
.window,.dash{background:#0B1020;border-color:rgba(255,255,255,.1);box-shadow:0 40px 90px -40px rgba(0,0,0,.95),0 0 0 1px rgba(59,116,255,.06)}
.win-bar{background:#0E1426;border-color:rgba(255,255,255,.06)}
.win-bar i{background:rgba(255,255,255,.14)}
.dash-side{background:#070B17;border-right:1px solid rgba(255,255,255,.06)}
.dash-main{background:#0B1020}
.kpi,.panel{background:#0F1528;border-color:rgba(255,255,255,.07)}
.dash-search,.chip{background:#0B1020;border-color:rgba(255,255,255,.1);color:#8E99B3}
.demo-tag{background:#0B1020;border-color:rgba(255,255,255,.12);color:#8E99B3}
th{color:#8E99B3}
td.mono{color:#8E99B3}
.months{color:#6F7A94}
.bars span{background:rgba(91,140,255,.28)}.bars span:nth-child(3n){background:rgba(124,92,255,.32)}.bars span.hi{background:#3B74FF}
.b-ok{background:rgba(18,163,122,.16);color:#5FE0B4}.b-info{background:rgba(59,116,255,.18);color:#8FB0FF}.b-warn{background:rgba(217,138,11,.16);color:#F2B65A}.b-bad{background:rgba(224,71,91,.16);color:#FF8D9B}
.kpi .up{color:#5FE0B4}.kpi .down{color:#FF8D9B}
.phone{background:#0F1528;border-color:rgba(255,255,255,.12);box-shadow:0 30px 60px -28px rgba(0,0,0,.95)}
.phone-notch{background:rgba(255,255,255,.14)}
.toast{background:#141C33;border:1px solid rgba(255,255,255,.1)}
.line g{stroke:rgba(255,255,255,.07)}

/* responsive */
@media (max-width:1180px){
  .wrap{padding:0 28px}
  .main-nav ul a{padding:8px 10px}
  .foot-grid{grid-template-columns:1.4fr 1fr 1fr 1fr;}
  .foot-grid>div:last-child{grid-column:1/-1}
}
@media (max-width:1060px){
  .burger{display:block}
  .main-nav{position:fixed;inset:var(--hh) 0 auto 0;background:#fff;border-bottom:1px solid var(--line);padding:12px 28px 28px;transform:translateY(-8px);opacity:0;visibility:hidden;transition:opacity .25s,transform .25s,visibility .25s;max-height:calc(100dvh - var(--hh));overflow:auto;box-shadow:0 24px 40px -24px rgba(14,23,48,.25)}
  .main-nav.open{opacity:1;transform:none;visibility:visible}
  .main-nav ul{flex-direction:column;gap:0}
  .main-nav ul a{padding:16px 2px;font-size:18px;font-family:var(--f-head);font-weight:600;color:var(--ink);border-bottom:1px solid var(--line-2)}
  .main-nav ul a::after{display:none}
  .nav-mobile-extra{display:block;margin-top:20px}.nav-mobile-extra .btn{width:100%}
  .hero-in{grid-template-columns:minmax(0,1fr);gap:24px}
  .hero-copy{max-width:680px}
  .hero-visual{padding:16px 0 48px 20px}
  .sol-layout,.trust-layout,.faq-layout,.contact-layout{grid-template-columns:minmax(0,1fr);gap:44px}
  .sol-left{position:static}
  .tabs{flex-direction:row;overflow-x:auto;border-top:0;border-bottom:1px solid var(--line);scrollbar-width:none;-webkit-overflow-scrolling:touch;scroll-snap-type:x proximity}
  .tabs::-webkit-scrollbar{display:none}
  .tabs button{flex:none;border-bottom:0;white-space:nowrap;scroll-snap-align:start}
  .tabs button[aria-selected=true]::before{left:0;right:0;top:auto;bottom:0;width:auto;height:2px}
  .split-head{grid-template-columns:1fr;gap:18px;margin-bottom:48px}
  .split-head .sub{justify-self:start}
  .exp-grid{grid-template-columns:repeat(2,1fr)}
  .exp-grid li:not(:nth-child(3n+1)){border-left:0}
  .exp-grid li:nth-child(even){border-left:1px solid var(--line)}
  .timeline{grid-template-columns:repeat(2,1fr);row-gap:48px}
  .work-grid{grid-template-columns:repeat(2,1fr)}
  .work-lg{grid-row:auto}
  .sec{padding:96px 0}
}
@media (max-width:720px){
  :root{--hh:64px}
  .wrap{padding:0 20px}
  .hide-sm{display:none}
  .hero{padding-top:44px}
  .display{font-size:clamp(38px,11vw,52px)}
  .lead{font-size:16.5px}
  .cta-row .btn{flex:1 1 100%}
  .hero-visual{padding:8px 0 40px 0}
  .hero-dash{grid-template-columns:1fr}
  .hero-dash .dash-side,.dash .dash-side{display:none}
  .dash{grid-template-columns:1fr}
  .dash-kpis{grid-template-columns:repeat(2,minmax(0,1fr))}
  .dash-grid{grid-template-columns:1fr}
  .panel.span2{grid-column:auto}
  .dash-search{display:none}
  .panel-table{overflow-x:auto}
  .phone,.toast{display:none}
  .hero-visual .win-bar span{display:none}
  .values{grid-template-columns:1fr}
  .values li,.values li+li{padding:22px 0;border-left:0;border-bottom:1px solid var(--line)}
  .values li:last-child{border-bottom:0}
  .sec{padding:76px 0}
  .exp-grid{grid-template-columns:1fr}
  .exp-grid li:nth-child(even){border-left:0}
  .exp-item{padding:28px 4px 32px}
  .exp-num{margin-bottom:20px}
  .exp-go{right:4px;top:24px}
  .tp-head{flex-direction:column;align-items:flex-start}
  .tp-points{grid-template-columns:1fr}
  .timeline{grid-template-columns:1fr;row-gap:0}
  .timeline::before{left:7px;right:auto;top:0;bottom:0;width:1px;height:auto;background:linear-gradient(180deg,var(--blue),var(--violet))}
  .timeline li{padding:0 0 36px 40px}
  .work-grid{grid-template-columns:1fr;gap:20px}
  .work-lg{grid-column:auto}
  .work-lg .work-media{aspect-ratio:16/10;min-height:0}
  .trust-grid{grid-template-columns:1fr}
  .trust-grid li,.trust-grid li:nth-child(even){padding:24px 0;border-left:0}
  .faq-item button{font-size:16px;gap:12px;padding:18px 0}
  .faq-a p{padding:0 0 20px 0}
  .form{padding:24px 18px}
  .f-row{grid-template-columns:1fr;gap:0}
  .foot-grid{grid-template-columns:1fr 1fr;gap:32px}
  .foot-brand{grid-column:1/-1}
  .foot-bottom{flex-direction:column}
  .wa-float{right:16px;bottom:16px}
}
@media (prefers-reduced-motion:reduce){
  html{scroll-behavior:auto}
  *,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important}
  .js .reveal{opacity:1;transform:none}
  .draw{stroke-dashoffset:0}
}
</style>
