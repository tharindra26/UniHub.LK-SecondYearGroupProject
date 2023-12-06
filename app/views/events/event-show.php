<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<?php echo var_dump($data) ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/event-show_style.css">

    <div class="event-header">
        <div class="cover-image-section">
            <img src="sample-cover-image.jpg" alt="event cover image">
            <div class="title-overlay">
                <h1>Event-Title</h1>
            </div>
        </div>
        <div class="secondary-section">
            <div class="countdown-section">
                <div class="countdown-header">
                    <div class="countdown-header-text">Event will start on</div>
                </div>
                <div class="countdown">
                    <div class="days countdown-box">
                        <p>20</p> 
                        <span>DAYS</span>
                    </div>
                    <div class="hours countdown-box">
                        <p>5</p> 
                        <span>HOURS</span>
                    </div>
                    <div class="mins countdown-box">
                        <p>4</p> 
                        <span>MINS</span>
                    </div>
                    <div class="sec countdown-box">
                        <p>32</p> 
                        <span>SECS</span>
                    </div>
                    <a class="main-action-button-link" href="#">
                        <div class="main-action-button">
                            <span>Register Now</span>
                            <i class="fa-solid fa-angles-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="event-profile-image-section">
                <div class="event-profile-image">
                    <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $data['event']->event_profile_image ?>" alt="">
                </div>
            </div>
            <div class="event-reaction-section">
                <a href="#" class="event-reaction-link">
                    <div class="interested-btn reaction-btn">
                        <i class="fa-regular fa-face-grin-hearts"></i>
                        <span>&nbsp Interested</span>
                    </div>
                </a>
                <a href="#" class="event-reaction-link"> 
                    <div class="going-btn reaction-btn">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>&nbsp Going</span>
                    </div>
                </a>
            </div>
        </div>  
    </div>

    <div class="container">
        <div class="bottom-main-section">

            <!-- left-section -->
            <div class="left-section">
                <div class="social-media">
                    <div class="social-media-title">
                        Follow us on
                    </div>
                    <div class="icons">
                        <div class="icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="icon">
                            <i class="fa-brands fa-facebook"></i>
                        </div>
                        <div class="icon">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="icon">
                            <i class="fa-brands fa-linkedin"></i>
                        </div>  
                    </div>    
                </div>

                <div class="event-settings">
                    <a href="#" class="event-settings-link">
                        <div class="event-settings-btn">
                            <i class="fa-solid fa-gear"></i> &nbsp Event Settings
                        </div>
                    </a>
                </div>
            </div>
            <!-- left-section -->

            <!-- middle-section -->
            <div class="middle-section">
                <div class="event-description">
                    <div class="description-title">
                        Event-Title
                    </div>
                    <div class="description">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit, quisquam? Asperiores ipsa et quam ducimus porro labore earum odit deserunt quisquam eius. 
                            <span class="read-more-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. At debitis voluptate nihil? Molestias quidem ea reiciendis id vel tenetur saepe, obcaecati voluptatibus quis earum nostrum adipisci inventore consequatur laborum tempore in similique? Fugit quod ab corrupti vero accusantium tempora repellendus blanditiis eos hic, ipsa a adipisci! Vitae, aliquid assumenda quasi adipisci, illo necessitatibus labore illum numquam accusantium asperiores quo ea nisi sed! Eligendi, quibusdam. 
                            </span>
                        </p>
                        <span class="read-more-btn">Read More</span>
                    </div>
                </div>
            </div>
            <!-- middle-section -->

            <!-- right-section -->
            <div class="right-section">
                <div class="placement">
                    <div class="date-time">
                        <i class="fa-solid placement-icons fa-calendar-days"></i> &nbsp 2023-12-15 &nbsp 19:00:00
                    </div>
                    <div class="venue">
                        <i class="fa-solid placement-icons fa-location-dot"></i> &nbsp Viharamahadevi Open Air Theatre
                    </div>
                    <div class="organization">
                        <i class="fa-solid placement-icons fa-medal"></i> &nbsp Organized by IEEE Student Branch @UCSC
                    </div>
                </div>

                <div class="event-map">
                    Event-map
                </div>
            </div>
            <!-- right-section -->
        </div>
        
    </div>





    <script src="<?php echo URLROOT?>/js/events/event-show.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>