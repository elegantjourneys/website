<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --ej-teal:    #1a3d4f;
  --ej-teal2:   #234d62;
  --ej-amber:   #b5884a;
  --ej-amber2:  #cca068;
  --ej-cream:   #faf8f4;
  --ej-ivory:   #f2ede4;
  --ej-sand:    #e8e0d0;
  --ej-border:  #ddd5c4;
  --ej-text:    #2a2520;
  --ej-muted:   #7a6f63;
  --ej-white:   #ffffff;
  --ej-sage:    #2e4a3e;
  --ej-sage2:   #3a5c50;

  --serif: 'Cormorant Garamond', Georgia, serif;
  --sans:  'Inter', system-ui, sans-serif;

  --shadow-sm:  0 2px 10px rgba(26,61,79,.07);
  --shadow-md:  0 6px 28px rgba(26,61,79,.11);
  --shadow-lg:  0 16px 52px rgba(26,61,79,.15);
  --radius:     8px;
  --radius-lg:  14px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: var(--sans); color: var(--ej-text); background: var(--ej-white); }
img { display: block; max-width: 100%; }
a { text-decoration: none; color: inherit; }

/* ── Containers ──────────────────────────────────────── */
.ej-wrap    { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.ej-wrap-lg { max-width: 1360px; margin: 0 auto; padding: 0 24px; }

/* ── Sections ────────────────────────────────────────── */
.ej-section       { padding: 72px 0; }
.ej-section-cream { background: var(--ej-cream); }
.ej-section-ivory { background: var(--ej-ivory); }
.ej-section-sage  { background: var(--ej-sage); }

/* ── Heading ─────────────────────────────────────────── */
.ej-heading { text-align: center; margin-bottom: 48px; }
.ej-heading .kicker {
  display: inline-flex; align-items: center; gap: 12px;
  font-size: 10.5px; font-weight: 600; letter-spacing: .22em;
  text-transform: uppercase; color: var(--ej-amber); margin-bottom: 14px;
}
.ej-heading .kicker::before,
.ej-heading .kicker::after { content: ''; width: 32px; height: 1px; background: var(--ej-amber); opacity: .6; }
.ej-heading h2 {
  font-family: var(--serif); font-size: clamp(2rem, 3.2vw, 2.8rem);
  font-weight: 700; color: var(--ej-teal); margin-bottom: 14px; line-height: 1.15;
}
.ej-heading p { color: var(--ej-muted); max-width: 560px; margin: 0 auto; font-size: .93rem; line-height: 1.75; }
.ej-heading.light h2 { color: #fff; }
.ej-heading.light p  { color: rgba(255,255,255,.62); }

/* ── Buttons ─────────────────────────────────────────── */
.ej-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 13px 30px; border-radius: 40px;
  font-family: var(--sans); font-size: .82rem; font-weight: 600;
  letter-spacing: .05em; cursor: pointer;
  border: 1.5px solid transparent; transition: all .25s;
}
.ej-btn-primary { background: var(--ej-amber); color: #fff; }
.ej-btn-primary:hover { background: var(--ej-amber2); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(181,136,74,.3); }
.ej-btn-outline-white { background: rgba(255,255,255,.1); color: #fff; border-color: rgba(255,255,255,.55); backdrop-filter: blur(4px); }
.ej-btn-outline-white:hover { background: rgba(255,255,255,.2); border-color: rgba(255,255,255,.9); }
.ej-btn-teal { background: var(--ej-teal); color: #fff; }
.ej-btn-teal:hover { background: var(--ej-teal2); transform: translateY(-2px); box-shadow: var(--shadow-md); }


/* ═══════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════ */
.city-hero {
  position: relative; height: clamp(520px, 74vh, 720px);
  overflow: hidden; display: flex; align-items: flex-end;
}
.city-hero__bg {
  position: absolute; inset: 0;
  background: url('https://images.unsplash.com/photo-1599661046289-e31897846e41?w=1600&q=80') center / cover no-repeat;
  transition: transform 8s ease;
}
.city-hero:hover .city-hero__bg { transform: scale(1.04); }
.city-hero__overlay {
  position: absolute; inset: 0;
  background: linear-gradient(170deg, rgba(26,61,79,.08) 0%, rgba(26,61,79,.3) 50%, rgba(15,35,45,.82) 100%);
}
.city-hero__overlay::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(181,136,74,.08) 0%, transparent 40%);
}
.city-hero__content { position: relative; z-index: 2; width: 100%; padding: 0 0 52px; }
.city-hero__inner { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.city-hero__state {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 10.5px; font-weight: 600; letter-spacing: .22em;
  text-transform: uppercase; color: var(--ej-amber2); margin-bottom: 16px;
}
.city-hero__title {
  font-family: var(--serif); font-weight: 700;
  font-size: clamp(3rem, 6.5vw, 5.5rem); line-height: 1.0;
  color: #fff; margin-bottom: 16px; max-width: 720px;
  text-shadow: 0 2px 24px rgba(0,0,0,.2);
}
.city-hero__tagline {
  font-size: 1rem; color: rgba(255,255,255,.75);
  margin-bottom: 28px; max-width: 500px; line-height: 1.7; font-weight: 300;
}
.city-hero__actions { display: flex; gap: 12px; flex-wrap: wrap; }
.city-hero__scroll {
  position: absolute; bottom: 24px; left: 50%; transform: translateX(-50%);
  display: flex; flex-direction: column; align-items: center; gap: 6px;
  color: rgba(255,255,255,.45); font-size: 9px; letter-spacing: .2em; text-transform: uppercase;
}
.city-hero__scroll-line {
  width: 1px; height: 36px;
  background: linear-gradient(to bottom, rgba(255,255,255,.5), transparent);
  animation: scrollPulse 2s ease-in-out infinite;
}
@keyframes scrollPulse { 0%,100%{opacity:.4} 50%{opacity:1} }


/* ═══════════════════════════════════════════════════════
   FACTS STRIP
═══════════════════════════════════════════════════════ */
.city-facts-strip {
  background: var(--ej-white); box-shadow: var(--shadow-lg);
  border-bottom: 1px solid var(--ej-border); position: relative; z-index: 10;
}
.city-facts-strip__grid { display: grid; grid-template-columns: repeat(4, 1fr); }
.fact-cell {
  padding: 24px 28px; border-right: 1px solid var(--ej-border);
  display: flex; align-items: center; gap: 14px; transition: background .2s;
}
.fact-cell:hover { background: var(--ej-cream); }
.fact-cell:last-child { border-right: none; }
.fact-cell__icon {
  width: 46px; height: 46px; flex-shrink: 0; border-radius: 12px;
  background: rgba(181,136,74,.1);
  display: flex; align-items: center; justify-content: center;
}
.fact-cell__icon svg { color: var(--ej-amber); }
.fact-cell__label { font-size: 10px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--ej-muted); margin-bottom: 4px; }
.fact-cell__value { font-family: var(--serif); font-size: 1.1rem; font-weight: 700; color: var(--ej-teal); line-height: 1.2; }


/* ═══════════════════════════════════════════════════════
   BREADCRUMB
═══════════════════════════════════════════════════════ */
.ej-breadcrumb-bar { background: var(--ej-ivory); padding: 11px 0; border-bottom: 1px solid var(--ej-sand); }
.ej-breadcrumb { display: flex; align-items: center; gap: 6px; list-style: none; font-size: .76rem; color: var(--ej-muted); }
.ej-breadcrumb li + li::before { content: '›'; opacity: .45; margin-right: 6px; }
.ej-breadcrumb a { color: var(--ej-muted); transition: color .2s; }
.ej-breadcrumb a:hover { color: var(--ej-amber); }
.ej-breadcrumb .bc-cur { color: var(--ej-teal); font-weight: 500; }


/* ═══════════════════════════════════════════════════════
   ABOUT
═══════════════════════════════════════════════════════ */
.city-about__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center; }
.city-about__img-wrap { position: relative; }
.city-about__img { width: 100%; height: 460px; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); }
.city-about__img-wrap::before {
  content: '';
  position: absolute; top: -14px; left: -14px; right: 14px; bottom: 14px;
  border: 1.5px solid var(--ej-amber); border-radius: var(--radius-lg);
  opacity: .35; pointer-events: none;
}
.city-about__badge {
  position: absolute; bottom: -20px; right: -20px;
  background: var(--ej-teal); color: #fff;
  padding: 22px 26px; border-radius: var(--radius-lg); text-align: center; box-shadow: var(--shadow-md);
}
.city-about__badge strong { display: block; font-family: var(--serif); font-size: 2.2rem; color: var(--ej-amber2); line-height: 1; }
.city-about__badge span { font-size: .68rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; opacity: .8; }
.city-about__text .kicker {
  display: inline-flex; align-items: center; gap: 10px;
  font-size: 10.5px; font-weight: 600; letter-spacing: .2em;
  text-transform: uppercase; color: var(--ej-amber); margin-bottom: 16px;
}
.city-about__text h2 { font-family: var(--serif); font-size: clamp(1.8rem, 2.6vw, 2.4rem); font-weight: 700; color: var(--ej-teal); margin-bottom: 20px; line-height: 1.15; }
.city-about__text h2 em { font-style: italic; color: var(--ej-amber); }
.city-about__text p { color: var(--ej-muted); font-size: .94rem; line-height: 1.85; margin-bottom: 30px; }


