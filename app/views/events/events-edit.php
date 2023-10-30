<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/events/events-edit_style.css">
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
                <img src="<?php echo URLROOT ?>/img/event-cover-images/<?php echo $data['event_cover_image'] ?>">
            </div>
            <div class="header-inner-box">
                <div class="top-half">
                    <div class="left-part">
                        <div class="title-part"><?php echo $data['event_title'] ?></div>
                        <div class="sub-details-part"><?php echo $data['event_type']; ?></div>
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
                        $rawDateTime = $data['date'];

                        // Convert the raw datetime to a timestamp
                        $timestamp = strtotime($rawDateTime);

                        // Format the timestamp as "01st JUNE 10:10PM"
                        $formattedDateTime = date("dS F Y h:ia", $timestamp);
                    ?>
                    <div class="date-text"><i class="fa-solid fa-calendar-days"></i> &nbsp <?php echo $formattedDateTime; ?></div>
                    <div class="location-text"><i class="fa-solid fa-location-dot"></i> &nbsp <?php echo $data['location']; ?></div>
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
                    <?php echo flash('event_message') ?>
                <!-- add-form -->
                    <form action="<?php echo URLROOT; ?>/events/edit/<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="container">
                        <label for="event_title"><b>Event Title</b></label>
                        <input type="text" placeholder="Enter Event Title" name="event_title" value="<?php echo $data['event_title'] ?>" >
                        <?php if (!empty($data['event_title_err'])): ?>
                            <span class="error-message"><?php echo $data['event_title_err']; ?></span>
                        <?php endif; ?>

                        <label for="event_type"><b>Event Type</b></label>
                        <input type="text" placeholder="Enter Event Type" name="event_type" value="<?php echo $data['event_type'] ?>" >
                        <?php if (!empty($data['event_type_err'])): ?>
                            <span class="error-message"><?php echo $data['event_type_err']; ?></span>
                        <?php endif; ?>

                        <label for="description"><b>Description</b></label>
                        <textarea class="custom-text-area" name="description" value="<?php echo $data['description'] ?>" ><?php echo $data['description'] ?></textarea>
                        <?php if (!empty($data['description_err'])): ?>
                            <span class="error-message"><?php echo $data['description_err']; ?></span>
                        <?php endif; ?>

                        <label for="date"><b>Date</b></label>
                        <input type="datetime-local" name="date" value="<?php echo $data['date'] ?>" >
                        <?php if (!empty($data['date_err'])): ?>
                            <span class="error-message"><?php echo $data['date_err']; ?></span>
                        <?php endif; ?>

                        <label for="location"><b>Location</b></label>
                        <input type="text" placeholder="Enter Location" name="location" value="<?php echo $data['location'] ?>" >
                        <?php if (!empty($data['location_err'])): ?>
                            <span class="error-message"><?php echo $data['location_err']; ?></span>
                        <?php endif; ?>

                        <label for="event_card_image"><b>Event Card Image</b></label>
                        <input class="file-upload" type="file" placeholder="Enter event card image" name="event_card_image" value="<?php echo $data['event_card_image'] ?>" >
                        <?php if (!empty($data['event_card_image_err'])): ?>
                            <span class="error-message"><?php echo $data['event_card_image_err']; ?></span>
                        <?php endif; ?>

                        <label for="event_cover_image"><b>Event Cover Image</b></label>
                        <input class="file-upload" type="file" placeholder="Enter event cover image" name="event_cover_image" value="<?php echo $data['event_cover_image'] ?>" >
                        <?php if (!empty($data['event_cover_image_err'])): ?>
                            <span class="error-message"><?php echo $data['event_cover_image_err']; ?></span>
                        <?php endif; ?>


                        <button class="form-button" type="submit">Update Event</button>
                    </div>

                </form>
                <!-- add-form================================ -->
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

                    <a  href="<?php echo URLROOT ?>/events/edit/<?php echo $data['id'] ?>">
                    <div class="update-event">
                        <i class="fa-solid fa-wrench"></i>
                        &nbsp Update Event
                    </div>
                    </a>
                    
                    <!-- <a  href="<?php echo URLROOT ?>/events/delete/<?php echo $data['id'] ?>">
                    <div class="delete-event">
                        <i class="fa-regular fa-trash-can"></i>
                        &nbsp Delete Event
                    </div>
                    </a> -->
                    <form  action="<?php echo URLROOT; ?>/events/delete/<?php echo $data['id'] ?>" method="post">
                        <input type="submit" value="Delete" class="delete-event">
                    </form>
                </div>
            </div>
        </div>
        
      </div>


      <!-- script for card loading -->
      <!-- <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script> -->


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>