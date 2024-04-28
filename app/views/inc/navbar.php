<!-- new-edition-here -->
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/navbar_style.css">
<!-- navigation-bar -->
<div class="nav-outer-container">
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
                    <a href="<?php echo URLROOT ?>/users/show/<?php echo $_SESSION['user_id'] ?>">
                        <div class="profile-navigator">
                            <div class="profile-image">
                                <?php
                                if ($_SESSION['user_type'] === 'orgrep') {
                                    echo '<img src="' . URLROOT . '/img/organizations/organization_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                } else {
                                    echo '<img src="' . URLROOT . '/img/users/users_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                }
                                ?>
                            </div>
                            <div class="profile-name">
                                <div class="user-name"><?php echo $_SESSION["user_name"] ?></div>
                                <div class="user-type"><?php echo $_SESSION["user_type"] ?></div>
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
            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/pages/index"><i class="fa-solid fa-house"></i> &nbsp
                    Home</a></li>
            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>
            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/posts/index">Posts</a></li>
            <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/opportunities/index">Opportunities</a></li>
            <li class="hideOnMobile">
                <div class="notification-icon" onclick="toggleNotificationList()">
                    <i class="fa-solid fa-bell"></i>
                    <div class="notification-count">3</div>
                    <div class="notification-list" id="notification-list">
                        <!-- Notification items will go here -->
                        <div class="notification-item">
                            <div class="notification-text">Notification1</div>
                            <hr>
                        </div>

                        <!-- Add more notification items as needed -->
                    </div>
                </div>
            </li>




            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="hideOnMobile">
                    <a href="#">
                        <div class="profile-navigator" onclick="toggleMenu()">
                            <div class="profile-image">
                                <?php
                                if ($_SESSION['user_type'] === 'orgrep') {
                                    echo '<img src="' . URLROOT . '/img/organizations/organization_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                } else {
                                    echo '<img src="' . URLROOT . '/img/users/users_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                }
                                ?>
                            </div>
                            <div class="profile-name">
                                <div class="user-name"><?php echo $_SESSION["user_name"] ?></div>
                                <div class="user-type"><?php echo $_SESSION["user_type"] ?></div>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- sub-menu-wrap -->
                <div class="sub-menu-wrap" id="sub-menu-wrap">
                    <div class="sub-menu">
                        <a href="<?php echo URLROOT ?>/users/show/<?php echo $_SESSION['user_id'] ?>" class="user-info">
                            <div class="sub-menu-profile-image">
                                <?php
                                if ($_SESSION['user_type'] === 'orgrep') {
                                    echo '<img src="' . URLROOT . '/img/organizations/organization_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                } else {
                                    echo '<img src="' . URLROOT . '/img/users/users_profile_images/' . $_SESSION["user_profile_image"] . '" alt="not found">';
                                }
                                ?>

                            </div>
                            <div class="sub-menu-profile-name">
                                <div class="sub-menu-user-name"><?php echo $_SESSION["user_name"] ?></div>
                                <div class="sub-menu-user-type"><?php echo $_SESSION["user_type"] ?></div>
                            </div>
                        </a>
                        <hr>

                        <a href="<?php echo URLROOT ?>/users/logout" class="sub-menu-link">
                            <i class="sub-menu-link-icon fa-solid fa-arrow-right-from-bracket"></i>
                            <p>Signout</p>
                            <div class="right-arrow">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- sub-menu-wrap -->

            <?php else: ?>
                <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
                <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
            <?php endif; ?>

            <li class="menu-button" onclick=showSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        height="26" viewBox="0 -960 960 960" width="26">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg></a></li>
        </ul>
    </nav>

</div>
<!-- navigation-bar -->

<script src="<?php echo URLROOT ?>/js/navbar.js"></script>
<!-- new-edition-here -->