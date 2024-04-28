<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organizations-index_style.css">

<!-- Slider -->
<div class="slider-container">
    <div class="slider">
        <div class="item"
            style="background-image: url(<?php echo URLROOT ?>/img/organizations/organizations_slider/AIESEC.jpg)">
            <div class="content">
                <div class="text">
                    <div class="name">AIESEC in Colombo Central</div>
                    <div class="university">University of Colombo</div>
                    <div class="description">AIESEC is a global platform for young people to explore and develop their
                        leadership potential.</div>
                </div>
                <button>See More</button>
            </div>
        </div>
        <div class="item"
            style="background-image: url(<?php echo URLROOT ?>/img/organizations/organizations_slider/Art_Circle.jpg)">
            <div class="content">
                <div class="text">
                    <div class="name">Art Circle</div>
                    <div class="university">University of Sri Jayawardenapura</div>
                    <div class="description">The spotlight of the Arts Circle calendar is focused on a variety
                        performance bearing the name “Talents”.</div>
                </div>
                <button>See More</button>
            </div>
        </div>
        <div class="item"
            style="background-image: url(<?php echo URLROOT ?>/img/organizations/organizations_slider/Rotaract.png)">
            <div class="content">
                <div class="text">
                    <div class="name">Rotaract Club of UCSC</div>
                    <div class="university">University of Colombo</div>
                    <div class="description">At the Rotaract Club of UCSC, we are more than just a club; we are a
                        community.</div>
                </div>
                <button>See More</button>
            </div>
        </div>
        <div class="item"
            style="background-image: url(<?php echo URLROOT ?>/img/organizations/organizations_slider/ButterflyRT.jpg)">
            <div class="content">
                <div class="text">
                    <div class="name">Butterfly Research Team</div>
                    <div class="university">University of Ruhuna</div>
                    <div class="description">Butterflies are one of the most noticeable species of Earth's biodiversity.
                    </div>
                </div>
                <button>See More</button>
            </div>
        </div>
    </div>

    <div class="button">
        <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</div>
<!-- Slider -->

<!-- Search-bar -->
<div class="container">
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="searchInput" placeholder="Explore Organizations" id="search-bar-input">

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
                <div class="option" onclick="quickShortcut('')">All
                    <hr>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="option" onclick="userFollowedOrganizations('<?php echo $_SESSION['user_id'] ?>')">Followed
                        <hr>
                    </div>
                <?php endif; ?>

                <div class="option" onclick="quickShortcut('Sports')">Sports
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('Volunteer')">Volunteer
                    <hr>
                </div>
                <div class="option" onclick="quickShortcut('Arts & Performance')">Art & Performance
                    <hr>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Quick-shortcut-bar -->

<!-- organization-showing-section -->
<div class="container">
    <div class="outer-body-container">

        <!-- filters-section -->
        <div class="filters-section">
            <a href="<?php echo URLROOT ?>/organizations/add">
                <div class="add-event-button">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Request Organization</span>
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
                    <?php foreach ($data['organization_categories'] as $category): ?>
                        <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text"><?php echo $category->category_name ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- category filter -->

            .


        </div>
        <!-- filters-section -->

        <!-- organization-card-section -->
        <div class="content-section" id="content-section">


        </div>
        <!-- organization-card-section -->

    </div>
</div>
<!-- organization-showing-section -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/organizations/organizations-index.js"></script>
<script>
    function quickShortcut(category) {
        $.ajax({
            url: URLROOT + "/organizations/filterByCategory",
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

    function userFollowedOrganizations(userId) {
        $.ajax({
            url: URLROOT + "/organizations/userFollowedOrganizations",
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

    

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>