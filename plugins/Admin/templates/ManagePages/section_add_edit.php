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
                    <?= $this->Html->link(
                        $page_title[0] ?? '',
                        ['plugin' => 'Admin', 'controller' => 'ManagePages', 'action' => 'managePage', $pageId]
                    ); ?>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        $page_title[1] ?? '',
                        ['plugin' => 'Admin', 'controller' => 'ManagePages', 'action' => 'sectionListing', $pageId]
                    ); ?>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= @$page_title["2"] ?></a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->create($section, ['type' => 'file']) ?>
                <div class="card">
                    <div class="card-header">
                        <div class="page-header-box">
                            <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">
                                <!-- Left: Title -->
                                <h4 class="card-title text-white mb-0">
                                    <?= @$page_title["2"] ?>
                                </h4>
                                <!-- Middle: Page Name -->
                                <span class="page-name ms-md-auto">
                                    <?= $cmsPage->name ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <?= $this->Form->control('name', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'value' => $section->name ?? ''
                                    ]) ?>
                                </div>
                                <div class="form-group">
                                    <label for="description">Code</label>
                                    <?= $this->Form->control('code', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'value' => $section->code ?? '',
                                        'oninput' => 'this.value = this.value.toUpperCase()',
  										'maxlength' => "100"
                                    ]) ?>
                                </div>
                                <div class="form-group">
                                    <label for="description">Type</label>
                                    <?= $this->Form->control('content_category_id', [
                                        'label' => false,
                                        'options' => $contentCategories,
                                        'class' => 'form-control',
                                        'value' => $section->content_category_id ?? '',
                                        'disabled' => !empty($section->id) ? true : false
                                    ]) ?>

                                    <?= $this->Form->control('page_id', [
                                        'type' => 'hidden',
                                        'value' => $pageId
                                    ]); ?>
                                    <?php if (!empty($section->id)) : ?>
                                        <?= $this->Form->hidden('content_category_id', [
                                            'value' => $section->content_category_id
                                        ]) ?>
                                    <?php endif; ?>
                                </div>

                                <!-- GENERAL -->

                                <div id="generalSection" class="dynamic-section my-5 bg-light rounded-3" style="display:none;">

                                    <div id="generalWrapper">

                                        <?php if (!empty($generalData)) : ?>
                                            <?php foreach ($generalData as $i => $row) : ?>
                                                <div class="general-item border p-3 mb-3 rounded">

                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="general[<?= $i ?>][title]"
                                                            value="<?= h($row->title) ?>"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea id="editor_<?= $i ?>"
                                                            name="general[<?= $i ?>][description]"
                                                            class="form-control ckeditor"><?= h($row->description) ?></textarea>
                                                    </div>

                                                    <?php /* ?><button type="button" class="btn btn-danger removeRow">Remove</button><?php */ ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="general-item border p-3 mb-3 rounded">

                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="general[0][title]" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="general[0][description]" class="form-control ckeditor"></textarea>
                                                </div>

                                                <?php /* ?><button type="button" class="btn btn-danger removeRow">Remove</button><?php */ ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <?php /* ?><div class="text-end me-4">
                                        <button type="button" id="addMore" class="btn btn-primary mb-4">+ Add More</button>
                                    </div><?php */ ?>
                                </div>

                                <!-- PRICE -->
                                <div id="priceSection" class="dynamic-section" style="display:none;">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <?= $this->Form->control('price', [
                                            'label' => false,
                                            'class' => 'form-control'
                                        ]) ?>
                                    </div>
                                </div>

                                <!-- VIDEO -->
                                <div id="videoSection" class="dynamic-section my-5 bg-light rounded-3" style="display:none;">
                                    <div id="video-wrapper">
                                        <?php if (!empty($videoData)) : ?>
                                            <?php foreach ($videoData as $i => $video) : ?>
                                                <div class="video-row mb-3">
                                                    <div class="form-group my-2">
                                                        <label>Title</label>
                                                        <input type="text" name="videos[<?= $i ?>][title]"
                                                            value="<?= h($video->title) ?>"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label>Video URL</label>
                                                        <input type="text" name="videos[<?= $i ?>][video_url]"
                                                            value="<?= h($video->video_url) ?>"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label>Video Type</label>
                                                        <select name="videos[<?= $i ?>][video_type]" class="form-control">
                                                            <option value="internal" <?= $video->video_type == 'internal' ? 'selected' : '' ?>>Internal</option>
                                                            <option value="youtube" <?= $video->video_type == 'youtube' ? 'selected' : '' ?>>YouTube</option>
                                                        </select>
                                                    </div>
                                                    <!-- DELETE BUTTON -->
                                                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-video">
                                                        Delete
                                                    </button>
                                                </div>
                                                <!--  <?= $this->Form->control("videos.$i.title", [
                                                            'label' => 'Title',
                                                            'class' => 'form-control',
                                                            'value' => $video->title
                                                        ]) ?>

                                                    <?= $this->Form->control("videos.$i.video_url", [
                                                        'label' => 'Video URL',
                                                        'class' => 'form-control',
                                                        'value' => $video->video_url
                                                    ]) ?>

                                                    <?= $this->Form->control("videos.$i.video_type", [
                                                        'type' => 'select',
                                                        'options' => ['internal' => 'Internal', 'youtube' => 'YouTube'],
                                                        'class' => 'form-control',
                                                        'value' => $video->video_type
                                                    ]) ?>
                                                </div> -->
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="video-row mb-3">
                                                <div class="form-group my-2">
                                                    <label>Title</label>
                                                    <input type="text" name="videos[0][title]" class="form-control">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label>Video URL</label>
                                                    <input type="text" name="videos[0][video_url]" class="form-control">
                                                </div>
                                                <div class="form-group my-2">
                                                    <label>Video Type</label>
                                                    <select name="videos[0][video_type]" class="form-control">
                                                        <option value="internal">Internal</option>
                                                        <option value="youtube">YouTube</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--  <?= $this->Form->control("videos.0.title", [
                                                        'label' => 'Title',
                                                        'class' => 'form-control'
                                                    ]) ?>

                                                <?= $this->Form->control("videos.0.video_url", [
                                                    'label' => 'Video URL',
                                                    'class' => 'form-control'
                                                ]) ?>

                                                <?= $this->Form->control("videos.0.video_type", [
                                                    'type' => 'select',
                                                    'options' => ['internal' => 'Internal', 'youtube' => 'YouTube'],
                                                    'class' => 'form-control'
                                                ]) ?>
                                            </div> -->
                                        <?php endif; ?>
                                    </div>

                                    <div class="text-end me-4"><button type="button" class="btn btn-primary" onclick="addVideo()">Add More</button></div>
                                </div>

                                <!-- IMAGE -->

                                <div id="imageSection" class="dynamic-section my-5 bg-light rounded-3" style="display:none;">
                                    <div id="image-wrapper">

                                        <?php if (!empty($imageData)) : ?>
                                            <?php foreach ($imageData as $i => $img) : ?>
                                                <div class="image-row mb-3">

                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="images[<?= $i ?>][title]"
                                                            value="<?= h($img->title) ?>"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Upload Image</label>
                                                        <input type="file" name="images[<?= $i ?>][image]" class="form-control">
                                                    </div>

                                                    <!-- OLD IMAGE PREVIEW -->
                                                    <div class="mt-2">
                                                        <!-- OLD IMAGE -->
                                                        <input type="hidden" name="images[<?= $i ?>][old_image]" value="<?= h($img->image) ?>">

                                                        <img src="<?= $this->Url->build('/trains/assets/images/' . $img->image) ?>" width="120">
                                                    </div>

                                                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-image">
                                                        Delete
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="image-row mb-3">


                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="images[0][title]" class="form-control mb-2" placeholder="Title">
                                                </div>

                                                <div class="form-group">
                                                    <label>Upload Image</label>
                                                    <input type="file" name="images[0][image]" class="form-control">
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary" onclick="addImage()">Add More</button>
                                    </div>
                                </div>

                                <!-- ITINERARY -->
                                <div id="itinerarySection" class="dynamic-section my-4 p-4 bg-light" style="display:none;">

                                    <div id="itinerary-wrapper">

                                        <!-- MAIN INFO -->
                                        <div class="mb-3">

                                            <!-- Itinerary Name -->
                                            <div class="form-group">
                                                <label>Itinerary Name</label>
                                                <input type="text"
                                                    name="itinerary[title]"
                                                    class="form-control mb-2"
                                                    placeholder="Itinerary Title"
                                                    value="<?= h($itineraryData->title ?? '') ?>">
                                            </div>

                                            <!-- Page URL -->
                                            <div class="form-group">
                                                <label>Page URL</label>
                                                <input type="text"
                                                    name="itinerary[page_url]"
                                                    class="form-control mb-2"
                                                    placeholder="Page URL"
                                                    value="<?= h($itineraryData->page_url ?? '') ?>">
                                            </div>

                                            <!-- TOTAL DAYS -->
                                            <div class="form-group">
                                                <label>Total Days</label>
                                                <select name="itinerary[total_days]" id="total_days" class="form-control mb-3">
                                                    <option value="">Select Days</option>
                                                    <?php for ($i = 1; $i <= 15; $i++): ?>
                                                        <option value="<?= $i ?>" <?= (!empty($itineraryData) && $itineraryData->total_days == $i) ? 'selected' : '' ?>>
                                                            <?= $i ?> Days
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>

                                            <!-- IMAGE -->
                                            <div class="form-group">
                                                <label>Upload Main Image</label>

                                                <input type="file" name="itinerary[image]" class="form-control mb-2">

                                                <!-- OLD IMAGE -->
                                                <input type="hidden" name="itinerary[old_image]" value="<?= h($itineraryData->image ?? '') ?>">

                                                <!-- PREVIEW -->
                                                <?php if (!empty($itineraryData->image)) : ?>
                                                    <div class="mt-2">
                                                        <img src="<?= $this->Url->build('/trains/assets/images/' . $itineraryData->image) ?>" width="150">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>

                                        <!-- DAYS -->
                                        <div id="days-wrapper">

                                            <?php if (!empty($itineraryData->cms_content_itinerary_days)) : ?>

                                                <?php foreach ($itineraryData->cms_content_itinerary_days as $i => $day) : ?>

                                                    <div class="day-block border p-3 mb-3 bg-info rounded-3">

                                                        <h5>Day <?= $i + 1 ?></h5>

                                                        <input type="hidden" name="itinerary[days][<?= $i ?>][id]" value="<?= $day->id ?>">
                                                        <input type="hidden" name="itinerary[days][<?= $i ?>][day_count]" value="<?= $day->day_count ?>">

                                                        <input type="text" name="itinerary[days][<?= $i ?>][week_day]"
                                                            value="<?= h($day->week_day) ?>" class="form-control mb-2">

                                                        <input type="text" name="itinerary[days][<?= $i ?>][city]"
                                                            value="<?= h($day->city) ?>" class="form-control mb-2">

                                                        <input type="text" name="itinerary[days][<?= $i ?>][title]"
                                                            value="<?= h($day->title) ?>" class="form-control mb-2">

                                                        <!-- DESCRIPTIONS -->
                                                        <div class="desc-wrapper">

                                                            <?php foreach ($day->cms_content_itinerary_descriptions as $j => $desc) : ?>

                                                                <textarea id="desc_<?= $i ?>_<?= $j ?>"
                                                                    name="itinerary[days][<?= $i ?>][descriptions][<?= $j ?>]"
                                                                    class="form-control ckeditor mb-2"><?= h($desc->description) ?></textarea>

                                                            <?php endforeach; ?>

                                                        </div>

                                                        <button type="button" class="btn btn-danger btn-sm remove-day my-3">Delete Day</button>

                                                    </div>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </div>



                                    </div>
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

