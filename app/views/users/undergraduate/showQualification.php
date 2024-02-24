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
                <a href="<?php echo URLROOT ?>/users/addQualification" class="button">Add New</a>
            </div>

        </div>
        <div class="bottom-part">
            <div class="left-box">
                <div class="form-outer-box">
                        <div class="row">
                            <?php if (!empty($data['qualification'][0]->qualification_id)) : ?> 
                                <?php foreach ($data['qualification'] as $qualification) : 
                                    $qualification_id = $qualification->qualification_id; ?>
                                <div class="content">
                                    <div class="edu-info">
                                        <h4><?php echo $qualification->qualification_name ?> - <?php echo $qualification->institution ?></h4>
                                        <p>Completed date : <?php echo $qualification->completion_date?></p>
                                        <p><?php echo $qualification->description ?></p>
                                    </div>
                                    <div class="edu-btn">
                                        <a href="<?php echo URLROOT ?>/users/editQualification/<?php echo $qualification->qualification_id; ?>" class="button">Update</a>
                                        <a href="#" class="button" onclick="openPopup('<?php echo $qualification->qualification_id; ?>')">Delete</a>
                                        <!-- popupModal -->

                        <span class="overlay"></span>
                        <div class="modal-box" id="<?php echo $qualification_id; ?>">
                        <!-- <i class="fa-solid fa-xmark"></i> -->
                        <i class="fa-solid fa-trash-can"></i>
                            <h2>Confirm Deletion</h2>
                            <p>Are you sure you want to delete</p>
                        <div class="btn">
                            <button class="close-btn" onclick="confirmDelete('<?php echo $qualification->qualification_id; ?>')">Delete</button>
                            <button class="close-btn" onclick="closePopup('<?php echo $qualification->qualification_id; ?>')">Cancel</button>
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
<script src="<?php echo URLROOT ?>/js/users/undergraduate/showQualification.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>