<!-- <div class="header">
    <nav class="main-nav">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">UniHub.LK</label>
        <ul >
            <li><a class="active nav-elements" href="<?php echo URLROOT ?>/pages/index">Home</a></li>
            <li><a  class="nav-elements" href="<?php echo URLROOT ?>/events/index">Events</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/knowledgehubs/index">Knowledge Hub</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>#">Opportunities</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a class="active nav-elements" href="<?php echo URLROOT ?>/users/show/<?php echo $_SESSION['user_id'] ?>">
                    <i class="fa-solid fa-user"></i>
                    &nbsp <?php
                            if ($_SESSION['user_type'] === 'admin') {
                                echo 'Admin-' . $_SESSION['user_name'];
                            } elseif ($_SESSION['user_type'] === 'org') {
                                echo 'Org-' . $_SESSION['user_name'];
                            } else {
                                echo 'MY PROFILE-' . $_SESSION['user_name'];
                            }
                            ?>
                </a></li>
                <li><a class="active nav-elements" href="<?php echo URLROOT ?>/users/logout">Logout</a></li>
            <?php else : ?>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/login">Login</a></li>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div> -->




<!-- new-edition-here -->
<link rel="stylesheet" href="<?php echo URLROOT?>/css/navbar_style.css">
<!-- navigation-bar -->
<div class="nav-outer-container">
    <div class="container">
        <div class="navigation-bar-container">
            <nav>
                <!-- vertical navbar -->
                <ul class="sidebar">
                    <!-- <li><a href="#"><img src="unihub-logo.png" alt="" class="navbar-logo"></a></li> -->
                    <li onclick=hideSideBar()><a href="#" ><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Organizations</a></li>
                    <li><a href="#">KnowledgeHub</a></li>
                    <li><a href="#">Opportunties</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                </ul>


                <!-- horizontal-navbar -->
                <ul>
                    <!-- <li><a href="#"><img src="unihub-logo.png" alt="" class="navbar-logo"></a></li> -->
                    <li>
                        <a href="#" class="unihub-logo-text">UniHub.lk</a>
                    </li>
                    <li class="hideOnMobile"><a href="#">Events</a></li>
                    <li class="hideOnMobile"><a href="#">Organizations</a></li>
                    <li class="hideOnMobile"><a href="#">KnowledgeHub</a></li>
                    <li class="hideOnMobile"><a href="#">Opportunities</a></li>
                    <li class="hideOnMobile"><a href="#">Login</a></li>
                    <li class="hideOnMobile"><a href="#">Register</a></li>
                    <li class="hideOnMobile">
                        <a href="#">
                            <div class="profile-navigator">
                                <div class="profile-image">
                                    <img src="profile-image.jpg" alt="not found">
                                </div>
                                <div class="profile-name">
                                    <div class="user-name">Tharindra Fernando</div>
                                    <div class="user-type">Admin</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="menu-button" onclick=showSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- navigation-bar -->

<script src="<?php echo URLROOT?>/js/navbar.js"></script>
<!-- new-edition-here -->