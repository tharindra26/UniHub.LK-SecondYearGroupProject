<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <!-- Start Editing area -->

    <!--Start Image Slider -->
    <div class="slider">
        <div class="list">
            <div class="item">
            
                <img src="<?php echo URLROOT?>/img/home-images/image1.jpg" alt="">
            </div>
            <div class="item">
                <img src="<?php echo URLROOT?>/img/home-images/image2.jpg" alt="">
            </div>
            <div class="item">
                <img src="<?php echo URLROOT?>/img/home-images/image3.jpg" alt="">
            </div>
            <div class="item">
                <img src="<?php echo URLROOT?>/img/home-images/image4.jpg" alt="">
            </div>
        </div>

        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    
    <!--End Image Slider -->

    <!--Start Search Bar -->
    <div class="search">
        <form action="#">
          <input type="text"
                class="search-input"
                placeholder=" Search "
                name="search">
        </form>
      </div>
      <!--End Search Bar -->

      <!--Start Events Slider -->

      <div class="container-box">
        <div class="material-uploads">
            <div class="txt">
                <h1>EVENTS</h1>
            </div>
            
            <div class="material-slider">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                    <li class="card">
                        <h2>Name</h2>
                        <span>Description</span>
                    </li>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
    
        </div>
    </div>

      <!--End Events Slider -->

    <!-- End Editing area -->


      <!-- script for card loading -->
      <!-- <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script> -->



    </div>

    
    <script type="text/javascript" src="<?php echo URLROOT?>/js/home.js"></script>
   <!--<script src="<?php echo URLROOT; ?>/js/main.js"></script>-->
    </body>
</html>
<?php require APPROOT .'/views/inc/footer.php'; ?>



