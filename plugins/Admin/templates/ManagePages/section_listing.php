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
                    <a href="<?= $this->Url->build(['action' => 'manage-page', $pageId]) ?>"><?= @$page_title["0"] ?></a>
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
                            <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                                <!-- Left: Title -->
                                <h4 class="card-title text-white mb-0">
                                    <?= @$page_title["1"] ?>
                                </h4>

                                <!-- Middle: Page Name -->
                                <span class="page-name ms-md-auto">
                                    <?= $cmsPage->name ?>
                                </span>

                                <!-- Right: Button -->
                                <?= $this->Html->link(
                                    '<i class="fa fa-plus me-1"></i> Add Section',
                                    ['action' => 'sectionAddEdit', $pageId],
                                    [
                                        'class' => 'btn btn-light btn-sm ms-md-2',
                                        'escape' => false
                                    ]
                                ); ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 250.113px;">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending" style="width: 364.3px;">Code</th>
                                                    <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 200px;">Type</th>
                                                    <th style="width: 20%;">Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php foreach ($sections as $page): ?>
                                                    <tr>
                                                        <td class="sorting_1"><?= $page->name ?></td>
                                                        <td><?= $page->code ?></td>
                                                        <td><?= $page->category_name ?></td>
                                                        <td>
                                                            <?= $this->Html->link(
                                                                '<i class="fa fa-edit"></i>',
                                                                ['action' => 'sectionAddEdit', $pageId, $page->id],
                                                                [
                                                                    'class' => 'btn btn-link btn-primary btn-sm me-2',
                                                                    'escape' => false
                                                                ]
                                                            ); ?>
                                                            <?= $this->Form->postLink(
                                                                '<i class="fa fa-trash"></i>',
                                                                ['action' => 'sectionDelete', $pageId, $page->id],
                                                                [
                                                                    'class' => 'btn btn-link btn-danger btn-sm',
                                                                    'escape' => false,
                                                                    'confirm' => 'Are you sure you want to delete this page?'
                                                                ]
                                                            ); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                                <div class="row">
                                    <?php echo $this->element("content-pagination"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>