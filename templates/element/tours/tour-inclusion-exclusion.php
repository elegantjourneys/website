<section id="inclusions" class="col-lg-9 col-xl-9 col-xxl-9 col-md-11 mx-lg-auto mx-3 mb-3">
    <div class="d-lg-flex justify-content-between">
        <div class="col-lg-5 col">
            <div class="wsbold font-3 blue mb-3">Tour Inclusions</div>
                <?php
                    foreach($data['inclusion_exclusion']['inclusion'] as $inclusion)
                    {
                ?>
                <div class="d-flex align-items-start ">
                    <div class="me-2"><img src="<?=WEBROOT?>tours/image/include.png" width="15"></div>
                    <div><?=$inclusion?></div>
                </div>
                <?php
                    }
                ?>
              
            </div>

        <div class="col-lg-5 col">
            <div class="wsbold font-3 blue mb-3">Tour Exclusions</div>
                <?php
                    foreach($data['inclusion_exclusion']['exclusion'] as $exclusion)
                    {
                ?>
                <div class="d-flex align-items-start">
                    <div class="me-2"><img src="<?=WEBROOT?>tours/image/exclude.png" width="15"></div>
                    <div><?=$exclusion?></div>
                </div>
              <?php
                    }
              ?>
            </div>
        </div>
    </div>
</section>