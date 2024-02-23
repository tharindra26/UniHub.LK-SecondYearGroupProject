<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/edit-contact-details_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <div class="title">
                <p>Education Details</p>
            </div>
            <div class="add-btn">
                <button>Add Education</button>
            </div>

        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">
                        <div class="row">
                            <?php if (!empty($data['education'][0]->education_id)) : ?> 
                                <?php foreach ($data['education'] as $education) : ?>
                                    <?php $edu_id = $education->education_id; ?>
                                <div class="content">
                                    <div class="edu-info">
                                        <h4><?php echo $education->institution ?></h4>
                                        <p><?php echo $education->start_year?> - <?php echo $education->end_year?></p>
                                        <p><?php echo $education->description ?></p>
                                    </div>
                                    <div class="edu-btn">
                                        <button onclick="openPopup('<?php echo $edu_id; ?>')">Update</button>
                                        <!-- popupModal -->
                                        <span class="overlay"></span>
                                        <div class="modal-box" id="<?php echo $edu_id; ?>">
                                            <!-- <i class="fa-solid fa-xmark"></i> -->
                                            <h2>Change Eduction</h2>
                                            <!-- <h3>Please check your email and password and try again.</h3> -->
                                            <!-- Form Starts -->
                                            <div class="form-outer-box">
                        <form class="form" action="<?php echo URLROOT; ?>/users/editEducation/<?php echo $data['education_id'] ?>" method="post"
                        enctype="multipart/form-data">

                        <div class="column">
                            <div class="input-box">
                                <label for="">Institute</label>
                                <input type="text" name="institution"  id="" placeholder="Enter the Institution" value="<?php echo $data['institution'] ?>">
                                <!--  <?php if (!empty($data['institution_err'])): ?>
                                    <span class="error-message"><?php echo $data['institution_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Description</label>
                                <input type="text" name="description"  id="" placeholder="Enter the Description" value="<?php echo $data['description'] ?>">
                                <!-- <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message"><?php echo $data['description_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Start Year</label>
                                <input type="text" name="start_year"  id="" placeholder="Enter the Start Year" value="<?php echo $data['start_year'] ?>">
                                <!-- <?php if (!empty($data['start_year_err'])): ?>
                                    <span class="error-message"><?php echo $data['web_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">End Year</label>
                                <input type="tel" name="end_year"  id="" placeholder="Enter the End Year" value="<?php echo $data['end_year'] ?>">
                                <!-- <?php if (!empty($data['end_year_err'])): ?>
                                    <span class="error-message"><?php echo $data['end_year_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">Update</button>
                    </form>
                </div>

                <!-- rating-system -->


            </div>

            <!-- popupModal -->

                                        <button>Delete</button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                </div>
            </div>

            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/undegraduate/showEducation.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>