<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/signin_style.css">

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
                        <li class="menu-button" onclick=showSideBar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- navigation-bar -->


    <div class="container">
        <div class="background">
            <div class="content">
                <h1>UniHub.lk</h1>
                <p class="description">An Innovative digital platform revolutionizing Sri Lankan university life......</p>
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

            <div class="wrapper">
                <div class="form-box login">
                    <h2>SignIn</h2>
                    <form action="#">
                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-envelope"></i>
                            </span> 
                            <input type="email" required>  
                            <label>Enter Your Email</label>  
                        </div>
                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" required>
                            <label>Enter Your Password</label>
                        </div>
                        <div class="remember-forgot">
                            <label><input type="checkbox" name="" id="">Remember Me</label>
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn">Login</button>
                        <div class="register-link">
                            <p>Do not have an Account? <a href="#">Register Now</a></p>
                        </div>
                    
                    </form>
                </div>
            </div>
    
        </div>
    </div>
    <script src="<?php echo URLROOT ?>/js/signin.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>
