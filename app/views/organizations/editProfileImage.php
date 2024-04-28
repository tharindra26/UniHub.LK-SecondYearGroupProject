<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/editProfileImage_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Profile Image,Cover Image & Board Members Image</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form"
                        action="<?php echo URLROOT; ?>/organizations/editProfileImage/<?php echo $data['organization_id'] ?>"
                        method="post" enctype="multipart/form-data">
                        <h3>Organization Logo</h3>
                        <div class="profile-img-box">
                            <img src="<?php echo URLROOT ?>/img/organizations/organization_profile_images/<?php echo $data['organization_profile_image'] ?>"
                                alt="">
                        </div>

                        <div class="input-box">
                            <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="profileImageUpload" name="organization_profile_image"
                                value="<?php echo $data['organization_profile_image'] ?>" accept="image/*">
                            <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp Choose a image</button>

                            <span id="profile-img-txt">
                                <?php echo (!empty($data['organization_profile_image'])) ? basename($data['organization_profile_image']) : 'No file chosen, yet.'; ?>
                            </span>

                            <?php if (!empty($data['organization_profile_image_err'])): ?>
                                <span class="error-message">
                                    <?php echo $data['organization_profile_image_err']; ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3>Cover Image</h3>
                        <div class="cover-img-box">
                            <img src="<?php echo URLROOT ?>/img/organizations/organization_cover_images/<?php echo $data['organization_cover_image'] ?>"
                                alt="">
                        </div>

                        <div class="input-box">
                            <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution:
                                1600x900 pixels. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="coverImageUpload" name="organization_cover_image"
                                value="<?php echo $data['organization_cover_image'] ?>" accept="image/*">
                            <button type="button" id="custom-cover-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp Choose a image</button>
                            <span id="cover-img-txt">
                                <?php echo (!empty($data['organization_cover_image'])) ? basename($data['organization_cover_image']) : 'No file chosen, yet.'; ?>
                            </span>
                            <?php if (!empty($data['organization_cover_image_err'])): ?>
                                <span class="error-message">
                                    <?php echo $data['organization_cover_image_err']; ?>
                                </span>
                            <?php endif; ?>
                        </div>


                        <h3>Board Members Image</h3>
                        <div class="board-img-box">
                            <img src="<?php echo URLROOT ?>/img/organizations/board_members_images/<?php echo $data['board_members_image'] ?>"
                                alt="">
                        </div>

                        <div class="input-box">
                            <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution:
                                1600x900
                                pixels. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="boardImageUpload" name="board_members_image"
                                value="<?php echo $data['board_members_image'] ?>" accept="image/*">
                            <button type="button" id="custom-board-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp
                                Choose a image</button>
                            <span id="board-img-txt">
                                <?php echo (!empty($data['board_members_image'])) ? basename($data['board_members_image']) : 'No file chosen, yet.'; ?>
                            </span>
                            <?php if (!empty($data['board_members_image_err'])): ?>
                                <span class="error-message"><?php echo $data['board_members_image_err']; ?></span>
                            <?php endif; ?>
                        </div>

                        <button class="submit-btn" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/organizations/editProfileImage.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>