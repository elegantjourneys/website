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
	
	
	       <style>
.middle {
    position: absolute;
    top: 73%;
    width: 90%;
    margin: 0 20px;
}
.rounded-4 {
    border-radius: 0.7rem;
}
@media (min-width: 320px) and (max-width: 480px){
	.middle {top: 64%;}
}
</style>

<style>
/* Grid layout */
.video-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 20px;
}

.video-item {
  text-align: center;
}

.thumbnail-wrapper {
  position: relative;
  width: 100%;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  background-color: #000; /* Fallback if image not loaded */
  overflow: hidden;
  border-radius: 8px;
}

.thumbnail-wrapper img {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover; /* Ensures uniform size */
}

.play-button-overlay {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  font-size: 30px;
  color: white;
  background: rgba(0,0,0,0.5);
  border-radius: 50%;
  padding: 12px 20px;
  cursor: pointer; 
}


.video-details {
  margin-top: 8px;
}

.video-name {
  font-size: 1.1em;
  margin: 0;
  font-weight: bold;
}

.video-country {
  font-size: 0.9em;
  color: #666;
  margin: 0;
}

/* Modal styling */
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  padding-top: 60px;
  left: 0; top: 0;
  width: 100%; height: 100%;
  /*background-color: rgba(0,0,0,0.8);*/
}

.modal-content {
  background-color: #000;
  margin: auto;
  padding: 0;
  width: 80%;
  max-width: 800px;
}

.close {
  color: white;
  font-size: 28px;
  margin-right: 12px;
  cursor: pointer;
}

@media (min-width: 576px) {
  .video-container {
   
    width: 100%;
  }
}

@media (min-width: 768px) {
  .video-container {
   
    width: 50%;
  }
}

