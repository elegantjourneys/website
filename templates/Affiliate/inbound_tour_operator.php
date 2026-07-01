<style>
    :root {
      --gold: #3b82f6;
      --gold-light: #93c5fd;
      --gold-pale: #f5f9ff;
      --navy: #3d4f6f;
      --navy-mid: #5a6d8a;
      --navy-light: #7b8da8;
      --white: #ffffff;
      --off-white: #fafbfc;
      --light-bg: #f5f7fa;
      --border: #eceff3;
      --text-dark: #4a5568;
      --text-mid: #6b7280;
      --text-light: #9ca3af;
    }
    /* ── HERO ────────────────────────────────────── */
    .hero {
      min-height: 100vh;
      background: linear-gradient(135deg, #ffffff 0%, var(--off-white) 60%, #f8fafc 100%);
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
    }
    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse at 70% 50%, rgba(59,130,246,0.04) 0%, transparent 60%),
        radial-gradient(ellipse at 20% 80%, rgba(59,130,246,0.03) 0%, transparent 50%);
      pointer-events: none;
    }
    .hero-pattern {
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230d6efd' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      pointer-events: none;
    }
    .hero-badge-wrap {
      position: relative;
      display: inline-block;
    }
    .hero-badge-img {
      width: 200px;
      height: 200px;
      object-fit: contain;
      filter: drop-shadow(0 0 20px rgba(59,130,246,0.12));
      animation: float 4s ease-in-out infinite;
    }
    .badge-glow {
      position: absolute;
      inset: -20px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
      animation: pulse-glow 3s ease-in-out infinite;
    }
    @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
    @keyframes pulse-glow { 0%,100%{opacity:0.5;transform:scale(1)} 50%{opacity:1;transform:scale(1.1)} }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(59,130,246,0.06);
      border: 1px solid rgba(59,130,246,0.15);
      color: var(--gold);
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 0.45rem 1rem;
      border-radius: 2px;
      margin-bottom: 1.5rem;
    }
    .hero h1 {
      font-size: clamp(2.2rem, 5vw, 4rem);
      color: var(--navy);
      line-height: 1.15;
      margin-bottom: 1.5rem;
    }
    .hero h1 em {
      color: var(--gold);
      font-style: italic;
    }
    .hero-sub {
      color: var(--text-mid);
      font-size: 1.05rem;
      line-height: 1.8;
      max-width: 540px;
      margin-bottom: 2.5rem;
    }
    .btn-gold {
      background: linear-gradient(135deg, #60a5fa, #93c5fd);
      color: var(--white);
      font-weight: 700;
      font-size: 0.88rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 0.85rem 2rem;
      border: none;
      border-radius: 2px;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    .btn-gold:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59,130,246,0.2);
      color: var(--white);
    }
    .btn-outline-gold {
      background: transparent;
      color: var(--gold);
      border: 1.5px solid var(--gold);
      font-weight: 700;
      font-size: 0.88rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 0.85rem 2rem;
      border-radius: 2px;
      transition: all 0.3s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    .btn-outline-gold:hover {
      background: rgba(59,130,246,0.05);
      color: var(--navy-mid);
    }
    .hero-certifications {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      flex-wrap: wrap;
      margin-top: 2rem;
    }
    .cert-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-light);
      font-size: 0.82rem;
      font-weight: 500;
    }
    .cert-item i { color: #60a5fa; font-size: 1rem; }
    .hero-stat-card {
      background: var(--white);
      border: 1px solid var(--border);
      box-shadow: 0 1px 6px rgba(0,0,0,0.03);
    }
    .hero-stat-card-label { color: var(--text-light); font-size: 0.78rem; margin-top: 0.2rem; }
    .hero-scroll {
      position: absolute;
      bottom: 2rem;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.4rem;
      color: var(--text-light);
      font-size: 0.72rem;
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .scroll-line {
      width: 1px;
      height: 50px;
      background: linear-gradient(to bottom, rgba(59,130,246,0.35), transparent);
      animation: scroll-drop 1.5s ease-in-out infinite;
    }
    @keyframes scroll-drop { 0%{opacity:0;transform:scaleY(0);transform-origin:top} 50%{opacity:1} 100%{opacity:0;transform:scaleY(1);transform-origin:bottom} }

    /* ── SECTION TITLES ──────────────────────────── */
    .section-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 0.8rem;
    }
    .section-tag::before, .section-tag::after {
      content: '';
      display: block;
      width: 24px;
      height: 1px;
      background: var(--gold);
    }
    .section-title {
      font-size: clamp(1.8rem, 3.5vw, 2.8rem);
      color: var(--navy);
      line-height: 1.2;
      margin-bottom: 1rem;
    }
    .section-title.light { color: var(--navy); }
    .section-sub {
      color: var(--text-mid);
      font-size: 1rem;
      line-height: 1.8;
      max-width: 620px;
      margin: 0 auto;
    }
    .section-sub.light { color: var(--text-mid); }
    .gold-divider {
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, #93c5fd, #bfdbfe);
      margin: 1.2rem auto;
    }
    .gold-divider.left { margin-left: 0; }

    /* ── INTRO ───────────────────────────────────── */
    .section-intro { padding: 100px 0; background: var(--white); }
    .intro-card {
      background: var(--off-white);
      border-radius: 4px;
      padding: 2.5rem;
      height: 100%;
      border: 1px solid var(--border);
      border-bottom: 3px solid transparent;
      transition: all 0.3s;
      box-shadow: none;
    }
    .intro-card:hover {
      border-bottom-color: var(--gold-light);
      transform: translateY(-4px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }
    .intro-icon {
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, #60a5fa, #bfdbfe);
      border-radius: 3px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.2rem;
    }
    .intro-icon i { color: var(--white); font-size: 1.3rem; }
    .intro-card h4 {
      font-size: 1.3rem;
      color: var(--navy);
      margin-bottom: 0.6rem;
    }
    .intro-card p { color: var(--text-mid); font-size: 0.93rem; line-height: 1.7; }
    .stat-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--gold-pale);
      border: 1px solid rgba(59,130,246,0.12);
      padding: 0.4rem 0.9rem;
      border-radius: 20px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--navy-mid);
      margin-top: 0.8rem;
    }
    .stat-pill i { color: var(--gold); }

    /* ── BENEFITS ────────────────────────────────── */
    .section-benefits { padding: 100px 0; background: var(--off-white); position: relative; overflow: hidden; }
    .section-benefits::before {
      content: '';
      position: absolute;
      top: -100px; right: -100px;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(59,130,246,0.03) 0%, transparent 70%);
      border-radius: 50%;
    }
    .benefit-item {
      display: flex;
      gap: 1.2rem;
      margin-bottom: 1.5rem;
      padding: 1.5rem;
      border: 1px solid var(--border);
      border-radius: 4px;
      transition: all 0.3s;
      background: var(--white);
    }
    .benefit-item:hover {
      border-color: rgba(59,130,246,0.2);
      background: var(--gold-pale);
    }
    .benefit-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.5rem;
      font-weight: 700;
      color: rgba(59,130,246,0.15);
      line-height: 1;
      min-width: 50px;
    }
    .benefit-content h5 {
      color: var(--navy);
      font-family: 'Mulish', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      margin-bottom: 0.4rem;
    }
    .benefit-content p { color: var(--text-mid); font-size: 0.87rem; line-height: 1.6; margin: 0; }
    .benefit-visual {
      background: var(--white);
      border-radius: 4px;
      padding: 2.5rem;
      border: 1px solid var(--border);
      height: 100%;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .benefit-visual-title { color: var(--navy); font-size: 1.6rem; margin-bottom: 1rem; }
    .benefit-visual-desc { color: var(--text-mid); font-size: 0.9rem; margin-bottom: 1.5rem; }
    .benefit-visual-icon {
      width: 80px; height: 80px;
      background: linear-gradient(135deg, #60a5fa, #bfdbfe);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 1.5rem;
    }
    .benefit-visual-icon i { font-size: 2rem; color: var(--white); }
    .check-list { list-style: none; padding: 0; margin: 1.5rem 0; }
    .check-list li {
      display: flex;
      align-items: flex-start;
      gap: 0.7rem;
      color: var(--text-mid);
      font-size: 0.9rem;
      padding: 0.6rem 0;
      border-bottom: 1px solid var(--border);
    }
    .check-list li:last-child { border-bottom: none; }
    .check-list li i { color: var(--gold); margin-top: 2px; flex-shrink: 0; }

    /* ── STANDARDS ───────────────────────────────── */
    .section-standards { padding: 100px 0; background: var(--white); }
    .standard-card {
      background: var(--off-white);
      border-radius: 4px;
      padding: 2rem;
      height: 100%;
      position: relative;
      overflow: hidden;
      transition: all 0.3s;
      border: 1px solid var(--border);
    }
    .standard-card::after {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 3px;
      background: linear-gradient(90deg, var(--gold), var(--gold-light));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s;
    }
    .standard-card:hover::after { transform: scaleX(1); }
    .standard-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.04); }
    .standard-icon {
      width: 48px; height: 48px;
      background: linear-gradient(135deg, #60a5fa, #bfdbfe);
      border-radius: 3px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 1rem;
    }
    .standard-icon i { color: var(--white); font-size: 1.1rem; }
    .standard-card h5 {
      font-family: 'Mulish', sans-serif;
      font-weight: 700;
      font-size: 0.92rem;
      color: var(--navy);
      margin-bottom: 0.5rem;
    }
    .standard-card p { color: var(--text-mid); font-size: 0.87rem; line-height: 1.6; margin: 0; }
    .compliance-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      background: #EAF7EE;
      color: #1B7A3B;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 0.3rem 0.7rem;
      border-radius: 20px;
      margin-top: 0.8rem;
      border: 1px solid #C3E6CB;
    }

    /* ── WHY CHOOSE ──────────────────────────────── */
    .section-why { padding: 100px 0; background: var(--white); }
    .why-feature {
      display: flex;
      align-items: flex-start;
      gap: 1.2rem;
      margin-bottom: 2rem;
    }
    .why-icon-wrap {
      width: 48px; height: 48px;
      background: linear-gradient(135deg, #60a5fa, #bfdbfe);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .why-icon-wrap i { color: var(--white); font-size: 1rem; }
    .why-feature h5 {
      font-family: 'Mulish', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      color: var(--navy);
      margin-bottom: 0.3rem;
    }
    .why-feature p { color: var(--text-mid); font-size: 0.88rem; line-height: 1.6; margin: 0; }
    .why-image-block {
      background: var(--off-white);
      border: 1px solid var(--border);
      border-radius: 6px;
      padding: 3rem;
      position: relative;
      overflow: hidden;
      box-shadow: none;
    }
    .why-image-block::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%230d6efd' fill-opacity='0.05'%3E%3Cpath d='M20 0L40 20L20 40L0 20z'/%3E%3C/g%3E%3C/svg%3E");
    }
    .trust-score {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 1.5rem;
      margin-bottom: 1rem;
      position: relative;
    }
    .trust-partners-box {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 1.2rem;
    }
    .trust-partners-label {
      color: var(--text-mid);
      font-size: 0.8rem;
      margin-bottom: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .trust-badge {
      background: var(--gold-pale);
      color: var(--navy);
      padding: 0.3rem 0.7rem;
      border-radius: 2px;
      font-size: 0.78rem;
      font-weight: 600;
    }
    .trust-quote-box {
      margin-top: 1rem;
      background: var(--gold-pale);
      border: 1px solid rgba(59,130,246,0.1);
      border-radius: 4px;
      padding: 1.2rem;
    }
    .trust-quote-text { color: var(--text-dark); font-size: 0.85rem; font-style: italic; }
    .trust-quote-author { color: var(--text-mid); font-size: 0.75rem; padding-left: 1.5rem; }
    .trust-score-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 3.5rem;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }
    .trust-score-label { color: var(--text-mid); font-size: 0.82rem; margin-top: 0.3rem; }
    .trust-stars { color: var(--gold); font-size: 0.9rem; margin-top: 0.3rem; }

    /* ── TIMELINE ────────────────────────────────── */
    .section-timeline { padding: 100px 0; background: var(--off-white); position: relative; overflow: hidden; }
    .timeline-container { position: relative; }
    .timeline-container::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 0; bottom: 0;
      width: 2px;
      background: linear-gradient(to bottom, transparent, var(--gold), transparent);
      transform: translateX(-50%);
    }
    .timeline-item {
      display: flex;
      justify-content: flex-end;
      padding-right: calc(50% + 40px);
      margin-bottom: 3rem;
      position: relative;
    }
    .timeline-item:nth-child(even) {
      justify-content: flex-start;
      padding-right: 0;
      padding-left: calc(50% + 40px);
    }
    .timeline-dot {
      position: absolute;
      left: 50%;
      top: 24px;
      transform: translateX(-50%);
      width: 16px; height: 16px;
      background: var(--gold);
      border-radius: 50%;
      border: 3px solid var(--off-white);
      box-shadow: 0 0 0 3px var(--gold);
      z-index: 1;
    }
    .timeline-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 4px;
      padding: 1.5rem;
      max-width: 380px;
      transition: all 0.3s;
      box-shadow: 0 1px 6px rgba(0,0,0,0.03);
    }
    .timeline-card:hover {
      background: var(--gold-pale);
      border-color: rgba(59,130,246,0.2);
    }
    .timeline-year {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
      margin-bottom: 0.4rem;
    }
    .timeline-card h5 {
      color: var(--navy);
      font-family: 'Mulish', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      margin-bottom: 0.4rem;
    }
    .timeline-card p { color: var(--text-mid); font-size: 0.87rem; line-height: 1.6; margin: 0; }

    /* ── STATS ───────────────────────────────────── */
    .section-stats {
      padding: 80px 0;
      background: linear-gradient(135deg, #f5f9ff 0%, #eef4fc 100%);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      position: relative;
      overflow: hidden;
    }
    .section-stats::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%233b82f6' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
    }
    .stat-box { text-align: center; padding: 1.5rem; }
    .stat-number {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.5rem, 4vw, 4rem);
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }
    .stat-suffix { font-size: 1.8rem; }
    .stat-label {
      color: var(--text-mid);
      font-size: 0.88rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 0.5rem;
    }
    .stat-divider {
      width: 1px;
      background: var(--border);
      align-self: stretch;
    }

    /* ── FAQ ─────────────────────────────────────── */
    .section-faq { padding: 100px 0; background: var(--white); }
    .accordion-item {
      border: 1px solid var(--border) !important;
      border-radius: 4px !important;
      margin-bottom: 0.8rem;
      overflow: hidden;
    }
    .accordion-button {
      font-family: 'Mulish', sans-serif;
      font-weight: 700;
      font-size: 0.95rem;
      color: var(--navy) !important;
      background: var(--white) !important;
      padding: 1.2rem 1.5rem;
    }
    .accordion-button:not(.collapsed) {
      color: var(--gold) !important;
      background: var(--gold-pale) !important;
      box-shadow: none !important;
    }
    .accordion-button::after {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230d6efd'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    }
    .accordion-body {
      color: var(--text-mid);
      font-size: 0.92rem;
      line-height: 1.8;
      background: var(--white);
    }
    .faq-tag {
      display: inline-block;
      background: var(--gold-pale);
      color: var(--navy-mid);
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 0.25rem 0.6rem;
      border-radius: 2px;
      margin-bottom: 0.5rem;
    }
    /* ── UTILITIES ───────────────────────────────── */
    .bg-navy { background: var(--navy); }
    .text-gold { color: var(--gold); }
    .pt-nav { padding-top: 100px; }

    @media (max-width: 768px) {
      .timeline-container::before { left: 20px; }
      .timeline-item, .timeline-item:nth-child(even) {
        padding-right: 0;
        padding-left: 50px;
        justify-content: flex-start;
      }
      .timeline-dot { left: 20px; }
      .stat-divider { display: none; }
      
    }
</style>
<!-- AOS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Mulish:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

<!-- ── HERO ──────────────────────────────────────── -->
<section class="hero pt-nav">
  <div class="hero-pattern"></div>
  <div class="container position-relative">
    <div class="row align-items-center gy-5">
      <div class="col-lg-7" data-aos="fade-right" data-aos-duration="900">
        <div class="hero-tag">
          <i class="fas fa-shield-halved"></i>
          Ministry of Tourism · Govt. of India Certified
        </div>
        <h1>
          Government<br>
          Recognized<br>
          <em>Inbound Tour Operator</em>
        </h1>
        <p class="hero-sub">
          Certified by the Ministry of Tourism, Government of India — delivering world-class, authentic travel experiences across the subcontinent with full compliance, safety, and trust.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="#cta" class="btn-gold">
            <i class="fas fa-paper-plane"></i> Plan Your Journey
          </a>
          <a href="#benefits" class="btn-outline-gold">
            <i class="fas fa-play-circle"></i> Why Choose Us
          </a>
        </div>
        <div class="hero-certifications">
          <div class="cert-item"><i class="fas fa-certificate"></i> Ministry of Tourism</div>
          <div class="cert-item"><i class="fas fa-leaf"></i> TOFT Certified</div>
          <div class="cert-item"><i class="fas fa-handshake"></i> IATO Active Member</div>
          <div class="cert-item"><i class="fas fa-globe"></i> FAITH Partner</div>
        </div>
      </div>
      <div class="col-lg-5 text-center" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">
        <div class="hero-badge-wrap d-inline-block">
          <div class="badge-glow"></div>
          <img
            src="<?= WEBROOT ?>version2/assets/images/affiliation%20(2).png"
            alt="Ministry of Tourism Recognized Inbound Tour Operator Badge"
            class="hero-badge-img"
          />
        </div>
        <!-- Floating cards -->
        <div class="row g-2 mt-3">
          <div class="col-6">
            <div class="p-3 rounded-2 text-start hero-stat-card">
              <div class="text-gold" style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;line-height:1">25+</div>
              <div class="hero-stat-card-label">Years of Excellence</div>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 rounded-2 text-start hero-stat-card">
              <div class="text-gold" style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;line-height:1">10K+</div>
              <div class="hero-stat-card-label">Happy Travellers</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── INTRO ──────────────────────────────────────── -->
<section class="section-intro" id="intro">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="d-flex justify-content-center"><div class="section-tag">Our Significance</div></div>
      <h2 class="section-title">The Importance of Recognized<br>Inbound Tourism in India</h2>
      <div class="gold-divider"></div>
      <p class="section-sub">India's inbound tourism is a cornerstone of economic growth, cultural exchange, and sustainable development. Working with a government-recognized operator ensures every journey is safe, authentic, and meaningful.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
        <div class="intro-card">
          <div class="intro-icon"><i class="fas fa-landmark"></i></div>
          <h4>Economic Catalyst</h4>
          <p>Inbound tourism contributes over $28 billion annually to India's GDP, creating millions of livelihoods across hospitality, transport, and handicraft sectors.</p>
          <div class="stat-pill"><i class="fas fa-arrow-trend-up"></i>$28B Annual GDP Contribution</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="intro-card">
          <div class="intro-icon"><i class="fas fa-globe-asia"></i></div>
          <h4>Cultural Bridge</h4>
          <p>Recognized operators promote India's rich heritage responsibly, ensuring cultural sensitivity, preservation of traditions, and genuine connection between visitors and communities.</p>
          <div class="stat-pill"><i class="fas fa-star"></i>Authentic Experiences</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="intro-card">
          <div class="intro-icon"><i class="fas fa-shield-check"></i></div>
          <h4>Safety & Compliance</h4>
          <p>Government recognition ensures strict adherence to traveller safety protocols, legal frameworks, and international tourism standards — giving you complete peace of mind.</p>
          <div class="stat-pill"><i class="fas fa-check-circle"></i>Govt. Verified Standards</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="intro-card">
          <div class="intro-icon"><i class="fas fa-seedling"></i></div>
          <h4>Sustainable Tourism</h4>
          <p>Certified operators follow TOFT and Ministry of Tourism guidelines to minimize environmental impact while maximizing benefits to local communities and ecosystems.</p>
          <div class="stat-pill"><i class="fas fa-leaf"></i>Eco-Responsible Travel</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── BENEFITS ───────────────────────────────────── -->
<section class="section-benefits" id="benefits">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="section-tag" style="color:var(--gold)">Core Advantages</div>
        <h2 class="section-title light">Benefits of Working With a Recognized Tour Operator</h2>
        <div class="gold-divider left"></div>
        <p class="section-sub light mb-4">Every rupee spent with a Ministry-recognized operator is invested in safe, accountable, and transformative travel.</p>

        <div class="benefit-item">
          <div class="benefit-num">01</div>
          <div class="benefit-content">
            <h5>Legal Protection & Accountability</h5>
            <p>Recognized operators are legally bound to uphold consumer protection laws, ensuring full refund policies and dispute resolution mechanisms.</p>
          </div>
        </div>
        <div class="benefit-item">
          <div class="benefit-num">02</div>
          <div class="benefit-content">
            <h5>Trained & Certified Staff</h5>
            <p>All guides, drivers, and service personnel undergo mandatory Ministry of Tourism training and background verification.</p>
          </div>
        </div>
        <div class="benefit-item">
          <div class="benefit-num">03</div>
          <div class="benefit-content">
            <h5>Preferred Hotel & Airline Rates</h5>
            <p>Registered operators have exclusive tie-ups with premium hotels and airlines, passing significant savings directly to travellers.</p>
          </div>
        </div>
        <div class="benefit-item">
          <div class="benefit-num">04</div>
          <div class="benefit-content">
            <h5>24/7 Emergency Support</h5>
            <p>Round-the-clock coordination centres to manage any travel emergency, health incident, or logistical disruption anywhere in India.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="150">
        <div class="benefit-visual">
          <div class="benefit-visual-icon"><i class="fas fa-award"></i></div>
          <h3 class="benefit-visual-title">Recognition Ensures Excellence</h3>
          <p class="benefit-visual-desc">The Ministry of Tourism's recognition framework evaluates operators across multiple dimensions of service quality and compliance.</p>
          <ul class="check-list">
            <li><i class="fas fa-check-circle"></i>Annual audit and compliance verification by Ministry inspectors</li>
            <li><i class="fas fa-check-circle"></i>Mandatory insurance coverage for all travellers and itineraries</li>
            <li><i class="fas fa-check-circle"></i>Registered foreign exchange dealings and transparent billing</li>
            <li><i class="fas fa-check-circle"></i>Grievance redressal mechanism with government oversight</li>
            <li><i class="fas fa-check-circle"></i>Inclusive tourism practises for differently-abled travellers</li>
            <li><i class="fas fa-check-circle"></i>Commitment to responsible wildlife and heritage tourism</li>
          </ul>
          <a href="#cta" class="btn-gold mt-2">
            <i class="fas fa-file-certificate"></i> View Our Certification
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── STANDARDS ──────────────────────────────────── -->
<section class="section-standards" id="standards">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="d-flex justify-content-center"><div class="section-tag">Our Commitment</div></div>
      <h2 class="section-title">Eligibility & Compliance Standards</h2>
      <div class="gold-divider"></div>
      <p class="section-sub">Meeting the Ministry of Tourism's stringent criteria for recognition requires ongoing dedication to excellence across every aspect of our operations.</p>
    </div>
    <div class="row g-3">
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-file-contract"></i></div>
          <h5>Registered Business Entity</h5>
          <p>Incorporated under Indian company law with valid GST registration, PAN, and compliance with all tourism-related statutes.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> Fully Compliant</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-user-tie"></i></div>
          <h5>Qualified Tourism Personnel</h5>
          <p>Management team with minimum 3 years in inbound tourism, certified by IATO and holding Ministry-approved guide licenses.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> Certified</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-building"></i></div>
          <h5>Dedicated Office Infrastructure</h5>
          <p>Physical office with adequate staff, communication systems, and round-the-clock operational capability as mandated by the Ministry.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> Verified</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-coins"></i></div>
          <h5>Foreign Exchange Compliance</h5>
          <p>Authorized foreign exchange dealer with FEMA compliance, ensuring transparent and legal handling of international currency transactions.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> RBI Authorized</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-umbrella"></i></div>
          <h5>Comprehensive Insurance Coverage</h5>
          <p>Mandatory travel insurance, professional indemnity, and public liability coverage as per Ministry of Tourism circular guidelines.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> Insured</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
        <div class="standard-card">
          <div class="standard-icon"><i class="fas fa-recycle"></i></div>
          <h5>Sustainable Tourism Practises</h5>
          <p>Active adoption of TOFT certification standards, carbon footprint reduction initiatives, and responsible community-based tourism frameworks.</p>
          <div class="compliance-badge"><i class="fas fa-circle-check"></i> TOFT Approved</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── WHY CHOOSE ──────────────────────────────────── -->
<section class="section-why" id="why">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-5" data-aos="fade-right">
        <div class="why-image-block">
          <div class="position-relative">
            <div class="trust-score">
              <div class="trust-score-num">4.9</div>
              <div class="trust-score-label">Average Traveller Rating</div>
              <div class="trust-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-stroke"></i>
              </div>
            </div>
            <div class="trust-partners-box">
              <div class="trust-partners-label">Recognized By</div>
              <div class="d-flex flex-wrap gap-2">
                <span class="trust-badge">Ministry of Tourism</span>
                <span class="trust-badge">FAITH</span>
                <span class="trust-badge">IATO</span>
                <span class="trust-badge">TOFT</span>
              </div>
            </div>
            <div class="trust-quote-box">
              <div class="d-flex align-items-center gap-2 mb-1">
                <i class="fas fa-quote-left" style="color:var(--gold);font-size:0.9rem"></i>
                <span class="trust-quote-text">"An unparalleled India experience — completely authentic and safe."</span>
              </div>
              <div class="trust-quote-author">— James M., United Kingdom</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7" data-aos="fade-left" data-aos-delay="150">
        <div class="section-tag">Traveller Assurance</div>
        <h2 class="section-title">Why Travellers Should Choose Recognized Operators</h2>
        <div class="gold-divider left"></div>
        <p style="color:var(--text-mid);margin-bottom:2rem;line-height:1.8">When you book through a Ministry-recognized operator, every element of your journey is backed by government oversight, professional expertise, and an unwavering commitment to your welfare.</p>
        <div class="why-feature">
          <div class="why-icon-wrap"><i class="fas fa-map-marked-alt"></i></div>
          <div><h5>Curated, Authentic Itineraries</h5><p>Every route and experience is crafted by certified experts with deep local knowledge, ensuring genuine cultural immersion rather than generic tourist traps.</p></div>
        </div>
        <div class="why-feature">
          <div class="why-icon-wrap"><i class="fas fa-headset"></i></div>
          <div><h5>Dedicated Personal Concierge</h5><p>From visa assistance to last-minute customisations, your assigned travel manager handles every detail before, during, and after your trip.</p></div>
        </div>
        <div class="why-feature">
          <div class="why-icon-wrap"><i class="fas fa-lock"></i></div>
          <div><h5>Secure Financial Transactions</h5><p>All payments processed through government-registered channels with full receipts, invoices, and refund protection — your money is always safe.</p></div>
        </div>
        <div class="why-feature">
          <div class="why-icon-wrap"><i class="fas fa-star"></i></div>
          <div><h5>Premium, Vetted Accommodation Partners</h5><p>Exclusively partnering with Ministry-approved hotels and heritage properties, vetted for hygiene, safety, and authentic experience quality.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── TIMELINE ────────────────────────────────────── -->
<section class="section-timeline" id="timeline">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="d-flex justify-content-center"><div class="section-tag" style="color:var(--gold)">Our Journey</div></div>
      <h2 class="section-title light">Milestones of Excellence</h2>
      <div class="gold-divider"></div>
      <p class="section-sub light">Two and a half decades of building India's most trusted inbound tourism legacy.</p>
    </div>
    <div class="timeline-container">
      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">1999</div>
          <h5>Founded &amp; Ministry Registration</h5>
          <p>Established as a specialized inbound tour operator and received our inaugural Ministry of Tourism recognition — the beginning of a trusted legacy.</p>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">2004</div>
          <h5>IATO Active Membership Awarded</h5>
          <p>Became an Active Member of the Indian Association of Tour Operators, expanding our network and gaining access to exclusive industry partnerships.</p>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">2010</div>
          <h5>1,000th International Group Hosted</h5>
          <p>Celebrated hosting our 1,000th international group — representing travellers from over 45 countries — while achieving a perfect 5-star compliance audit.</p>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">2015</div>
          <h5>TOFT Sustainable Tourism Certification</h5>
          <p>Awarded the TOFT (Tourism for Tomorrow's Future) certification, recognising our commitment to driving sustainable destinations across India.</p>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">2019</div>
          <h5>FAITH Founding Partner Recognition</h5>
          <p>Recognised as a founding partner of FAITH — Federation of Associations in Indian Tourism &amp; Hospitality — contributing to policy-level industry advocacy.</p>
        </div>
      </div>
      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-dot"></div>
        <div class="timeline-card">
          <div class="timeline-year">2024</div>
          <h5>National Tourism Excellence Award</h5>
          <p>Honoured with the Ministry of Tourism's National Tourism Excellence Award for outstanding contribution to inbound tourism growth and traveller satisfaction.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── STATS ──────────────────────────────────────── -->
<section class="section-stats" id="stats">
  <div class="container position-relative">
    <div class="row align-items-center g-4">
      <div class="col-6 col-md-3">
        <div class="stat-box" data-aos="zoom-in" data-aos-delay="0">
          <div class="stat-number"><span class="counter" data-target="25">0</span><span class="stat-suffix">+</span></div>
          <div class="stat-label">Years of Service</div>
        </div>
      </div>
      <div class="col-md-auto d-none d-md-block"><div class="stat-divider" style="height:80px"></div></div>
      <div class="col-6 col-md-3">
        <div class="stat-box" data-aos="zoom-in" data-aos-delay="100">
          <div class="stat-number"><span class="counter" data-target="10">0</span><span class="stat-suffix">K+</span></div>
          <div class="stat-label">Happy Travellers</div>
        </div>
      </div>
      <div class="col-md-auto d-none d-md-block"><div class="stat-divider" style="height:80px"></div></div>
      <div class="col-6 col-md-3">
        <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
          <div class="stat-number"><span class="counter" data-target="60">0</span><span class="stat-suffix">+</span></div>
          <div class="stat-label">Countries Served</div>
        </div>
      </div>
      <div class="col-md-auto d-none d-md-block"><div class="stat-divider" style="height:80px"></div></div>
      <div class="col-6 col-md-2">
        <div class="stat-box" data-aos="zoom-in" data-aos-delay="300">
          <div class="stat-number"><span class="counter" data-target="98">0</span><span class="stat-suffix">%</span></div>
          <div class="stat-label">Client Satisfaction</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ ────────────────────────────────────────── -->
<section class="section-faq" id="faq">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="d-flex justify-content-center"><div class="section-tag">Common Questions</div></div>
      <h2 class="section-title">Frequently Asked Questions</h2>
      <div class="gold-divider"></div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="accordion" id="faqAccordion">

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="0">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                What does "Ministry of Tourism Recognized" actually mean?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Recognition</div>
                <p>Recognition by India's Ministry of Tourism is a formal certification awarded to tour operators who meet stringent criteria relating to business registration, staff qualifications, office infrastructure, insurance coverage, and foreign exchange compliance. It is renewed annually through an audit process, ensuring operators consistently maintain the highest standards of service and legal compliance. Recognized operators receive a unique certificate number that can be verified on the Ministry's official website.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="60">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                How can I verify your Ministry of Tourism certification?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Verification</div>
                <p>You can verify our recognition status directly on the Ministry of Tourism's official portal at tourism.gov.in. Our certificate number and registration details are publicly available on the Ministry's approved operator registry. We are also happy to share a certified copy of our recognition certificate, current compliance audit report, and IATO membership ID upon request. Transparency is a cornerstone of our commitment to travellers.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="120">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                What types of inbound travel experiences do you specialise in?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Services</div>
                <p>We specialise in a wide range of inbound experiences including cultural heritage tours, wildlife and nature safaris, spiritual pilgrimages, luxury train journeys, adventure expeditions, MICE (Meetings, Incentives, Conferences, Events) travel, wellness and Ayurveda retreats, and customised private tours. All itineraries are crafted to provide authentic Indian experiences while meeting the specific interests and comfort requirements of international travellers.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="180">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                What happens if there is an emergency during my trip?
              </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Safety</div>
                <p>Every traveller is assigned a dedicated personal tour manager who remains reachable 24/7 throughout the journey. We maintain an emergency operations centre staffed around the clock. In the event of a medical emergency, we coordinate directly with empanelled hospitals and insurance providers. For security emergencies, we maintain direct lines to local law enforcement and the nearest international consulates. Our comprehensive travel insurance covers evacuation, medical expenses, and trip interruption costs.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="240">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                Are your tour packages customisable for private groups or solo travellers?
              </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Customisation</div>
                <p>Absolutely. We specialise in fully tailor-made itineraries for solo travellers, couples, families, and private groups of any size. Starting from a discovery call, our travel designers work with you to understand your interests, travel pace, accommodation preferences, dietary requirements, and budget. There is no minimum group size, and every package is uniquely built around your vision of India — whether that means a 7-day Golden Triangle classic or a 30-day cross-country odyssey.</p>
              </div>
            </div>
          </div>

          <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                What is your cancellation and refund policy?
              </button>
            </h2>
            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <div class="faq-tag">Policy</div>
                <p>Our cancellation policy is structured transparently and in full compliance with Ministry of Tourism guidelines. Cancellations made 60+ days before departure receive a 90% refund. For 30-59 days, 70% is refunded; 15-29 days, 50%; and within 14 days, 25%. Force majeure cancellations (natural disasters, government travel advisories) are treated with full flexibility including reschedules at no additional cost. All refund timelines and conditions are clearly documented in your booking contract.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- AOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
  // AOS Init
  AOS.init({ once: true, duration: 750, offset: 80 });

  // Navbar scroll
  window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 60);
  });

  // Animated counters
  const counters = document.querySelectorAll('.counter');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = +el.dataset.target;
      let count = 0;
      const step = Math.ceil(target / 60);
      const timer = setInterval(() => {
        count = Math.min(count + step, target);
        el.textContent = count;
        if (count >= target) clearInterval(timer);
      }, 25);
      observer.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(c => observer.observe(c));
</script>