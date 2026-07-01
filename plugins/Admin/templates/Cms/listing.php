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
                    <a href="#"><?= @$page_title["0"] ?></a>
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
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= @$page_title["1"] ?></h4>
                            <?= $this->Html->link(
                                '<i class="fa fa-plus"></i> Add Page',
                                ['action' => 'add'],
                                [
                                    'class' => 'btn btn-primary btn-round ms-auto',
                                    'escape' => false
                                ]
                            ); ?>
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
                                                    <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Page URL: activate to sort column ascending" style="width: 364.3px;">Page URL</th>
                                                    <th style="width: 20%;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <tbody>
                                                <?php foreach ($cmsPages as $page): ?>
                                                    <tr>
                                                        <td><?= h($page->name) ?></td>
                                                        <td><?= h($page->page_url) ?></td>

                                                        <td>
                                                            <div class="form-button-action">

                                                             <?= $this->Html->link(
                                                                    '<i class="fa fa-cog"></i>',
                                                                    ['controller' => 'ManagePages', 'action' => 'manage-page', $page->id],
                                                                    [
                                                                        'escape' => false,
                                                                        'class' => 'btn btn-link btn-warning btn-lg',
                                                                        'data-bs-toggle' => 'tooltip',
                                                                        'title' => 'Manage Page'
                                                                    ]
                                                                ) ?>
                                                                <?= $this->Html->link(
                                                                    '<i class="fa fa-edit"></i>',
                                                                    ['action' => 'edit', $page->id],
                                                                    [
                                                                        'escape' => false,
                                                                        'class' => 'btn btn-link btn-primary btn-lg',
                                                                        'data-bs-toggle' => 'tooltip',
                                                                        'title' => 'Edit'
                                                                    ]
                                                                ) ?>

                                                                <?= $this->Form->postLink(
                                                                    '<i class="fa fa-times"></i>',
                                                                    ['action' => 'delete', $page->id],
                                                                    [
                                                                        'escape' => false,
                                                                        'class' => 'btn btn-link btn-danger',
                                                                        'confirm' => 'Are you sure?'
                                                                    ]
                                                                ) ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="add-row_previous"><a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item next" id="add-row_next"><a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div> -->
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