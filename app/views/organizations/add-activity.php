<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/add-activity_style.css">

<div class="container">
    <div class="inner-container">
        <div class="top-part">
            <header>Add Organization Activity</header>
        </div>
        <div class="bottom-part">
            <div class="bottom-left">
                <div class="add-event-form">

                    <form class="form"
                        action="<?php echo URLROOT; ?>/organizations/addActivity/<?php echo $data['organization_id'] ?>"
                        method="post" enctype="multipart/form-data">




                        <div class="input-box">
                            <label for="">Activity Title</label>
                            <input type="text" name="activity_title" id="" value="<?php echo $data['activity_title'] ?>"
                                placeholder="Enter the activity title">
                            <?php if (!empty($data['activity_title_err'])): ?>
                                <span class="error-message"><?php echo $data['activity_title_err']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="input-box">
                            <label for="">Activity Description</label>
                            <textarea id="eventDescription" name="activity_description"
                                value="<?php echo $data['activity_description'] ?>"
                                placeholder="Enter the activity description"><?php echo $data['activity_description'] ?></textarea>
                            <?php if (!empty($data['activity_description_err'])): ?>
                                <span class="error-message"><?php echo $data['activity_description_err']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="input-box">
                            <H3>Activity Image</H3>
                            <label for="">Not Manditory. Recommend to upload a image with a 16:9 aspect ratio. Accepted formats: JPG, PNG.</label>
                            <input type="file" id="activityImageUpload" name="activity_image"
                                value="<?php echo $data['activity_image'] ?>" accept="image/*">
                            <button type="button" id="custom-activity-img-btn"><i class="fa-regular fa-file-image"></i>
                                &nbsp Choose a image</button>
                                
                            <span id="activity-img-txt">
                                <?php echo !empty($data['activity_image']) ? $data['activity_image'] : 'No file chosen, yet.'; ?>
                            </span>

                            <?php if (!empty($data['activity_image_err'])): ?>
                                <span class="error-message"><?php echo $data['activity_image_err']; ?></span>
                            <?php endif; ?>
                        </div>


                        <button class="submit-btn" type="submit">Submit Activity</button>
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
<script src="<?php echo URLROOT ?>/js/organizations/add-activity.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>