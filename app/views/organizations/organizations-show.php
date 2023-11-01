<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/organizations/organizations-show_style.css">
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
        <div class="header-outer-box">
            <div class="cover-image">
               
                <img src="<?php echo URLROOT ?>/img/organization-cover-images/<?php echo $data['organization']->organization_cover_image; ?>">
            </div>
            <div class="header-inner-box">
                <div class="top-half">
                    <div class="left-part">
                        <div class="title-part"><?php echo $data['organization']->name; ?></div>
                        <div class="sub-details-part"><?php echo $data['organization']->university; ?></div>
                    </div>
                    <div class="right-part">
                        <div class="link-button">
                            Join With Us
                        </div>
                    </div>
                </div>
                <div class="middle-line"></div>
                <div class="bottom-half">
                    <div class="date-text"><i class="fa-solid fa-link"></i> &nbsp <?php echo $data['organization']->link; ?></div>
                </div>
            </div>
        </div>
        <div class="content-outer-box">
            <div class="left-section">
                <div class="social-media-box">
                    <div class="social-media-text">
                        Connect with us
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
                <?php echo $data['organization']->description; ?>
                </div>
            </div>
            <div class="right-section">
                <div class="action-box">
                    <div class="add-calender-event">
                        <i class="fa-solid fa-heart"></i>
                        &nbsp Follow Us
                    </div>

                    <div class="report-event">
                        <i class="fa-solid fa-bug"></i>
                        &nbsp Report Organization
                    </div>

                    
                    <?php if(isset($_SESSION['user_id'])):?>
                        <?php if($_SESSION['user_id'] == $data['organization']-> user_id || $_SESSION['user_type'] == 'admin'):?>
                            <a  href="<?php echo URLROOT ?>/organizations/edit/<?php echo $data['organization']->id; ?>">
                                <div class="update-event">
                                    <i class="fa-solid fa-wrench"></i>
                                    &nbsp Update Organization
                                </div>
                            </a>
                        
                            <form  action="<?php echo URLROOT; ?>/organizations/delete/<?php echo $data['organization']->id; ?>" method="post">
                                <input type="submit" value="Delete" class="delete-event">
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        
      </div>


      <!-- script for card loading -->
      <!-- <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script> -->


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>