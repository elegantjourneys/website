<nav aria-label="breadcrumb" class="pt-3">
  <ol class="breadcrumb px-2 py-1 m-0" style="--bs-breadcrumb-divider: '>';">
	<?php
		foreach($data['breadcrumbs'] as $breadCrumb)
		{
			if($breadCrumb['link_url'])
			{
	?>
				<li class="breadcrumb-item">
				  <a href="<?=$breadCrumb['link']?>" class="text-decoration-none"><?=$breadCrumb['label']?></a>
				</li>
	 <?php
			}
			else
			{
	?>
				<li class="breadcrumb-item active" aria-current="page">
				  <?=$breadCrumb['label']?>
				</li>
	<?php
			}
		}
	?>
  </ol>
</nav>