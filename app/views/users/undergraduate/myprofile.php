<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/myprofile_style.css">
    <div class="container content-profile">
        <div class="left-bar">
            <div class="profile_header">
                <div class="photos">
                    <img src="<?php echo URLROOT ?>/img/users/default/<?php echo $data['user']->cover_image ?>" alt="Cover Photo" class="cover-photo">
                    <img src="<?php echo URLROOT ?>/img/users/default/<?php echo $data['user']->profile_image ?>" alt="Profile Picture" class="profile-photo">
                </div>
                <div class="profile-info">
                    <div class="description">
                        <h1><?php echo $data['user']->fname , " " , $data['user']->lname ?></h1>
                        <p class="title"><?php echo $data['user']->profile_title ?></p>
                        <p class="uni"><?php echo $data['university']->name ?></p>
                        <a href="#" class="follow-btn">Update Profile</a>
                        <a href="#" class="msg-btn">Delete Account</a> 
                    </div>
                    <div class="current-work">
                        <ul class="work-list">
                            <li class="option">
                                <a href="#">
                                    <div class="list-op">
                                        <img src="<?php echo URLROOT ?>/img/universities/<?php echo $data['university']->logo ?>" alt="logo">
                                        <h4><?php echo $data['university']->name ?></h4>
                                    </div>   
                                </a>
                            </li>
                            <li class="option">
                                <a href="#">
                                    <div class="list-op">
                                        <img src="../UserProfiles/images/uni.png" alt="">
                                        <h4>IEEE Student Branch</h4>
                                    </div>   
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>    
            </div>
            <div class="about">
                <h1>About</h1>
                <p>
                    <?php 
                        $content = $data['user']->description;
                        $string = strip_tags($content);
                        if(strlen($string) > 300):
                            $stringCut = substr($string, 0, 300);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint?substr($stringCut, 0, $endPoint):substr($stringCut,0);
                            echo $string;
                        endif;?>
                    <span class="see-more-text">
                        <?php
                            $content = $data['user']->description;
                            $string = strip_tags($content);
                            $endString = substr($string, $endPoint);
                            echo $endString;
                        ?> 
                    </span>
                    
                </p>
                <span class="see-more-btn">See more...</span>
            </div>
            <!--Slider Starts-->
            <div class="slide-container swiper">
                <div class="wrapper">
                    <div class="carousel">
                        <div class="card">
                            <div class="card-title">
                                <h3>Card Title</h3>
                            </div>
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="../UserProfiles/images/cover.jpg" alt="" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <p>
                                    The event will be held on 20th December 2023
                                </p>
                            </div>
                            <div class="card-btn">
                                <a href="#">View More...</a>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="card-title">
                                <h3>Card Title</h3>
                            </div>
                            <div class="image-content">

                                <div class="card-image">
                                    <img src="../UserProfiles/images/cover.jpg" alt="" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <p>
                                    The event will be held on 20th December 2023
                                </p>
                            </div>
                            <div class="card-btn">
                                <a href="#">View More...</a>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="card-title">
                                <h3>Card Title</h3>
                            </div>
                            <div class="image-content">

                                <div class="card-image">
                                    <img src="../UserProfiles/images/cover.jpg" alt="" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <p>
                                    The event will be held on 20th December 2023
                                </p>
                            </div>
                            <div class="card-btn">
                                <a href="#">View More...</a>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="card-title">
                                <h3>Card Title</h3>
                            </div>
                            <div class="image-content">

                                <div class="card-image">
                                    <img src="../UserProfiles/images/cover.jpg" alt="" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <p>
                                    The event will be held on 20th December 2023
                                </p>
                            </div>
                            <div class="card-btn">
                                <a href="#">View More...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <!--Slider Ends-->
            <!--Slide Indicator Starts-->
            <div class="slide-indicator">
                <input type="radio" name="nav-slider" id="liked_materials" checked>
                <input type="radio" name="nav-slider" id="going_events">
                <input type="radio" name="nav-slider" id="interest">
                <input type="radio" name="nav-slider" id="watch_later">
                <nav>
                    <label for="liked_materials" class="liked_materials">Liked</label>
                    <label for="going_events" class="going_events">Going</label>
                    <label for="interest" class="interest">Interest</label>
                    <label for="watch_later" class="watch_later">Watch Later</label>
                    <div class="nav-slider"></div>
                </nav>
                <section>
                    <div class="tab-content content-1">
                        <div class="material">
                            <a href="#">
                                <div class="material-img">
                                    <img src="../UserProfiles/images/profile.jpg" alt="">
                                </div>
                                <div class="material-content">
                                    <h4>A blogger is someone who writes regularly for an online journal or website</h4>
                                    <p>The sun dipped below the horizon, casting a warm, golden glow over the tranquil meadow. 
                                        The gentle rustling of leaves in the nearby forest provided a soothing backdrop to the 
                                        symphony of chirping crickets. <span class="see-more-btn">See more...</span>
                                    </p>
                                </div>
                            </a>    
                        </div>
                        <div class="material">
                            <a href="#">
                                <div class="material-img">
                                    <img src="../UserProfiles/images/profile.jpg" alt="">
                                </div>
                                <div class="material-content">
                                    <h4>A blogger is someone who writes regularly for an online journal or website</h4>
                                    <p>The sun dipped below the horizon, casting a warm, golden glow over the tranquil meadow. 
                                        The gentle rustling of leaves in the nearby forest provided a soothing backdrop to the 
                                        symphony of chirping crickets. <span class="see-more-btn">See more...</span>
                                    </p>
                                </div>
                            </a>    
                        </div>
                        <div class="material">
                            <a href="#">
                                <div class="material-img">
                                    <img src="../UserProfiles/images/profile.jpg" alt="">
                                </div>
                                <div class="material-content">
                                    <h4>A blogger is someone who writes regularly for an online journal or website</h4>
                                    <p>The sun dipped below the horizon, casting a warm, golden glow over the tranquil meadow. 
                                        The gentle rustling of leaves in the nearby forest provided a soothing backdrop to the 
                                        symphony of chirping crickets. <span class="see-more-btn">See more...</span>
                                    </p>
                                </div>
                            </a>    
                        </div>
                    
                        <div class="show-more-link">
                            <a href="#">Show All Liked Materials <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="tab-content content-2">
                        <h1>Going events content</h1>
                        <div class="show-more-link">
                            <a href="#">Show All Liked Materials <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="tab-content content-3">
                        <h1>Interest content</h1>
                        <div class="show-more-link">
                            <a href="#">Show All Liked Materials <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="tab-content content-4">
                        <h1>Watch later content</h1>
                        <div class="show-more-link">
                            <a href="#">Show All Liked Materials <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                </section>
            </div>
            <!--Slide Indicator Ends-->
            <!--Accordion Starts-->
            <div class="accordion-section">
                <ul class="accordion">
                    <li>
                        <input type="radio" name="accordion" id="first" checked>
                        <label for="first">Education</label>
                        <div class="accordion-content">
                            <p>Education list</p>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" id="second">
                        <label for="second">Qualifications</label>
                        <div class="accordion-content">
                            <p>Qualification list</p>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" id="third">
                        <label for="third">Skills</label>
                        <div class="accordion-content">
                            <p>Skills list</p>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Accordion Ends-->
        </div>
        <div class="right-bar">
            <div class="portfolio">
                <div class="portfolio-content">
                    <h4>Craft Your Future: Unleash Your Potential on Unihub.lk!</h4>
                    <p>Unleash your academic prowess on Unihub.lk – your go-to platform for effortless resume creation. 
                        Seamlessly blend your skills and aspirations into a sleek, professional document that speaks volumes. 
                        Embrace the future of career development in just a few clicks. Your journey to success begins here!</p>
                </div>
                <a href="#">Generate Portfolio</a>
            </div>
            <div class="friends">
                <div class="friends-content">
                    <a href="#">
                        <div class="friend-pic">
                            <img src="../UserProfiles/images/profile.jpg" alt="">
                        </div>
                        <div class="friend-info">
                            <h4>Chathuni Ranasinghe</h4>
                        </div>
                    </a>
                    <a class="view-btn" href="#">View Profile</a>
                    <hr>
                </div>
                    
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT?>/js/users/undergraduate/myprofile.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>