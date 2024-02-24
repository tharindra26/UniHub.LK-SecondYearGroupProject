<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organizations-show_style.css">

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

    <!-- title bar -->
    <div class="title">
        <div class="title-image"></div>
        <div class="org-info">
            <div class="org-name">AIESEC in Colombo Central</div>
            <div class="org-university">University of Colombo</div>
            <div class="org-des">AIESEC is a global platform for young people to explore and develop their leadership potential. We are a non-partisan, independent, not-for-profit organization run by students and recent graduates of institutions of higher education. Its members are interested in world issues, leadership, and management. AIESEC does not discriminate on the basis of gender, sexual orientation, disabilities, creed, religion, nor on the basis of national, ethnic, or social origin.</div>
        </div>
        <div class="logo"></div>
    </div>
    <!-- title bar -->

    <!-- organization-info-section -->
    <div class="container">
        <div class="outer-body-container">
            <div class="social-media">
                <div class="wrapper">
                    <div class="icon facebook">
                        <div class="tooltip">Facebook</div>
                        <span><i class="fa-brands fa-facebook-f"></i></span>
                    </div>
                    <div class="icon twitter">
                        <div class="tooltip">Twitter</div>
                        <span><i class="fa-brands fa-x-twitter"></i></span>
                    </div>
                    <div class="icon instagram">
                        <div class="tooltip">Instagram</div>
                        <span><i class="fa-brands fa-instagram"></i></span>
                    </div>
                    <div class="icon youtube">
                        <div class="tooltip">Youtube</div>
                        <span><i class="fa-brands fa-youtube"></i></span>
                    </div>
                    <div class="icon tikTok">
                        <div class="tooltip">TikTok</div>
                        <span><i class="fa-brands fa-tiktok"></i></span>
                    </div>
                    <div class="icon linkedin">
                        <div class="tooltip">LinkedIn</div>
                        <span><i class="fa-brands fa-linkedin-in"></i></span>
                    </div>
                </div>
            </div>

            <!-- organization-section -->
            <div class="section-1">
                <div class="recent-events">
                    <div class="events-heading">Recent Events</div>
                    <div class="slider-wrapper">
                        <button id="prev-slide" class="slide-button material-symbols-rounded">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>

                        <div class="image-list">
                            <img src="img/event-1.jpg" alt="event-1" class="image-item">
                            <img src="img/event-2.jpg" alt="event-2" class="image-item">
                            <img src="img/event-3.jpg" alt="event-3" class="image-item">
                            <img src="img/event-4.jpg" alt="event-4" class="image-item">
                            <img src="img/event-5.jpg" alt="event-5" class="image-item">
                        </div>

                        <button id="next-slide" class="slide-button material-symbols-rounded">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="slider-scrollbar">
                        <div class="scrollbar-track">
                            <div class="scrollbar-thumb"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- organizations-section -->
        </div> 
    </div>
    <!-- organization-info-section -->
    
<script src="<?php echo URLROOT ?>/js/organizations/organizations-show.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>