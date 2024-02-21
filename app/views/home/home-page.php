<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/home-page/home-page_style.css">


<div class="front-face">
    <!-- navigation-bar -->
    <div class="nav-outer-container">
        <div class="container">
            <div class="navigation-bar-container">
                <nav>
                    <!-- vertical navbar -->
                    <ul class="sidebar">
                        <!-- <li><a href="#"><img src="unihub-logo.png" alt="" class="navbar-logo"></a></li> -->
                        <li onclick=hideSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26"
                                    viewBox="0 -960 960 960" width="26">
                                    <path
                                        d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                </svg></a></li>
                        <?php if (isset($_SESSION["user_id"])): ?>
                            <li>
                                <a href="<?php echo URLROOT ?>/users/show">
                                    <div class="profile-navigator">
                                        <div class="profile-image">
                                            <img src="profile-image.jpg" alt="not found">
                                        </div>
                                        <div class="profile-name">
                                            <div class="user-name">
                                                <?php echo $_SESSION["user_name"] ?>
                                            </div>
                                            <div class="user-type">
                                                <?php echo $_SESSION["user_type"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li><a href="<?php echo URLROOT ?>/pages/index">Home</a></li>
                        <li><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
                        <li><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>
                        <li><a href="<?php echo URLROOT ?>/posts/index">Posts</a></li>
                        <li><a href="<?php echo URLROOT ?>/opportunities/index">Opportunties</a></li>

                        <?php if (!isset($_SESSION["user_id"])): ?>
                            <li><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
                            <li><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo URLROOT ?>/users/logout">Logout</a></li>
                        <?php endif; ?>

                    </ul>


                    <!-- horizontal-navbar -->
                    <ul>
                        <!-- <li><a href="#"><img src="unihub-logo.png" alt="" class="navbar-logo"></a></li> -->
                        <li>
                            <a href="#" class="unihub-logo-text">UniHub.lk</a>
                        </li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/pages/index"><i
                                    class="fa-solid fa-house"></i> &nbsp Home</a></li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a>
                        </li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/posts/index">Posts</a>
                        </li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/opportunities/index">Opportunities</a>
                        </li>


                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="hideOnMobile">
                                <a href="<?php echo URLROOT ?>/users/show">
                                    <div class="profile-navigator">
                                        <div class="profile-image">
                                            <img src="<?php echo URLROOT ?>/img/users/default/<?php echo $_SESSION["user_profile_image"] ?>"
                                                alt="not found">
                                        </div>
                                        <div class="profile-name">
                                            <div class="user-name">
                                                <?php echo $_SESSION["user_name"] ?>
                                            </div>
                                            <div class="user-type">
                                                <?php echo $_SESSION["user_type"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/logout"><i
                                        class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp Signout</a></li>

                        <?php else: ?>
                            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
                            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
                        <?php endif; ?>

                        <li class="menu-button" onclick=showSideBar()><a href="#"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26">
                                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                                </svg></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- navigation-bar -->


    <div class="container">

        <div class="middle-part">
            <div class="left-part">

                <div class="content-section">
                    <div class="first-text">
                        <div class="empowering">Empowering</div>
                    </div>
                    <div class="second-text">
                        <div class="sri-lankan">Sri Lankan</div>
                        <div class="under">Undergraduates</div>
                    </div>
                    <div class="bottom-underline"></div>
                    <div class="caption" id="typewriter-caption">
                        Unlocking Opportunities, Fostering Connections, and Elevating Education for a Brighter
                        Future
                    </div>
                </div>
                <div class="button-section">
                    <div class="button-caption">Are you a Sri Lankan undergraduate seeking community and growth? Join
                        us!
                    </div>

                    <div class="options">
                        <a class="join-btn " href="<?php echo URLROOT ?>/users/login">
                            <i class="fa-solid fa-rocket"></i> &nbsp Join the Community
                        </a>
                        <a class="discover-btn " href="#">
                            Discover More
                        </a>
                    </div>
                </div>

            </div>
            <div class="right-part">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>

        </div>

    </div>





    <script src="<?php echo URLROOT ?>/js/navbar.js"></script>

    <script src="<?php echo URLROOT ?>/js/home/home.js"></script>
    <script src="<?php echo URLROOT ?>/js/home/app.js"></script>



    <?php require APPROOT . '/views/inc/footer.php'; ?>