<script>
    $(document).ready(function() {
        function toggleSections(value) {
            $('.dynamic-section').hide();
            $('.dynamic-section :input').prop('disabled', true);

            if (value == '1') {
                $('#generalSection').show().find(':input').prop('disabled', false);
            } else if (value == '2') {
                $('#priceSection').show().find(':input').prop('disabled', false);
            } else if (value == '3') {
                $('#videoSection').show().find(':input').prop('disabled', false);
            } else if (value == '4') {
                $('#imageSection').show().find(':input').prop('disabled', false);
            } else if (value == '5') {
                $('#itinerarySection').show().find(':input').prop('disabled', false);
            }
        }
        // On change
        $('#content-category-id').change(function() {
            let selected = $(this).val();
            //alert(selected);
            toggleSections(selected);
        });

        // On page load (edit case)
        let selected = $('#content-category-id').val();
        toggleSections(selected);

    });
    $(document).ready(function() {

        let index = <?= !empty($generalData) ? count($generalData) : 1 ?>;

        $('#addMore').click(function() {

            let textareaId = 'editor_' + index;

            let html = `
        <div class="general-item border p-3 mb-3 rounded">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="general[${index}][title]" class="form-control">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea id="${textareaId}" name="general[${index}][description]" class="form-control"></textarea>
            </div>

            <button type="button" class="btn btn-danger removeRow">Remove</button>
        </div>`;

            $('#generalWrapper').append(html);

            // Initialize CKEditor for new textarea
            CKEDITOR.replace(textareaId);

            index++;
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('.general-item').remove();
        });

    });
    $(document).ready(function() {
        $('.ckeditor').each(function() {
            CKEDITOR.replace($(this).attr('id'));
        });
    });
