<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/editSocialMedia_style.css">

<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Update Social Media Handles</header>
            <form class="form"
                action="<?php echo URLROOT; ?>/organizations/editSocialMedia/<?php echo $data['organization_id'] ?>"
                method="post" enctype="multipart/form-data">

                <div class="column">
                    <div class="input-box">
                        <label for="">Website</label>
                        <input type="text" name="website_url" id=""
                            value="<?php echo $data['website_url'] ?>" placeholder="Enter organization website">
                        <?php if (!empty($data['website_url_err'])): ?>
                            <span class="error-message"><?php echo $data['website_url_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Linekin</label>
                        <input type="text" name="linkedin" id=""
                            value="<?php echo $data['linkedin'] ?>" placeholder="Enter the organization linkedin">
                        <?php if (!empty($data['linkedin_err'])): ?>
                            <span class="error-message"><?php echo $data['linkedin_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                <div class="input-box">
                        <label for="">Facebook</label>
                        <input type="text" name="facebook" id=""
                            value="<?php echo $data['facebook'] ?>" placeholder="Enter the facebook">
                        <?php if (!empty($data['facebook_err'])): ?>
                            <span class="error-message"><?php echo $data['facebook_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Instagram</label>
                        <input type="text" name="instagram" id=""
                            value="<?php echo $data['instagram'] ?>" placeholder="Enter the instagram">
                        <?php if (!empty($data['instagram_err'])): ?>
                            <span class="error-message"><?php echo $data['instagram_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <button class="submit-btn" type="submit">Update Social Media</button>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT ?>/js/organizations/editSocialMedia.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>