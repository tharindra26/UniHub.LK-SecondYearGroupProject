<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/post-add_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Publish Post</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/posts/add" method="post"
                        enctype="multipart/form-data">
                        <div class="column">
                            <div class="input-box">

                                <label for="">Title</label>
                                <input type="text" name="title" id="" placeholder="Enter your title " value="<?php echo $data['title'] ?>">
                                <?php if (!empty($data['title_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['title_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="column">
                            <div class="input-box">
                                <label for="">Event Description</label>
                                <textarea id="eventDescription" name="description"  placeholder="Enter event description"><?php echo $data['description'] ?></textarea>
                                <?php if (!empty($data['description_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['description_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">
                        <div class="input-box">
                                <label for="">Material links</label>
                                <input type="text" name="material_link" id="" placeholder="Enter the material link"
                                    value="<?php echo $data['material_link'] ?>">
                                <?php if (!empty($data['material_link_err'])): ?>
                                    <span class="error-message"><?php echo $data['material_link_err']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">
                            <p><i class="fa-solid fa-paper-plane"></i> publish post</p>
                        </button>


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
<script src="<?php echo URLROOT ?>/js/posts/post-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>