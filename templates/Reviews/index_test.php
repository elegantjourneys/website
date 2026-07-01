<?php
/**
 * FILE: src/Template/Pages/tripadvisor_review_index.ctp (or equivalent)
 * URL:  /tripadvisor-review
 */

// 1. Extract the dynamic data passed from the controller
$reviews = !empty($data['review_list']['trip_advisor']) ? $data['review_list']['trip_advisor'] : [];
$total   = count($reviews);

// Note: Because the controller uses find('all') without standard CakePHP pagination, 
// we are currently displaying all records. The pagination HTML at the bottom has been hidden/removed 
// until true pagination is implemented in the controller.
?>

<style>
/* ── Bubble Rating ── */
.bubble-rating { display: flex; gap: 3px; }
.bubble-rating span { width: 16px; height: 16px; border-radius: 50%; background: #00A680; display: inline-block; }
.bubble-rating span.empty { background: #dcdcdc; }

/* ── Left Panel ── */
.ta-left-panel {
    background: #fff; border: 1px solid #e4e4e4; border-radius: 12px;
    padding: 22px 18px; position: sticky; top: 20px;
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
    display: block; width: 100%; margin-top: 16px; padding: 9px; background: #00A680; 
    color: #fff; border: none; border-radius: 24px; font-size: 0.82rem;
    font-weight: 700; text-align: center; text-decoration: none; cursor: pointer; transition: background 0.2s;
}
.ta-write-btn:hover { background: #008f6c; color: #fff; }

/* ── Reviews header ── */
.ta-reviews-header {
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
    background: #fff; border: 1px solid #e4e4e4; border-radius: 10px; padding: 14px 18px; margin-bottom: 14px;
}
.ta-reviews-count { font-weight: 700; font-size: 0.95rem; color: #111; }
.ta-sort-select {
    font-size: 0.8rem; padding: 6px 10px; border: 1px solid #ddd; border-radius: 6px;
    color: #444; background: #fff; cursor: pointer;
}

/* ── Review Card ── */
.ta-review-card {
    background: #fff; border: 1px solid #e4e4e4; border-radius: 10px;
    padding: 20px; margin-bottom: 12px; transition: box-shadow 0.2s;
}
.ta-review-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }

.ta-reviewer-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
.ta-avatar {
    width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #00A680, #005f4a);
    display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; color: #fff; flex-shrink: 0;
}
.ta-reviewer-name { font-weight: 700; font-size: 0.9rem; color: #111; }
.ta-reviewer-meta { font-size: 0.75rem; color: #999; margin-top: 1px; }
.ta-rating-date-row { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
.ta-review-date { font-size: 0.75rem; color: #aaa; }
.ta-review-title { font-weight: 700; font-size: 0.95rem; color: #111; margin-bottom: 6px; }
.ta-review-snippet {
    font-size: 0.85rem; color: #555; line-height: 1.6; display: -webkit-box; 
    -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.ta-review-footer {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 14px; flex-wrap: wrap; gap: 8px;
}
.ta-thumb-gallery { display: flex; gap: 5px; }
.ta-thumb-gallery img {
    width: 60px; height: 48px; object-fit: cover; border-radius: 5px; 
    border: 1px solid #e4e4e4; cursor: pointer; transition: transform 0.2s;
}
.ta-thumb-gallery img:hover { transform: scale(1.07); }
.ta-read-more-link {
    display: inline-flex; align-items: center; gap: 5px; font-size: 0.82rem; 
    font-weight: 600; color: #00A680; text-decoration: none; padding: 6px 14px;
    border: 1.5px solid #00A680; border-radius: 20px; transition: background 0.15s, color 0.15s; white-space: nowrap;
}
.ta-read-more-link:hover { background: #00A680; color: #fff; }

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
                        <div class="ta-rating-bar"><div class="ta-rating-fill" style="width:100%"></div></div>
                        <div class="ta-rating-count"><?= h($total) ?></div>
                    </div>

                    <hr class="ta-divider">

                    <a href="https://www.tripadvisor.com" target="_blank" rel="noopener" class="ta-write-btn">
                        ✏&nbsp; Write a Review
                    </a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="ta-reviews-header">
                    <div class="ta-reviews-count"><?= h($total) ?> Reviews</div>
                    <select class="ta-sort-select">
                        <option>Most Recent</option>
                    </select>
                </div>

                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <?php
                            // 2. Map database values to variables
                            $initial = !empty($review['name']) ? strtoupper(substr($review['name'], 0, 1)) : 'U';
                            
                            // Check if date is a CakePHP time object or a string and format accordingly
                            $reviewDate = '';
                            if (!empty($review['review_date'])) {
                                $reviewDate = is_object($review['review_date']) 
                                    ? $review['review_date']->format('M Y') 
                                    : date('M Y', strtotime($review['review_date']));
                            }

                            // Dynamic Detail URL (adjust routing structure if needed)
                            $detailUrl = WEBROOT . 'tripadvisor-review/' . $review['page_url'];
                        ?>
                        <div class="ta-review-card">
                            <div class="ta-reviewer-row">
                                <div class="ta-avatar"><?= h($initial) ?></div>
                                <div>
                                    <div class="ta-reviewer-name">
                                        <?= h($review['name']) ?>
                                    </div>
                                    <div class="ta-reviewer-meta"><?= h($review['place']) ?></div>
                                </div>
                            </div>

                            <div class="ta-rating-date-row">
                                <div class="bubble-rating">
                                    <span></span><span></span><span></span><span></span><span></span>
                                </div>
                                <div class="ta-review-date"><?= h($reviewDate) ?></div>
                            </div>

                            <div class="ta-review-title"><?= h($review['short_description']) ?></div>
                            
                            <p class="ta-review-snippet"><?= h(strip_tags($review['long_description'])) ?></p>

                            <div class="ta-review-footer">
                                <?php if (!empty($review['image'])): ?>
                                    <div class="ta-thumb-gallery">
                                        <img src="<?= WEBROOT ?>uploads/reviews/<?= h($review['image']) ?>" alt="Review photo" loading="lazy">
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
                <?php else: ?>
                    <p class="text-muted">No reviews available at this time.</p>
                <?php endif; ?>

            </div></div></div>
</section>

 <?php 
		if($data['content']['description']!="")
		{
			echo $this->element('version2/category/description'); 
		}
		?>
		<?php 
			if($data['faq']['faq_list'][0]['question']!="")
			{
				echo $this->element('version2/category/faq'); 
				
			}
		?>