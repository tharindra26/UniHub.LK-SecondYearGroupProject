<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/events-index_style.css">

<!-- title bar -->
    
<div class="title-bar">
        <div class="title-bar-txt">Events</div>
    </div>
    
    <!-- title bar -->

    <!-- Search-bar -->
    <div class="container">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="" id="" placeholder="Search anything">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <!-- Search-bar -->

    <!-- Quick-shortcut-bar -->
    <div class="container">
        <div class="shortcut-bar">
            <div class="section-name">Events</div>
            <div class="shortcut-options">
                <div class="option">Hackathons</div>
                <div class="option">Entertainment</div>
                <div class="option">Workshops</div>
            </div>
        </div>
    </div>
    <!-- Quick-shortcut-bar -->

    <!-- event-showing-section -->
    <div class="container">
        <div class="outer-body-container">

            <!-- filters-section -->
            <div class="filters-section">
                <a href="#">
                    <div class="add-event-button">
                        <i class="fa-solid fa-plus"></i>
                      <span>Add Event</span>
                    </div>
                </a>

                <!-- university-filter -->
                <div class="uni-filter ">
                    <div class="select-btn">
                        <span>Select University</span>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="uni-filter-content">
                        <div class="uni-reset-btn">Reset</div>
                        <div class="uni-filter-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search" id="">
                        </div>
                        <ul class="uni-filter-options">
                        </ul>
                    </div>     
                </div>
                <!-- university-filter -->

                <!-- date filter -->
                
                <div class="date-filter">
                    <input type="date" name="" id="date-input">
                    <span class="date-reset-btn"  onclick="resetDate()">Reset Date</span>
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

            <!-- events-card-section -->
            <div class="content-section">
                <div class="event-card">
                    <div class="image-section">
                        <img src="<?php echo URLROOT ?>/img/events/events_profile_images/default_event_profile_image.jpg " alt="">
                    </div>
                    <div class="details-section">
                        <div class="date-section">
                            <i class="fa-regular fa-calendar-days"></i> &nbsp THU NOV 16 &nbsp &nbsp
                            <i class="fa-solid fa-clock"></i> &nbsp 06:00 PM
                        </div>
                        <div class="title-section">Mad-Hack 3.0</div>
                        <div class="venue-section">UCSC-Colombo</div>
                        <a href="#" class="view-event-button">
                            <div class="">View Event</div>
                        </a>
                    </div>
                </div>


                <div class="event-card">
                    <div class="image-section">
                        <img src="sample-card-img.jpg" alt="">
                    </div>
                    <div class="details-section">
                        <div class="date-section">
                            <i class="fa-regular fa-calendar-days"></i> &nbsp THU NOV 16 &nbsp &nbsp
                            <i class="fa-solid fa-clock"></i> &nbsp 06:00 PM
                        </div>
                        <div class="title-section">Mad-Hack 3.0</div>
                        <div class="venue-section">UCSC-Colombo</div>
                        <a href="#" class="view-event-button">
                            <div class="">View Event</div>
                        </a>
                    </div>
                </div>


                <div class="event-card">
                    <div class="image-section">
                        <img src="sample-card-img.jpg" alt="">
                    </div>
                    <div class="details-section">
                        <div class="date-section">
                            <i class="fa-regular fa-calendar-days"></i> &nbsp THU NOV 16 &nbsp &nbsp
                            <i class="fa-solid fa-clock"></i> &nbsp 06:00 PM
                        </div>
                        <div class="title-section">Mad-Hack 3.0</div>
                        <div class="venue-section">UCSC-Colombo</div>
                        <a href="#" class="view-event-button">
                            <div class="">View Event</div>
                        </a>
                    </div>
                </div>


                <div class="event-card">
                    <div class="image-section">
                        <img src="sample-card-img.jpg" alt="">
                    </div>
                    <div class="details-section">
                        <div class="date-section">
                            <i class="fa-regular fa-calendar-days"></i> &nbsp THU NOV 16 &nbsp &nbsp
                            <i class="fa-solid fa-clock"></i> &nbsp 06:00 PM
                        </div>
                        <div class="title-section">Mad-Hack 3.0</div>
                        <div class="venue-section">UCSC-Colombo</div>
                        <a href="#" class="view-event-button">
                            <div class="">View Event</div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- events-card-section -->

        </div> 
    </div>
    <!-- event-showing-section -->




<script src="<?php echo URLROOT?>/js/events/events-index.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>