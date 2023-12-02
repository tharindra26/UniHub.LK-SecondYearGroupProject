<?php require APPROOT . '/views/inc/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/register_style.css">

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
                        <li><a  href="<?php echo URLROOT ?>/users/login">Login</a></li>
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
                                        <div class="user-name">Tharindra Fernando</div>
                                        <div class="user-type">Admin</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="hideOnMobile"><a  href="<?php echo URLROOT ?>/users/login">Login</a></li>
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


<div class="container">
        <div class="outer-box">
            <div class="wrapper">
                <div class="register">
                    <h2>SignUp</h2>
                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-envelope"></i>
                            </span> 
                            <input type="email" value="<?php echo $data['email'] ?>" name="email" placeholder=" ">  
                            <label>University Email</label>  
                        </div>
                        <?php if (!empty($data['email_err'])): ?>
                                <span class="error-message"><?php echo $data['email_err']; ?></span>
                        <?php endif; ?>

                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-user"></i>
                            </span> 
                            <input type="text" value="<?php echo $data['fname']; ?>" name="fname">  
                            <label>First Name</label>  
                        </div>
                        <?php if (!empty($data['fname_err'])): ?>
                                <span class="error-message"><?php echo $data['fname_err']; ?></span>
                        <?php endif; ?>

                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-user"></i>
                            </span> 
                            <input type="text" value="<?php echo $data['lname'] ?>" name="lname">  
                            <label>Last Name</label>  
                        </div>
                        <?php if (!empty($data['lname_err'])): ?>
                                <span class="error-message"><?php echo $data['lname_err']; ?></span>
                        <?php endif; ?>

                        <!-- dob input -->
                        <div class="input-box dob-input-box">
                            <span>
                                <i class="fa-solid fa-calendar"></i>
                            </span> 
                            <input type="date" value="<?php echo $data['dob'] ?>" name="dob">  
                            <label class="dob-label">Date Of Birth</label>  
                        </div>
                        <?php if (!empty($data['dob_err'])): ?>
                                <span class="error-message"><?php echo $data['dob_err']; ?></span>
                        <?php endif; ?>

                        <div class="drop-down">
                            <!-- hidden university iput field -->
                            <input type="hidden" name="university" id="universityInput" value="<?php echo $data['university'] ?>" name="university">

                            <div class="selected">
                                <span>
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                                <span class="btn-text">University</span>
                                <span class="arrow-dwn">
                                    <i class="fa-solid fa-chevron-down"></i>   
                                </span>
                            </div>
                            <ul class="options">
                                <li class="option">
                                    <img src="<?php echo URLROOT ?>/img/register/uni.png" alt="">
                                    <span class="option-text">University of Colombo</span>
                                </li>
                                <li class="option">
                                    <img src="<?php echo URLROOT ?>/img/register/uni.png" alt="">
                                    <span class="option-text">University of Moratuwa</span>
                                </li>
                                <li class="option">
                                    <img src="<?php echo URLROOT ?>/img/register/uni.png" alt="">
                                    <span class="option-text">University of Kelaniya</span>
                                </li>
                                <li class="option">
                                    <img src="<?php echo URLROOT ?>/img/register/uni.png" alt="">
                                    <span class="option-text">University of Ruhuna</span>
                                </li>
                                
                            </ul>
                        </div>
                        <?php if (!empty($data['university_err'])): ?>
                                <span class="error-message"><?php echo $data['university_err']; ?></span>
                        <?php endif; ?>
                    
                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" value="<?php echo $data['password'] ?>" name="password">
                            <label>Password</label>
                        </div>
                        <?php if (!empty($data['password_err'])): ?>
                                <span class="error-message"><?php echo $data['password_err']; ?></span>
                        <?php endif; ?>

                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" value="<?php echo $data['confirm_password'] ?>" name="confirm_password">
                            <label>Confirm Password</label>
                        </div>
                        <?php if (!empty($data['confirm_password_err'])): ?>
                                <span class="error-message"><?php echo $data['confirm_password_err']; ?></span>
                        <?php endif; ?>


                        <div class="terms">
                            <label><input type="checkbox" name="" id="">I agree to the terms & conditions</label>
                        </div>
                        <button type="submit" class="btn">Register</button>
                        <div class="register-link">
                            <p>Already have an account? <a href="#">Sign In</a></p>
                        </div>
                            
                    </form>
                </div>
            </div>
            
            <div class="content">
                <!--<h1>UniHub.lk</h1>-->
                <div class="description">
                    <p class="description">Revolutionizing University Connectivity and Organizations Showcase.....</p>
                </div>
                
                <div class="organization-btn">
                    <a href="#" class="reg-btn">Register As An Organization</a>
                </div> 
                
                    
            </div>
        </div>
    </div>
    
    
    <script src="<?php echo URLROOT ?>/js/register.js"></script>

    <?php require APPROOT . '/views/inc/footer.php'; ?>