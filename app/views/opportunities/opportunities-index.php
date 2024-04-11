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

                <a href="<?php echo URLROOT ?>/opportunities/add">
                    <div class="add-opportunity-button">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Post Opportunity</span>
                    </div>
                </a>
            </div>


        </div>
        <!-- filters-section -->

        <!-- opportunity-card-section -->
        <div class="content-section" id="content-section">
            



        </div>
        <!-- events-card-section -->

    </div>
</div>
<!-- event-showing-section -->

<script>

</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/opportunities/opportunities-index.js"></script>



<?php require APPROOT . '/views/inc/footer.php'; ?>