<?php
/**
 * FILE:    src/Template/Reviews/tripadvisor_detail.php
 * ROUTE:   /tripadvisor-review/:page_url
 * EXAMPLE: /tripadvisor-review/elizabeth-r-alexandria-va
 *
 * Controller passes via $this->set():
 *   $review        – single review array (id, name, location, title, body, date, rating …)
 *   $prevReview    – ['slug'=>…, 'title'=>…]  or null
 *   $nextReview    – ['slug'=>…, 'title'=>…]  or null
 *   $moreReviews   – array of up to 3 other reviews
 *   $totalReviews  – int  (total count for sidebar)
 *   $data          – full data array (meta_tags, schema, breadcrumbs)
 */

// ── Output meta tags & schema (same pattern as other pages) ──────────────────
if (!empty($data['meta_tags'])) {
    echo $data['meta_tags'];
}
if (!empty($data['schema'])) {
    foreach ($data['schema'] as $schema) {
        echo $schema;
    }
}

$initial   = strtoupper(substr($review['name'], 0, 1));
$fullStars = (int)($review['rating'] ?? 5);
$totalReviews = $totalReviews ?? 0;
?>

<style>
/* ── TripAdvisor green bubbles ── */
.ta-bubbles        { display:flex; gap:3px; }
.ta-bubbles span   { width:15px; height:15px; border-radius:50%; background:#00A680; display:inline-block; }
.ta-bubbles span.e { background:#dcdcdc; }

/* ── Page heading (inside heroSection) ── */
.ta-page-heading {
    font-size:1.6rem; font-weight:800; color:#1a3a2a;
    line-height:1.3; margin:10px 0 8px;
}
.ta-page-subheading {
    display:flex; align-items:center; flex-wrap:wrap;
    font-size:.85rem; color:#666; margin-bottom:0; gap:4px;
}

/* Back link */
.ta-back-link {
    display:inline-flex; align-items:center; gap:6px;
    font-size:.82rem; font-weight:600; color:#00A680;
    text-decoration:none; margin-bottom:18px;
}
.ta-back-link:hover { text-decoration:underline; }

/* Reviewer header card */
.ta-reviewer-card {
    background:#fff;
    border:1px solid #e4e4e4;
    border-radius:10px;
    padding:22px 24px 18px;
    margin-bottom:16px;
    display:flex;
    align-items:flex-start;
    gap:16px;
}
.ta-avatar {
    width:52px; height:52px; border-radius:50%; flex-shrink:0;
    background:linear-gradient(135deg,#00A680,#005f4a);
    display:flex; align-items:center; justify-content:center;
    font-weight:800; font-size:1.25rem; color:#fff;
}
.ta-reviewer-name  { font-weight:800; font-size:.95rem; color:#111; margin-bottom:2px; }
.ta-reviewer-meta  { font-size:.76rem; color:#999; }
.ta-trip-badge {
    display:inline-flex; align-items:center; gap:3px;
    font-size:.68rem; color:#555; background:#f2f2f2;
    border-radius:20px; padding:2px 8px; margin-left:6px;
}
.ta-rating-date-row { display:flex; align-items:center; gap:10px; margin-top:10px; }
.ta-date-lbl        { font-size:.76rem; color:#aaa; }

/* Review body */
.ta-body-card {
    background:#fff;
    border:1px solid #e4e4e4; border-radius:10px;
    padding:22px 24px; margin-bottom:16px;
}
.ta-body-card p { font-size:.9rem; color:#444; line-height:1.85; margin-bottom:14px; }
.ta-body-card p:last-child { margin-bottom:0; }

/* Photo grid */
.ta-photo-card {
    background:#fff;
    border:1px solid #e4e4e4; border-radius:10px;
    padding:18px 20px; margin-bottom:16px;
}
.ta-photo-card h6 { font-size:.8rem; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:.5px; margin-bottom:12px; }
.ta-photo-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(120px,1fr));
    gap:8px;
}
.ta-photo-grid img {
    width:100%; height:95px; object-fit:cover; border-radius:7px;
    cursor:pointer; border:1px solid #eee;
    transition:transform .2s, box-shadow .2s;
}
.ta-photo-grid img:hover { transform:scale(1.05); box-shadow:0 4px 12px rgba(0,0,0,.14); }

/* Actions */
.ta-actions-card {
    background:#fff;
    border:1px solid #e4e4e4; border-radius:10px;
    padding:16px 20px; margin-bottom:16px;
    display:flex; align-items:center; gap:10px; flex-wrap:wrap;
}
.ta-action-lbl { font-size:.76rem; color:#aaa; }
.ta-action-btn {
    display:inline-flex; align-items:center; gap:4px;
    font-size:.76rem; color:#555; font-family:inherit;
    background:#f5f5f5; border:1px solid #e0e0e0;
    border-radius:20px; padding:5px 13px; cursor:pointer;
    transition:background .15s;
}
.ta-action-btn:hover  { background:#e8e8e8; }
.ta-action-btn.marked { color:#00A680; border-color:#00A680; background:#edf9f5; }

/* Management response */
.ta-response-card {
    background:#f4faf7; border:1px solid #c8e6d4;
    border-radius:10px; padding:18px 22px; margin-bottom:16px;
}
.ta-response-hdr { display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.ta-resp-avatar {
    width:36px; height:36px; border-radius:50%; background:#1a3a2a; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:.68rem; font-weight:700;
}
.ta-resp-name { font-weight:700; font-size:.84rem; color:#1a3a2a; }
.ta-resp-date { font-size:.72rem; color:#999; }
.ta-resp-body { font-size:.85rem; color:#444; line-height:1.7; }

/* Prev / Next */
.ta-nav-row { display:flex; gap:10px; margin-bottom:20px; }
.ta-nav-btn {
    flex:1; display:flex; align-items:center; gap:8px;
    font-size:.8rem; font-weight:600; color:#00A680;
    text-decoration:none; padding:12px 14px;
    border:1.5px solid #d4ede5; border-radius:10px; background:#fff;
    transition:background .15s, border-color .15s; overflow:hidden;
}
.ta-nav-btn:hover          { background:#edf9f5; border-color:#00A680; color:#00A680; }
.ta-nav-btn.disabled       { color:#ccc; border-color:#eee; pointer-events:none; background:#fafafa; }
.ta-nav-btn.prev           { justify-content:flex-start; }
.ta-nav-btn.next           { justify-content:flex-end; text-align:right; }
.ta-nav-arrow              { font-size:1.1rem; flex-shrink:0; }
.ta-nav-inner span.lbl     { display:block; font-size:.68rem; color:#aaa; font-weight:400; }
.ta-nav-inner span.ttl     { display:block; font-size:.8rem; font-weight:700;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:180px; }

/* More reviews */
.ta-more-heading   { font-weight:700; font-size:1rem; color:#111; margin-bottom:12px; }
.ta-more-grid      { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.ta-mini-card {
    background:#fff; border:1px solid #e4e4e4; border-radius:10px;
    padding:15px; text-decoration:none; color:inherit; display:block;
    transition:box-shadow .2s, transform .15s;
}
.ta-mini-card:hover   { box-shadow:0 4px 14px rgba(0,0,0,.08); transform:translateY(-2px); color:inherit; }
.ta-mini-reviewer     { font-weight:700; font-size:.8rem; color:#111; margin-bottom:3px; }
.ta-mini-bubbles      { display:flex; gap:2px; margin-bottom:5px; }
.ta-mini-bubbles span { width:10px; height:10px; border-radius:50%; background:#00A680; display:inline-block; }
.ta-mini-bubbles span.e { background:#dcdcdc; }
.ta-mini-title   { font-size:.8rem; font-weight:600; color:#333; margin-bottom:3px; }
.ta-mini-snippet {
    font-size:.75rem; color:#888; line-height:1.5;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.ta-view-all {
    display:flex; align-items:center; justify-content:center;
    text-align:center; color:#00A680; font-weight:700; font-size:.85rem; min-height:80px;
}

/* ── Right sidebar ── */
.ta-sidebar-card {
    background:#fff; border:1px solid #e4e4e4; border-radius:10px;
    padding:20px; margin-bottom:16px;
    position:sticky; top:20px;
}
.ta-sidebar-logo   { max-height:36px; display:block; margin:0 auto 12px; }
.ta-sidebar-score  { font-size:2rem; font-weight:900; color:#111; text-align:center; line-height:1; }
.ta-sidebar-label  { text-align:center; font-size:.82rem; color:#555; }
.ta-sidebar-based  { text-align:center; font-size:.73rem; color:#999; margin-bottom:14px; }
.ta-sdivider       { border:none; border-top:1px solid #ebebeb; margin:14px 0; }
.ta-srating-title  { font-weight:700; font-size:.82rem; color:#111; margin-bottom:10px; }
.ta-srating-row    { display:flex; align-items:center; margin-bottom:7px; font-size:.76rem; gap:6px; }
.ta-srating-lbl    { width:66px; color:#555; flex-shrink:0; }
.ta-srating-bar    { flex:1; height:6px; background:#ebebeb; border-radius:3px; overflow:hidden; }
.ta-srating-fill   { height:100%; background:#00A680; border-radius:3px; }
.ta-srating-cnt    { width:20px; text-align:right; color:#999; font-size:.72rem; flex-shrink:0; }
.ta-enquire-btn {
    display:block; width:100%; margin-top:14px;
    padding:10px; background:#c8a96e; color:#fff;
    border:none; border-radius:6px; font-size:.88rem;
    font-weight:700; text-align:center; text-decoration:none;
    cursor:pointer; transition:background .2s; letter-spacing:.3px;
}
.ta-enquire-btn:hover { background:#b5904f; color:#fff; }
.ta-write-btn {
    display:block; width:100%; margin-top:8px;
    padding:9px; background:#fff; color:#00A680;
    border:1.5px solid #00A680; border-radius:6px; font-size:.82rem;
    font-weight:700; text-align:center; text-decoration:none;
    cursor:pointer; transition:background .2s, color .2s;
}
.ta-write-btn:hover { background:#00A680; color:#fff; }
.ta-review-num-pill {
    display:flex; align-items:center; justify-content:center;
    gap:6px; background:#f7f7f7; border-radius:8px;
    padding:8px 12px; margin-bottom:14px; font-size:.8rem; color:#555;
}
.ta-review-num-pill strong { color:#111; }

/* ── Lightbox ── */
#ta-lb { display:none; position:fixed; inset:0; background:rgba(0,0,0,.88); z-index:9999; align-items:center; justify-content:center; }
#ta-lb.open { display:flex; }
#ta-lb img  { max-width:90vw; max-height:85vh; border-radius:8px; box-shadow:0 8px 32px rgba(0,0,0,.4); }
#ta-lb-x    { position:absolute; top:16px; right:22px; color:#fff; font-size:2rem; cursor:pointer; background:none; border:none; line-height:1; }

/* ── Responsive ── */
@media (max-width:767px) {
    .ta-reviewer-card { flex-wrap:wrap; }
    .ta-more-grid     { grid-template-columns:1fr; }
    .ta-nav-row       { flex-direction:column; }
    .ta-sidebar-card  { position:static; }
}
</style>

<!-- Lightbox -->
<div id="ta-lb">
    <button id="ta-lb-x" onclick="taLbClose()">&times;</button>
    <img id="ta-lb-img" src="" alt="Review photo">
</div>

<!-- ── Breadcrumb + page heading ── -->
<section class="heroSection w-100 px-0 py-4">
    <div class="container">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
        <h1 class="ta-page-heading"><?= h($review['title']) ?></h1>
        <p class="ta-page-subheading">
            <span class="ta-bubbles d-inline-flex me-2">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span<?= $i > $fullStars ? ' class="e"' : '' ?>></span>
                <?php endfor; ?>
            </span>
            <?= h($review['name']) ?>
            <?php if (!empty($review['location'])): ?>
                &middot; <?= h($review['location']) ?>
            <?php endif; ?>
            <?php if (!empty($review['date'])): ?>
                &middot; <?= h($review['date']) ?>
            <?php endif; ?>
        </p>
    </div>
</section>

<!-- ── Main two-column layout ── -->
<section class="w-100 py-4">
    <div class="container">
        <div class="row g-4">

            <!-- ═══════════ LEFT COLUMN – review content ═══════════ -->
            <div class="col-lg-8 col-md-8">

                <!-- Back link -->
                <a href="<?= WEBROOT ?>tripadvisor-review" class="ta-back-link">
                    &larr; All TripAdvisor Reviews
                </a>

                <!-- Reviewer header -->
                <div class="ta-reviewer-card">
                    <div class="ta-avatar"><?= h($initial) ?></div>
                    <div style="flex:1; min-width:0;">
                        <div class="ta-reviewer-name">
                            <?= h($review['name']) ?>
                            <?php if (!empty($review['trip_type'])): ?>
                            <span class="ta-trip-badge">
                                <?= h($review['trip_icon'] ?? '') ?>&nbsp;<?= h($review['trip_type']) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($review['location'])): ?>
                        <div class="ta-reviewer-meta"><?= h($review['location']) ?></div>
                        <?php endif; ?>
                        <div class="ta-rating-date-row">
                            <div class="ta-bubbles">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span<?= $i > $fullStars ? ' class="e"' : '' ?>></span>
                                <?php endfor; ?>
                            </div>
                            <?php if (!empty($review['date'])): ?>
                            <span class="ta-date-lbl">Written: <?= h($review['date']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Review body -->
                <div class="ta-body-card">
                    <?= $review['body'] /* HTML from DB – sanitised on save */ ?>
                </div>

                <!-- Photos (if any stored) -->
                <?php if (!empty($review['photos'])): ?>
                <div class="ta-photo-card">
                    <h6>Photos from this review</h6>
                    <div class="ta-photo-grid">
                        <?php foreach ($review['photos'] as $photo): ?>
                            <img src="<?= h($photo) ?>"
                                 alt="Review photo by <?= h($review['name']) ?>"
                                 loading="lazy"
                                 onclick="taLbOpen('<?= h($photo) ?>')">
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Helpful / Share -->
                <div class="ta-actions-card">
                    <span class="ta-action-lbl">Helpful?</span>
                    <button class="ta-action-btn" onclick="taHelpful(this)">👍 Yes</button>
                    <button class="ta-action-btn" onclick="this.textContent='👎 Noted'; this.disabled=true;">👎 No</button>
                    <span class="ta-action-lbl" style="margin-left:6px;">Share:</span>
                    <button class="ta-action-btn" onclick="taCopy()">🔗 Copy link</button>
                    <?php if (!empty($review['tripadvisor_link'])): ?>
                    <a href="<?= h($review['tripadvisor_link']) ?>" target="_blank" rel="noopener" class="ta-action-btn">
                        🌐 View on TripAdvisor
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Management response -->
                <div class="ta-response-card">
                    <div class="ta-response-hdr">
                        <div class="ta-resp-avatar">EJ</div>
                        <div>
                            <div class="ta-resp-name">Elegant Journeys &mdash; Management Response</div>
                            <?php if (!empty($review['date'])): ?>
                            <div class="ta-resp-date">Responded <?= h($review['date']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ta-resp-body">
                        Thank you so much for this wonderful review! We are delighted your journey with us
                        was so memorable. It was our absolute pleasure to host you, and we look forward to
                        planning your next adventure in India. Warm regards from the entire Elegant Journeys team.
                    </div>
                </div>

                <!-- Prev / Next navigation -->
                <div class="ta-nav-row">
                    <?php if (!empty($prevReview)): ?>
                        <a href="<?= WEBROOT ?>tripadvisor-review/<?= h($prevReview['slug']) ?>" class="ta-nav-btn prev">
                            <span class="ta-nav-arrow">&larr;</span>
                            <span class="ta-nav-inner">
                                <span class="lbl">Previous</span>
                                <span class="ttl"><?= h($prevReview['title']) ?></span>
                            </span>
                        </a>
                    <?php else: ?>
                        <span class="ta-nav-btn prev disabled">
                            <span class="ta-nav-arrow">&larr;</span>
                            <span class="ta-nav-inner">
                                <span class="lbl">Previous</span>
                                <span class="ttl">No earlier review</span>
                            </span>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($nextReview)): ?>
                        <a href="<?= WEBROOT ?>tripadvisor-review/<?= h($nextReview['slug']) ?>" class="ta-nav-btn next">
                            <span class="ta-nav-inner">
                                <span class="lbl">Next</span>
                                <span class="ttl"><?= h($nextReview['title']) ?></span>
                            </span>
                            <span class="ta-nav-arrow">&rarr;</span>
                        </a>
                    <?php else: ?>
                        <span class="ta-nav-btn next disabled">
                            <span class="ta-nav-inner">
                                <span class="lbl">Next</span>
                                <span class="ttl">No further review</span>
                            </span>
                            <span class="ta-nav-arrow">&rarr;</span>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- More reviews grid -->
                <?php if (!empty($moreReviews)): ?>
                <div class="ta-more-heading">More reviews</div>
                <div class="ta-more-grid mb-4">
                    <?php foreach ($moreReviews as $mr): ?>
                    <?php $mrS = (int)($mr['rating'] ?? 5); ?>
                    <a href="<?= WEBROOT ?>tripadvisor-review/<?= h($mr['slug']) ?>" class="ta-mini-card">
                        <div class="ta-mini-reviewer">
                            <?= h($mr['name']) ?>
                            <?php if (!empty($mr['location'])): ?>
                                &middot; <?= h($mr['location']) ?>
                            <?php endif; ?>
                        </div>
                        <div class="ta-mini-bubbles">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span<?= $i > $mrS ? ' class="e"' : '' ?>></span>
                            <?php endfor; ?>
                        </div>
                        <div class="ta-mini-title"><?= h($mr['title']) ?></div>
                        <div class="ta-mini-snippet"><?= h($mr['snippet']) ?></div>
                    </a>
                    <?php endforeach; ?>
                    <a href="<?= WEBROOT ?>tripadvisor-review" class="ta-mini-card ta-view-all">
                        View all <?= (int)$totalReviews ?> reviews &rarr;
                    </a>
                </div>
                <?php endif; ?>

            </div><!-- /col-lg-8 -->

            <!-- ═══════════ RIGHT SIDEBAR ═══════════ -->
            <div class="col-lg-4 col-md-4">
                <div class="ta-sidebar-card">

                    <img src="<?= WEBROOT ?>version2/assets/images/logo-trip-advisor.png"
                         alt="Tripadvisor" class="ta-sidebar-logo img-fluid">

                    <div class="ta-bubbles justify-content-center d-flex my-2">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <div class="ta-sidebar-score">5.0</div>
                    <div class="ta-sidebar-label">Exceptional</div>
                    <div class="ta-sidebar-based">Based on <?= (int)$totalReviews ?> Reviews</div>

                    <div class="ta-review-num-pill">
                        Reading review <strong>#<?= h($review['id']) ?></strong> of <strong><?= (int)$totalReviews ?></strong>
                    </div>

                    <hr class="ta-sdivider">

                    <div class="ta-srating-title">Traveller rating</div>
                    <div class="ta-srating-row">
                        <div class="ta-srating-lbl">Excellent</div>
                        <div class="ta-srating-bar"><div class="ta-srating-fill" style="width:90%"></div></div>
                        <div class="ta-srating-cnt">115</div>
                    </div>
                    <div class="ta-srating-row">
                        <div class="ta-srating-lbl">Very Good</div>
                        <div class="ta-srating-bar"><div class="ta-srating-fill" style="width:7%"></div></div>
                        <div class="ta-srating-cnt">9</div>
                    </div>
                    <div class="ta-srating-row">
                        <div class="ta-srating-lbl">Average</div>
                        <div class="ta-srating-bar"><div class="ta-srating-fill" style="width:2%"></div></div>
                        <div class="ta-srating-cnt">2</div>
                    </div>
                    <div class="ta-srating-row">
                        <div class="ta-srating-lbl">Poor</div>
                        <div class="ta-srating-bar"><div class="ta-srating-fill" style="width:1%"></div></div>
                        <div class="ta-srating-cnt">1</div>
                    </div>
                    <div class="ta-srating-row">
                        <div class="ta-srating-lbl">Terrible</div>
                        <div class="ta-srating-bar"><div class="ta-srating-fill" style="width:0%"></div></div>
                        <div class="ta-srating-cnt">0</div>
                    </div>

                    <hr class="ta-sdivider">

                    <a href="<?= WEBROOT ?>tailor-make-a-tour" class="ta-enquire-btn">Enquire Now</a>
                    <?php if (!empty($review['tripadvisor_link'])): ?>
                    <a href="<?= h($review['tripadvisor_link']) ?>" target="_blank" rel="noopener" class="ta-write-btn">
                        ✏&nbsp; Write a Review
                    </a>
                    <?php else: ?>
                    <a href="https://www.tripadvisor.com/Attraction_Review-g304551-d16713366-Elegant_Journeys-New_Delhi.html" target="_blank" rel="noopener" class="ta-write-btn">
                        ✏&nbsp; Write a Review
                    </a>
                    <?php endif; ?>

                </div>
            </div><!-- /col-lg-4 -->

        </div><!-- /row -->
    </div><!-- /container -->
</section>

<script>
function taLbOpen(src) {
    document.getElementById('ta-lb-img').src = src;
    document.getElementById('ta-lb').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function taLbClose() {
    document.getElementById('ta-lb').classList.remove('open');
    document.body.style.overflow = '';
}
document.getElementById('ta-lb').addEventListener('click', function(e) {
    if (e.target === this) taLbClose();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') taLbClose();
});
function taHelpful(btn) {
    btn.textContent = '👍 Thanks!';
    btn.classList.add('marked');
    btn.disabled = true;
}
function taCopy() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link copied!');
    });
}
</script>
