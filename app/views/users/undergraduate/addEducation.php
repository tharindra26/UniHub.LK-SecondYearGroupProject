<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/edit-contact-details_style.css">

<div class="container">
    <div class="inner-container">
    <div class="title-text">
            <p>Add Education</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">
            <form class="form" action="<?php echo URLROOT; ?>/users/addEducation" method="post" enctype="multipart/form-data">
 
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
                                <label for="">Grade</label>
                                <input type="text" name="grade"  id="" placeholder="Enter the Grade" value="<?php echo $data['grade'] ?>">
                                <?php if (!empty($data['grade_err'])): ?>
                                    <span class="error-message"><?php echo $data['grade_err']; ?></span>
                                <?php endif; ?>
                            </div>
                    </div>

                    <div class="column">
                            <div class="input-box">
                                <label for="">Start Year</label>
                                <input type="number" name="start_year"  id="startyearInput" min="1990" max="2100" step="1" placeholder="YYYY"  value="<?php echo $data['start_year'] ?>" required>
                                <?php if (!empty($data['start_year_err'])): ?>
                                    <span class="error-message"><?php echo $data['start_year_err']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="input-box">
                                <label for="">End Year</label>
                                <input type="number" name="end_year"  id="endyearInput" min="1990" max="2100" step="1" placeholder="YYYY" value="<?php echo $data['end_year'] ?>">
                                <!-- <?php if (!empty($data['end_year_err'])): ?>
                                    <span class="error-message"><?php echo $data['end_year_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                    </div>

                <button class="submit-btn" type="submit">Add Education</button>
            </form>
        </div>
            </div>
            <div class="image-section">
            <img src="<?php echo URLROOT ?>/img/events/event-add/event-add-image.jpg" alt="" srcset="">
        </div>
        </div>
        
    </div>
    
    
</div>



<script src="<?php echo URLROOT?>/js/events/event-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>