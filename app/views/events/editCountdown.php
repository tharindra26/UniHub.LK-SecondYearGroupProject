<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editCountdown_style.css">



<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Countdown Settings</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form"
                        action="<?php echo URLROOT; ?>/events/editCountdown/<?php echo $data['id'] ?>"
                        method="post" enctype="multipart/form-data">
                        <div class="column">
                            <div class="input-box">
                                <label for="">Main Button Action</label>
                                <input type="text" name="main_button_action" id="" placeholder="Enter the main button action"
                                    value="<?php echo $data['main_button_action'] ?>">
                                <?php if (!empty($data['main_button_action_err'])): ?>
                                    <span class="error-message"><?php echo $data['main_button_action_err']; ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="input-box">
                                <label for="">Main Button Link</label>
                                <input type="text" name="main_button_link" id="" placeholder="Enter the main button link"
                                    value="<?php echo $data['main_button_link'] ?>">
                                <?php if (!empty($data['main_button_link_err'])): ?>
                                    <span class="error-message"><?php echo $data['main_button_link_err']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Countdown Text</label>
                                <input type="text" name="countdown_text" id="" placeholder="Enter the countdown text"
                                    value="<?php echo $data['countdown_text'] ?>">
                                <?php if (!empty($data['countdown_text_err'])): ?>
                                    <span class="error-message"><?php echo $data['countdown_text_err']; ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="input-box">
                                <label for="">Countdown date-time</label>
                                <input type="datetime-local" name="countdown_datetime"
                                    value="<?php echo $data['countdown_datetime'] ?>" id="">
                                <?php if (!empty($data['countdown_datetime_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['countdown_datetime_err']; ?>
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
<script src="<?php echo URLROOT ?>/js/events/changeContactDetails.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>