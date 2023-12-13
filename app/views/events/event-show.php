<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/event-show_style.css">

    <div class="event-header">
        <div class="cover-image-section">
            <img src="<?php echo URLROOT ?>/img/events/events_cover_images/<?php echo $data['event']->event_cover_image ?>" alt="event cover image">
            <div class="title-overlay">
                <h1><?php echo $data['event']->title ?></h1>
            </div>
        </div>
        <div class="secondary-section">
            <div class="countdown-section">
                <div class="countdown-header">
                    <div class="countdown-header-text"><?php echo $data['event']->countdown_text ?></div>
                </div>
                <div class="countdown">
                    <div class="days countdown-box">
                        <p id="days">20</p> 
                        <span>DAYS</span>
                    </div>
                    <div class="hours countdown-box">
                        <p id="hours">5</p> 
                        <span>HOURS</span>
                    </div>
                    <div class="mins countdown-box">
                        <p id="minutes">4</p> 
                        <span>MINS</span>
                    </div>
                    <div class="sec countdown-box">
                        <p id="seconds">32</p> 
                        <span >SECS</span>
                    </div>
                    <a class="main-action-button-link" href="<?php echo $data['event']->main_button_link ?>">
                        <div class="main-action-button">
                            <span><?php echo $data['event']->main_button_action ?></span>
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

                    <?php
                        $description = $data['event']->description; // Assuming $data['event']->description contains the full text
                        $words = explode(' ', $description);
                        $first100Words = implode(' ', array_slice($words, 0, 100));
                        $remainingWords = implode(' ', array_slice($words, 100));
                    ?>
                    <div class="description-title">
                        <?php echo $data['event']->title ?>
                    </div>
                    <div class="description">
                        <p> <?php echo $first100Words ?>
                            <span class="read-more-text">
                                <?php echo $remainingWords ?>
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
                    <?php
                        // Assuming $data['event']->date contains the datetime string
                        $original_start_datetime = $data['event']->start_datetime;

                        // Create a DateTime object from the original datetime string
                        $dateTime = new DateTime($original_start_datetime);

                        // Format the datetime as 'Y-m-d h:i A'
                        $formattedDatetime = $dateTime->format('Y-m-d h:i A');
                    ?>
                        <i class="fa-solid placement-icons fa-calendar-days"></i> &nbsp <?php echo $formattedDatetime ?>
                    </div>
                    <div class="venue">
                        <i class="fa-solid placement-icons fa-location-dot"></i> &nbsp <?php echo $data['event']->venue ?>
                    </div>
                    <div class="organization">
                        <i class="fa-solid placement-icons fa-medal"></i> &nbsp <?php echo $data['event']->organized_by?>
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