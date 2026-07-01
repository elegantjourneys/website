
<nav aria-label="breadcrumb" class="mt-2 small">
	<ol class="breadcrumb small text-secondary">
		 <?php
            foreach($data['breadcrumbs'] as $breadCrumb)
            {
               
                if($breadCrumb['link_url'])
                {
        ?>
					<li class="breadcrumb-item"><a href="<?=$breadCrumb['link']?>"><?=$breadCrumb['title']?></a></li>
		 <?php
                }
                else
                {
        ?>
					<li class="breadcrumb-item active" aria-current="page"><?=$breadCrumb['title']?></li>
		 <?php
                }
            }
        ?>
	</ol>
</nav>