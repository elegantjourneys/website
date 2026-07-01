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
                    <a href="<?= $this->Url->build(['controller' => 'Cms', 'action' => 'listing']) ?>"><?= @$page_title["0"] ?></a>
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
                <div class="card">
                    <div class="card-header">
                        <div class="page-header-box">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="page-title">
                                    <i class="fa fa-file-alt me-2"></i>
                                    <?= @$page_title["1"] ?>
                                </div>

                                <div class="page-name">
                                    <?php echo $cmsPage->name; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">



                                <div class="container mt-4">
                                    <div class="row g-4">

                                        <!-- List Section -->
                                        <div class="col-md-4">
                                            <a href="<?= $this->Url->build(['controller' => 'ManagePages', 'action' => 'sectionListing/' . $cmsPage->id]) ?>" class="card-link-wrapper">
                                                <div class="dashboard-card card-blue">
                                                    <div class="card-icon">
                                                        <i class="fas fa-list"></i>
                                                    </div>
                                                    <div class="card-info-detail">
                                                        <h3>List Sections</h3>
                                                        <p>View and manage CMS pages.</p>
                                                    </div>
                                                    <div class="card-link-text">View All</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Manage SEO -->
                                        <div class="col-md-4">
                                            <a href="<?= $this->Url->build(['controller' => 'ManagePages', 'action' => 'seoAddEdit/' . $cmsPage->id]) ?>" class="card-link-wrapper">
                                            <div class="dashboard-card card-green">
                                                <div class="card-icon">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                                <div class="card-info-detail">
                                                    <h3>SEO Pages</h3>
                                                    <p>Manage SEO settings for CMS pages.</p>
                                                </div>
                                                <div class="card-link-text">Manage SEO</div>
                                            </div>
                                            </a>
                                        </div>

                                        <!-- Add Section -->
                                        <div class="col-md-4">
                                            <a href="<?= $this->Url->build(['controller' => 'ManagePages', 'action' => 'sectionAddEdit/' . $cmsPage->id]) ?>" class="card-link-wrapper">
                                                <div class="dashboard-card card-orange">
                                                    <div class="card-icon">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="card-info-detail">
                                                        <h3>New Section</h3>
                                                        <p>Create a new CMS section.</p>
                                                    </div>
                                                    <div class="card-link-text">Add Now</div>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>