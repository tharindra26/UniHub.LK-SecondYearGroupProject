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

                    <form class="form"
                        action="<?php echo URLROOT; ?>/events/addAnnouncement/<?php echo $data['event_id']; ?>"
                        method="post">
                        <div class="column">
                            <div class="input-box">
                                <label for="">Announcement</label>
                                <textarea id="eventAnnouncement" name="announcement"
                                    value="<?php $data['announcement'] ?>"
                                    placeholder="Enter the announcement"><?php echo $data['announcement']; ?></textarea>
                                <?php if (!empty($data['announcement_err'])): ?>
                                    <span class="error-message"><?php echo $data['announcement_err']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- <div class="column">
                        <div class="input-box">  
                                <label for="">Notify for event followers via email?</label>
                                <div class="select-box">
                                    <select name="sharingOption" id="selection" >
                                        <option hidden <?php if (empty($data['sharingOption']))
                                            echo 'selected'; ?>>Select the option</option>
                                        <option value="1" <?php if ($data['sharingOption'] == 1)
                                            echo 'selected'; ?>>Yes, notify them</option>    
                                        <option value="0" <?php if ($data['sharingOption'] == 0)
                                            echo 'selected'; ?>>No, don't notify them</option>    
                                    </select>
                                </div>
                                <?php if (!empty($data['sharingOption_err'])): ?>
                                    <span class="error-message"><?php echo $data['sharingOption_err']; ?></span>
                                <?php endif; ?>
                            </div>
                       </div> -->
                        <div class="radio-option-box">
                            <h3>Notify followers</h3>
                            <div class="radio-options">
                                <div class="radio-option">
                                    <input type="radio" id="check-yes" name="sharingOption" value="1" checked>
                                    <label for="check-yes">Yes, notify them</label>
                                </div>

                                <div class="radio-option">
                                    <input type="radio" id="check-no" name="sharingOption" value="0">
                                    <label for="check-no">No,don't notify them</label>
                                </div>
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