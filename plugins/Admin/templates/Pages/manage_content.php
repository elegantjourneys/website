<div class="container">
  <div class="page-inner">
    <div class="page-header">
      
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?=@$page_title["0"]?></a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#"><?=@$page_title["1"]?></a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?= $this->Form->create($cmsContent) ?>
<div class="card">
  <div class="card-header"><div class="card-title"><?=@$page_title["1"]?></div></div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="form-group">
          <label for="title">Title</label>
          <?= $this->Form->control('cms_content_descriptions.0.title', [
              'label' => false,
              'class' => 'form-control',
              'value' => $cmsContent->cms_content_descriptions[0]->title ?? ''
          ]) ?>
        </div>
        <div class="form-group">
          <label for="description">Content</label>
          <?= $this->Form->control('cms_content_descriptions.0.description', [
              'label' => false,
              'type' => 'textarea',
              'class' => 'form-control',
              'rows' => 8,
              'value' => $cmsContent->cms_content_descriptions[0]->description ?? ''
          ]) ?>
        </div>
      </div>
    </div>
  </div>
  <div class="card-action">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</div>
<?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // Get the last part of the URL path
  const urlPath = window.location.pathname;
  const lastSegment = urlPath.substring(urlPath.lastIndexOf('/') + 1);

  // Define segments where CKEditor should be hidden
  const disabledSegments = ['script', 'meta'];

  // Check if the segment is NOT in the disabled list
  if (!disabledSegments.includes(lastSegment)) {
    CKEDITOR.replace('cms-content-descriptions-0-description', {
      allowedContent: true,
      contentsCss: [
        'https://palaceonwheel.travel/assets/css/styles.css?v=4',
        'https://palaceonwheel.travel/assets/css/test.css?v=4'
      ]
      
    });

    // CKFinder setup (optional with CKEDITOR 4.5+)
    CKFinder.setupCKEditor(null);
  }
</script>


