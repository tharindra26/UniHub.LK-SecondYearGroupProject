<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/edit-contact-details_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Password Reset</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/users/passwordChange/<?php echo $data['user_id'] ?>"
                        method="post" enctype="multipart/form-data">

                        <div class="column">
                            <div class="input-box">
                                <label for="">Current Password</label>
                                <input type="password" name="current_password"
                                    value="<?php echo $data['current_password'] ?>" id=""
                                    placeholder="Enter the current password">
                                <?php if (!empty($data['current_password_err'])): ?>
                                <span class="error-message"><?php echo $data['current_password_err']; ?></span>
                            <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">New Password</label>
                                <input type="password" name="new_password" value="<?php echo $data['new_password'] ?>" id=""
                                    placeholder="Enter the new_password">
                                <?php if (!empty($data['new_password_err'])): ?>
                                <span class="error-message"><?php echo $data['new_password_err']; ?></span>
                            <?php endif; ?>
                            </div>
                            <div class="input-box">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" value="<?php echo $data['confirm_password'] ?>" id=""
                                    placeholder="Enter the confirm_password">
                                <?php if (!empty($data['confirm_password_err'])): ?>
                                <span class="error-message"><?php echo $data['confirm_password_err']; ?></span>
                            <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">

                        </div>


                        <button class="submit-btn" type="submit">Reset Password</button>
                    </form>
                </div>
            </div>

            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/changeContactDetails.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>