<?php if (!empty($data['posts'][0]->post_id)): ?>
    <?php foreach ($data['posts'] as $post): ?>
        <?php
        // Calculate remaining days for application deadline
        $timestamp_created = date_create($post->post_timestamp_created);

        // Format the application deadline
        $formatted_timestamp = date_format($timestamp_created, 'd M, Y');
        ?>
        <div class="post-card">
            <div class="post-card-left-section">
                <div class="publisher-details">
                    <div class="publisher-image-box">
                        <img src="<?php echo URLROOT ?>/img/posts/post-authors/default_user.png" alt="">
                    </div>
                    <div class="publisher-name">
                        <div class="publisher-name"><?php echo $post->fname . ' ' . $post->lname ?></div>
                    </div>
                    <div class="published-date"><?php echo $formatted_timestamp ?></div>
                </div>
                <div class="post-title"><?php echo $post->post_title ?></div>
                <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->post_id ?>" class="post-short-description">
                    <?php
                    // Get the description and split it into an array of words
                    $words = explode(' ', $post->post_description);

                    // Check if the number of words is greater than 50
                    if (count($words) > 50) {
                        // Slice the array to get the first 50 words and join them back into a string
                        $shortDescription = implode(' ', array_slice($words, 0, 50));
                        echo $shortDescription . '...';
                    } else {
                        // If the description has 50 or fewer words, display the entire description
                        echo $post->post_description;
                    }
                    ?>
                </a>
                <div class="post-tags">
                    <?php $tags = explode(',', $post->tags); ?>
                    <?php foreach ($tags as $tag): ?>
                        <div class="tag"><?php echo $tag ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="post-options">
                    <div class="like-option" data-post-id="<?php echo $post->post_id ?>"
                        data-liked-users='<?php echo json_encode(explode(',', $post->liked_users)) ?>'>
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <a href="<?php echo URLROOT ?>/posts/comments/<?php echo $post->post_id ?>" class="comment-option">
                        <i class="fa-regular fa-comment"></i>
                        <div class="comment-text"><?php echo $post->comment_count ?></div>
                    </a>
                    <div class="bookmark-option" data-post-id="<?php echo $post->post_id ?>"
                        data-bookmarked-users='<?php echo json_encode(explode(',', $post->bookmarked_users)) ?>'>
                        <i class="fa-regular fa-bookmark"></i>
                        <div class="bookmark-text">Add Bookmark</div>
                    </div>
                </div>
                <!-- <div class="explore-more-section">
                    <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->post_id ?>">
                        <i class="fa-solid fa-rocket"></i>
                        <div class="explore-more-text">
                            Explore More
                        </div>
                    </a>
                </div> -->
            </div>
            <div class="post-card-rigth-section">
                <div class="post-image-box">
                    <img src="<?php echo URLROOT ?>/img/posts/post_profile_images/<?php echo $post->post_profile_image ?>"
                        alt="post image">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="no-data-image">
        <img src="<?php echo URLROOT ?>/img/events/no_data/No data-rafiki.png" alt="no_data">
    </div>
<?php endif; ?>

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