<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/post-index_style.css">

<div class="header-block">
    <div class="header-block-text">
        <h2>Journey into the Unknown</h3>
            <h3>Where Every Click Unveils New Horizons.</h3>
            <div class="header-buttons">
                <div class="start-reading-btn">
                    <p>Start reading</p>
                </div>

                <div class="add-post-btn">
                    <p><i class="fa-solid fa-bullhorn"></i> Publish Your Work</p>
                </div>
            </div>

    </div>
    <div class="header-block-image">
        <img src="<?php echo URLROOT ?>/img/posts/post-index/posts-header-block-image.png" alt="">
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/posts/post-index.js"></script>


<?php require APPROOT . '/views/inc/footer.php'; ?>