<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/add-announcement_style.css">

<div class="container">
    <div class="inner-container">
        <div class="announcement-title-text">
            <p>Add Announcement</p>
        </div>
        <div class="bottom-part">
            <div class="announcement-box">
                <div class="add-announcement-form">
                
                    <form class="form" action="<?php echo URLROOT; ?>/events/add" method="post" enctype="multipart/form-data">
                        <div class="column">
                            <div class="input-box">
                                <label for="">Announcement</label>
                                <textarea  id="eventAnnouncement" name="announcement" value="" placeholder="Enter the announcement"></textarea>
                                <!-- <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message"><?php echo $data['description_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>
                        

                       <div class="column">
                        <div class="input-box">  
                                <label for="">Notify for event followers via email?</label>
                                <div class="select-box">
                                    <select name="university" id="selection" >
                                        <option hidden <?php if (empty($data['university'])) echo 'selected'; ?>>Select the option</option>
                                        <option value="yes" <?php if ($data['notify'] == 'yes') echo 'selected'; ?>>Yes, notify them</option>    
                                        <option value="no" <?php if ($data['notify'] == 'no') echo 'selected'; ?>>No, don't notify them</option>    
                                    </select>
                                </div>
                                <!-- <?php if (!empty($data['notify_err'])): ?>
                                    <span class="error-message"><?php echo $data['notify_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                       </div>
                        
                        <button class="submit-btn" type="submit">Add Announcememnt</button>
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
<script src="<?php echo URLROOT ?>/js/events/add-announcement.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>