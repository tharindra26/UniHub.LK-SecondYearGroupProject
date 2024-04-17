<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/comments_style.css">

<div class="container">
    <div class="inner-container">
        <?php
        // Calculate remaining days for application deadline
        $timestamp_created = date_create($data['post']->post_timestamp_created);

        // Format the application deadline
        $formatted_timestamp = date_format($timestamp_created, 'd M, Y');
        ?>
        <div class="post-card">
            <div class="post-card-rigth-section">
                <div class="post-image-box">
                    <img src="<?php echo URLROOT ?>/img/posts/post_profile_images/<?php echo $data['post']->post_profile_image ?>"
                        alt="post image">
                </div>
            </div>
            <div class="post-card-left-section">
                <div class="publisher-details">
                    <div class="publisher-image-box">
                        <img src="<?php echo URLROOT ?>/img/posts/post-authors/default_user.png" alt="">
                    </div>
                    <div class="publisher-name">
                        <div class="publisher-name"><?php echo $data['post']->fname . ' ' . $data['post']->lname ?>
                        </div>
                    </div>
                    <div class="published-date"><?php echo $formatted_timestamp ?></div>

                    <!-- bookmark-option -->
                    <div class="bookmark-option" data-post-id="<?php echo $data['post']->post_id ?>"
                        data-bookmarked-users='<?php echo json_encode(explode(',', $data['post']->bookmarked_users)) ?>'>
                        <i class="fa-regular fa-bookmark"></i>
                        <div class="bookmark-text">Add Bookmark</div>
                    </div>
                    <!-- bookmark-option -->
                    
                </div>
                <div class="post-title"><?php echo $data['post']->post_title ?></div>
                <div class="post-tags">
                    <?php $tags = explode(',', $data['post']->tags); ?>
                    <?php foreach ($tags as $tag): ?>
                        <div class="tag"><?php echo $tag ?></div>
                    <?php endforeach; ?>
                </div>
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
                </div>
                <div class="explore-more-section">
                    <a class="explore-more-btn" href="<?php echo URLROOT ?>/posts/show/<?php echo $data['post']->post_id ?>">
                        <i class="fa-solid fa-rocket"></i>
                        <div class="explore-more-text">
                            Explore More
                        </div>
                    </a>
                    <a href="#" class="add-comment-btn" onclick="openPopup('addComment-popup-<?php echo $data['post']->post_id ?>')">
                        <i class="fa-solid fa-comment"></i>
                        <div class="explore-more-text">
                            Add Comment
                        </div>
                    </a>
                    <!-- popupModal -->
                    <span class="overlay"></span>
                    <div class="modal-box" id="addComment-popup-<?php echo $data['post']->post_id ?>">
                        <!-- <i class="fa-solid fa-trash-can"></i> -->
                        <h2>Add a Comment</h2>

                        <form class="form" action="#" method="post">
                            <div class="column">
                                <div class="input-box">
                                    <textarea id="comment" name="announcement" value=""
                                        placeholder="Add your comment"></textarea>
                                </div>
                            </div>
                        </form>

                        <div class="buttons">
                            <button class="close-btn" id="update-btn"
                                onclick="addComment('<?php echo $data['post']->post_id ?>')">
                                Comment
                            </button>
                        </div>
                    </div>
                    <!-- popupModal -->
                </div>
            </div>

        </div>

        <div class="comments-section">
            <?php if (!empty($data['comments'][0]->comment_id)): ?>
                <?php foreach ($data['comments'] as $comment): ?>
                    <div class="comment-card">
                        <?php
                        // Calculate remaining days for application deadline
                        $comment_timestamp_created = date_create($comment->timestamp_commented);

                        // Format the application deadline
                        $formatted_comment_timestamp = date_format($comment_timestamp_created, 'd M, Y');
                        ?>
                        <div class="user-details">
                            <div class="user-image-box">
                                <img src="<?php echo URLROOT ?>/img/posts/post-authors/default_user.png" alt="">
                            </div>
                            <div class="user-name">
                                <div class="user-name">
                                    <?php echo $comment->user_fname . ' ' . $comment->user_lname ?>
                                </div>
                            </div>
                            <div class="published-date"><?php echo $formatted_comment_timestamp ?></div>

                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment->user_id): ?>
                                <div class="comment-delete-option"
                                    onclick="openPopup('deleteComment-popup-<?php echo $comment->comment_id ?>')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
                                <div class="comment-edit-option"
                                    onclick="openPopup('updateComment-popup-<?php echo $comment->comment_id ?>')">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                            <?php endif; ?>
                            <!-- popupModal -->
                            <span class="overlay"></span>
                            <div class="modal-box" id="updateComment-popup-<?php echo $comment->comment_id ?>">
                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                <h2>Update Comment</h2>

                                <form class="form" action="#" method="post">
                                    <div class="column">
                                        <div class="input-box">
                                            <textarea id="updatedComment" name="announcement" value=""
                                                placeholder="Add your comment"><?php echo $comment->comment_text ?></textarea>
                                        </div>
                                    </div>
                                </form>

                                <div class="buttons">
                                    <button class="close-btn" id="update-btn"
                                        onclick="updateComment('<?php echo $comment->comment_id ?>')">
                                        Update Comment
                                    </button>
                                </div>
                            </div>
                            <!-- popupModal -->

                            <!-- popupModal -->
                            <span class="overlay"></span>
                            <div class="modal-box" id="deleteComment-popup-<?php echo $comment->comment_id ?>">
                                <i class="fa-solid fa-trash-can"></i>
                                <h2>Delete Comment</h2>

                                <div class="buttons">
                                    <button class="close-btn"
                                        onclick="deleteComment('<?php echo $comment->comment_id ?>')">Ok,Delete</button>
                                </div>
                            </div>
                            <!-- popupModal -->


                        </div>
                        <div class="comment-text">
                            <?php echo $comment->comment_text ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments available.</p>
            <?php endif; ?>
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
    // popup modal script
    const overlay = document.querySelector(".overlay");
    const modalBox = document.querySelector(".modal-box");

    function openPopup(popupId) {
        console.log('Opening popup with ID:', popupId);
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.add("active");
            overlay.classList.add("active");
        }
    }

    function closePopup(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.remove("active");
            overlay.classList.remove("active");
        }
    }
    overlay.addEventListener("click", () => {
        // Find all elements with the "active" class
        var activeElements = document.querySelectorAll('.active');

        // Remove the "active" class from each element
        activeElements.forEach(function (element) {
            element.classList.remove("active");
        });
    });
    // popup modal script



    function addComment(postId) {
        // Send an AJAX request to the server to delete the category
        var commentText = $("#comment").val();


        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/addComment', // Replace with the URL of your server-side script
            data: {
                postId: postId,
                commentText: commentText
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Comment Added');
                    closePopup('addComment-popup-' + postId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                } else {
                    console.log('Error adding comment');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting announcement:', error);
            }
        });
    }

    function updateComment(commentId) {
        // Send an AJAX request to the server to delete the category
        var commentText = $("#updatedComment").val();
        console.log(commentId, commentText);


        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/updateComment', // Replace with the URL of your server-side script
            data: {
                commentId: commentId,
                commentText: commentText
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Comment Updated');
                    closePopup('updateComment-popup-' + commentId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                } else {
                    console.log('Error adding comment');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating comment:', error);
            }
        });
    }



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

    function deleteComment(commentId) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/deleteComment', // Replace with the URL of your server-side script
            data: {
                commentId: commentId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Comment deleted successfully');
                    closePopup('deleteComment-popup-' + commentId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                } else {
                    console.log('Error deleting comment');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating comment:', error);
            }
        });
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>