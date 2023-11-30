<!-- new-edition-here -->
<?php var_dump($_SESSION)?>
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
                    <?php if(isset($_SESSION["user_id"])): ?>
                        <li >
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
                    <?php endif; ?>
                    <li><a href="<?php echo URLROOT ?>/pages/index">Home</a></li>
                    <li><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
                    <li><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>
                    <li><a href="<?php echo URLROOT ?>/knowledgehubs/index">KnowledgeHub</a></li>
                    <li><a href="<?php echo URLROOT ?>/opportunities/index">Opportunties</a></li>

                    <?php if(!isset($_SESSION["user_id"])): ?>
                        <li><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
                        <li><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
                    <?php endif; ?>

                </ul>


                <!-- horizontal-navbar -->
                <ul>
                    <!-- <li><a href="#"><img src="unihub-logo.png" alt="" class="navbar-logo"></a></li> -->
                    <li>
                        <a href="#" class="unihub-logo-text">UniHub.lk</a>
                    </li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/pages/index"><i class="fa-solid fa-house"></i> &nbsp Home</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/knowledgehubs/index">KnowledgeHub</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/opportunities/index">Opportunities</a></li>
                    

                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="hideOnMobile">
                            <a href="#">
                                <div class="profile-navigator">
                                    <div class="profile-image">
                                        <img src="profile-image.jpg" alt="not found">
                                    </div>
                                    <div class="profile-name">
                                        <div class="user-name"> <?php echo $_SESSION['user_name']?></div>
                                        <div class="user-type"><?php echo $_SESSION['user_type']?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
                        <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
                    <?php endif; ?>
                    
                    <li class="menu-button" onclick=showSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- navigation-bar -->

<script src="<?php echo URLROOT?>/js/navbar.js"></script>
<!-- new-edition-here -->