/* ═══════════════════════════════════════════════════════
   ATTRACTIONS
═══════════════════════════════════════════════════════ */
.attr-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
.attr-card {
  border-radius: var(--radius-lg); overflow: hidden;
  box-shadow: var(--shadow-sm); background: var(--ej-white);
  transition: transform .3s, box-shadow .3s; border: 1px solid var(--ej-border);
}
.attr-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
.attr-card__img-wrap { overflow: hidden; position: relative; height: 230px; }
.attr-card__img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease; }
.attr-card:hover .attr-card__img { transform: scale(1.08); }
.attr-card__overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(26,61,79,.5) 0%, transparent 55%);
  opacity: 0; transition: opacity .3s;
}
.attr-card:hover .attr-card__overlay { opacity: 1; }
.attr-card__body { padding: 20px 22px 24px; }
.attr-card__title { font-family: var(--serif); font-size: 1.2rem; font-weight: 700; color: var(--ej-teal); margin-bottom: 8px; }
.attr-card__desc { font-size: .86rem; color: var(--ej-muted); line-height: 1.7; }


/* ═══════════════════════════════════════════════════════
   PACKAGES
═══════════════════════════════════════════════════════ */
.pkg-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
.pkg-card {
  border: 1px solid var(--ej-border); border-radius: var(--radius-lg);
  background: var(--ej-white); overflow: hidden;
  box-shadow: var(--shadow-sm); transition: box-shadow .3s, transform .3s;
  display: flex; flex-direction: column;
}
.pkg-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-6px); }
.pkg-card__badge {
  background: var(--ej-teal); color: #fff;
  font-size: .66rem; font-weight: 600; letter-spacing: .14em;
  text-transform: uppercase; padding: 6px 14px;
  display: inline-block; border-radius: 0 0 var(--radius) 0;
  position: absolute; top: 0; left: 0;
}
.pkg-card__imgwrap { position: relative; height: 200px; overflow: hidden; }
.pkg-card__img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.pkg-card:hover .pkg-card__img { transform: scale(1.07); }
.pkg-card__body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
.pkg-card__title { font-family: var(--serif); font-size: 1.15rem; font-weight: 700; color: var(--ej-teal); margin-bottom: 10px; line-height: 1.3; }
.pkg-card__nights { font-size: .81rem; color: var(--ej-muted); display: flex; align-items: center; gap: 6px; margin-bottom: 16px; }
.pkg-card__price-row { margin-top: auto; display: flex; align-items: flex-end; justify-content: space-between; border-top: 1px solid var(--ej-border); padding-top: 16px; }
.pkg-card__price-lbl { font-size: .7rem; color: var(--ej-muted); text-transform: uppercase; letter-spacing: .08em; }
.pkg-card__price-val { font-family: var(--serif); font-size: 1.5rem; font-weight: 700; color: var(--ej-teal); line-height: 1; }
.pkg-card__price-val small { font-size: .73rem; font-family: var(--sans); font-weight: 400; color: var(--ej-muted); }
.pkg-card__cta { display: block; text-align: center; background: var(--ej-amber); color: #fff; font-weight: 600; font-size: .82rem; padding: 12px; transition: background .2s; border-radius: 0 0 var(--radius-lg) var(--radius-lg); }
.pkg-card__cta:hover { background: var(--ej-amber2); }


/* ═══════════════════════════════════════════════════════
   GALLERY
═══════════════════════════════════════════════════════ */
.gallery-mosaic {
  display: grid; grid-template-columns: repeat(4, 1fr);
  grid-template-rows: 230px 230px; gap: 10px;
}
.gal-item { overflow: hidden; border-radius: var(--radius); position: relative; cursor: zoom-in; }
.gal-item:first-child  { grid-column: 1 / 3; grid-row: 1 / 3; }
.gal-item:nth-child(4) { grid-column: 3 / 5; }
.gal-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease; }
.gal-item:hover img { transform: scale(1.09); }
.gal-item__caption {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(26,61,79,.6) 0%, transparent 50%);
  opacity: 0; transition: opacity .3s;
  display: flex; align-items: flex-end; padding: 16px 18px;
}
.gal-item:hover .gal-item__caption { opacity: 1; }
.gal-item__caption span { font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: #fff; }


/* ═══════════════════════════════════════════════════════
   TRUST BAND
═══════════════════════════════════════════════════════ */
.trust-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 2px; }
.trust-item {
  background: rgba(255,255,255,.06); text-align: center;
  padding: 42px 24px; border: 1px solid rgba(255,255,255,.1); border-radius: var(--radius);
  transition: background .2s;
}
.trust-item:hover { background: rgba(255,255,255,.1); }
.trust-item__icon { font-size: 2rem; margin-bottom: 14px; line-height: 1; }
.trust-item__num { font-family: var(--serif); font-size: 2.4rem; font-weight: 700; color: var(--ej-amber2); line-height: 1; margin-bottom: 8px; }
.trust-item__lbl { font-size: .82rem; color: rgba(255,255,255,.62); line-height: 1.5; }