</script>
<script>
    function addVideo() {
        let index = document.querySelectorAll('.video-row').length;

        let html = `
        <div class="video-row mb-3 my-5 bg-light rounded-3">
        <div class="form-group my-2">
            <label>Title</label>
            <input type="text" name="videos[${index}][title]" class="form-control mb-1" placeholder="Title">
        </div>
        <div class="form-group my-2">
            <label>Video URL</label>

            <input type="text" name="videos[${index}][video_url]" class="form-control mb-1" placeholder="Video URL">
        </div>
        <div class="form-group my-2">
            <label>Video Type</label>

            <select name="videos[${index}][video_type]" class="form-control">
                <option value="internal">Internal</option>
                <option value="youtube">YouTube</option>
            </select>
        </div>
             <!-- DELETE BUTTON -->
             <div class="mb-3 pb-2"><button type="button" class="btn btn-danger btn-sm mt-2 remove-video">
                Delete
            </button></div>
    </div>
            
    `;

        document.getElementById('video-wrapper').insertAdjacentHTML('beforeend', html);
    }
</script>
<script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-video')) {
            e.target.closest('.video-row').remove();
        }
    });
</script>
<script>
    function addImage() {
        let index = document.querySelectorAll('.image-row').length;

        let html = `
        <div class="image-row mb-3">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="images[${index}][title]" class="form-control mb-2" placeholder="Title">
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="images[${index}][image]" class="form-control">
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-image">Delete</button>
            </div>
    `;

        document.getElementById('image-wrapper').insertAdjacentHTML('beforeend', html);
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.image-row').remove();
        }
    });
