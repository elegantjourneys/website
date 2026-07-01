<?php
/**
 * FILE: src/Template/Pages/tripadvisor_review_index.ctp
 * URL:  /tripadvisor-review
 *
 * Controller should pass:
 *   $reviews  – array of review records
 *   $total    – total review count (int)
 *   $page     – current page (int)
 *   $perPage  – reviews per page (int)
 */

// ── Static fallback data (remove once controller passes real data) ──
if (empty($reviews)) {
    $reviews = [
        [
            'id'        => 1,
            'slug'      => 'our-2nd-incredible-trip-to-india',
            'name'      => 'gumchiu',
            'location'  => 'Hong Kong',
            'trip_type' => 'Couples',
            'trip_icon' => '👫',
            'date'      => 'Oct 2024',
            'rating'    => 5,
            'title'     => 'Our 2nd incredible trip to India',
            'snippet'   => 'We had an incredible holiday in India organized by Elegant Journeys. From the hotels to the guides, everything was perfect. Their attention to detail and personalized service made our trip unforgettable...',
            'photos'    => [
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
            ],
        ],
        [
            'id'        => 2,
            'slug'      => 'a-flawless-golden-triangle-tour',
            'name'      => 'Emma',
            'location'  => 'London',
            'trip_type' => 'Family',
            'trip_icon' => '👨‍👩‍👧',
            'date'      => 'Sep 2024',
            'rating'    => 5,
            'title'     => 'A flawless Golden Triangle tour',
            'snippet'   => 'Elegant Journeys provided the best Golden Triangle experience we could have asked for. The guides were knowledgeable, the hotels were excellent, and the itinerary was very well planned...',
            'photos'    => [
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
            ],
        ],
        [
            'id'        => 3,
            'slug'      => 'beyond-all-expectations-a-dream-come-true',
            'name'      => 'Sarah_Travels',
            'location'  => 'New York',
            'trip_type' => 'Couples',
            'trip_icon' => '👫',
            'date'      => 'Aug 2024',
            'rating'    => 5,
            'title'     => 'Beyond all expectations — a dream come true',
            'snippet'   => 'My husband and I celebrated our anniversary with a private Rajasthan tour. Every palace hotel, every guided walk through ancient bazaars — flawlessly curated by Elegant Journeys...',
            'photos'    => [
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
            ],
        ],
        [
            'id'        => 4,
            'slug'      => 'solo-travel-made-effortless-and-memorable',
            'name'      => 'Michael T.',
            'location'  => 'Sydney',
            'trip_type' => 'Solo',
            'trip_icon' => '🧳',
            'date'      => 'Jul 2024',
            'rating'    => 5,
            'title'     => 'Solo travel made effortless and memorable',
            'snippet'   => 'Travelling solo to India for the first time felt daunting, but Elegant Journeys handled everything seamlessly. My guide was incredible — knowledgeable, friendly and always punctual...',
            'photos'    => [
                'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg',
            ],
        ],
    ];
    $total   = 127;
    $page    = 1;
    $perPage = 10;
}

$totalPages = isset($perPage) && $perPage > 0 ? ceil($total / $perPage) : 1;
?>

