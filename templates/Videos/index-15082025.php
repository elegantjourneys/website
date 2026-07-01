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
<section class="container py-4">
	<h2 class="text-center fw-bold mb-5">VIDEO GALLERY</h2>
	<h4 class="mb-3 fw-bold">General</h4>
	<div class="row row-cols-md-3 row-cols-1 mb-5">
	<?php foreach($videoData as $videoTestimonial ){ ?>
		<div class="col p-2 mb-3 position-relative">
			
			<a href="#" data-bs-toggle="modal" data-bs-target="#img<?= $videoTestimonial['id'] ?>">
				 <img src="<?= WEBROOT ?>repositery/video/image/<?= $videoTestimonial['thumbnails'] ?>" class="w-100 h-100 rounded-4" />
				 <div class="play-button">
												    <img src="<?= WEBROOT ?>version1/image/play-button.png" alt="play-button" />
												</div>
				 </a>
				<div class="modal fade" id="img<?= $videoTestimonial['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content bg-dark">
					  <div class="modal-header border-0 justify-content-between">
						<div>&nbsp;</div>
						<div class="text-center text-white"><?=$videoTestimonial['client_name'] ?> (<?=$videoTestimonial['country'] ?>)</div>
						<button type="button" class="btn-close btn-close-white p-0 m-0" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						
							<div class="ratio ratio-16x9">
																																			<video id="my-video" class="video-js ratio" controls preload="auto" poster="<?= WEBROOT ?>repositery/video/image/<?= $videoTestimonial['thumbnails'] ?>" data-setup="{}" >
								<source src="<?= WEBROOT ?>repositery/video/<?= $videoTestimonial['video'] ?>" type="video/mp4" />
						</video>
						
					</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="middle">
					<div class="text-white cbbold"><?=$videoTestimonial['client_name'] ?></div>
					<p class="text-white"><?=$videoTestimonial['country'] ?></p>
				</div>
		</div>
		
	<?php } ?>
	</div>
	
</section>