@media (min-width: 1000px) {
  .video-container {
   
    width: 33.333%;
  }
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
            <a id="book" href="https://www.elegantjourneys.com/tailor-make-a-tour" class="btn btn-outline-primary me-2">Request a Quote</a>
            <a href="https://www.elegantjourneys.com/tours-luxury-offers" class="btn btn-outline-secondary">View Similar Itineraries</a>
          </div>
        </section>

      </article>

      <section class="related-videos">
        <h3 class="h5 mb-3">Related Videos</h3>
        <div class="row g-3">
          <div class="col-sm-6">
				<!-- Video Thumbnail -->
				<div class="video-gallery card h-100">
					<div class="video-item">
						<div class="video-thumbnail" data-video-src="https://www.elegantjourneys.com/repositery/video/hugh.mp4">
						  <div class="thumbnail-wrapper">
							<img src="https://www.elegantjourneys.com/repositery/video/image/hugh.png" alt="Hugh Elizabeth S. Family" loading="lazy">
							<div class="play-button-overlay">▶</div>
						  </div>
						</div>
						<div class="video-details card-body">
						  <h3 class="video-name mb-1">Hugh Elizabeth S. Family</h3>
						
							<p class="small text-muted mb-0">1:20 • USA</p>
						</div>
					</div>
				</div>
				<!-- Video Thumbnail ends-->
			</div>

          <div class="col-sm-6">
				<!-- Video Thumbnail -->
				<div class="video-gallery card h-100">
					<div class="video-item">
						<div class="video-thumbnail" data-video-src="https://www.elegantjourneys.com/repositery/video/nicky.mp4">
						  <div class="thumbnail-wrapper">
							<img src="https://www.elegantjourneys.com/repositery/video/image/nicky.png" alt="Nicky D. Family" loading="lazy">
							<div class="play-button-overlay">▶</div>
						  </div>
						</div>
						<div class="video-details card-body">
						  <h3 class="video-name mb-1">Nicky D. Family</h3>
						
							<p class="small text-muted mb-0">1:22 • New Zealand</p>
						</div>
					</div>
				</div>
				<!-- Video Thumbnail ends-->
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
            <a href="https://www.elegantjourneys.com/tailor-make-a-tour" class="btn btn-primary w-100 mb-2">Enquire Now</a>
            <a href="tel:+919910078975" class="btn btn-outline-secondary w-100">Call Us</a>
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
              <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="shareFacebook();" aria-label="Share on Facebook">Facebook</a>
              <a class="btn btn-sm btn-outline-info" href="javascript:void(0);" onclick="shareTwitter();" aria-label="Share on Twitter">Twitter</a>
              <a class="btn btn-sm btn-outline-secondary" href="javascript:void(0);" onclick="copyLink();" id="copyLinkBtn" aria-label="Copy link">Copy Link</a>
            </div>
          </div>
        </div>

        <div class="card">
          
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  <div id="reviewCarousel" class="carousel slide p-2 mt-2 py-3 bg-white" data-bs-ride="false">

 <div class="carousel-inner">
				<div class="text-center">
					<h2 class="fw-semibold fs-5">What Our Guests Say on Tripadvisor</h2>
					<p class="mb-0">Authentic Tripadvisor Reviews from Real Guests</p>
				</div>
                  <!-- Review 1 -->
                  <div class="carousel-item active">
                    <div class="card border-0 mx-auto width-[90%]" style="width: 90%;">
                      <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-start gap-3 mb-2">
                          <img src="https://www.elegantjourneys.com/version2/assets/images/tripadvisor-logo.png" class="w-25 rounded-circle shadow-1-strong">
                          <div>
                            <h5 class="fw-normal fs-14 m-0 fw-bold">Trevor W</h5>
                            <h5 class="fw-normal fs-14 m-1 fw-bold">Melbourne, Australia</h5>
                          </div>
                        </div>
                        <ul class="list-unstyled d-flex justify-content-start m-0 gap-[1px]">
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                          <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
						   <li>
                            <i class="fa-solid fa-circle fa-sm text-teal"></i>
                          </li>
                                                  </ul>
                        <p class="m-0 fw-semibold">
                          they deliver on all their promises                        </p>
                        <p class="mt-2 m-0 fw-normal truncate-4 review">
                          <i class="fas fa-quote-left pe-2"></i>Have just returned from a 7 day golden triangle tour with Elegant Journeys. 
As previous posts attest, they deliver on all their promises. From the t                        </p>
                        <!-- <a class="text-primary toggle-btn" onclick="toggleTruncate(this)">See
                      More</a> -->
                        <a href="https://www.elegantjourneys.com/tripadvisor-review" class="text-dark fw-semibold small">
                          See More
                        </a>
						                      </div>
                    </div>
                  </div>

			  
				  
				  
				  


                 
                </div>
              </div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
        </div>

      </div>
    </aside>
  </div>

  <div class="row mt-5">
    <div class="col-12 text-center">
      <p class="small text-muted">Prefer a tailor-made family itinerary? <a href="https://www.elegantjourneys.com/contact-us"><strong>Contact Elegant Journeys</strong></a> and our specialists will craft a personalised luxury family holiday for you.</p>
    </div>
  </div>
</section>









<!-- Modal -->
<div id="videoModal" class="modal">
  <div class="modal-content">
    <span class="close d-flex justify-content-end">&times;</span>
    <video id="popupVideo" controls preload="metadata" width="100%">
      <source src="" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</div>

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


<script>
// Open modal on thumbnail click
document.querySelectorAll('.video-thumbnail').forEach(function(thumb) {
  thumb.addEventListener('click', function() {
    var videoSrc = this.getAttribute('data-video-src');
    var video = document.getElementById('popupVideo');
    video.querySelector('source').setAttribute('src', videoSrc);
    video.load();
    document.getElementById('videoModal').style.display = 'block';
    video.play();
  });
});

// Close modal
document.querySelector('.close').addEventListener('click', function() {
  var modal = document.getElementById('videoModal');
  var video = document.getElementById('popupVideo');
  video.pause();
  modal.style.display = 'none';
});
</script>

<script>
    // Get the current page URL and Title dynamically
    const pageUrl = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);

    // 1. Facebook Share Function
    function shareFacebook() {
        const fbShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
        // Opens a popup window for sharing
        window.open(fbShareUrl, 'facebook-share-dialog', 'width=600,height=400,scrollbars=yes');
    }

    // 2. Twitter (X) Share Function
    function shareTwitter() {
        const twitterShareUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=Check out this amazing luxury India tour: ${pageTitle}`;
        // Opens a popup window for sharing
        window.open(twitterShareUrl, 'twitter-share-dialog', 'width=600,height=400,scrollbars=yes');
    }

    // 3. Copy Link Function
    function copyLink() {
        const urlToCopy = window.location.href;
        
        // Uses the modern Clipboard API
        navigator.clipboard.writeText(urlToCopy).then(() => {
            // Provide feedback to the user that it worked
            const copyBtn = document.getElementById('copyLinkBtn');
            const originalText = copyBtn.innerText;
            
            copyBtn.innerText = 'Copied!';
            copyBtn.style.color = 'green'; // Optional: change color to show success
            
            // Revert back to original text after 2 seconds
            setTimeout(() => { 
                copyBtn.innerText = originalText; 
                copyBtn.style.color = ''; 
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy the link: ', err);
            alert("Failed to copy link. Please copy the URL from your browser address bar.");
        });
    }
</script>