</script>
<script>
    document.getElementById('total_days').addEventListener('change', function() {

        let totalDays = parseInt(this.value);
        let wrapper = document.getElementById('days-wrapper');

        // 🔥 Destroy old editors (important)
        if (typeof CKEDITOR !== 'undefined') {
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].destroy(true);
            }
        }

        wrapper.innerHTML = ''; // clear old

        if (!totalDays) return;

        for (let i = 0; i < totalDays; i++) {

            let textareaId = `desc_${i}_0`;

            let html = `
        <div class="day-block border p-3 mb-3 bg-info rounded-3">

            <h5>Day ${i + 1}</h5>

            <input type="hidden" name="itinerary[days][${i}][day_count]" value="${i + 1}">
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Week Day</label>
                    <input type="text" name="itinerary[days][${i}][week_day]" class="form-control mb-2" placeholder="Week Day">
                </div>

                <div class="form-group col-md-6">
                    <label>City</label>
                    <input type="text" name="itinerary[days][${i}][city]" class="form-control mb-2" placeholder="City">
                </div>
            </div>

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="itinerary[days][${i}][title]" class="form-control mb-2" placeholder="Title">
            </div>

            <div class="form-group">
                <label>Description</label>
                <div class="desc-wrapper">
                    <textarea id="${textareaId}" name="itinerary[days][${i}][descriptions][0]" class="form-control mb-2" placeholder="Description"></textarea>
                </div>
            </div>

        </div>`;

            wrapper.insertAdjacentHTML('beforeend', html);

            // 🔥 Initialize CKEditor for this textarea
            setTimeout(function() {
                if (!CKEDITOR.instances[textareaId]) {
                    CKEDITOR.replace(textareaId, {
                        height: 120
                    });
                }
            }, 100);
        }
    });
</script>
<script>
    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('add-desc')) {

            let wrapper = e.target.previousElementSibling;
            let index = wrapper.querySelectorAll('textarea').length;

            let name = wrapper.querySelector('textarea').name.replace(/\[\d+\]$/, '');

            let html = `<textarea name="${name}[${index}]" class="form-control mb-2"></textarea>`;
            wrapper.insertAdjacentHTML('beforeend', html);
        }
    });
</script>
<script>
    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('remove-day')) {

            if (confirm('Delete this day?')) {

                let block = e.target.closest('.day-block');

                // destroy CKEditor inside block
                block.querySelectorAll('textarea').forEach(function(el) {
                    if (CKEDITOR.instances[el.id]) {
                        CKEDITOR.instances[el.id].destroy(true);
                    }
                });

                block.remove();

                updateTotalDays();
            }
        }
    });

    function updateTotalDays() {
        let count = document.querySelectorAll('.day-block').length;
        document.getElementById('total_days').value = count;
    }
</script>