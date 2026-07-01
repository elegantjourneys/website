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
  background-color: rgba(0,0,0,0.8);
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


</style>

<section class="heroSection w-100 py-3">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
 </section>
      <section class="w-100 py-1">
        <div class="row">
          <div class="col-md-12">
		  
			<h1 class="fs-2">Travel Video Testimonials – Real Experiences from Happy Customers</h1>
			<p class="mt-3 " >
            Watch real travelers share their unforgettable journeys across India through our video testimonials. 
			From Delhi and Agra to Rajasthan and beyond, see what makes our tours truly memorable.
          </p>
				
				
				
				<div class="row row-cols-md-3 row-cols-1 mb-5">
	<?php 
		foreach($videoData as $videoTestimonial )
		{ 
	?>
			<div class="col p-2 mb-3 position-relative">
			
						<!-- Video Thumbnail -->
							<div class="video-gallery">
							
							
							<div class="video-item">
								<div class="video-thumbnail" data-video-src="<?= WEBROOT ?>repositery/video/<?= $videoTestimonial['video'] ?>">
								  <div class="thumbnail-wrapper">
									<img src="<?=WEBROOT?>repositery/video/image/<?=$videoTestimonial['thumbnails']?>" alt="<?=$videoTestimonial['client_name']?> Testimonial" loading="lazy">
									<div class="play-button-overlay">▶</div>
								  </div>
								</div>
								<div class="video-details">
								  <h3 class="video-name"><?=$videoTestimonial['client_name']?></h3>
								  <p class="video-country"><?=$videoTestimonial['country']?></p>
								</div>
							  </div>
	  

					</div>
			</div>
		
	<?php } ?>
	</div>
	
	
	<?php /*<div class="text-center mt-3">
  <button id="loadMoreButton" class="btn bg-teal text-white w-50 w-md-50">Load More Videos</button>
</div> */ ?>




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
	
	
		  
		  
		  
		 </div>

          
        </div>
      </section> 
		  
		  



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