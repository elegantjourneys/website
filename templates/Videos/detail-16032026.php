<!-- Video Detail Page: Family-Friendly Luxury Tours in India
     Designed to work with the site's existing CSS (Bootstrap-based / Elegant Journeys styles).
     No inline styles added — uses existing utility classes (container, row, col, btn, ratio, card, list-unstyled, etc.)
-->
<style>
        .ej-video-container {
            max-width: 900px;
            margin: 40px auto;
            position: relative;
        }

        .ej-video-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            background: #000;
            border-radius: 10px;
        }

        .ej-video-poster {
            width: 100%;
            height: auto;
            display: block;
            cursor: pointer;
        }

        .ej-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 80px;
            color: #ffffff;
            opacity: 0.85;
            pointer-events: none;
        }

        /* Ensure responsive video */
        video {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
        }
    </style>

<section class="heroSection w-100 py-3">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
 </section>
<section class="container video-detail-page">
  
  <div class="row">
    <div class="col-12 mb-4">
      <h1 class="h3"><?=$data['general']['title']?></h1>
      <p class="text-muted"><?=$data['general']['short_introduction']?></p>
    </div>
  </div>

  <div class="row">
    <main class="col-lg-8">

      <article class="mb-4">  
        <div class="ratio mb-3">
      
	<div class="ej-video-wrapper" id="ejVideoBox"
         data-video-src="<?=$data['general']['video_url']?>"
         data-poster="<?=$data['general']['thumbnail_url']?>">

        <!-- Poster Image -->
        <img src="<?=$data['general']['thumbnail_url']?>"
             alt="<?=$data['general']['title']?>"
             class="ej-video-poster"
             id="ejPoster">

        <!-- Play Button -->
        <div class="ej-play-btn">►</div>
    </div>

          
        </div>

        
        <div class="card mb-4">
          <div class="card-body">
				<?=$data['description']?>
          </div>
        </div>

        <section class="mb-4 card">
          <div class="card-body">
            <h3 class="h5">Plan This Trip</h3>
            <p class="mb-2">Interested in this itinerary? Our team can personalise a family-friendly luxury package to match your schedule, ages of children, and special requests.</p>
            <a id="book" href="/contact" class="btn btn-outline-primary me-2">Request a Quote</a>
            <a href="/itineraries" class="btn btn-outline-secondary">View Similar Itineraries</a>
          </div>
        </section>

      </article>

      <section class="related-videos">
        <h3 class="h5 mb-3">Related Videos</h3>
        <div class="row g-3">
          <div class="col-sm-6">
            <div class="card h-100">
              <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/RELATED_VIDEO_ID_1" title="Rajasthan Family Tours" allowfullscreen></iframe>
              </div>
              <div class="card-body">
                <p class="mb-1"><strong>Rajasthan: Royal Family Tours</strong></p>
                <p class="small text-muted mb-0">3:45 • Palace stays & cultural activities</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="card h-100">
              <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/RELATED_VIDEO_ID_2" title="Kerala Backwaters" allowfullscreen></iframe>
              </div>
              <div class="card-body">
                <p class="mb-1"><strong>Kerala Backwaters: Family Houseboat</strong></p>
                <p class="small text-muted mb-0">4:10 • Houseboats, nature & wellness</p>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <aside class="col-lg-4">
      <div class="position-sticky" style="top: 1.5rem;">

        <div class="card mb-3">
          <div class="card-body text-center">
            <p class="mb-2"><strong>Looking to travel?</strong></p>
            <p class="small text-muted mb-3">Get a custom family itinerary & quote from Elegant Journeys</p>
            <a href="/contact" class="btn btn-primary w-100 mb-2">Enquire Now</a>
            <a href="tel:+911234567890" class="btn btn-outline-secondary w-100">Call Us</a>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <h4 class="h6 mb-2">Trip Snapshot</h4>
            <ul class="list-unstyled small mb-0">
              <li><strong>Duration:</strong> 7-12 days</li>
              <li><strong>Best Time:</strong> Oct – Mar</li>
              <li><strong>Style:</strong> Luxury, Family-friendly, Multi-generational</li>
              <li><strong>Regions:</strong> Rajasthan, Kerala, Goa, Andaman, Ranthambore</li>
            </ul>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <h4 class="h6 mb-2">Share this video</h4>
            <div class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-primary" href="#" aria-label="Share on Facebook">Facebook</a>
              <a class="btn btn-sm btn-outline-info" href="#" aria-label="Share on Twitter">Twitter</a>
              <a class="btn btn-sm btn-outline-secondary" href="#" aria-label="Copy link">Copy Link</a>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h4 class="h6 mb-2">Customer Reviews</h4>
            <p class="small mb-1"><strong>"A perfect family holiday — seamless and luxurious."</strong></p>
            <p class="small text-muted">— The Sharma Family</p>
            <hr>
            <p class="small mb-1"><strong>"Kids loved the safaris and palace stay."</strong></p>
            <p class="small text-muted">— The Martins</p>
          </div>
        </div>

      </div>
    </aside>
  </div>

  <div class="row mt-5">
    <div class="col-12 text-center">
      <p class="small text-muted">Prefer a tailor-made family itinerary? <a href="/contact"><strong>Contact Elegant Journeys</strong></a> and our specialists will craft a personalised luxury family holiday for you.</p>
    </div>
  </div>
</section>

<!-- Notes for integrator:
  - Replace VIDEO_ID_OR_URL and RELATED_VIDEO_ID_X with actual video IDs/URLs.
  - This fragment relies on existing site CSS (Bootstrap utility classes and site card/button styles).
  - No inline CSS except a small sticky top offset which can be removed if the theme handles sticky sidebars.
-->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const box = document.getElementById("ejVideoBox");
        const poster = document.getElementById("ejPoster");

        poster.addEventListener("click", function () {

            // Create video element only on click (fast loading)
            const video = document.createElement("video");
            video.controls = true;
            video.autoplay = true;
            video.playsInline = true;

            // Set video source
            const source = document.createElement("source");
            source.src = box.getAttribute("data-video-src");
            source.type = "video/mp4";
            video.appendChild(source);

            // Remove poster + play icon
            box.innerHTML = "";

            // Add video to the container
            box.appendChild(video);

            // Start playing
            video.play();
        });

    });
</script>