<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/knowledgehubs/knowledgehubs-add_style.css">
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
          <a href="<?php echo URLROOT ?>/knowledgehubs/add">
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
            <form action="<?php echo URLROOT; ?>/knowledgehubs/add" method="post" enctype="multipart/form-data">
            
                <div class="container">
                    <label for="title"><b>Post Title</b></label>
                    <input type="text" placeholder="Enter Post Title" name="title" value="<?php echo $data['title'] ?>" >
                    <?php if (!empty($data['title_err'])): ?>
                        <span class="error-message"><?php echo $data['title_err']; ?></span>
                    <?php endif; ?>

                    <label for="type"><b>Event Type</b></label>
                    <input type="text" placeholder="Enter Post Type" name="type" value="<?php echo $data['type'] ?>" >
                    <?php if (!empty($data['type_err'])): ?>
                        <span class="error-message"><?php echo $data['type_err']; ?></span>
                    <?php endif; ?>

                    <label for="description"><b>Description</b></label>
                    <textarea class="custom-text-area" name="description" value="<?php echo $data['description'] ?>" ><?php echo $data['description'] ?></textarea>
                    <?php if (!empty($data['description_err'])): ?>
                        <span class="error-message"><?php echo $data['description_err']; ?></span>
                    <?php endif; ?>

                    <label for="link"><b>Post Link</b></label>
                    <input type="text" placeholder="Enter Post Link" name="link" value="<?php echo $data['link'] ?>" >
                    <?php if (!empty($data['link_err'])): ?>
                        <span class="error-message"><?php echo $data['link_err']; ?></span>
                    <?php endif; ?>

                    <label for="knowledgehub_card_image"><b>Event Card Image</b></label>
                    <input class="file-upload" type="file" placeholder="Enter event card image" name="knowledgehub_card_image" value="<?php echo $data['knowledgehub_card_image'] ?>" >
                    <?php if (!empty($data['knowledgehub_card_image_err'])): ?>
                        <span class="error-message"><?php echo $data['knowledgehub_card_image_err']; ?></span>
                    <?php endif; ?>

                    <label for="knowledgehub_cover_image"><b>Event Cover Image</b></label>
                    <input class="file-upload" type="file" placeholder="Enter event cover image" name="knowledgehub_cover_image" value="<?php echo $data['knowledgehub_cover_image'] ?>" >
                    <?php if (!empty($data['event_cover_image_err'])): ?>
                        <span class="error-message"><?php echo $data['knowledgehub_cover_image_err']; ?></span>
                    <?php endif; ?>


                    <button class="form-button" type="submit">Add Post</button>
                </div>

            </form>
            <!-- add-form================================ -->
        </div>


          
      </div>


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>