<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/opportunities/opportunities-index_style.css">


<div class="title-bar">
    <h3>Take the Next Step: Openings Just a Click Away</h3>
</div>

<!-- title bar -->

<!-- Search-bar -->
<div class="container">
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="searchInput" placeholder="Explore Opportunities" id="search-bar-input">

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
                <div class="option" onclick="quickShortcut('all')">All
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('hackathon')">Intern
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('entertainment')">Job
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('workshops')">New Initiative
                    <hr>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Quick-shortcut-bar -->

<!-- event-showing-section -->
<div class="container">
    <div class="outer-body-container">

        <!-- filters-section -->
        <div class="filters-section">
            <div class="opportunities-adding">
                <div class="opportunity-adding-image">
                    <img src="<?php echo URLROOT ?>/img/opportunities/index-page/job_hiring.jpg" alt="">
                </div>
                <p class="opportunity-adding-text">Share your opportunity with our vibrant undergraduate community and
                    connect with tomorrow's leaders.
                    Post your job openings, internships, and exciting initiatives directly to our platform.</p>

                <a href="<?php echo URLROOT ?>/events/add">
                    <div class="add-opportunity-button">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Post Opportunity</span>
                    </div>
                </a>
            </div>


        </div>
        <!-- filters-section -->

        <!-- events-card-section -->
        <div class="content-section" id="content-section">
            <a class="opportunity-card-link" href="<?php echo URLROOT ?>/opportunities/show/1">
                <div class="opportunity-card">
                    <div class="left-color-bar"></div>
                    <div class="image-section">
                        <img src="<?php echo URLROOT ?>/img/opportunities/card-images/medium_square.png" alt="">
                    </div>
                    <div class="title-section">
                        <div class="title-text">GitLab Innovation Pitch</div>
                        <div class="days-left">
                            <div class="day-count-box">
                                <div class="day-count"><i class="fa-solid fa-circle"></i>21 days left</div>
                            </div>
                            <div class="working-mod-box">
                                <div class="working-mod"><i class="fa-solid fa-building"></i> Physical</div>
                            </div>
                        </div>
                        <div class="interesting-count">
                            <div class="interesting-box">
                                <p><span>253</span> Interesting </p>
                            </div>
                            <div class="bookmark"><i class="fa-solid fa-bookmark"></i>
                                <p>Add Bookmark</p>
                            </div>
                        </div>
                        <!-- <div class="options-tab">

                        </div> -->

                    </div>
                    <div class="details-section">
                        <div class="posted-by">
                            <i class="fa-solid fa-flag"></i>
                            <p>WSO2</p>
                        </div>
                        <div class="duration">
                            <i class="fa-solid fa-calendar-days"></i>
                            <p>10 Feb-15 Mar, 2024</p>
                        </div>
                        <div class="tags">
                            <i class="fa-solid fa-tags"></i>
                            <div class="tag">Intern</div>
                            <div class="tag">Machine Learning</div>
                            <div class="tag">AI</div>
                            <div class="tag">Python</div>
                        </div>
                    </div>
                    <div class="right-color-bar">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
            </a>


            <!-- rating-system -->
            <div class="rating-box">
                <div class="post">
                    <div class="text">Thanks for rating us!</div>
                    <div class="edit">EDIT</div>
                </div>
                <div class="star-widget">
                    <input type="radio" name="rate"  id="rate-5">
                    <label for="rate-5" class="fa-solid fa-star"></label>
                    <input type="radio" name="rate" id="rate-4">
                    <label for="rate-4" class="fa-solid fa-star"></label>
                    <input type="radio" name="rate" id="rate-3">
                    <label for="rate-3" class="fa-solid fa-star"></label>
                    <input type="radio" name="rate" id="rate-2">
                    <label for="rate-2" class="fa-solid fa-star"></label>
                    <input type="radio" name="rate" id="rate-1">
                    <label for="rate-1" class="fa-solid fa-star"></label>

                    <form action="#">
                        <header></header>
                        <div class="textarea">
                            <textarea name="" id="" cols="30" placeholder="Describe your experience..."></textarea>
                        </div>
                        <div class="btn">
                            <p>Post</p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- rating-system -->



        </div>







        <!-- events-card-section -->

    </div>
</div>
<!-- event-showing-section -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/opportunities-index.js"></script>

<script>
    const btn=document.querySelector(".btn");
    const post=document.querySelector(".post");
    const widget=document.querySelector(".star-widget");
    const editBtn=document.querySelector(".edit");

    btn.onclick= ()=>{
        widget.style.display ="none";
        post.style.display ="block";
        editBtn.onclick = ()=>{
            widget.style.display ="block";
            post.style.display ="none";
            return false;
        }
    }

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>