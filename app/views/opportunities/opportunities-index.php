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
                <div class="option" onclick="quickShortcut('hackathon')">Interns
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('entertainment')">Jobs
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('workshops')">New Initiatives
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
            <a href="<?php echo URLROOT ?>/events/add">
                <div class="add-event-button">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Event</span>
                </div>
            </a>

            <!-- university-filter -->
            <div class="uni-filter ">
                <div class="select-btn">
                    <span id="universitySpan">Select University</span>
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <div class="uni-filter-content">
                    <div class="uni-reset-btn">Reset</div>
                    <div class="uni-filter-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search" id="">
                    </div>
                    <ul class="uni-filter-options"></ul>
                </div>
            </div>
            <!-- university-filter -->

            <!-- date filter -->

            <div class="date-filter">
                <input type="date" name="" id="date-input">
                <span id="date-reset-btn" class="date-reset-btn" onclick="resetDate()">Reset Date</span>
            </div>
            <!-- date filter -->

            <!-- category filter -->
            <div class="category-filter">
                <div class="category-select-btn">
                    <span class="category-btn-txt">Select Category</span>
                    <span class="arrow-dwn">
                        <i class="fa-solid fa-angle-down"></i>
                    </span>
                </div>

                <ul class="list-items" id="category-list">
                    <div class="category-reset-btn">Reset</div>
                    <li class="item">
                        <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                        </span>
                        <span class="item-text">Concert</span>
                    </li>
                    <li class="item">
                        <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                        </span>
                        <span class="item-text">Hackathon</span>
                    </li>

                    <li class="item">
                        <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                        </span>
                        <span class="item-text">Musical Show</span>
                    </li>

                    <li class="item">
                        <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                        </span>
                        <span class="item-text">Workshop</span>
                    </li>
                </ul>
            </div>
            <!-- category filter -->
        </div>
        <!-- filters-section -->

        <!-- events-card-section -->
        <div class="content-section" id="content-section">
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
                    <div class="options-tab"></div>

                </div>
                <div class="details-section"></div>
                <div class="right-color-bar">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
            <div class="opportunity-card"></div>
            <div class="opportunity-card"></div>

        </div>
        <!-- events-card-section -->

    </div>
</div>
<!-- event-showing-section -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/opportunities-index.js"></script>


<?php require APPROOT . '/views/inc/footer.php'; ?>