<style>
/* ── Bubble Rating ── */
.bubble-rating { display: flex; gap: 3px; }
.bubble-rating span { width: 16px; height: 16px; border-radius: 50%; background: #00A680; display: inline-block; }
.bubble-rating span.empty { background: #dcdcdc; }

/* ── Left Panel ── */
.ta-left-panel {
    background: #fff;
    border: 1px solid #e4e4e4;
    border-radius: 12px;
    padding: 22px 18px;
    position: sticky;
    top: 20px;
}
.ta-left-panel .ta-logo { max-height: 40px; display: block; margin: 0 auto 12px; }
.ta-score-big { font-size: 2.2rem; font-weight: 900; color: #111; text-align: center; line-height: 1; }
.ta-score-label { text-align: center; font-size: 0.85rem; color: #555; margin-bottom: 2px; }
.ta-score-based { text-align: center; font-size: 0.75rem; color: #999; margin-bottom: 14px; }
.ta-divider { border: none; border-top: 1px solid #ebebeb; margin: 14px 0; }
.ta-rating-title { font-weight: 700; font-size: 0.85rem; color: #111; margin-bottom: 10px; }
.ta-rating-row { display: flex; align-items: center; margin-bottom: 7px; font-size: 0.78rem; gap: 7px; }
.ta-rating-label { width: 68px; color: #555; flex-shrink: 0; }
.ta-rating-bar { flex: 1; height: 6px; background: #ebebeb; border-radius: 3px; overflow: hidden; }
.ta-rating-fill { height: 100%; background: #00A680; border-radius: 3px; }
.ta-rating-count { width: 22px; text-align: right; color: #999; font-size: 0.75rem; flex-shrink: 0; }
.ta-write-btn {
    display: block; width: 100%; margin-top: 16px;
    padding: 9px; background: #00A680; color: #fff;
    border: none; border-radius: 24px; font-size: 0.82rem;
    font-weight: 700; text-align: center; text-decoration: none;
    cursor: pointer; transition: background 0.2s;
}
.ta-write-btn:hover { background: #008f6c; color: #fff; }

/* ── Reviews header ── */
.ta-reviews-header {
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 10px;
    background: #fff; border: 1px solid #e4e4e4;
    border-radius: 10px; padding: 14px 18px; margin-bottom: 14px;
}
.ta-reviews-count { font-weight: 700; font-size: 0.95rem; color: #111; }
.ta-sort-select {
    font-size: 0.8rem; padding: 6px 10px;
    border: 1px solid #ddd; border-radius: 6px;
    color: #444; background: #fff; cursor: pointer;
}

/* ── Review Card ── */
.ta-review-card {
    background: #fff;
    border: 1px solid #e4e4e4;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 12px;
    transition: box-shadow 0.2s;
}
.ta-review-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }

.ta-reviewer-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
.ta-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(135deg, #00A680, #005f4a);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1rem; color: #fff; flex-shrink: 0;
}
.ta-reviewer-name { font-weight: 700; font-size: 0.9rem; color: #111; }
.ta-reviewer-meta { font-size: 0.75rem; color: #999; margin-top: 1px; }
.ta-trip-badge {
    display: inline-flex; align-items: center; gap: 3px;
    font-size: 0.7rem; color: #555; background: #f2f2f2;
    border-radius: 20px; padding: 2px 8px; margin-left: 5px;
}
.ta-rating-date-row { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
.ta-review-date { font-size: 0.75rem; color: #aaa; }
.ta-review-title { font-weight: 700; font-size: 0.95rem; color: #111; margin-bottom: 6px; }
.ta-review-snippet {
    font-size: 0.85rem; color: #555; line-height: 1.6;
    display: -webkit-box; -webkit-line-clamp: 3;
    -webkit-box-orient: vertical; overflow: hidden;
}
.ta-review-footer {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 14px; flex-wrap: wrap; gap: 8px;
}
.ta-thumb-gallery { display: flex; gap: 5px; }
.ta-thumb-gallery img {
    width: 60px; height: 48px; object-fit: cover;
    border-radius: 5px; border: 1px solid #e4e4e4;
    cursor: pointer; transition: transform 0.2s;
}
.ta-thumb-gallery img:hover { transform: scale(1.07); }
.ta-read-more-link {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 0.82rem; font-weight: 600; color: #00A680;
    text-decoration: none; padding: 6px 14px;
    border: 1.5px solid #00A680; border-radius: 20px;
    transition: background 0.15s, color 0.15s; white-space: nowrap;
}
.ta-read-more-link:hover { background: #00A680; color: #fff; }

/* ── Pagination ── */
.ta-pagination { display: flex; justify-content: center; gap: 6px; margin-top: 24px; flex-wrap: wrap; }
.ta-page-btn {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.83rem; font-weight: 600; cursor: pointer;
    border: 1.5px solid #ddd; background: #fff; color: #555;
    text-decoration: none; transition: all 0.15s;
}
.ta-page-btn:hover, .ta-page-btn.active { background: #00A680; color: #fff; border-color: #00A680; }

@media (max-width: 767px) {
    .ta-left-panel { position: static; margin-bottom: 20px; }
    .ta-thumb-gallery img { width: 50px; height: 40px; }
}
</style>

<section class="heroSection w-100 px-0 py-4">
    <div class="container">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
        <img src="<?= WEBROOT ?>version2/assets/images/trip-advisor-banner.png" alt="TripAdvisor Reviews" class="img-fluid" />
    </div>
</section>

<section class="w-100 py-4">
    <div class="container my-2">
        <div class="row g-4">

            <!-- ── Left Panel ── -->
            <div class="col-md-3">
                <div class="ta-left-panel text-center">
                    <img src="<?= WEBROOT ?>version2/assets/images/logo-trip-advisor.png"
                         alt="Tripadvisor" class="ta-logo img-fluid">

                    <div class="bubble-rating justify-content-center d-flex my-2">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <div class="ta-score-big">5.0</div>
                    <div class="ta-score-label">Exceptional</div>
                    <div class="ta-score-based">Based on <?= h($total) ?> Tripadvisor Reviews</div>

                    <hr class="ta-divider">

                    <div class="ta-rating-title text-start">Traveller rating</div>
                    <div class="ta-rating-row">
                        <div class="ta-rating-label">Excellent</div>
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:90%"></div></div>
                        <div class="ta-rating-count">115</div>
                    </div>
                    <div class="ta-rating-row">
                        <div class="ta-rating-label">Very Good</div>
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:7%"></div></div>
                        <div class="ta-rating-count">9</div>
                    </div>
                    <div class="ta-rating-row">
                        <div class="ta-rating-label">Average</div>
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:2%"></div></div>
                        <div class="ta-rating-count">2</div>
                    </div>
                    <div class="ta-rating-row">
                        <div class="ta-rating-label">Poor</div>
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:1%"></div></div>
                        <div class="ta-rating-count">1</div>
                    </div>
                    <div class="ta-rating-row">
                        <div class="ta-rating-label">Terrible</div>
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:0%"></div></div>
                        <div class="ta-rating-count">0</div>
                    </div>

                    <hr class="ta-divider">

                    <a href="https://www.tripadvisor.com" target="_blank" rel="noopener" class="ta-write-btn">
                        ✏&nbsp; Write a Review
                    </a>
                </div>
            </div>

            <!-- ── Right Reviews Panel ── -->
            <div class="col-md-9">

                <div class="ta-reviews-header">
                    <div class="ta-reviews-count"><?= h($total) ?> Reviews</div>
                    <select class="ta-sort-select">
                        <option>Most Recent</option>
                        <option>Highest Rating</option>
                        <option>Lowest Rating</option>
                    </select>
                </div>

                <?php foreach ($reviews as $review): ?>
                <?php
                    $initial  = strtoupper(substr($review['name'], 0, 1));
                    $fullStars = (int)$review['rating'];
                    // Detail page URL — swap to slug if available
                    $detailUrl = '/tripadvisor-review/' . (!empty($review['slug']) ? $review['slug'] : $review['id']);
                ?>
                <div class="ta-review-card">
                    <div class="ta-reviewer-row">
                        <div class="ta-avatar"><?= h($initial) ?></div>
                        <div>
                            <div class="ta-reviewer-name">
                                <?= h($review['name']) ?>
                                <span class="ta-trip-badge">
                                    <?= h($review['trip_icon']) ?> <?= h($review['trip_type']) ?>
                                </span>
                            </div>
                            <div class="ta-reviewer-meta"><?= h($review['location']) ?></div>
                        </div>
                    </div>

                    <div class="ta-rating-date-row">
                        <div class="bubble-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span<?= $i > $fullStars ? ' class="empty"' : '' ?>></span>
                            <?php endfor; ?>
                        </div>
                        <div class="ta-review-date"><?= h($review['date']) ?></div>
                    </div>

                    <div class="ta-review-title"><?= h($review['title']) ?></div>
                    <p class="ta-review-snippet"><?= h($review['snippet']) ?></p>

                    <div class="ta-review-footer">
                        <?php if (!empty($review['photos'])): ?>
                        <div class="ta-thumb-gallery">
                            <?php foreach (array_slice($review['photos'], 0, 3) as $photo): ?>
                                <img src="<?= h($photo) ?>" alt="Review photo" loading="lazy">
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <div></div>
                        <?php endif; ?>

                        <a href="<?= h($detailUrl) ?>" class="ta-read-more-link">
                            Read full review &rarr;
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- ── Pagination ── -->
                <?php if ($totalPages > 1): ?>
                <div class="ta-pagination">
                    <?php if ($page > 1): ?>
                        <a href="/tripadvisor-review?page=<?= $page - 1 ?>" class="ta-page-btn">&larr;</a>
                    <?php endif; ?>

                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <a href="/tripadvisor-review?page=<?= $p ?>"
                           class="ta-page-btn <?= $p === (int)$page ? 'active' : '' ?>">
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="/tripadvisor-review?page=<?= $page + 1 ?>" class="ta-page-btn">&rarr;</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div><!-- /col-md-9 -->
        </div><!-- /row -->
    </div>
</section>
