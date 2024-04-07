<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/google-auth_style.css">

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
                    <li><a href="<?php echo URLROOT ?>/posts/index">Posts</a></li>
                    <li><a href="<?php echo URLROOT ?>/opportunities/index">Opportunties</a></li>

                    <?php if (!isset($_SESSION["user_id"])): ?>
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
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/pages/index"><i
                                class="fa-solid fa-house"></i> &nbsp Home</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/events/index">Events</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/posts/index">Posts</a></li>
                    <li class="hideOnMobile"><a href="<?php echo URLROOT ?>/opportunities/index">Opportunities</a></li>


                    <?php if (isset($_SESSION['user_id'])): ?>
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
    </div>
</div>
<!-- navigation-bar -->

<script src="<?php echo URLROOT ?>/js/navbar.js"></script>
<!-- new-edition-here -->

<div class="outer-container">
    <div class="container">
        <div class="background">
            <div class="content">
                <h1>UniHub.lk</h1>
                <p class="description">An Innovative digital platform revolutionizing Sri Lankan university life......
                </p>
                <!-- <div class="list">
                        <p>We offer a centralized hub for:</p>
                        <ul class="services">
                            <li>Publishing and accessing learning materials</li>
                            <li>Publishing and engaging with events</li>
                            <li>Exploring new job opportunities and scolarships</li>
                            <li>Showcasing organizational bodies</li>
                        </ul>
                    </div> -->

                <a href="#" class="reg-btn">Register Now</a>
                
            </div>

            <div class="right-wrapper">
                    <h2>SignIn</h2>
                    <div class="google-auth-caption">
                        Please proceed with Google authentication to continue.
                    </div>                   
                    <a class="google-login" href="<?php echo URLROOT; ?>/users/googleLogin">
                        <div class="google-logo">
                            <img src="<?php echo URLROOT ?>/img/users/google-login/google-logo.png" alt="">
                        </div>
                        <div class="auth-txt">
                            Google Authentication
                        </div>
                    </a>

            </div>

        </div>
    </div>
</div>



<!-- popupModal -->

<span class="overlay"></span>
<div class="modal-box" id="login-fail">
    <i class="fa-solid fa-xmark"></i>
    <h2>Login Failed</h2>
    <h3>Please check your email and password and try again.</h3>

    <div class="buttons">
        <button class="close-btn" onClick=closePopup('login-fail')>Ok, Close</button>
    </div>
</div>

<!-- popupModal -->

<script>

    // popup modal script
    const overlay = document.querySelector(".overlay");
    const modalBox = document.querySelector(".modal-box");

    function openPopup(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.add("active");
            overlay.classList.add("active");
        }
    }

    function closePopup(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.remove("active");
            overlay.classList.remove("active");
        }
    }
    overlay.addEventListener("click", () => {
        modalBox.classList.remove("active");
        overlay.classList.remove("active");
    });
    // popup modal script

</script>


<?php if($_SESSION['login_status'] =='invalid'): ?>
    <script>
        openPopup('login-fail');
    </script>
    <?php unset($_SESSION['login_status']); ?> 
<?php endif; ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>