<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editProfileImage_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Profile Image & Cover Image</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/events/editProfileImage/<?php echo $data['id'] ?>" method="post"
                        enctype="multipart/form-data">
                        <h3>Profile Image</h3>
                        <div class="profile-img-box">
                            <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $data['event_profile_image'] ?>"
                                alt="">
                        </div>

                        <div class="input-box">
                            <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="profileImageUpload" name="event_profile_image"
                                value="<?php echo $data['event_profile_image'] ?>" accept="image/*">
                            <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp Choose a image</button>
                            <span id="profile-img-txt">No file chosen, yet.</span>
                            <?php if (!empty($data['event_profile_image_err'])): ?>
                                <span class="error-message">
                                    <?php echo $data['event_profile_image_err']; ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3>Cover Image</h3>
                        <div class="cover-img-box">
                            <img src="<?php echo URLROOT ?>/img/events/events_cover_images/<?php echo $data['event_cover_image'] ?>"
                                alt="">
                        </div>

                        <div class="input-box">
                            <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution:
                                1600x900 pixels. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="coverImageUpload" name="event_cover_image"
                                value="<?php echo $data['event_cover_image'] ?>" accept="image/*">
                            <button type="button" id="custom-cover-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp Choose a image</button>
                            <span id="cover-img-txt">No file chosen, yet.</span>
                            <?php if (!empty($data['event_cover_image_err'])): ?>
                                <span class="error-message">
                                    <?php echo $data['event_cover_image_err']; ?>
                                </span>
                            <?php endif; ?>
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
<script src="<?php echo URLROOT ?>/js/events/editProfileImage.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>