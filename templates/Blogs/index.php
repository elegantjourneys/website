<section class="heroSection w-100 py-3">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
 </section>
      <section class="w-100 py-1">
	  
<div class="row g-4">

<h1 class="fs-2 h1">Elegant Journeys Travel Blog - Luxury Tours, Insider Tips &amp; Inspiring Destinations</h1>
<h2 class="mt-3 h6" >Expert Travel Guides to India's Iconic Landmarks, Historic Palaces, Vibrant Bazaars, Luxury Tours, and Golden Triangle Tours</h2>

  <!-- Blog Listing (left) -->
  <section class="col-lg-8">

    <!-- Post Card (repeat for each article) -->
	<?php
		foreach($data['blog_list'] as $blogInfo)
		{
	?>
    <article class="card mb-4">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?=$blogInfo['image']?>" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="Taj Mahal at sunrise">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h2 class="h5 card-title"><?=$blogInfo['title']?></h2>
            <p class="text-muted mb-1 small">By Elegant Journeys  <?=$blogInfo['publication_date']?>  <span class="badge bg-primary">Travel Tips</span></p>
            <p class="card-text"><?=$blogInfo['short_description']?></p>
				<a href="<?=$blogInfo['page_url']?>">
					<button class="btn bg-teal text-white fw-semibold rounded-1">
                      Read More
                    </button>
				</a>
          </div>
        </div>
      </div>
    </article>
	<?php
		}
	?>
    
    <!-- Pagination -->
    <?php //echo $this->element('version2/blog/section-blog-pagination'); ?>

  </section>

  <!-- Sidebar (right) -->
  <aside class="col-lg-4">
    <?php echo $this->element('version2/blog/section-blog-right-bar'); ?>
  </aside>

</div>
</section>