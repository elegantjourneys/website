<style>
.blog-content p {
  line-height: 1.8;
  margin-bottom: 20px;
}

/* Scoped float-left-img inside blog-content */
.blog-content .float-left-img {
  float: left;
  width: 400px;       /* Adjust size */
  height: auto;
  margin-right: 20px;
  margin-bottom: 15px;
  border-radius: 8px;
}

.blog-content .float-right-img {
  float: right;
  width: 400px;       /* Adjust size */
  height: auto;
  margin-right: 20px;
  margin-bottom: 15px;
  border-radius: 8px;
}

* Responsive adjustments */
@media screen and (max-width: 768px) {
  .blog-content .float-left-img {
    float: none;
    display: block;
    margin: 0 auto 15px auto;
    width: 100%;
    max-width: 100%;
  }
  
  .blog-content .float-right-img {
    float: none;
    display: block;
    margin: 0 auto 15px auto;
    width: 100%;
    max-width: 100%;
  }
}

/* Image group styling */
.blog-content .image-group {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 15px;
  margin: 20px 0;
}

/* Individual images */
.blog-content .image-group .group-img {
  width: calc(33.333% - 10px);
  height: auto;
  border-radius: 8px;
  object-fit: cover;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect for luxury feel */
.blog-content .image-group .group-img:hover {
  transform: scale(1.03);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}

.map-wide {
    width: 100vw;
    max-width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
}

.map-wide .full-width-img {
    width: 70%;
    height: auto;
    display: block;
}

/* Responsive behavior */
@media (max-width: 768px) {
  .blog-content .image-group .group-img {
    width: 100%;
  }
}
</style>
<section class="heroSection w-100 py-3">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
 </section>
      <section class="w-100 py-1">
	  
<div class="row g-4">

  <!-- Blog Detail (left) -->
  <article class="col-lg-8">
   
    <h1 class="h2 mb-3"><?=$data['general']['title']?></h1>
    <p class="text-muted small mb-4">By Elegant Journeys · <?=$data['general']['publication_date']?> · <span class="badge bg-primary">Travel Tips</span></p>

    <img src="<?=$data['general']['image']?>" class="img-fluid rounded mb-4" alt="Golden Triangle Tour">
	<div class="blog-content">
		<?=$data['general']['description']?>
	</div>

    <hr class="my-5">
    <!--<h3 class="h6">Share this post</h3>
    <div class="d-flex gap-2 mb-5">
      <a href="#" class="btn btn-outline-secondary btn-sm">Facebook</a>
      <a href="#" class="btn btn-outline-secondary btn-sm">Twitter</a>
      <a href="#" class="btn btn-outline-secondary btn-sm">Instagram</a>
    </div>-->

    <!-- Comments Section -->
    <!--<section>
      <h3 class="h5 mb-3">Leave a Comment</h3>
      <form>
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Your Name">
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Email Address">
        </div>
        <div class="mb-3">
          <textarea class="form-control" rows="4" placeholder="Your Comment"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Post Comment</button>
      </form>
    </section>-->
  </article>

  <!-- Sidebar (right) -->
   <aside class="col-lg-4">
    <?php echo $this->element('version2/blog/section-blog-right-bar'); ?>
  </aside>

</div>