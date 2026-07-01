<?php
	echo "<pre>";
	print_r($data);
	echo "</pre>";
?>
<div>
	<h4 class="fw-semibold">Tour Inclusions</h4>
	<ul class="fs-14 list-unstyled">
		<?php
                foreach($data['inclusion_exclusion']['inclusion'] as $inclusion)
                {
        ?>
		<li class="d-flex align-items-center gap-2"> <i class="ri-check-double-line"></i> <?=$inclusion?> </li>
		<?php
                }
        ?>
		
	</ul>
</div>
<div>
	<h4 class="fw-semibold">Tour Exclusions</h4>
	<ul class="fs-14 list-unstyled">
		<?php
            foreach($data['inclusion_exclusion']['exclusion'] as $exclusion)
            {
        ?>
		<li class="d-flex align-items-center gap-2"> <i class="ri-close-line"></i><?=$exclusion?> </li>
		<?php
            }
        ?>
		
	</ul>
</div>