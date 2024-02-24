<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editDescription_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Description</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/events/editDescription/<?php echo $data['id'] ?>"
                        method="post" enctype="multipart/form-data">
                       
                        <div class="column">
                            <div class="input-box">
                                <label for="">Description</label>
                                <textarea  id="eventDescription" name="description" value="<?php $data['description'] ?>" placeholder="Enter the description"><?php echo $data['description']; ?></textarea>
                                <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['description_err']; ?>
                                    </span>
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
<script src="<?php echo URLROOT ?>/js/events/editDescription.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>