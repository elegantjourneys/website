<!-- <div class="row" style='border:0px solid red;'>
    <?php

    $this->Paginator->generateUrl([

        //'sort' => null,
        //'direction' => null,
        /*  @$this->passedArgs[0],
        @$this->passedArgs[1],
        @$this->passedArgs[2],
        @$this->passedArgs[3], */
        //'?'=>$_GET


    ]);

    ?>
    <div class="col-md-12 text-center">
        <ul class="pagination pagination-mg">
            <li>
                <?php
                echo $this->Paginator->prev(
                    __('<i class="fa fa-arrow-left"></i>'),
                    array("escape" => false),
                    null,
                    array('class' => 'prev disabled', "escape" => false)
                );

                ?>
            </li>
                <?php
                    echo $this->Paginator->numbers(array("tag" => "li", "currentClass" => "active", "currentTag" => "a class='active'", "separator" => "<li />"));
                ?>
            <li>
                <?php
                echo $this->Paginator->next(
                    __('<i class="fa fa-arrow-right"></i>'),
                    array("class" => "prev disabled", "escape" => false),
                    __('<i class="fa fa-arrow-right"></i>'),
                    array("class" => "prev disabled", "escape" => false)
                );

                ?></li>

        </ul>
        <p>
            <?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?>
        </p>

    </div>
</div> -->

<div class="col-sm-12 col-md-5">
    <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">
        <?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?>
    </div>
</div>
<div class="col-sm-12 col-md-7">
    <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
       <?php /* ?> <ul class="pagination">
            <li class="paginate_button page-item previous disabled" id="add-row_previous">
                <!-- <a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a> -->
                <?php
                echo $this->Paginator->prev(
                    __('<i class="fa fa-arrow-left"></i>'),
                    array("escape" => false),
                    null,
                    array('class' => 'page-link disabled', "escape" => false)
                );

                ?>
            </li>
            <!-- <li class="paginate_button page-item active"><a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
            <li class="paginate_button page-item "><a href="#" aria-controls="add-row" data-dt-idx="2" tabindex="0" class="page-link">2</a></li> -->
            <?php
                    echo $this->Paginator->numbers(array("tag" => "li", "currentClass" => "paginate_button page-item active", "currentTag" => "a class='page-link active'", "separator" => "<li />"));
                ?>
            <li class="paginate_button page-item next" id="add-row_next">
                <!-- <a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a> -->
                 <?php
                echo $this->Paginator->next(
                    __('<i class="fa fa-arrow-right"></i>'),
                    array("class" => "page-link disabled", "escape" => false),
                    __('<i class="fa fa-arrow-right"></i>'),
                    array("class" => "page-link disabled", "escape" => false)
                );

                ?>
            </li>
        </ul><?php */ ?>
<ul class="pagination">
    <?= $this->Paginator->prev('<i class="fa fa-arrow-left"></i>', ['escape' => false]) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next('<i class="fa fa-arrow-right"></i>', ['escape' => false]) ?>
</ul>
    </div>
</div>