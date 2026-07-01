<section class="mb-3 position-relative py-5 wsregular font-13" style="background-size: 100% 100%;background-repeat: no-repeat; background-image: url('<?=WEBROOT?>version1/image/star-bg.jpg');">
			<div class="col-lg-9 mx-lg-auto mx-3">
				<div class="row row-cols-md-2 row-cols-1">
				
				<?php foreach($testimonialData as $td){ ?>
					<div class="col d-flex border-bottom pb-3 mb-4">
						<div class="email-box">
							<div class="d-flex align-items-center">
								<div class="me-4"><img src="<?=WEBROOT?>version1/image/man.jpg" width="45" /></div>
								<div class="flex-wrap">
								<h6 class="wsbold"><?=$td["name"];?></h6>
								<div class="fw-bold"><?=$td["country"];?></div></div>
							</div>
							<div>
								<div class="mt-4">	
									<?php echo $this->Text->truncate($td["text"],120,['ellipsis' => '...','exact' => false]);?><a class="fw-bold openPopup" data-href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'emailTestimonialView', $td["id"]]); ?>" data-bs-toggle="modal" href="#exampleModalToggle" role="button">View more</a>
								</div>
							</div>
							
						</div>
					</div>
				<?php } ?>
					
				
			</div>
			<div class="mt-4">
				<?php echo $this->element("common/pagination"); ?>
				</div>
		</section>
		<!-- Modal -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
        $('.openPopup').on('click',function(){
        //var title = $(this).attr('data-title');
        var dataURL = $(this).attr('data-href');
        //$('.modal-title').text(title);
        $('.modal-body').load(dataURL,function(){
            $('#exampleModalToggle').modal({show:true});
        });
    }); 
});
</script>
