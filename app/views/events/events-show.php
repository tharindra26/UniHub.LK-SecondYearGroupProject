<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/events/events-show_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <div class="border-container">

      <div class="search">
        <form action="#">
          <input type="text"
                class="search-input"
                placeholder=" Search "
                name="search">
          <button class="search-button">
              <i class="fa fa-search"
                style="font-size: 18px;">
              </i>
          </button>
        </form>
      </div>

      <div class="quick-shortcut-bar">
        <div class="section-name">Events</div>
        <div class="shortcut-set">
          <nav class="shortcut-options">
            <ul>
              <li><a  href="#">Hackathons</a></li>
              <li><a  href="#">Entertainments</a></li>
              <li><a  href="#">Workshops</a></li>
            </ul>
          </nav>
          
        </div>
      </div>


      <div class="outer-body-container">
        <div class="header-outer-box">
            <div class="cover-image">
                <img src="<?php echo URLROOT ?>/img/event-cover-images/Shankar Mahadevan1-event-cover-image.jpg">
            </div>
            <div class="header-inner-box">
                <div class="top-half">
                    <div class="left-part">
                        <div class="title-part"><?php echo $data['event']->title; ?></div>
                        <div class="sub-details-part"><?php echo $data['event']->type; ?></div>
                    </div>
                    <div class="right-part">
                        <div class="link-button">
                            Register
                        </div>
                    </div>
                </div>
                <div class="middle-line"></div>
                <div class="bottom-half">
                    <?php
                        $rawDateTime = $data['event']->date;

                        // Convert the raw datetime to a timestamp
                        $timestamp = strtotime($rawDateTime);

                        // Format the timestamp as "01st JUNE 10:10PM"
                        $formattedDateTime = date("dS F Y h:ia", $timestamp);
                    ?>
                    <div class="date-text"><i class="fa-solid fa-calendar-days"></i> &nbsp <?php echo $formattedDateTime; ?></div>
                    <div class="location-text"><i class="fa-solid fa-location-dot"></i> &nbsp <?php echo $data['event']->location; ?></div>
                </div>
            </div>
        </div>
        <div class="content-outer-box">
            <div class="left-section">
                <div class="social-media-box">
                    <div class="social-media-text">
                        Share this event
                    </div>
                    <div class="social-media-icons">
                        <i class="fa-brands fa-square-facebook"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-linkedin"></i>
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    
                </div>
            </div>
            <div class="middle-section">
                <div class="event-description-box">
                <?php echo $data['event']->description; ?>
                <!-- Stand-Up Comedy with a Musical Twist The Jagane Thandiram event is designed to appeal to a broad audience demographic, 
                spanning from ages 13 to 60. As a family-friendly show, it promises wholesome entertainment suitable for all generations, 
                ensuring that attendees can enjoy a memorable evening of laughter and bonding with their loved ones.
                Stand-Up Comedy with a Musical Twist The Jagane Thandiram event is designed to appeal to a broad audience demographic, 
                spanning from ages 13 to 60. As a family-friendly show, it promises wholesome entertainment suitable for all generations, 
                ensuring that attendees can enjoy a memorable evening of laughter and bonding with their loved ones.
                Stand-Up Comedy with a Musical Twist The Jagane Thandiram event is designed to appeal to a broad audience demographic, 
                spanning from ages 13 to 60. As a family-friendly show, it promises wholesome entertainment suitable for all generations, 
                ensuring that attendees can enjoy a memorable evening of laughter and bonding with their loved ones. -->
                </div>
            </div>
            <div class="right-section">
                <div class="action-box">
                    <div class="add-calender-event">
                        <i class="fa-regular fa-calendar-check"></i>
                        &nbsp Add to Calendar
                    </div>

                    <div class="report-event">
                        <i class="fa-solid fa-bug"></i>
                        &nbsp Report Event
                    </div>

                    <div class="update-event">
                        <i class="fa-solid fa-wrench"></i>
                        &nbsp Update Event
                    </div>

                    <div class="delete-event">
                        <i class="fa-regular fa-trash-can"></i>
                        &nbsp Delete Event
                    </div>
                </div>
            </div>
        </div>
        
      </div>


      <!-- script for card loading -->
      <!-- <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script> -->


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>