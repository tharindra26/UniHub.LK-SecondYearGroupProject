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
                        <a href="<?php echo URLROOT ?>/users/updatemyprofile/<?php echo $data['user']->id ?>" class="follow-btn">Update Profile</a>
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
                        ?>

                    <span class="see-more-text">
                        <?php
                            $content = $data['user']->description;
                            $string = strip_tags($content);
                            $endString = substr($string, $endPoint);
                            echo $endString;
                        ?> 
                    </span>
                    <span class="see-more-btn">See more...</span>
                    <?php
                        else :
                            echo $string;
                        endif;
                    ?>
                </p>
                
            </div>
            <!--Slider Starts-->
            <div class="slide-container">
                <div class="wrapper">
                    <i id="left" class="fa-solid fa-chevron-left arr-head"></i>
                    <div class="carousel">
                     <?php if (!empty($data['event'][0]->id)) : ?> 
                        <?php foreach ($data['event'] as $event) : ?>
                            <?php
                                $eventStartDate = $event->start_datetime;
                                // Convert MySQL datetime to DateTime object
                                $dateTime = new DateTime($eventStartDate);
                                // Format the DateTime object to extract only THU NOV 16
                                $extractedDate = $dateTime->format('D M j');
                                // Format the DateTime object to extract only the time (06.00PM)
                                $extractedTime = $dateTime->format('h:i A');
                            ?>
                        <div class="card">
                            <div class="card-title">
                                <h3><?php echo $event->title ?></h3>
                            </div>
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $event->event_profile_image ?>" alt="" draggable="false" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                            <div class="date-section">
                                <i class="fa-regular fa-calendar-days"></i> &nbsp <?php echo $extractedDate ?> &nbsp &nbsp
                                <i class="fa-solid fa-clock"></i> &nbsp <?php echo $extractedTime ?>
                            </div>
                            <div class="venue-section"><?php echo $event->venue ?></div>
                            </div>
                            <div class="card-btn">
                                <a href="<?php echo URLROOT ?>/events/show/<?php echo $event->id ?>">View More...</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <i id="right" class="fa-solid fa-chevron-right arr-head"></i>
                </div>
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

                    <!-- Liked Materials -->
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
                    
                        <div class="show-more-link">
                            <a href="#">Show All Liked Materials <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Going Events -->
                    <div class="tab-content content-2">
                    <?php if (!empty($data['goingEvents'][0]->id)) : ?> 
                        <?php foreach ($data['goingEvents'] as $goingEvents) : ?>
                            
                            <?php
                                $eventStartDate = $goingEvents->start_datetime;
                                // Convert MySQL datetime to DateTime object
                                $dateTime = new DateTime($eventStartDate);
                                // Format the DateTime object to extract only THU NOV 16
                                $extractedDate = $dateTime->format('D M j');
                                // Format the DateTime object to extract only the time (06.00PM)
                                $extractedTime = $dateTime->format('h:i A');
                            ?>
                        <div class="material">
                            <a href="<?php echo URLROOT ?>/events/show/<?php echo $goingEvents->id ?>">
                                <div class="material-img">
                                    
                                    <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $goingEvents->event_profile_image ?>" alt="Event Profile Image">
                                </div>
                                <div class="material-content">
                                    <h4><?php echo $goingEvents->title ?></h4>
                                    <div class="date-vennue">
                                        <div class="tab-date-section">
                                            <i class="fa-regular fa-calendar-days"></i> &nbsp <?php echo $extractedDate ?> &nbsp &nbsp
                                            <i class="fa-solid fa-clock"></i> &nbsp <?php echo $extractedTime ?>
                                        </div>
                                        <div class="tab-venue-section">
                                            <i class="fa-solid fa-location-dot"></i> &nbsp <?php echo $goingEvents->venue ?>       
                                        </div>
                                    </div>
                                    <p>
                                        <?php 
                                            $content = $goingEvents->description;
                                            $string = strip_tags($content);
                                            if(strlen($string) > 100):
                                                $stringCut = substr($string, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $string = $endPoint?substr($stringCut, 0, $endPoint):substr($stringCut,0);
                                                echo $string;
                                        ?>
                                        <span class="see-more-btn">See more...</span>
                                        <?php
                                            else :
                                            echo $string;
                                            endif;
                                        ?>
                                    </p>
                                </div>
                            </a>    
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        <div class="show-more-link">
                            <a href="#">Show All Going Events <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Interested Events -->
                    <div class="tab-content content-3">
                    <?php if (!empty($data['interestEvents'][0]->id)) : ?> 
                        <?php foreach ($data['interestEvents'] as $interestEvents) : ?>
                            
                            <?php
                                $eventStartDate = $interestEvents->start_datetime;
                                // Convert MySQL datetime to DateTime object
                                $dateTime = new DateTime($eventStartDate);
                                // Format the DateTime object to extract only THU NOV 16
                                $extractedDate = $dateTime->format('D M j');
                                // Format the DateTime object to extract only the time (06.00PM)
                                $extractedTime = $dateTime->format('h:i A');
                            ?>
                    <div class="material">
                            <a href="<?php echo URLROOT ?>/events/show/<?php echo $interestEvents->id ?>">
                                <div class="material-img">
                                    
                                    <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $interestEvents->event_profile_image ?>" alt="Event Profile Image">
                                </div>
                                <div class="material-content">
                                    <h4><?php echo $interestEvents->title ?></h4>
                                    <div class="date-vennue">
                                        <div class="tab-date-section">
                                            <i class="fa-regular fa-calendar-days"></i> &nbsp <?php echo $extractedDate ?> &nbsp &nbsp
                                            <i class="fa-solid fa-clock"></i> &nbsp <?php echo $extractedTime ?>
                                        </div>
                                        <div class="tab-venue-section">
                                            <i class="fa-solid fa-location-dot"></i> &nbsp <?php echo $interestEvents->venue ?>       
                                        </div>
                                    </div>
                                    <p>
                                        <?php 
                                            $content = $interestEvents->description;
                                            $string = strip_tags($content);
                                            if(strlen($string) > 100):
                                                $stringCut = substr($string, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $string = $endPoint?substr($stringCut, 0, $endPoint):substr($stringCut,0);
                                                echo $string;
                                        ?>
                                        <span class="see-more-btn">See more...</span>
                                        <?php
                                            else :
                                            echo $string;
                                            endif;
                                        ?>
                                    </p>
                                </div>
                            </a>    
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        <div class="show-more-link">
                            <a href="#">Show All Interested Events <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Watch Later Materials -->
                    <div class="tab-content content-4">
                        <h1>Watch later content</h1>
                        <div class="show-more-link">
                            <a href="#">Show All Watch Later Materials <i class="fa-solid fa-arrow-right"></i></a>
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
                            <?php if (!empty($data['education'][0]->education_id)) : ?> 
                                <?php foreach ($data['education'] as $education) : ?>
                                    <h4><?php echo $education->institution ?></h4>
                                    <p><?php echo $education->start_year?> - <?php echo $education->end_year?></p>
                                    <p><?php echo $education->description ?></p>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" id="second">
                        <label for="second">Qualifications</label>
                        <div class="accordion-content">
                        <?php if (!empty($data['qualifications'][0]->user_qualification_id)) : ?> 
                                <?php foreach ($data['qualifications'] as $qualification) : ?>
                                    <h4><?php echo $qualification->qualification_name ?> - <?php echo $qualification->institution ?></h4>
                                    <p>Completed date : <?php echo $qualification->completion_date?></p>
                                    <p><?php echo $qualification->description ?></p>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" id="third">
                        <label for="third">Skills</label>
                        <div class="accordion-content">
                            <?php if (!empty($data['skills'][0]->user_skill_id)) : ?> 
                                <?php foreach ($data['skills'] as $skill) : ?>
                                    <h4><?php echo $skill->skill_name ?></h4>
                                    <p>Proficiency Level : <?php echo $skill->proficiency_level?></p>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
            <!-- <?php var_dump($data['friends']) ?> -->
            <div class="friends">
                <div class="friends-content">
                    <h2>Friends</h2>
                    <a href="#">
                        <div class="friend-pic">
                            <img src="<?php echo URLROOT ?>/img/users/default/profilephoto.jpg" alt="">
                        </div>
                        <div class="friend-info">
                            <h4>Chathuni Ranasinghe</h4>
                            <div class="uni">
                                <img src="<?php echo URLROOT ?>/img/universities/<?php echo $data['university']->logo ?>" alt="logo">
                                <h3>University of Colombo</h3>
                            </div>
                            
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