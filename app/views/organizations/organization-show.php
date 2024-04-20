<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organization-show_style.css">
<style>
    .organization-cover-image{
        background-image: url('<?php echo URLROOT ?>/img/organizations/organization_cover_images/<?php echo $data['organization']->organization_cover_image ?>');
    }
</style>

<div class="organization-cover-image" >
</div>
    
<script src="<?php echo URLROOT ?>/js/organizations/organizations-show.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>