<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/organizations/organizations-main_style.css">
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
        <div class="section-name">Organizations</div>
        <div class="shortcut-set">
          <nav class="shortcut-options">
            <ul>
              <li><a  href="#">Trending</a></li>
              <li><a  href="#">Technical</a></li>
              <li><a  href="#">Religious</a></li>
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
            <h1>Categories</h1>
            <label class="checkbox-container">Clubs and Societies
              <input type="checkbox" checked="checked">
              <span class="checkmark"></span>
            </label>
            <label class="checkbox-container">Technical
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="checkbox-container">Religious
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
        


        <?php foreach ($data['organizations'] as $organization) : ?>
            
            <div class="event-card">

                <div class="image-section">
                    <a class="linked-card" href="<?php echo URLROOT ?>/organizations/show/<?php echo $organization->organizationId ?>">
                        <img src="<?php echo URLROOT ?>/img/organization-card-images/<?php echo $organization->organization_card_image ?>" alt="organization-card-img-1">
                    </a>
                </div>

                <div class="details-section">
                    <div class="knowledgehub-description">
                        <div class="knowledgehub-title"><?php echo $organization->name; ?></div>
                        <div class="knowledgehub-type"><?php echo $organization->university; ?></div>   
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