<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/events/events-main_style.css">
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
          <!-- <button class="search-button">
              <i class="fa fa-search"
                style="font-size: 18px;">
              </i>
          </button> -->
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
        <div class="option-section">
          <a href="<?php echo URLROOT ?>/events/add">
            <div class="request-event-button">
              <i class="fa-regular fa-pen-to-square"></i>
              <span>Request Event</span>
            </div>
          </a>
          <!-- <input type="button" class="button" value="Request Event"> -->

          <!-- date-filter -->
          <div class="date-filter">
            <h1>Date</h1>
            <label class="checkbox-container">Today
              <input type="checkbox" checked="checked">
              <span class="checkmark"></span>
            </label>
            <label class="checkbox-container">Tomorrow
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="checkbox-container">Weekend
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>
          <!-- date-filter================================================ -->
        </div>

        <!-- card-displaying-section -->
        <div class="content-section">
          <div class="flash-message-section">
            <?php flash('event_message'); ?>
          </div>
        

        <?php foreach ($data['events'] as $event) : ?>
            <?php
              // Assuming $event->start_date_time is in the format 'Y-m-d H:i:s'
              $dateTime = new DateTime($event->date);
              $date = $dateTime->format('d');   // Extract the day of the month
              $month = $dateTime->format('M');  // Extract the abbreviated month
            ?>
            
              <div class="event-card">

                  <div class="image-section">
                    <a class="linked-card" href="<?php echo URLROOT ?>/events/show/<?php echo $event->eventId ?>">
                      <img src="<?php echo URLROOT ?>/img/event-card-images/<?php echo $event->event_card_image ?>" alt="event-card-img-1">
                    </a>
                  </div>
               
                  <div class="details-section">
                    <div class="event-date">
                      <div class="number-date"><?php echo $date; ?></div>
                      <div class="month"><?php echo $month; ?></div>
                    </div>
                    <div class="event-description">
                      <div class="event-title"><?php echo $event->title; ?></div>
                      <div class="event-location"><?php echo $event->location; ?></div> 
                      <div class="event-category"><?php echo $event->type; ?></div> 
                      posted by <?php echo $event->name; ?>  
                    </div>
                  </div>
            </div>
          
          <?php endforeach; ?>


          
        </div>
      </div>


      <!-- script for card loading -->
      <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script>


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>