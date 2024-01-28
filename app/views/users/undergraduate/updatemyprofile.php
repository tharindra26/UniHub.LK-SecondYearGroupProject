<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/updatemyprofile_style.css">

<div class="container">
    <div class="inner-container">
        <div class="settings-text">
            <p>Update Profile</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">


                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div class="option-text">Profile Header</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Profile Image</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Cover Image</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-align-right"></i>
                        </div>
                        <div class="option-text">About</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div class="option-text">Events Added</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Education</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Qualifications</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Skills</div>
                    </div>
                </a>

                <a href="#" class="option-link">
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
<script src="<?php echo URLROOT ?>/js/users/undergraduate/updatemyprofile.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>