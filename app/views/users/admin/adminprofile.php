<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/profile_style.css">


<div class="profile-name">
    <h1> <?php echo $data['user']->fname ?></h1>
    <h1> <?php echo $data['user']->lname ?></h1>
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>

