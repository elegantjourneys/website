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
                        ['plugin' => 'Admin', 'controller' => 'Cms', 'action' => 'listing']
                    ); ?>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= @$page_title["1"] ?></a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->create($cmsContent) ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?= @$page_title["1"] ?></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <?= $this->Form->control('CmsPages.name', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'value' => $cmsPage->name ?? ''
                                    ]) ?>
                                </div>
                                <div class="form-group">
                                    <label for="description">Page URL</label>
                                    <?= $this->Form->control('CmsPages.page_url', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'value' => $cmsPage->page_url ?? ''
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