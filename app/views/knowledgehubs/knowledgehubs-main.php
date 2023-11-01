<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/knowledgehubs/knowledgehubs-main_style.css">
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
        <div class="section-name">Knowledge Hub</div>
        <div class="shortcut-set">
          <nav class="shortcut-options">
            <ul>
              <li><a  href="#">Blog Posts</a></li>
              <li><a  href="#">Research Papers</a></li>
              <li><a  href="#">Social Media Posts</a></li>
            </ul>
          </nav>
          
        </div>
      </div>


      <div class="outer-body-container">
        <div class="option-section">
          <a href="<?php echo URLROOT ?>/knowledgehubs/add">
            <div class="request-event-button">
              <i class="fa-regular fa-pen-to-square"></i>
              <span>Share Post</span>
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
        

        <?php foreach ($data['knowledgehubs'] as $knowledgehub) : ?>
            
              <div class="event-card">

                  <div class="image-section">
                    <a class="linked-card" href="<?php echo URLROOT ?>/knowledgehubs/show/<?php echo $knowledgehub->knowledgehubId ?>">
                      <img src="<?php echo URLROOT ?>/img/knowledgehub-card-images/<?php echo $knowledgehub->knowledgehub_card_image ?>" alt="knowledgehub-card-img-1">
                    </a>
                  </div>
               
                  <div class="details-section">
                    <div class="knowledgehub-description">
                      <div class="knowledgehub-title"><?php echo $knowledgehub->title; ?></div>
                      <div class="knowledgehub-type"><?php echo $knowledgehub->type; ?></div> 
                      <div class="knowledgehub-published">posted by-<?php echo $knowledgehub->name; ?></div>  
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