/* ═══════════════════════════════════════════════════════
   FAQ
═══════════════════════════════════════════════════════ */
.faq-list { max-width: 820px; margin: 0 auto; }
.faq-item { border-bottom: 1px solid var(--ej-border); }
.faq-item summary {
  list-style: none; cursor: pointer;
  padding: 20px 0; display: flex; justify-content: space-between;
  align-items: center; gap: 16px;
  font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--ej-teal);
  transition: color .2s;
}
.faq-item summary:hover { color: var(--ej-amber); }
.faq-item summary::-webkit-details-marker { display: none; }
.faq-icon {
  width: 30px; height: 30px; flex-shrink: 0; border-radius: 50%;
  border: 1.5px solid var(--ej-border);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; color: var(--ej-amber); transition: transform .3s, background .2s;
}
.faq-item[open] .faq-icon { transform: rotate(45deg); background: var(--ej-amber); color: #fff; border-color: var(--ej-amber); }
.faq-body { padding: 0 0 20px; font-size: .92rem; color: var(--ej-muted); line-height: 1.8; }


/* ═══════════════════════════════════════════════════════
   CTA BAND
═══════════════════════════════════════════════════════ */
.city-cta {
  background: linear-gradient(135deg, var(--ej-teal) 0%, #1f4d62 50%, #163c4f 100%);
  padding: 72px 24px; text-align: center; position: relative; overflow: hidden;
}
.city-cta::before {
  content: ''; position: absolute; top: -100px; right: -100px;
  width: 400px; height: 400px; border-radius: 50%;
  background: radial-gradient(circle, rgba(181,136,74,.14) 0%, transparent 70%);
  pointer-events: none;
}
.city-cta::after {
  content: ''; position: absolute; bottom: -80px; left: -80px;
  width: 280px; height: 280px; border-radius: 50%;
  background: radial-gradient(circle, rgba(181,136,74,.1) 0%, transparent 70%);
  pointer-events: none;
}
.city-cta h2 { font-family: var(--serif); font-size: clamp(1.9rem, 3.2vw, 2.8rem); color: #fff; margin-bottom: 14px; position: relative; }
.city-cta p  { color: rgba(255,255,255,.65); margin-bottom: 32px; font-size: .95rem; max-width: 520px; margin-left: auto; margin-right: auto; position: relative; line-height: 1.7; }
.city-cta .ej-btn { position: relative; }


/* ═══════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
  .city-about__grid { grid-template-columns: 1fr; gap: 50px; }
  .city-about__badge { bottom: -16px; right: -10px; }
  .city-about__img { height: 360px; }
  .attr-grid { grid-template-columns: repeat(2, 1fr); }
  .pkg-grid  { grid-template-columns: repeat(2, 1fr); }
  .trust-grid { grid-template-columns: repeat(2, 1fr); }
  .city-facts-strip__grid { grid-template-columns: repeat(2, 1fr); }
  .fact-cell:nth-child(2) { border-right: none; }
}
@media (max-width: 768px) {
  .gallery-mosaic { grid-template-columns: repeat(2, 1fr); grid-template-rows: auto; }
  .gal-item:first-child { grid-column: 1 / 3; grid-row: auto; height: 230px; }
  .gal-item:nth-child(4) { grid-column: auto; }
  .gal-item { height: 180px; }
  .attr-grid { grid-template-columns: 1fr; }
  .pkg-grid  { grid-template-columns: 1fr; }
  .trust-grid { grid-template-columns: 1fr 1fr; }
  .ej-section { padding: 50px 0; }
  .city-about__img-wrap::before { display: none; }
}
@media (max-width: 540px) {
  .city-facts-strip__grid { grid-template-columns: 1fr 1fr; }
  .trust-grid { grid-template-columns: 1fr 1fr; }
  .city-hero__actions { flex-direction: column; }
  .ej-btn { justify-content: center; }
}
@media (prefers-reduced-motion: reduce) {
  .city-hero__bg, .attr-card__img, .gal-item img, .pkg-card__img,
  .city-hero__scroll-line { transition: none; animation: none; }
  .city-hero:hover .city-hero__bg { transform: none; }
}
</style>
</head>
<body>

<!-- ════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════ -->
<div class="city-hero">
  <div class="city-hero__bg"></div>
  <div class="city-hero__overlay"></div>
  <div class="city-hero__content">
    <div class="city-hero__inner">
      <div class="city-hero__state">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Rajasthan &nbsp;·&nbsp; India
      </div>
      <h1 class="city-hero__title">Jaipur</h1>
      <p class="city-hero__tagline">The Pink City — where Mughal grandeur meets Rajput splendour in a tapestry of colour and culture.</p>
      <div class="city-hero__actions">
        <a href="#" class="ej-btn ej-btn-primary">Plan Your Trip</a>
        <a href="#packages" class="ej-btn ej-btn-outline-white">View Packages</a>
      </div>
    </div>
  </div>
  <div class="city-hero__scroll">
    <div class="city-hero__scroll-line"></div>
    scroll
  </div>
</div>

<!-- Quick Facts Strip -->
<div class="city-facts-strip">
  <div class="ej-wrap">
    <div class="city-facts-strip__grid">
      <div class="fact-cell">
        <div class="fact-cell__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div>
          <div class="fact-cell__label">Best Time to Visit</div>
          <div class="fact-cell__value">Oct – Mar</div>
        </div>
      </div>
      <div class="fact-cell">
        <div class="fact-cell__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div>
          <div class="fact-cell__label">Recommended Stay</div>
          <div class="fact-cell__value">3 – 5 Nights</div>
        </div>
      </div>
      <div class="fact-cell">
        <div class="fact-cell__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 4.69 12a19.79 19.79 0 0 1-2.89-9.82 2 2 0 0 1 2-2.18h3.06a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.5A16 16 0 0 0 12 12a16 16 0 0 0 3.5 1.91l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.02z"/></svg>
        </div>
        <div>
          <div class="fact-cell__label">Nearest Airport</div>
          <div class="fact-cell__value">Jaipur Intl (JAI)</div>
        </div>
      </div>
      <div class="fact-cell">
        <div class="fact-cell__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div>
          <div class="fact-cell__label">Language</div>
          <div class="fact-cell__value">Hindi, Rajasthani</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Breadcrumb -->
<div class="ej-breadcrumb-bar">
  <div class="ej-wrap">
    <ol class="ej-breadcrumb">
      <li><a href="#">Home</a></li>
      <li>Rajasthan</li>
      <li class="bc-cur">Jaipur</li>
    </ol>
  </div>
</div>


<!-- ════════════════════════════════════════════════════
     ABOUT
════════════════════════════════════════════════════ -->
<section class="ej-section">
  <div class="ej-wrap">
    <div class="city-about__grid">
      <div class="city-about__img-wrap">
        <img src="https://images.unsplash.com/photo-1477587458883-47145ed94245?w=900&q=80" class="city-about__img" alt="Jaipur">
        <div class="city-about__badge">
          <strong>20+</strong>
          <span>Years of Expertise</span>
        </div>
      </div>
      <div class="city-about__text">
        <span class="kicker">Destination Overview</span>
        <h2>Discover <em>Jaipur</em></h2>
        <p>Jaipur, the capital of Rajasthan, is a city that wears its history proudly. Founded in 1727 by Maharaja Sawai Jai Singh II, its rose-pink buildings give it a warm, other-worldly glow that earned it the enduring nickname "the Pink City". Walled forts, opulent palaces, and bustling bazaars line its wide avenues, making every turn a discovery.</p>
        <p>From the iconic Hawa Mahal to the hill-top Amer Fort, Jaipur rewards the curious traveller at every step. Our private guides unlock the stories behind the stones — the royal intrigues, the artisan traditions, the spice routes that once converged here.</p>
        <a href="#" class="ej-btn ej-btn-teal">Speak to an Expert &rarr;</a>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     TOP ATTRACTIONS
════════════════════════════════════════════════════ -->
<section class="ej-section ej-section-cream" id="attractions">
  <div class="ej-wrap">
    <div class="ej-heading">
      <div class="kicker">Must See</div>
      <h2>Top Attractions</h2>
      <p>Iconic landmarks and hidden treasures that define the spirit of Jaipur.</p>
    </div>
    <div class="attr-grid">
      <div class="attr-card">
        <div class="attr-card__img-wrap">
          <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=700&q=80" class="attr-card__img" alt="Amber Fort">
          <div class="attr-card__overlay"></div>
        </div>
        <div class="attr-card__body">
          <div class="attr-card__title">Amber Fort</div>
          <div class="attr-card__desc">A magnificent hilltop fortress whose mirrored halls, elephant ramps, and panoramic ramparts embody the peak of Rajput architecture.</div>
        </div>
      </div>
      <div class="attr-card">
        <div class="attr-card__img-wrap">
          <img src="https://images.unsplash.com/photo-1545126709-e80f4b7b3a5b?w=700&q=80" class="attr-card__img" alt="Hawa Mahal">
          <div class="attr-card__overlay"></div>
        </div>
        <div class="attr-card__body">
          <div class="attr-card__title">Hawa Mahal</div>
          <div class="attr-card__desc">The "Palace of Winds" — a five-storey honeycomb façade of 953 latticed windows designed so royal ladies could observe street life unseen.</div>
        </div>
      </div>
      <div class="attr-card">
        <div class="attr-card__img-wrap">
          <img src="https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=700&q=80" class="attr-card__img" alt="City Palace">
          <div class="attr-card__overlay"></div>
        </div>
        <div class="attr-card__body">
          <div class="attr-card__title">City Palace</div>
          <div class="attr-card__desc">Still home to the royal family, this walled complex blends Mughal and Rajput styles across museums, courtyards, and grand reception halls.</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     WHY BOOK — warm sage band
════════════════════════════════════════════════════ -->
<section class="ej-section ej-section-sage">
  <div class="ej-wrap">
    <div class="ej-heading light">
      <div class="kicker" style="color:var(--ej-amber2);">Trusted Since 2004</div>
      <h2>Why Travel with Elegant Journeys</h2>
    </div>
    <div class="trust-grid">
      <div class="trust-item">
        <div class="trust-item__icon">🏆</div>
        <div class="trust-item__num">10K+</div>
        <div class="trust-item__lbl">Travelers Served</div>
      </div>
      <div class="trust-item">
        <div class="trust-item__icon">⭐</div>
        <div class="trust-item__num">4.9/5</div>
        <div class="trust-item__lbl">Customer Satisfaction</div>
      </div>
      <div class="trust-item">
        <div class="trust-item__icon">🔄</div>
        <div class="trust-item__num">95%</div>
        <div class="trust-item__lbl">Repeat &amp; Referral Rate</div>
      </div>
      <div class="trust-item">
        <div class="trust-item__icon">🌍</div>
        <div class="trust-item__num">20+</div>
        <div class="trust-item__lbl">Years of Expertise</div>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     TOUR PACKAGES
════════════════════════════════════════════════════ -->
<section class="ej-section" id="packages">
  <div class="ej-wrap">
    <div class="ej-heading">
      <div class="kicker">Curated Itineraries</div>
      <h2>Tour Packages</h2>
      <p>Handcrafted private tours designed around you — every detail attended to.</p>
    </div>
    <div class="pkg-grid">
      <div class="pkg-card">
        <div class="pkg-card__imgwrap">
          <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=700&q=80" class="pkg-card__img" alt="Royal Rajasthan">
          <span class="pkg-card__badge">Private Tour</span>
        </div>
        <div class="pkg-card__body">
          <div class="pkg-card__title">Royal Rajasthan Circuit</div>
          <div class="pkg-card__nights">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            7 Days &nbsp;/&nbsp; 6 Nights
          </div>
          <div class="pkg-card__price-row">
            <div>
              <div class="pkg-card__price-lbl">Starting from</div>
              <div class="pkg-card__price-val">₹85,000 <small>onwards</small></div>
            </div>
          </div>
        </div>
        <a href="#" class="pkg-card__cta">View Details &rarr;</a>
      </div>
      <div class="pkg-card">
        <div class="pkg-card__imgwrap">
          <img src="https://images.unsplash.com/photo-1477587458883-47145ed94245?w=700&q=80" class="pkg-card__img" alt="Pink City Weekend">
          <span class="pkg-card__badge">Private Tour</span>
        </div>
        <div class="pkg-card__body">
          <div class="pkg-card__title">Pink City Long Weekend</div>
          <div class="pkg-card__nights">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            4 Days &nbsp;/&nbsp; 3 Nights
          </div>
          <div class="pkg-card__price-row">
            <div>
              <div class="pkg-card__price-lbl">Starting from</div>
              <div class="pkg-card__price-val">₹42,000 <small>onwards</small></div>
            </div>
          </div>
        </div>
        <a href="#" class="pkg-card__cta">View Details &rarr;</a>
      </div>
      <div class="pkg-card">
        <div class="pkg-card__imgwrap">
          <img src="https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=700&q=80" class="pkg-card__img" alt="Golden Triangle">
          <span class="pkg-card__badge">Private Tour</span>
        </div>
        <div class="pkg-card__body">
          <div class="pkg-card__title">Golden Triangle Classic</div>
          <div class="pkg-card__nights">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            6 Days &nbsp;/&nbsp; 5 Nights
          </div>
          <div class="pkg-card__price-row">
            <div>
              <div class="pkg-card__price-lbl">Starting from</div>
              <div class="pkg-card__price-val">₹68,000 <small>onwards</small></div>
            </div>
          </div>
        </div>
        <a href="#" class="pkg-card__cta">View Details &rarr;</a>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     PHOTO GALLERY
════════════════════════════════════════════════════ -->
<section class="ej-section ej-section-ivory">
  <div class="ej-wrap-lg">
    <div class="ej-heading">
      <div class="kicker">Visual Journey</div>
      <h2>Photo Gallery</h2>
    </div>
    <div class="gallery-mosaic">
      <div class="gal-item">
        <img src="https://images.unsplash.com/photo-1599661046289-e31897846e41?w=900&q=80" alt="Jaipur photo 1">
        <div class="gal-item__caption"><span>Jaipur</span></div>
      </div>
      <div class="gal-item">
        <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=700&q=80" alt="Jaipur photo 2">
        <div class="gal-item__caption"><span>Jaipur</span></div>
      </div>
      <div class="gal-item">
        <img src="https://images.unsplash.com/photo-1545126709-e80f4b7b3a5b?w=700&q=80" alt="Jaipur photo 3">
        <div class="gal-item__caption"><span>Jaipur</span></div>
      </div>
      <div class="gal-item">
        <img src="https://images.unsplash.com/photo-1477587458883-47145ed94245?w=900&q=80" alt="Jaipur photo 4">
        <div class="gal-item__caption"><span>Jaipur</span></div>
      </div>
      <div class="gal-item">
        <img src="https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=700&q=80" alt="Jaipur photo 5">
        <div class="gal-item__caption"><span>Jaipur</span></div>
      </div>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     FAQ
════════════════════════════════════════════════════ -->
<section class="ej-section">
  <div class="ej-wrap">
    <div class="ej-heading">
      <div class="kicker">Have Questions?</div>
      <h2>Frequently Asked Questions</h2>
    </div>
    <div class="faq-list">
      <details class="faq-item" open>
        <summary>
          What is the best time of year to visit Jaipur?
          <span class="faq-icon">+</span>
        </summary>
        <div class="faq-body">October to March is ideal — temperatures are pleasant (15–25°C), skies are clear, and all the major sites are fully accessible. The Jaipur Literature Festival in January and the colourful Holi celebrations in March are highlights. Avoid May–June when temperatures regularly exceed 40°C.</div>
      </details>
      <details class="faq-item">
        <summary>
          How many days do I need to explore Jaipur thoroughly?
          <span class="faq-icon">+</span>
        </summary>
        <div class="faq-body">We recommend a minimum of 3 nights to cover the major forts and palaces at a relaxed pace. For those who wish to include the bazaars, day trips to Abhaneri or Sanganer, and evening experiences like a heritage hotel dinner, 4–5 nights is ideal.</div>
      </details>
      <details class="faq-item">
        <summary>
          Can Elegant Journeys arrange heritage hotel stays in Jaipur?
          <span class="faq-icon">+</span>
        </summary>
        <div class="faq-body">Absolutely. Jaipur has some of India's finest heritage properties — converted havelis and former royal guesthouses where the décor tells as rich a story as the city itself. We have curated relationships with the top properties and can match you to the right one based on your style and budget.</div>
      </details>
      <details class="faq-item">
        <summary>
          Is Jaipur suitable for first-time visitors to India?
          <span class="faq-icon">+</span>
        </summary>
        <div class="faq-body">Yes — Jaipur is one of India's most visitor-friendly cities. With a well-developed tourism infrastructure, excellent road connections, and a compact old city, it makes a wonderful introduction to the subcontinent. Our private guides and transfers mean you never have to navigate the city alone.</div>
      </details>
    </div>
  </div>
</section>


<!-- ════════════════════════════════════════════════════
     CTA BAND
════════════════════════════════════════════════════ -->
<div class="city-cta">
  <h2>Ready to Explore Jaipur?</h2>
  <p>Let Elegant Journeys craft your perfect private journey — every detail perfected.</p>
  <a href="#" class="ej-btn ej-btn-primary">Enquire Now</a>
</div>