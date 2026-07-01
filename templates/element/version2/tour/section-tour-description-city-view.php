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

  /* ── +/− toggle wrapper (circle + label) ───────────────────── */
  .ej-tog-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    margin-right: 18px;
    flex-shrink: 0;
    user-select: none;
  }
  .ej-tog-lbl {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ej-muted);
    line-height: 1;
    transition: color 0.2s;
  }
  .ej-acc-btn[aria-expanded="true"] .ej-tog-lbl {
    color: var(--ej-teal);
  }
  .ej-tog {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1px solid var(--ej-border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
    line-height: 1;
    background: var(--ej-white);
    color: var(--ej-teal);
    transition: background 0.2s, border-color 0.2s, color 0.2s;
  }
  .ej-acc-btn[aria-expanded="true"] .ej-tog {
    background: var(--ej-white);
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
    background: var(--ej-light2);
    border-left: 3px solid var(--ej-black);
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

  /* ── Inclusion rows (each on its own line) ──────────────────── */
  .ej-tags {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .ej-tag {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 13px;
    padding: 9px 12px;
    background: var(--ej-light2);
    border-left: 3px solid var(--ej-black);
    border-radius: 5px;
    color: var(--ej-text);
    line-height: 1.3;
  }
  .ej-tag-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: var(--ej-while);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
	border: 1px solid var(--ej-black);
  }
  .ej-tag-icon i { color: var(--ej-white); font-size: 13px; }
  .ej-tag-check {
    margin-left: auto;
    flex-shrink: 0;
    color: var(--ej-black);
    font-size: 15px;
    font-weight: 700;
    line-height: 1;
  }

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
    .ej-tog-wrap   { margin-right: 10px; gap: 3px; }
    .ej-tog        { width: 24px; height: 24px; font-size: 17px; }
    .ej-tog-lbl    { font-size: 8px; }
    .ej-acc-body   { padding: 14px 14px 18px; font-size: 13px; }
    .ej-tag        { font-size: 12px; padding: 8px 12px; gap: 10px; }
    .ej-tag-icon   { width: 26px; height: 26px; }
    .ej-tag-icon i { font-size: 11px; }
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
    <!--<span class="ej-heading-sub">7 Days · Delhi · Agra · Jaipur</span>-->
  </span>
</h3>


<!-- ── Accordion box ─────────────────────────────────────── -->
<div class="ej-acc" id="ejDayAcc">

<?php
	$dayCounter = 1;
	foreach($data['tour_summary']['itinerary_plans'] as $itineraryPlans )
	{
		$dayTitle = $itineraryPlans['start_day'].'-'.$itineraryPlans['end_day'];
		
		if($itineraryPlans['start_day']==$itineraryPlans['end_day'])
		{
			$dayTitle = $itineraryPlans['start_day'];
		}
		
		if($dayCounter==1)
		{
			$areaExpanded = true;
			$expansion = 'show';
		}
		else
		{
			$areaExpanded = false;
			$expansion = '';
		}
		
?>
  <!-- ═══════════════════ DAY 1 ═══════════════════ -->
  <div class="ej-acc-item">
    <button class="ej-acc-btn" type="button"
            data-bs-toggle="collapse" data-bs-target="#eljD<?=$dayCounter?>"
            aria-expanded="<?=$areaExpanded?>" aria-controls="eljD<?=$dayCounter?>">
      <div class="ej-badge">
        <span class="ej-badge-lbl">Day</span>
        <span class="ej-badge-num"><?=$dayTitle?></span>
      </div>
      <div class="ej-acc-meta">
        <div class="ej-acc-title"><?=$itineraryPlans['city_name']?></div>
        <!--<div class="ej-acc-city"><i class="bi bi-geo-alt-fill"></i>Delhi</div>-->
      </div>
     <?php
		if($dayCounter==1)
		{
	  ?>
      <div class="ej-tog-wrap"><span class="ej-tog-lbl">Close</span><div class="ej-tog"><span class="ej-ti">&#8722;</span></div></div>
	  <?PHP
		}
		else
		{
	   ?>
	 <div class="ej-tog-wrap"><span class="ej-tog-lbl">Open</span><div class="ej-tog"><span class="ej-ti">&#43;</span></div></div>
	 <?PHP
		}
	 ?>
    </button>
    <div id="eljD<?=$dayCounter?>" class="collapse <?=$expansion?>">
      <div class="ej-acc-body">
        <?php
				echo $itineraryPlans['description'];
		?>
        
      </div>
    </div>
  </div>
   <?php
		$dayCounter++;
	}
  ?>

 

</div><!-- /.ej-acc -->


<script>
/* Sync +/− icons and Open/Close labels via Bootstrap collapse events */
(function () {
  var wrap = document.getElementById('ejDayAcc');
  if (!wrap) return;

  wrap.addEventListener('show.bs.collapse', function (e) {
    var btn = wrap.querySelector('[data-bs-target="#' + e.target.id + '"]');
    if (btn) {
      btn.querySelector('.ej-ti').innerHTML = '&#8722;';
      btn.querySelector('.ej-tog-lbl').textContent = 'Close';
    }
  });
  wrap.addEventListener('hide.bs.collapse', function (e) {
    var btn = wrap.querySelector('[data-bs-target="#' + e.target.id + '"]');
    if (btn) {
      btn.querySelector('.ej-ti').innerHTML = '&#43;';
      btn.querySelector('.ej-tog-lbl').textContent = 'Open';
    }
  });
}());
</script>