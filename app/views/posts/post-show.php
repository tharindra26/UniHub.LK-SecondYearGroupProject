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

                <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'undergraduate')): ?>
                    <div class="bookmark-option" data-post-id="<?php echo $data['post']->post_id ?>"
                        data-bookmarked-users='<?php echo json_encode(explode(',', $data['post']->bookmarked_users)) ?>'>
                        <i class="fa-regular fa-bookmark"></i>
                        <div class="bookmark-text">Add Bookmark</div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin' || (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $data['post']->user_id)): ?>
                <a href="<?php echo URLROOT ?>/posts/settings/<?php echo $data['post']->post_id ?>"
                    class="post-settings-option">
                    <i class="fa-solid fa-gear"></i>
                    <div class="post-setting-option-text">Settings</div>
                </a>
                <?php endif; ?>
                
                <a href="<?php echo $data['post']->material_link ?>" class="explore-more-option">
                    <i class="fa-solid fa-rocket"></i>
                    <div class="explore-more-text">Explore More</div>
                </a>
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
<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    <?php if (isset($_SESSION['user_id'])): ?>
        var currentUserId = <?php echo $_SESSION['user_id']; ?>;
    <?php else: ?>
        var currentUserId = -1;
    <?php endif; ?>

    $(document).ready(function () {
        // Function to handle liking a post via AJAX
        function likePost(postId) {
            $.ajax({
                type: 'POST',
                url: URLROOT + '/posts/addLike',
                data: { postId: postId },
                success: function (response) {
                    // Update the like count in the DOM
                    var likeOption = $('.like-option[data-post-id="' + postId + '"]');
                    if (response == 1) {
                        likeOption.find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        likeOption.find('.fa-solid').removeClass('fa-solid').addClass('fa-regular');;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Failed to like the post:', error);
                }
            });
        }

        // Attach click event listener to like buttons
        $('.like-option').click(function () {
            var postId = $(this).data('post-id');
            likePost(postId);
        });

        // Check if the user has liked each post and update the heart icon accordingly


        $('.like-option').each(function () {
            var postId = $(this).data('post-id');
            var likedUsers = $(this).data('liked-users');


            if (likedUsers.includes(currentUserId.toString())) {
                $(this).find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
            }
        });



        function bookmarkPost(postId) {
            $.ajax({
                type: 'POST',
                url: URLROOT + '/posts/addBookmark',
                data: { postId: postId },
                success: function (response) {
                    // Update the like count in the DOM
                    var bookmarkOption = $('.bookmark-option[data-post-id="' + postId + '"]');
                    if (response == 1) {
                        bookmarkOption.find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
                        bookmarkOption.find('.bookmark-text').text('Bookmark Added');
                    } else {
                        bookmarkOption.find('.fa-solid').removeClass('fa-solid').addClass('fa-regular');
                        bookmarkOption.find('.bookmark-text').text('Add Bookmark');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Failed to bookmark the post:', error);
                }
            });
        }

        // Attach click event listener to like buttons
        $('.bookmark-option').click(function () {
            var postId = $(this).data('post-id');
            bookmarkPost(postId);
        });

        // Check if the user has liked each post and update the heart icon accordingly


        $('.bookmark-option').each(function () {
            var postId = $(this).data('post-id');
            var bookmarkedUsers = $(this).data('bookmarked-users');


            if (bookmarkedUsers.includes(currentUserId.toString())) {
                $(this).find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
                var bookmarkOption = $('.bookmark-option[data-post-id="' + postId + '"]');
                bookmarkOption.find('.bookmark-text').text('Bookmark Added');
            }
        });
    });
</script>
<script src="<?php echo URLROOT ?>/js/posts/post-show.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>