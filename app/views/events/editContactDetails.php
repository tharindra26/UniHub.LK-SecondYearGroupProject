<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/change-contact-details_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Contact Details</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/events/add" method="post"
                        enctype="multipart/form-data">
                        <div class="column">
                            <div class="input-box">
                                <label for="">Organized by</label>
                                <input type="text" name="organized_by" value="" id=""
                                    placeholder="Enter the organization entity">
                                <!-- <?php if (!empty($data['organized_by_err'])): ?>
                                    <span class="error-message"><?php echo $data['organized_by_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Email</label>
                                <input type="text" name="email" value="" id="" placeholder="Enter the email">
                                <!-- <?php if (!empty($data['email_err'])): ?>
                                    <span class="error-message"><?php echo $data['email_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">Contact Number</label>
                                <input type="tel" name="contact_number" value="" id=""
                                    placeholder="Enter the Contact Number">
                                <!-- <?php if (!empty($data['contact_number_err'])): ?>
                                    <span class="error-message"><?php echo $data['contact_number_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Web Address</label>
                                <input type="text" name="web" value="" id="" placeholder="Enter the web">
                                <!-- <?php if (!empty($data['web_err'])): ?>
                                    <span class="error-message"><?php echo $data['web_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">LinkedIn</label>
                                <input type="tel" name="linkedin" value="" id="" placeholder="Enter the linkedin">
                                <!-- <?php if (!empty($data['linkedin_err'])): ?>
                                    <span class="error-message"><?php echo $data['linkedin_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Facebook</label>
                                <input type="text" name="facebook" value="" id="" placeholder="Enter the facebook">
                                <!-- <?php if (!empty($data['facebook_err'])): ?>
                                    <span class="error-message"><?php echo $data['facebook_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">Instagram</label>
                                <input type="tel" name="instagram" value="" id="" placeholder="Enter the Instagram">
                                <!-- <?php if (!empty($data['instagram_err'])): ?>
                                    <span class="error-message"><?php echo $data['instagram_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">Update</button>
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
<script src="<?php echo URLROOT ?>/js/events/add-announcement.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>