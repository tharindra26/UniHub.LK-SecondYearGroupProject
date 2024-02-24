<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/settings_style.css">

<div class="container">
    <div class="inner-container">
        <div class="settings-text">
            <p>Manage Event</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">

                <a href="<?php echo URLROOT ?>/events/editProfileImage/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-regular fa-images"></i>
                        </div>
                        <div class="option-text">Profile Image & Cover Image</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/events/editContactDetails/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div class="option-text">Contact Details</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/events/editPlacement/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div class="option-text">Placement</div>
                    </div>
                </a>

                <a href="<?php echo URLROOT ?>/events/editDescription/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-align-right"></i>
                        </div>
                        <div class="option-text">Description</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/events/editCategories/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Event Categories</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/events/editCountdown/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div class="option-text">Countdown</div>
                    </div>
                </a>

                <a href="<?php echo URLROOT ?>/events/editAnnouncements/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div class="option-text">Announcements</div>
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
<script src="<?php echo URLROOT ?>/js/events/settings.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>