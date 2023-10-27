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
          <button>
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
          <input type="button" class="button" value="Request Event">
        </div>
        <div class="content-section"></div>
      </div>

      


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>