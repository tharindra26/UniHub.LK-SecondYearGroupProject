<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/edit-contact-details_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Description</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/users/editDescription/<?php echo $data['id'] ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="column">
                            <div class="input-box">
                                <label for="">Profile Title</label>
                                <input type="text" name="profile_title"  id="" placeholder="Enter the profile title" value="<?php echo $data['profile_title'] ?>">
                                <?php if (!empty($data['profile_title_err'])): ?>
                                    <span class="error-message"><?php echo $data['profile_title_err']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="column">
                            <div class="input-box">
                                <label for="">Description</label>
                                <textarea id="description" name="description" placeholder="Enter the description" rows="6" cols="50"><?php echo $data['description'] ?></textarea>
                                <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message"><?php echo $data['description_err']; ?></span>
                                <?php endif; ?>
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
<script src="<?php echo URLROOT ?>/js/events/changeDescription.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>