<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/opportunities/settings_style.css">

<div class="container">
    <div class="inner-container">
        <div class="settings-text">
            <p>Manage Opportunity Profile</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">

                <a href="<?php echo URLROOT ?>/opportunities/updateOpportunity/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-wrench"></i>
                        </div>
                        <div class="option-text">Update Opportunity Profile</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/events/editContactDetails/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-regular fa-trash-can"></i>
                        </div>
                        <div class="option-text">Delete Opportunity</div>
                    </div>
                </a>

            </div>
            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/settings/settings.jpg" alt="">
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/opportunities/settings.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>