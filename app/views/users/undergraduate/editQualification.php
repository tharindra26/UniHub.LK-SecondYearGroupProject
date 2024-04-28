<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/change-contact-details_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Qualification</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/users/editQualification/<?php echo $data['qualification_id'] ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="column">
                        <div class="input-box">
                            <label for="">Qualification Name</label>
                            <input type="text" name="qualification_name" value="<?php echo $data['qualification_name'] ?>" id="" placeholder="Enter the qualification_name">
                            <?php if (!empty($data['qualification_name_err'])): ?>
                                <span class="error-message"><?php echo $data['qualification_name_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="">Institution</label>
                            <input type="text" name="institution" value="<?php echo $data['institution'] ?>" id="" placeholder="Enter the institution">
                            <?php if (!empty($data['institution_err'])): ?>
                                <span class="error-message"><?php echo $data['institution_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="column">
                            <div class="input-box">
                                <label for="">Description</label>
                                <input type="text" name="description"  id="" placeholder="Enter the Description" value="<?php echo $data['description'] ?>">
                                <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message"><?php echo $data['description_err']; ?></span>
                                <?php endif; ?>
                            </div>
                    </div>

                    <div class="column">
                            <div class="input-box">
                                <label for="">Completion Date</label>
                                <input type="date" name="completion_date" id="date-input" value="<?php echo $data['completion_date'] ?>">
                                <?php if (!empty($data['completion_date_err'])): ?>
                                    <span class="error-message"><?php echo $data['completion_date_err']; ?></span>
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
<script src="<?php echo URLROOT ?>/js/events/changeContactDetails.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>