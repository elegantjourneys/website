<?php
/**
 * CakePHP Element: section-tour-summary-day-view-static.php
 * Static HTML only — no PHP variables
 * Bootstrap 5 + Bootstrap Icons required in parent layout
 * All custom classes prefixed .ej- to avoid BS5 conflicts
 */
?>

<style>
  /* ── Root palette ─────────────────────────────────────────── */
  :root {
    --ej-navy:       #1e2d5a;
    --ej-teal:       #10436a;
    --ej-green:      #1a9e6e;
    --ej-green-lt:   #e8f7f2;
    --ej-green-dark: #137a54;
    --ej-text:       #2b2b2b;
    --ej-muted:      #666666;
    --ej-light:      #f7f8f9;
    --ej-light2:     #eef1f4;
    --ej-border:     #e0e4e8;
    --ej-white:      #ffffff;
	--ej-black:      #000000;
  }

  /* ── Section heading — standalone above accordion ───────────
     Matches live site exactly:
     Bold navy text, left-aligned, green bottom border line,
     sits outside/above the accordion box                       */
  .ej-itinerary-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 22px;
    font-weight: 700;
    color: var(--ej-navy);
    margin: 0 0 20px 0;
    padding: 7px 0 12px 10px;
    border-bottom: 1px solid var(--ej-border);
    line-height: 1.2;
    width: 100%;
    box-sizing: border-box;
	border-top: 1px solid var(--ej-border);
	background-color:#eef1f4;
  }
  .ej-itinerary-heading .ej-heading-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: #000000;
    border-radius: 8px;
    flex-shrink: 0;
  }
  .ej-itinerary-heading .ej-heading-icon i {
    color: var(--ej-green);
    font-size: 17px;
  }
  .ej-itinerary-heading .ej-heading-sub {
    display: block;
    font-size: 12px;
    font-weight: 400;
    color: var(--ej-muted);
    margin-top: 2px;
    letter-spacing: 0.02em;
  }

  /* ── Accordion wrapper ──────────────────────────────────────── */
  .ej-acc {
    border: 1px solid var(--ej-border);
    border-radius: 6px;
    overflow: hidden;
    background: var(--ej-white);
    width: 100%;
    box-sizing: border-box;
  }

  /* ── Each day row ───────────────────────────────────────────── */
  .ej-acc-item {
    background: var(--ej-white);
  }
  .ej-acc-item + .ej-acc-item {
    border-top: 1px solid var(--ej-border);
  }

  /* ── Day trigger button ─────────────────────────────────────── */
  .ej-acc-btn {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 0;
    border: none;
    background: var(--ej-while);
    cursor: pointer;
    text-align: left;
    transition: background 0.13s ease;
  }
  .ej-acc-btn:hover { background: var(--ej-white); }
  .ej-acc-btn[aria-expanded="true"] { background: var(--ej-white); }

  /* ── Day badge (left colour strip) ─────────────────────────── */
  .ej-badge {
    width: 80px;
    min-height: 68px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-right: 1px solid var(--ej-border);
    padding: 12px 6px;
    transition: background 0.2s;
	background:var(--ej-light2);
  }
  .ej-acc-btn[aria-expanded="true"] .ej-badge {
    background: var(--ej-light2);
  }
  .ej-badge-lbl {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ej-muted);
    line-height: 1;
    margin-bottom: 3px;
  }
  .ej-badge-num {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    color: var(--ej-navy);
    transition: color 0.2s;
  }
  .ej-acc-btn[aria-expanded="true"] .ej-badge-num {
    color: var(--ej-black);
  }

  /* ── Title + city ───────────────────────────────────────────── */
  .ej-acc-meta {
    flex: 1;
    padding: 14px 18px;
  }
  .ej-acc-title {
    font-size: 14.5px;
    font-weight: 600;
    color: var(--ej-navy);
    margin: 0 0 4px;
    line-height: 1.3;
  }
  .ej-acc-city {
    font-size: 12px;
    color: var(--ej-muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* ── +/− toggle circle ──────────────────────────────────────── */
  .ej-tog {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1px solid var(--ej-border);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 18px;
    flex-shrink: 0;
    font-size: 20px;
    line-height: 1;
    background: var(--ej-white);
    color: var(--ej-teal);
    transition: background 0.2s, border-color 0.2s, color 0.2s;
    user-select: none;
  }
  .ej-acc-btn[aria-expanded="true"] .ej-tog {
    background: var(--ej-while);
    border-color: var(--ej-border);
    color: var(--ej-black);
  }

  /* ── Collapsible body ───────────────────────────────────────── */
  .ej-acc-body {
    border-top: 1px solid var(--ej-border);
    background: var(--ej-white);
    padding: 20px 22px 24px;
    font-size: 13.5px;
    line-height: 1.85;
    color: var(--ej-text);
  }
  .ej-acc-body p { margin-bottom: 10px; }
  .ej-acc-body p:last-child { margin-bottom: 0; }

  /* ── Info / note box ────────────────────────────────────────── */
  .ej-note {
    display: flex;
    gap: 10px;
    background: var(--ej-green-lt);
    border-left: 3px solid var(--ej-green);
    border-radius: 6px;
    padding: 11px 15px;
    font-size: 13px;
    color: var(--ej-muted);
    line-height: 1.7;
    margin: 14px 0;
  }
  .ej-note i { color: var(--ej-green); font-size: 15px; flex-shrink: 0; margin-top: 3px; }

  /* ── "Experiences included" sub-header ─────────────────────── */
  .ej-inc-hd {
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: var(--ej-navy);
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 18px 0 10px;
  }
  .ej-inc-hd::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--ej-border);
  }

  /* ── Tag pills ──────────────────────────────────────────────── */
  .ej-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
  }
  .ej-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 4px;
    background: var(--ej-light);
    border: 1px solid var(--ej-border);
    color: var(--ej-teal);
    line-height: 1;
  }
  .ej-tag i { color: var(--ej-green); font-size: 12px; }

  /* ── Mobile (≤576px) ────────────────────────────────────────── */
  @media (max-width: 576px) {
    .ej-itinerary-heading        { font-size: 18px; margin-bottom: 14px; }
    .ej-itinerary-heading .ej-heading-icon { width: 30px; height: 30px; }
    .ej-badge      { width: 58px; min-height: 58px; padding: 8px 4px; }
    .ej-badge-num  { font-size: 20px; }
    .ej-badge-lbl  { font-size: 8px; }
    .ej-acc-meta   { padding: 10px 12px; }
    .ej-acc-title  { font-size: 13px; }
    .ej-acc-city   { font-size: 11px; }
    .ej-tog        { margin-right: 10px; width: 24px; height: 24px; font-size: 17px; }
    .ej-acc-body   { padding: 14px 14px 18px; font-size: 13px; }
    .ej-tag        { font-size: 11px; padding: 4px 9px; }
  }

  /* ── Tablet (577px–768px) ───────────────────────────────────── */
  @media (min-width: 577px) and (max-width: 768px) {
    .ej-badge      { width: 70px; }
    .ej-badge-num  { font-size: 22px; }
    .ej-acc-meta   { padding: 12px 14px; }
    .ej-acc-title  { font-size: 14px; }
  }
