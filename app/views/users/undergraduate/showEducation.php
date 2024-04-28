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
                <a href="<?php echo URLROOT ?>/users/addEducation" class="button">Add New</a>
            </div>

        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">
                    <div class="row">
                        <?php if (!empty($data['education'][0]->education_id)): ?>
                            <?php foreach ($data['education'] as $education):
                                $edu_id = $education->education_id; ?>
                                <div class="content">
                                    <div class="edu-info">
                                        <h4>
                                            <?php echo $education->institution ?>
                                        </h4>
                                        <?php if (!empty($education->end_year)): ?>
                                            <p>
                                                <?php echo $education->start_year ?> -
                                                <?php echo $education->end_year ?>
                                            </p>
                                        <?php else: ?>
                                            <p>
                                                From: &nbsp
                                                <?php echo $education->start_year ?>
                                            </p>
                                        <?php endif; ?>
                                        <p>
                                            <?php echo $education->description ?>
                                        </p>
                                    </div>
                                    <div class="edu-btn">
                                        <a href="<?php echo URLROOT ?>/users/editEducation/<?php echo $education->education_id ?>"
                                            class="button">Update</a>
                                        <a href="#" class="button"
                                            onclick="openPopup('<?php echo $education->education_id;
                                            ; ?>')">Delete</a>
                                        <!-- popupModal -->

                                        <span class="overlay"></span>
                                        <div class="modal-box" id="<?php echo $edu_id; ?>">
                                            <!-- <i class="fa-solid fa-xmark"></i> -->
                                            <i class="fa-solid fa-trash-can"></i>
                                            <h2>Confirm Deletion</h2>
                                            <p>Are you sure you want to delete</p>
                                            <div class="btn">
                                                <button class="close-btn"
                                                    onclick="confirmDelete('<?php echo $education->education_id; ?>')">Delete</button>
                                                <button class="close-btn"
                                                    onclick="closePopup('<?php echo $education->education_id; ?>')">Cancel</button>
                                            </div>
                                        </div>

                                        <!-- popupModal -->
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
<script src="<?php echo URLROOT ?>/js/users/undergraduate/showEducation.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>