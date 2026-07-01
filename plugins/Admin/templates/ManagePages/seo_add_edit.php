<?php
//echo "<pre>";
//print_r($cmsPage);exit; ?>
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
                        ['plugin' => 'Admin', 'controller' => 'ManagePages', 'action' => 'managePage', $cmsPage->id],
                        ['escape' => false]
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
                <?= $this->Form->create($cmsPage) ?>
                <div class="card">
                    <div class="card-header">
                        <div class="page-header-box">
                            <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">
                                <!-- Left: Title -->
                                <h4 class="card-title text-white mb-0">
                                    <?= @$page_title["1"] ?>
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
                                    <label>Meta Title</label>
                                    <?= $this->Form->control('cms_page_seo_tag.meta_title', [
                                        'label' => false,
                                        'class' => 'form-control'
                                    ]) ?>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <?= $this->Form->control('cms_page_seo_tag.meta_keyword', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'type' => 'textarea'
                                    ]) ?>
                                </div>

                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <?= $this->Form->control('cms_page_seo_tag.meta_description', [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'type' => 'textarea'
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Save SEO</button> 
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>