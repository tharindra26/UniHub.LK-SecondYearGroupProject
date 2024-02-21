<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organizations-index_style.css">

<!-- Search-bar -->
<div class="search-bar-container">
    <div class="container">
        <form action="" class="search-bar">
            <input type="text" name="" id="" placeholder="Search anything">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</div>
<!-- Search-bar -->

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

<!-- Quick-shortcut-bar -->
<div class="container">
    <div class="shortcut-bar">
        <div class="section-name">Organizations</div>
        <div class="shortcut-options">
            <div class="option">All</div>
            <div class="option">Academic</div>
            <div class="option">Community Service</div>
            <div class="option">Media</div>
            <div class="option">Multi Cutural</div>
            <div class="option">Sports</div>
            <div class="option">Perforaming Arts</div>
        </div>
    </div>
</div>
<!-- Quick-shortcut-bar -->

<!-- organizations-showing-section -->
<div class="container">
    <div class="outer-body-container">
        <!-- filters-section -->
        <div class="filters-section">
                <a href="<?php echo URLROOT ?>/organizations/add">
                    <div class="add-organization-button">
                        <i class="fa-solid fa-plus"></i>
                    <span>Add Organization</span>
                    </div>
                </a>

                <!-- university-filter -->
                <div class="uni-filter">
                    <div class="select-btn">
                        <span>Select University</span>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="uni-filter-content">
                        <div class="reset-btn">Reset</div>
                        <div class="uni-filter-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search" id="">
                        </div>
                        <ul class="uni-filter-options">
                        </ul>
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

                    <ul class="list-items">
                        <div class="category-reset-btn">Reset</div>
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
                    </ul>
                </div>
                <!-- category filter -->
            </div>
            <!-- filters-section -->

        <!-- organizations-card-section -->
        <div class="organizations-section">
            <?php if (!empty($data['organizations'][0]->id)): ?>
                <?php foreach ($data['organizations'] as $organization): ?>
                    <div class="item-container">
                        <div class="item-image-container">
                            <img src="<?php echo URLROOT ?>/img/organizations/organization_logos/<?php echo $organization->logo ?>"
                                alt="organization logo">
                        </div>
                        <div class="item-content">
                            <div class="organization-name">
                                <?php echo $organization->name ?>
                            </div>
                            <div class="line"></div>
                            <div class="organization-university">
                                <?php echo $organization->university ?>
                            </div>
                        </div>
                        <div class="membership">
                            <div class="number" m-number="<?php echo $organization->member_count ?>">0</div>
                            <a href="<?php echo URLROOT ?>/organizations/show/<?php echo $organization->id ?>" class ="view-org-btn">View Organization</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No organizations available.</p>
            <?php endif; ?>
        </div>
        <!-- organizations-card-section -->
    </div>
</div>
<!-- organizations-showing-section -->
<script src="<?php echo URLROOT ?>/js/organizations/organizations-index.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>