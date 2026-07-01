<div class="w-100 border border-1 rounded-1 px-2 py-3 mt-2 bg-white">
    <h2 class="fw-semibold fs-5">Traveler Stories in Motion</h2>
	<p class="text-muted">Elegant Journeys Video Testimonials</p>
    <div class="w-100 d-flex gap-2 overflow-x-auto">
    <!-- Video thumbnail with play button -->
		<div class="position-relative d-inline-block" id="videoWrapper" style="max-width: 600px;">
			<img src="<?=$data['video_testimonial']['thumbnail']?>" class="img-fluid rounded" alt="Play Video" id="videoThumb">
			<!-- Centered play button -->
		  <button class="btn btn-light rounded-circle shadow position-absolute top-50 start-50 translate-middle p-3"
				  id="playBtn" aria-label="Play video">
			<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
				 viewBox="0 0 16 16" aria-hidden="true">
			  <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l4.5-2.5a.5.5 0 0 0 0-.814l-4.5-2.5z"/>
			  <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm1 0a7 7 0 1 0 14 0A7 7 0 0 0 1 8z"/>
			</svg>
		  </button>
		</div>
	</div>
</div>
<script>
  document.getElementById('playBtn').addEventListener('click', function () {
    const wrapper = document.getElementById('videoWrapper');
    const video = document.createElement('video');
    video.setAttribute('src', '<?=$data['video_testimonial']['video']?>'); // <-- your video file
    video.setAttribute('controls', '');
    video.setAttribute('autoplay', '');
    video.className = 'img-fluid rounded w-100';
    wrapper.replaceChildren(video);
  });
</script>


                 
               