<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/events-index_style.css">

<!-- title bar -->

<!-- <div class="title-bar">
        <div class="title-bar-txt">Events</div>
    </div> -->
<div class="slider">
    <div class="dark-overlay"></div>
    <div class="slides">
        <!-- radio buttons -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
        <!-- radio buttons -->

        <!-- slide-image-start -->
        <div class="slide first">
            <img src="<?php echo URLROOT ?>/img/events/slider/parinamaya banner.jpg" alt="">
        </div>
        <div class="slide">
            <img src="<?php echo URLROOT ?>/img/events/slider/nye banner.jpg" alt="">
        </div>
        <div class="slide">
            <img src="<?php echo URLROOT ?>/img/events/slider/yaga banner.jpg" alt="">
        </div>
        <div class="slide">
            <img src="<?php echo URLROOT ?>/img/events/slider/youth banner.jpg" alt="">
        </div>
        <!-- slide-image-end -->



        <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn4"></div>
            <div class="auto-btn5"></div>
        </div>




    </div>

    <!-- manual navigation start -->
    <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
        <label for="radio4" class="manual-btn"></label>
    </div>

    <!-- manual navigation end -->
</div>

<!-- title bar -->

<!-- Search-bar -->
<div class="container">
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="searchInput" placeholder="Search Events" id="search-bar-input">

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

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="option" onclick="interesetedEvents('<?php echo $_SESSION['user_id'] ?>')">Interested
                        <hr>
                    </div>
                    <div class="option" onclick="eventSuggestions('<?php echo $_SESSION['user_id'] ?>')">Suggestions
                        <hr>
                    </div>
                <?php endif; ?>

                <div class="option" onclick="quickShortcut('hackathon')">Hackathons
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('entertainment')">Entertainment
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('workshop')">Workshops
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

            <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'undergraduate')): ?>
                <a href="<?php echo URLROOT ?>/events/add">
                    <div class="add-event-button">
                        <i class="fa-solid fa-plus"></i>
                        <span>Add Event</span>
                    </div>
                </a>
            <?php endif; ?>

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
                    <?php foreach ($data['event_categories'] as $category): ?>
                        <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text"><?php echo $category->category_name; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- category filter -->

            <!-- customize-feed-option -->
            <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'undergraduate')): ?>
                <div class="customize-feed-option">
                    <hr>
                    <div class="customize-feed-text">Pick Your Interests! Enhance your experience by selecting categories
                        that matter most to you. Start personalizing now!</div>
                    <a href="<?php echo URLROOT ?>/users/changeEventInterest" class="customize-feed-btn">
                        <i class="fa-solid fa-list-check"></i>
                        <div class="customize-feed-btn-txt">
                            Customize Event Feed
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <!-- customize-feed-option -->

        </div>
        <!-- filters-section -->

        <!-- events-card-section -->
        <div class="content-section" id="content-section">


        </div>



        <!-- events-card-section -->

    </div>
</div>
<!-- event-showing-section -->





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/events-index.js"></script>



<?php require APPROOT . '/views/inc/footer.php'; ?>