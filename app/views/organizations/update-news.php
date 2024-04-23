<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/add-news_style.css">

<div class="container">
    <div class="inner-container">
        <div class="top-part">
            <header>Update Organization News</header>
        </div>
        <div class="bottom-part">
            <div class="bottom-left">
                <div class="add-event-form">

                    <form class="form"
                        action="<?php echo URLROOT; ?>/organizations/updateNews/<?php echo $data['news_id'] ?>"
                        method="post" enctype="multipart/form-data">




                        <div class="input-box">
                            <label for="">News Title</label>
                            <input type="text" name="news_title" id="" value="<?php echo $data['news_title'] ?>"
                                placeholder="Enter the news title">
                            <?php if (!empty($data['news_title_err'])): ?>
                                <span class="error-message"><?php echo $data['news_title_err']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="input-box">
                            <label for="">News</label>
                            <textarea id="eventDescription" name="news_text" value="<?php echo $data['news_text'] ?>"
                                placeholder="Enter the news text"><?php echo $data['news_text'] ?></textarea>
                            <?php if (!empty($data['news_text_err'])): ?>
                                <span class="error-message"><?php echo $data['news_text_err']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="radio-option-box">
                            <h3>Notify followers</h3>
                            <div class="radio-options">
                                <div class="radio-option">
                                    <input type="radio" id="check-yes" name="sharing_option" value="1" <?php echo (!empty($data['sharing_option']) && $data['sharing_option'] == 0) ? '' : 'checked'; ?>>
                                    <label for="check-yes">Yes, notify them</label>
                                </div>

                                <div class="radio-option">
                                    <input type="radio" id="check-no" name="sharing_option" value="0" <?php echo (!empty($data['sharing_option']) && $data['sharing_option'] == 0) ? 'checked' : ''; ?>>
                                    <label for="check-no">No,don't notify them</label>
                                </div>
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">Update News</button>
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
<script src="<?php echo URLROOT ?>/js/organizations/add-news.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>