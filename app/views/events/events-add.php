<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/events/events-add_style.css">
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
            <!-- add-form -->
            <form action="<?php echo URLROOT; ?>/events/add" method="post" enctype="multipart/form-data">
            
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


                    <button class="form-button" type="submit">Add Event</button>
                </div>

            </form>
            <!-- add-form================================ -->
        </div>


          
      </div>


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>