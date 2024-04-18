<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/post-show_style.css">

<div class="container">
    <div class="inner-container">
        <div class="post-container">
            <div class="post-title"><?php echo $data['post']->post_title ?></div>
            <div class="publisher-info">
                <div class="publisher-image">
                    <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $data['post']->user_profile_image ?>"
                        alt="">
                </div>
                <div class="publisher-name">
                    <div class="fname"><?php echo $data['post']->fname ?></div>
                    <div class="lname"><?php echo $data['post']->lname ?></div>
                </div>

                <?php
                $timestamp_created = date_create($data['post']->post_timestamp_created);
                $formatted_timestamp = date_format($timestamp_created, 'd M, Y');
                ?>

                <div class="published-date">
                    <?php echo $formatted_timestamp ?>
                </div>
            </div>
            <hr>
            <div class="post-options">
                <div class="like-option" data-post-id="<?php echo $data['post']->post_id ?>"
                    data-liked-users='<?php echo json_encode(explode(',', $data['post']->liked_users)) ?>'>
                    <i class="fa-regular fa-heart"></i>
                </div>
                <a href="<?php echo URLROOT ?>/posts/comments/<?php echo $data['post']->post_id ?>"
                    class="comment-option">
                    <i class="fa-regular fa-comment"></i>
                    <div class="comment-text"><?php echo $data['post']->comment_count ?></div>
                </a>
                <div class="bookmark-option" data-post-id="<?php echo $data['post']->post_id ?>"
                    data-bookmarked-users='<?php echo json_encode(explode(',', $data['post']->bookmarked_users)) ?>'>
                    <i class="fa-regular fa-bookmark"></i>
                    <div class="bookmark-text">Add Bookmark</div>
                </div>
                <div class="explore-more-option">
                    <i class="fa-solid fa-rocket"></i>
                    <div class="explore-more-text">Explore More</div>
                </div>
            </div>
            <hr>
            <div class="post-image">
                <div class="post-image-box">
                    <img src="<?php echo URLROOT ?>/img/posts/post_profile_images/<?php echo $data['post']->post_profile_image ?>"
                        alt="">
                </div>
            </div>
            <div class="post-description">
                <?php echo $data['post']->post_description ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/posts/post-show.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>