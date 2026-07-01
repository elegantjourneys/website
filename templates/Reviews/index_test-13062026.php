<!-- Tripadvisor Review Style Section -->
<style>
  .bubble-rating span {
    display: inline-block;
    width: 16px;
    height: 16px;
    margin-right: 2px;
    border-radius: 50%;
    background-color: #00A680;
  }

  .bubble-rating span.empty {
    background-color: #dcdcdc;
  }

  .review-card {
    border-bottom: 1px solid #e0e0e0;
    padding: 1.5rem 0;
    display: flex;
    gap: 1rem;
    align-items: flex-start;
  }

  .review-content {
    flex: 1;
  }

  .review-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.3rem;
  }

  .review-meta {
    font-size: 0.85rem;
    color: #666;
  }

  .reviewer-info {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .reviewer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ccc;
    margin-right: 10px;
  }

  .review-text {
    margin-top: 0.5rem;
    line-height: 1.5;
  }

  .read-more {
    cursor: pointer;
    color: #007bff;
    font-size: 0.9rem;
  }

  .review-gallery {
    margin-top: 0.75rem;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 6px;
  }

  .review-gallery img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .review-gallery img:hover {
    transform: scale(1.05);
  }

  /* Left Panel */
  .logo-panel {
    /*min-width: 250px;*/
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    background-color: #f8f9fa;
    height:70vh;
  }

  .logo-panel img {
    max-height: 50px;
    margin-bottom: 10px;
  }

  .overall-rating {
    font-weight: 600;
    margin-top: 5px;
  }

  /* Traveller Rating Box */
  .traveller-rating-box {
    margin-top: 20px;
    text-align: left;
  }

  .traveller-rating-box h6 {
    font-weight: 600;
    margin-bottom: 10px;
  }

  .rating-row {
    display: flex;
    align-items: center;
    margin-bottom: 6px;
    font-size: 0.9rem;
  }

  .rating-label {
    width: 70px;
  }

  .rating-bar {
    flex: 1;
    height: 8px;
    background-color: #e0e0e0;
    border-radius: 4px;
    margin: 0 8px;
    overflow: hidden;
  }

  .rating-fill {
    height: 100%;
    background-color: #00A680;
  }

  .rating-count {
    font-size: 0.8rem;
    color: #555;
  }
</style>
<section class="heroSection w-100 px-0 py-4">
  <div class="container">
    <?php echo $this->element('common/breadcrumb-ver2'); ?>

    <img src="<?=WEBROOT?>version2/assets/images/trip-advisor-banner.png" alt="banner" class="img-fluid" />
  </div>

</section>
<section class="w-100 py-0">
  
      <div class="container my-1">
        <div class="row">
          <!-- Left Logo Panel -->
          <div class="col-md-3 logo-panel">
            <img src="https://www.elegantjourneys.com/version2/assets/images/logo-trip-advisor.png"
              alt="Tripadvisor Logo" class="img-fluid">
            <div class="bubble-rating my-2">
              <span></span><span></span><span></span><span></span><span></span>
            </div>
            <p class="overall-rating">5.0 · Exceptional</p>
            <p class="text-muted small">Based on 127 Tripadvisor Reviews</p>

            <!-- Traveller Rating Box -->
            <div class="traveller-rating-box">
              <h6>Traveller rating</h6>
              <div class="rating-row">
                <div class="rating-label">Excellent</div>
                <div class="rating-bar">
                  <div class="rating-fill" style="width: 90%;"></div>
                </div>
                <div class="rating-count">115</div>
              </div>
              <div class="rating-row">
                <div class="rating-label">Very Good</div>
                <div class="rating-bar">
                  <div class="rating-fill" style="width: 7%;"></div>
                </div>
                <div class="rating-count">9</div>
              </div>
              <div class="rating-row">
                <div class="rating-label">Average</div>
                <div class="rating-bar">
                  <div class="rating-fill" style="width: 2%;"></div>
                </div>
                <div class="rating-count">2</div>
              </div>
              <div class="rating-row">
                <div class="rating-label">Poor</div>
                <div class="rating-bar">
                  <div class="rating-fill" style="width: 1%;"></div>
                </div>
                <div class="rating-count">1</div>
              </div>
              <div class="rating-row">
                <div class="rating-label">Terrible</div>
                <div class="rating-bar">
                  <div class="rating-fill" style="width: 0%;"></div>
                </div>
                <div class="rating-count">0</div>
              </div>
            </div>
          </div>

          <!-- Right Reviews Panel -->
          <div class="col-md-9">
            <!-- Review Card -->
            <div class="review-card">
              <div class="review-content">
                <div class="reviewer-info">
                  <div class="reviewer-avatar"></div>
                  <div>
                    <strong>gumchiu</strong><br>
                    <span class="review-meta">Hong Kong · Oct 2024 · Couples</span>
                  </div>
                </div>
                <div class="bubble-rating mb-1">
                  <span></span><span></span><span></span><span></span><span></span>
                </div>
                <div class="review-title">Our 2nd incredible trip to India</div>
                <p class="review-text">
                  We had an incredible holiday in India organized by Elegant Journeys. From the hotels to the guides,
                  everything was perfect. Their attention to detail and personalized service made our trip
                  unforgettable...
                </p>
                <span class="read-more">Read more</span>

                <!-- Gallery -->
                <div class="review-gallery">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                </div>
              </div>
            </div>

            <div class="review-card">
              <div class="review-content">
                <div class="reviewer-info">
                  <div class="reviewer-avatar"></div>
                  <div>
                    <strong>Emma</strong><br>
                    <span class="review-meta">London · Sep 2024 · Family</span>
                  </div>
                </div>
                <div class="bubble-rating mb-1">
                  <span></span><span></span><span></span><span></span><span></span>
                </div>
                <div class="review-title">A flawless Golden Triangle tour</div>
                <p class="review-text">
                  Elegant Journeys provided the best Golden Triangle experience we could have asked for. The guides were
                  knowledgeable, the hotels were excellent, and the itinerary was very well planned...
                </p>
                <span class="read-more">Read more</span>

                <!-- Gallery -->
                <div class="review-gallery">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                  <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2f/68/bd/d1/caption.jpg"
                    alt="Review Photo">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.querySelectorAll('.read-more').forEach(btn => {
          btn.addEventListener('click', () => {
            const txt = btn.previousElementSibling;
            txt.classList.toggle('expanded');
            btn.textContent = txt.classList.contains('expanded') ? 'Read less' : 'Read more';
          });
        });
      </script>
    
</section>