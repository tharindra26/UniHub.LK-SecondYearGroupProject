<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/post-index_style.css">


<div class="header-block">
    <div class="header-block-text">
        <h2>Journey into the Unknown</h3>
            <h3>Where Every Click Unveils New Horizons.</h3>
            <div class="header-buttons">
                <a href="#search-bar-container" class="start-reading-btn">
                    <p>Start reading</p>
                </a>

                <a href="<?php echo URLROOT ?>/posts/add">
                    <div class="add-post-btn">
                        <p><i class="fa-solid fa-bullhorn"></i> Publish Your Work</p>
                    </div>
                </a>

            </div>

    </div>
    <div class="header-block-image">
        <img src="<?php echo URLROOT ?>/img/posts/post-index/post-header-image.jpg" alt="">
    </div>
</div>


<div class="container">
    <div class="trending-post-section">

        <div class="trending-post-title">
            <p><i class="fa-solid fa-arrow-trend-up"></i> Trending Posts</p>
        </div>

        <div class="trending-posts">

            <?php foreach ($data['popularPosts'] as $post): ?>
                <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->post_id ?>">
                    <div class="trending-post">
                        <div class="author-details">
                            <div class="author-image">
                                <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $post->author_profile_image ?>"
                                    alt="">
                            </div>
                            <p class="author-name"><?php echo $post->fname ?>     <?php echo $post->lname ?></p>
                        </div>
                        <div class="post-topic"><?php echo $post->post_title ?></div>
                        <div class="post-date"><?php echo date('M d, Y', strtotime($post->post_timestamp_created)) ?></div>
                    </div>
                </a>
            <?php endforeach; ?>


        </div>
        <hr>
    </div>
</div>

<div class="container">
    <div class="interest-setting-section">
        <div class="interest-left-side">
            <div class="interest-left-side-txt">
                Stay informed, stay inspired. Choose your interests and unlock a world of knowledge.

            </div>
            <a href="<?php echo URLROOT ?>/users/changePostInterest" class="interst-setting-btn">
                Customize Feed
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
        <div class="interest-right-side">
            <img src="<?php echo URLROOT ?>/img/posts/interest_image/interest.jpg" alt="">
        </div>
    </div>
</div>

<!-- Search-bar -->
<div class="container" id="search-bar-container">
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="searchInput" placeholder="Explore Posts" id="search-bar-input">

        </form>
    </div>
</div>
<!-- Search-bar -->

<!-- Quick-shortcut-bar -->
<div class="container">
    <div class="shortcut-bar">
        <!-- <div class="section-name">Opportunities</div> -->
        <div class="shortcut-options">
            <h3>Sort:</h3>
            <div class="shortcut-options-outer-box">
                <div class="option" onclick="quickShortcut('0')">All
                    <hr>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="option" onclick="bookmarkedPosts('<?php echo $_SESSION['user_id'] ?>')">Bookmarked
                        <hr>
                    </div>
                    <div class="option" onclick="postSuggestions('<?php echo $_SESSION['user_id'] ?>')">Suggestions
                        <hr>
                    </div>
                <?php endif; ?>

                <div class="option" onclick="quickShortcut('Blogs')">Blogs
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('Research')">Research
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('Kuppi')">Kuppi
                    <hr>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Quick-shortcut-bar -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- content-showing-section -->
<div class="container">
    <div class="content-outer-container">
        <div class="left-main-section" id="content-section">


            <!-- conetent-section -->

        </div>
    </div>

</div>

</div>
<!-- content-showing-section -->





<script src="<?php echo URLROOT ?>/js/posts/post-index.js"></script>
<script>
    $(document).ready(function () {
        // Smooth scrolling when clicking the "Start reading" button
        $(".start-reading-btn").click(function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $("#search-bar-container").offset().top
            }, 1000);
        });
    });

    function quickShortcut(category) {
        $.ajax({
            url: URLROOT + "/posts/filterByCategory",
            type: "POST",
            data: {
                category: category,
            },
            success: function (response) {
                $("#content-section").html(response);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }

    function bookmarkedPosts(userId) {
        $.ajax({
            url: URLROOT + "/posts/filterByUserId",
            type: "POST",
            data: {
                userId: userId,
            },
            success: function (response) {
                $("#content-section").html(response);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }

    function postSuggestions(userId) {
        $.ajax({
            url: URLROOT + "/posts/suggestedPosts",
            type: "POST",
            data: {
                userId: userId
            },
            success: function (response) {
                $("#content-section").html(response);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>