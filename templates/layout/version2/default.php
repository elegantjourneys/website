<!DOCTYPE html>
<html lang="en">
<?php echo $this->element("version2/head_section");?>
<body>  
    <?php echo $this->element('version2/header'); ?>
    <main class="w-100">
        
        <?php echo $this->element('version2/enquiry_modal'); ?>
        
        <?= $this->fetch('content') ?>     
        <?php echo $this->element('version2/our_partner'); ?>
        <?php echo $this->element('version2/footer'); ?>
    </main>
    <!-- Full-Page Loader -->
    <div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-none align-items-center justify-content-center bg-white bg-opacity-75" style="z-index: 1055;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
 <?php echo $this->element('version2/whatsapp'); ?>
    <?php echo $this->element('version2/script_section'); ?>
</body>
</html>