</style>


<!-- ╔══════════════════════════════════════════════════════════╗
     ║   7-DAY GOLDEN TRIANGLE TOUR — DAY-VIEW ITINERARY       ║
     ║   Static HTML element (no PHP variables)                 ║
     ╚══════════════════════════════════════════════════════════╝ -->

<!-- ── Section heading — outside & above the accordion box ── -->
<h3 class="ej-itinerary-heading">
  <span class="ej-heading-icon">
    <!-- Route / itinerary SVG icon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="6"  cy="19" r="2"/>
      <circle cx="18" cy="5"  r="2"/>
      <path d="M6 17V9a6 6 0 0 1 6-6h1"/>
      <path d="M18 7v8a6 6 0 0 1-6 6H11"/>
    </svg>
  </span>
  <span>
    Itinerary
    <span class="ej-heading-sub">7 Days · Delhi · Agra · Jaipur</span>
  </span>
</h3>


<!-- ── Accordion box ─────────────────────────────────────── -->
<div class="ej-acc" id="ejDayAcc">


  <!-- ═══════════════════ DAY 1 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD1"
            aria-expanded="true" aria-controls="ejD1">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">1</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Arrival in Delhi</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Delhi</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD1" class="collapse show">
      <div class="ej-acc-body">
        <p>Welcome to Delhi International Airport! Upon arrival, our team will warmly receive you and transfer you to your pre-booked luxury hotel in a private chauffeur-driven vehicle.</p>
        <p>New Delhi — India's grand capital — has been continuously inhabited since the 6th century BCE and was redesigned in the 1920s by Sir Edwin Lutyens and Herbert Baker into the magnificent metropolis it is today, blending Mughal grandeur with imperial British architecture.</p>
        <div class="ej-note">
          <i class="bi bi-info-circle-fill"></i>
          <span>Standard hotel check-in time is 2 pm. As most international flights arrive in the evening or night, no sightseeing is planned today. If your flight arrives early and you don't need time to recover from travel, we can arrange sightseeing at an additional charge.</span>
        </div>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 2 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD2"
            aria-expanded="true" aria-controls="ejD2">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">2</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Old Delhi &amp; New Delhi Sightseeing</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Delhi</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD2" class="collapse show">
      <div class="ej-acc-body">
        <p>Start your exploration of India with Old Delhi — known for its hustle and bustle, energy and colour, local shops and bazaars, and the twists and turns of narrow lanes between soaring buildings. A <strong>rickshaw ride through Chandni Chowk</strong> offers a truly unique experience, along with a tasting of local delicacies for an authentic flavour of Old Delhi's rich culinary heritage.</p>
        <p>Visit the magnificent <strong>Jama Masjid</strong> — India's largest mosque — and drive past the iconic <strong>Red Fort</strong>. Continue to <strong>Raj Ghat</strong>, the memorial of Mahatma Gandhi, a serene space in striking contrast to the lively old city.</p>
        <p>Also visit the golden-domed <strong>Gurudwara Bangla Sahib</strong> — a famous Sikh temple with a community kitchen (langar) feeding thousands every day. Explore <strong>Humayun's Tomb</strong> (UNESCO World Heritage Site, 1570 — India's first garden-tomb). End the day zipping around <strong>Connaught Place</strong> and admiring India Gate and Rashtrapati Bhavan.</p>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-ticket-perforated-fill"></i>All monument entrance fees</span>
          <span class="ej-tag"><i class="bi bi-camera-fill"></i>Still camera charges (non-professional)</span>
          <span class="ej-tag"><i class="bi bi-bicycle"></i>Rickshaw ride experience in Old Delhi</span>
          <span class="ej-tag"><i class="bi bi-cup-hot-fill"></i>Local delicacy tasting in Chandni Chowk</span>
          <span class="ej-tag"><i class="bi bi-shield-fill"></i>Robe/wrap rental &amp; shoe-keeping at Jama Masjid</span>
          <span class="ej-tag"><i class="bi bi-person-badge-fill"></i>Dedicated English-speaking expert guide</span>
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 3 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD3"
            aria-expanded="true" aria-controls="ejD3">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">3</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Drive to Agra · Taj Mahal Visit</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Delhi → Agra</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD3" class="collapse show">
      <div class="ej-acc-body">
        <p>Drive to the city of love — <strong>Agra</strong> — by private chauffeur. The 16th–17th century Mughal capital is home to three UNESCO World Heritage Sites: the Taj Mahal, Agra Fort, and the ancient city of Fatehpur Sikri.</p>
        <p>In the afternoon, visit the iconic <strong>Taj Mahal</strong>, reached by a short decorated horse-drawn carriage ride or battery-operated van. Built by Emperor Shah Jahan in memory of his beloved queen Mumtaz Mahal, this magnificent 17th-century white marble mausoleum — one of the Seven Wonders of the World — is set amid expansive Mughal gardens, grand audience halls, and elegant private chambers.</p>
        <p>A <strong>professional photograph of you at the Taj Mahal</strong>, beautifully framed, is gifted to you as a souvenir.</p>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-ticket-perforated-fill"></i>All monument entrance fees</span>
          <span class="ej-tag"><i class="bi bi-camera-fill"></i>Still camera charges (non-professional)</span>
          <span class="ej-tag"><i class="bi bi-emoji-heart-eyes-fill"></i>Decorated horse carriage / battery van to Taj Mahal</span>
          <span class="ej-tag"><i class="bi bi-image-fill"></i>Framed professional souvenir photograph at Taj Mahal</span>
          <span class="ej-tag"><i class="bi bi-person-badge-fill"></i>Dedicated English-speaking expert guide</span>
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 4 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD4"
            aria-expanded="true" aria-controls="ejD4">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">4</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Agra Fort, Baby Taj &amp; Mehtab Bagh Sunset</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Agra</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD4" class="collapse show">
      <div class="ej-acc-body">
        <p>Begin your guided Agra day at the <strong>Agra Fort (Lal Qila)</strong> — a majestic red sandstone fortress built by Emperor Akbar and a UNESCO World Heritage Site. Renowned for its architectural brilliance, the fort houses remarkable structures including Macchi Bhawan, Shah Jahani Mahal, Khas Mahal, Mina Masjid, Nagina Masjid, and the Diwan-i-Am (Hall of Public Audience).</p>
        <p>Next, visit <strong>Itmad-ud-Daulah</strong> — the "Baby Taj" — a jewel-like Mughal mausoleum famed for its intricate pietra dura inlay work and delicate marble lattice screens, set amidst tranquil gardens and graceful outbuildings.</p>
        <p>End the day at <strong>Mehtab Bagh</strong> — a serene Mughal garden set across the Yamuna River — for a breathtaking sunset view of the Taj Mahal, followed by a short walking tour of <strong>Katchpura Village</strong> for an authentic glimpse into local life and traditions.</p>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-ticket-perforated-fill"></i>All monument entrance fees</span>
          <span class="ej-tag"><i class="bi bi-camera-fill"></i>Still camera charges (non-professional)</span>
          <span class="ej-tag"><i class="bi bi-signpost-split-fill"></i>Heritage walk through Katchpura Village</span>
          <span class="ej-tag"><i class="bi bi-person-badge-fill"></i>Dedicated English-speaking expert guide</span>
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 5 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD5"
            aria-expanded="true" aria-controls="ejD5">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">5</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Fatehpur Sikri · Drive to Jaipur</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Agra → Jaipur</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD5" class="collapse show">
      <div class="ej-acc-body">
        <p>Visit the hauntingly beautiful ghost city of <strong>Fatehpur Sikri</strong> — a UNESCO World Heritage Site renowned for its extraordinary Mughal architecture. Explore highlights including <strong>Jama Masjid</strong>, the towering <strong>Buland Darwaza</strong>, the <strong>Tomb of Salim Chishti</strong>, Ibadat Khana, Mariam-uz-Zamani's Palace, Naubat Khana, Birbal's House, and the layered <strong>Panch Mahal</strong>.</p>
        <p>Afterwards, drive onwards to <strong>Jaipur</strong> — Rajasthan's renowned walled capital, also known as the <em>Pink City</em>. This nickname originates from the city being painted pink in 1876 as a symbol of the locals' warm welcome to Queen Victoria and the Prince of Wales — a colour that endures as a proud symbol of Rajasthani hospitality.</p>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-ticket-perforated-fill"></i>All monument entrance fees</span>
          <span class="ej-tag"><i class="bi bi-camera-fill"></i>Still camera charges (non-professional)</span>
          <span class="ej-tag"><i class="bi bi-lightning-charge-fill"></i>Battery-operated vehicle for last-mile monument access</span>
          <span class="ej-tag"><i class="bi bi-person-badge-fill"></i>Dedicated English-speaking expert guide</span>
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 6 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD6"
            aria-expanded="true" aria-controls="ejD6">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">6</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Jaipur — Forts, Palaces &amp; Bazaars</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Jaipur</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD6" class="collapse show">
      <div class="ej-acc-body">
        <p>Spend the day exploring Jaipur's impressive forts, majestic palaces, and vibrant local bazaars. The day begins with an <strong>elephant or jeep ride to Amber Fort</strong> — arrive early to beat the crowds. Admire the Hall of Public Audience and the dazzling Palace of Mirrors.</p>
        <p>From here, head to the <strong>City Palace</strong> and appreciate its magnificent gardens and striking courtyards, which offer a brilliant contrast to the palatial structures: Shri Govind Dev temple, Badal Mahal, Chandra Mahal, and Mubarak Mahal. Also visit the Diwan-e-Khas and marvel at the giant silver water vessels.</p>
        <p>Next is <strong>Jantar Mantar</strong> — the UNESCO astronomical observatory — comprising impressive geometric structures, each with a unique astronomical measurement function. Visit the striking <strong>Hawa Mahal</strong> (Palace of Winds) with over 900 windows. End the day shopping in the colourful bazaars of Jaipur.</p>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-ticket-perforated-fill"></i>All monument entrance fees</span>
          <span class="ej-tag"><i class="bi bi-camera-fill"></i>Still camera charges (non-professional)</span>
          <span class="ej-tag"><i class="bi bi-star-fill"></i>Royal-style elephant or jeep ride at Amber Fort</span>
          <span class="ej-tag"><i class="bi bi-person-badge-fill"></i>Dedicated English-speaking expert guide</span>
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


  <!-- ═══════════════════ DAY 7 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#ejD7"
            aria-expanded="true" aria-controls="ejD7">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num">7</span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title">Jaipur to Delhi — Departure</div>
        <div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Jaipur → Delhi</div>
      </div>
      <div class="ej-tog"><span class="ej-ti">&#8722;</span></div>
    </button>
    <div id="ejD7" class="collapse show">
      <div class="ej-acc-body">
        <p>After a wonderful journey through the heart of Mughal and Rajputana India, we drive you back to Delhi by private chauffeur for your onward flight. End of tour services.</p>
        <div class="ej-note">
          <i class="bi bi-lightbulb-fill"></i>
          <span><strong>Note:</strong> We can customise this tour to extend to other destinations — Varanasi, Udaipur, Ranthambore, and more — as per your preference. Contact us to tailor your perfect itinerary.</span>
        </div>
        <div class="ej-inc-hd">Experiences &amp; Services Included</div>
        <div class="ej-tags">
          <span class="ej-tag"><i class="bi bi-car-front-fill"></i>Private chauffeur-driven vehicle</span>
        </div>
      </div>
    </div>
  </div>


</div><!-- /.ej-acc -->


<script>
/* Sync +/− icons via Bootstrap collapse events */
(function () {
  var wrap = document.getElementById('ejDayAcc');
  if (!wrap) return;

  wrap.addEventListener('show.bs.collapse', function (e) {
    var btn = wrap.querySelector('[data-bs-target="#' + e.target.id + '"]');
    if (btn) btn.querySelector('.ej-ti').innerHTML = '&#8722;';
  });
  wrap.addEventListener('hide.bs.collapse', function (e) {
    var btn = wrap.querySelector('[data-bs-target="#' + e.target.id + '"]');
    if (btn) btn.querySelector('.ej-ti').innerHTML = '&#43;';
  });
}());
</script>











