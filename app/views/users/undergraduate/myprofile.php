<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/myprofile_style.css">

<div class="container">
    <div class="search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Profile" id="search-bar-input">
                <!-- <div class="searchId" id = "searchId">test</div> -->
                <a href="#">
                    <button type="submit" onclick="viewUser()"><i
                            class="fa-solid fa-magnifying-glass"></i>Search</button>
                </a>
            </form>
        </div>
        <div class="results" id="result-list">

        </div>

    </div>
    <div class="content-profile">
        <div class="left-bar">
            <div class="profile_header">
                <div class="photos">
                    <div class="cover-photo-box">
                        <img src="<?php echo URLROOT ?>/img/users/users_cover_images/<?php echo $data['user']->cover_image ?>"
                            alt="Cover Photo" class="cover-photo">
                    </div>

                    <div class="profile-photo-box">
                        <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $data['user']->profile_image ?>"
                            alt="Profile Picture" class="profile-photo">
                    </div>

                </div>
                <div class="profile-info">
                    <div class="description">
                        <h1><?php echo $data['user']->fname, " ", $data['user']->lname ?></h1>
                        <p class="uni"><?php echo $data['user']->profile_title ?></p>
                        <?php if ($data['user']->id == $_SESSION['user_id']): ?>
                            <a href="<?php echo URLROOT ?>/users/updatemyprofile/<?php echo $data['user']->id ?>"
                                class="follow-btn">Profile Settings</a>
                            <a href="<?php echo URLROOT ?>/users/showFriends/<?php echo $data['user']->id ?>"
                                class="msg-btn">Friends</a>
                        <?php else:
                            if ($_SESSION['user_type'] == 'undergraduate'): ?>
                                <a href="#" class="follow-btn" id="friendBtn" onclick="profileFriendBtnOption()"></a>
                                <a href="#" class="msg-btn">Report</a>
                            <?php elseif ($_SESSION['user_type'] == 'admin'): ?>
                                <a href="#" class="follow-btn" id="friendBtn">Update Profile</a>
                                <a href="#" class="msg-btn">Report</a>
                            <?php endif;
                        endif; ?>
                    </div>
                    <div class="current-work">
                        <ul class="work-list">
                            <li class="option">
                                <a href="#">
                                    <div class="list-op">
                                        <img src="<?php echo URLROOT ?>/img/universities/<?php echo $data['university']->logo ?>"
                                            alt="logo">
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
                    if (strlen($string) > 300):
                        $stringCut = substr($string, 0, 300);
                        $endPoint = strrpos($stringCut, ' ');
                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
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
                    else:
                        echo $string;
                    endif;
                    ?>
                </p>

            </div>
            <!--Accordion Starts-->
            <div class="accordion-section">
                <ul class="accordion">
                    <li>
                        <input type="radio" name="accordion" id="first" checked>
                        <label for="first">Education</label>
                        <div class="accordion-content">
                            <?php if (!empty($data['education'][0]->education_id)): ?>
                                <?php foreach ($data['education'] as $education): ?>
                                    <h4><?php echo $education->institution ?></h4>
                                    <p><?php echo $education->start_year ?> - <?php echo $education->end_year ?></p>
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
                            <?php if (!empty($data['qualifications'][0]->qualification_id)): ?>
                                <?php foreach ($data['qualifications'] as $qualification): ?>
                                    <h4><?php echo $qualification->qualification_name ?> -
                                        <?php echo $qualification->institution ?>
                                    </h4>
                                    <p>Completed date : <?php echo $qualification->completion_date ?></p>
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
                            <?php if (!empty($data['skills'][0]->user_skill_id)): ?>
                                <?php foreach ($data['skills'] as $skill): ?>
                                    <h4><?php echo $skill->skill_name ?></h4>
                                    <p>Proficiency Level : <?php echo $skill->proficiency_level ?></p>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" id="fourth">
                        <label for="fourth">Organizations</label>
                        <div class="accordion-content">
                            <?php if (!empty($data['organizations'][0]->id)): ?>
                                <?php foreach ($data['organizations'] as $organization): ?>
                                    <h4><?php echo $organization->organization_name ?> -
                                        <?php echo $organization->name ?>
                                    </h4>
                                    <p><?php echo $organization->role ?></p>
                                    <p>From: <?php echo $organization->start_date ?> To: <?php echo $organization->end_date ?>
                                    </p>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
            <!--Accordion Ends-->
            <!--Slide Indicator Starts-->
            <?php if ($data['user']->id == $_SESSION['user_id']): ?>
            <div class="slide-indicator">
                <input type="radio" name="nav-slider" id="liked_materials" checked>
                <input type="radio" name="nav-slider" id="going_events">
                <input type="radio" name="nav-slider" id="interest">
                <nav>
                    <label for="liked_materials" class="liked_materials">Liked Posts</label>
                    <label for="going_events" class="going_events">Organizations</label>
                    <label for="interest" class="interest">Interest</label>
                    <div class="nav-slider"></div>
                </nav>
                <section>
                    <!-- <?php echo var_dump($data['likedPosts']); ?> -->
                    <!-- Liked Materials -->
                    <div class="tab-content content-1">
                        <?php if (!empty($data['likedPosts'])): ?>
                            <?php foreach ($data['likedPosts'] as $likedPosts): ?>
                                <div class="material">
                                    <a href="<?php echo URLROOT ?>/posts/show/<?php echo $likedPosts->post_id ?>">
                                        <div class="material-img">

                                            <img src="<?php echo URLROOT ?>/img/posts/post_profile_images/<?php echo $likedPosts->post_profile_image ?>"
                                                alt="Post Profile Image">
                                        </div>
                                        <div class="material-content">
                                            <h4><?php echo $likedPosts->post_title ?></h4>
                                            <p>
                                                <?php
                                                $content = $likedPosts->post_description;
                                                $string = strip_tags($content);
                                                if (strlen($string) > 100):
                                                    $stringCut = substr($string, 0, 200);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    echo $string;
                                                    ?>
                                                    <span class="see-more-btn">See more...</span>
                                                    <?php
                                                else:
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
                            <a href="<?php echo URLROOT ?>/users/showAllLikedPosts/<?php echo $data['user']->id ?>">Show All Liked Posts <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Following Organizations -->
                    <div class="tab-content content-2">
                    <?php if (!empty($data['followingOrganizations'])): ?>
                            <?php foreach ($data['followingOrganizations'] as $org): ?>
                                <div class="material">
                                    <a href="<?php echo URLROOT ?>/organizations/show/<?php echo $org->organization_id ?>">
                                        <div class="material-img">
                                            <img class="org-log" src="<?php echo URLROOT ?>/img/organizations/organization_profile_images/<?php echo $org->organization_profile_image ?>"
                                                alt="Organization Profile Image">
                                        </div>
                                        <div class="material-content">
                                            <h4><?php echo $org->organization_name ?></h4>
                                            <div class="date-vennue">
                                                <div class="tab-venue-section">
                                                    <i class="fa-solid fa-location-dot"></i> &nbsp
                                                    <?php echo $org->uni_name ?>
                                                </div>
                                            </div>
                                            
                                            <p>
                                                <?php
                                                $content = $org->description;
                                                $string = strip_tags($content);
                                                if (strlen($string) > 100):
                                                    $stringCut = substr($string, 0, 150);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    echo $string;
                                                    ?>
                                                    <span class="see-more-btn">See more...</span>
                                                    <?php
                                                else:
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
                            <a href="<?php echo URLROOT ?>/users/showAllFollowingOrganizations/<?php echo $data['user']->id ?>">Show All Following Organizations <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Interested Events -->
                    <div class="tab-content content-3">
                        <?php if (!empty($data['interestEvents'][0]->id)): ?>
                            <?php foreach ($data['interestEvents'] as $interestEvents): ?>

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

                                            <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $interestEvents->event_profile_image ?>"
                                                alt="Event Profile Image">
                                        </div>
                                        <div class="material-content">
                                            <h4><?php echo $interestEvents->title ?></h4>
                                            <div class="date-vennue">
                                                <div class="tab-date-section">
                                                    <i class="fa-regular fa-calendar-days"></i> &nbsp
                                                    <?php echo $extractedDate ?> &nbsp &nbsp
                                                    <i class="fa-solid fa-clock"></i> &nbsp <?php echo $extractedTime ?>
                                                </div>
                                                <div class="tab-venue-section">
                                                    <i class="fa-solid fa-location-dot"></i> &nbsp
                                                    <?php echo $interestEvents->venue ?>
                                                </div>
                                            </div>
                                            <p>
                                                <?php
                                                $content = $interestEvents->description;
                                                $string = strip_tags($content);
                                                if (strlen($string) > 100):
                                                    $stringCut = substr($string, 0, 100);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    echo $string;
                                                    ?>
                                                    <span class="see-more-btn">See more...</span>
                                                    <?php
                                                else:
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
                            <a
                                href="<?php echo URLROOT ?>/users/showAllInterestedEvents/<?php echo $data['user']->id ?>">Show
                                All Interested Events <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </section>
            </div>
            <!--Slide Indicator Ends-->
            
            <?php endif; ?>

        </div>
        <div class="right-bar">
            <?php if ($data['user']->id == $_SESSION['user_id']): ?>
                <div class="portfolio">
                    <div class="portfolio-content">
                        <h4>Craft Your Future: Unleash Your Potential on Unihub.lk!</h4>
                        <p>Unleash your academic prowess on Unihub.lk – your go-to platform for effortless resume creation.
                            Seamlessly blend your skills and aspirations into a sleek, professional document that speaks
                            volumes.
                            Embrace the future of career development in just a few clicks. Your journey to success begins
                            here!</p>
                    </div>
                    <a href="<?php echo URLROOT ?>/users/generatePortfolio/<?php echo $data['user']->id ?>">Generate Portfolio</a>
                </div>
            <?php endif; ?>

            <?php if ($data['user']->id == $_SESSION['user_id']): ?>
                <!-- Friend Requsts -->
                <div class="friends">
                    <h2>Friend Requests</h2>
                    <div class="friends-content">
                        <?php if (!empty($data['requests'][0]->id)): ?>
                            <?php foreach ($data['requests'] as $requests):
                                $friend_id = $requests->follower_relationship_id; ?>
                                <a href="<?php echo URLROOT ?>/users/show/<?php echo $requests->id ?>" class="profile-link">
                                    <div class="friend-profile">
                                        <div class="friend-pic">
                                            <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $requests->profile_image ?>"
                                                alt="">
                                        </div>
                                        <div class="friend-info">
                                            <h4><?php echo $requests->fname, " ", $requests->lname ?></h4>
                                            <div class="friend-uni"><?php
                                            $uni = $requests->university_name;
                                            $string = strip_tags($uni);
                                            if (strlen($string) > 30):
                                                $stringCut = substr($string, 0, 23);
                                                $endPoint = strrpos($stringCut, '');
                                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                echo $string;
                                                ?>
                                                    <span class="see-more-btn">...</span>
                                                    <?php
                                            else:
                                                echo $string;
                                            endif;
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="btn">
                                    <div class="accept-div">
                                        <a class="accept-btn" href="#" onclick="acceptRequest(<?php echo $friend_id; ?>)"><i
                                                class="fa-solid fa-user-plus"></i> &nbsp;&nbsp;Accept</a>
                                        <!-- popupModal -->
                                        <span class="overlay"></span>
                                        <div class="modal-box" id="<?php echo $friend_id; ?>">
                                            <!-- <i class="fa-solid fa-xmark"></i> -->
                                            <i class="fa-solid fa-circle-check"></i>
                                            <h2>Accepted </h2>
                                            <p>You and <?php echo $requests->fname, " ", $requests->lname ?> are Friends Now</p>
                                            <div class="btn">
                                                <button class="close-btn"
                                                    onclick="closePopup('<?php echo $friend_id; ?>')">OK</button>
                                            </div>
                                        </div>
                                        <!-- popupModal -->

                                    </div>
                                    <div class="reject-div">
                                        <a class="reject-btn" href="#" onclick="openPopup('reject.<?php echo $friend_id; ?>')"><i
                                                class="fa-solid fa-user-xmark"></i>&nbsp;&nbsp;Reject</a>
                                        <!-- popupModal -->
                                        <span class="overlay"></span>
                                        <div class="modal-box" id="reject.<?php echo $friend_id; ?>">
                                            <!-- <i class="fa-solid fa-xmark"></i> -->
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            <h2>Are you sure?? </h2>
                                            <p>Reject Request : <?php echo $requests->fname, " ", $requests->lname ?></p>
                                            <div class="btn">
                                                <button class="close-btn"
                                                    onclick="rejectRequest('<?php echo $friend_id; ?>','reject.<?php echo $friend_id; ?>')">Reject</button>
                                                <button class="close-btn"
                                                    onclick="closePopup('reject.<?php echo $friend_id; ?>')">Close</button>
                                            </div>
                                        </div>
                                        <!-- popupModal -->
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span>No friend requests are available</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="friends">
                    <h2>Mutual Friends</h2>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>

    $(document).ready(function () {

        function checkFriendStatus() {
            $.ajax({
                url: 'http://localhost/unihub/users/checkFriendStatus',
                type: 'POST',
                data: {
                    user_id: <?php echo $data['user']->id ?>,
                    loggedin_id: <?php echo $_SESSION['user_id'] ?>,
                },
                success: function (response) {
                    // Handle the success response
                    console.log("Check Friend Status - AJAX request successful:", response);

                    var friendBtn = $("#friendBtn");

                    friendBtn.text(response);

                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    console.error("Check Friend Status - AJAX request failed:", status, error);
                }
            });
        }

        checkFriendStatus();

    });
</script>
<script>
    $(document).ready(function () {
        $("#search-bar-input").keyup(function () {
            var searchUser = $(this).val();
            if (searchUser != '') {
                $.ajax({
                    url: 'http://localhost/unihub/users/searchUsers',
                    type: 'POST',
                    data: {
                        keyword: searchUser,
                    },
                    success: function (response) {
                        $("#result-list").html(response);
                    }
                });
            }
            else {
                $("#result-list").html('');
            }
        });
        // $(document).on('click', 'a', function(){
        //     //$("#search-bar-input").val($(this).text());
        //     //$("#searchId").val('#userId');
        //     $("#result-list").html('');
        // })
    });

    function viewUser() {
        var userName = $("#search-bar-input").val();
        $.ajax({
            url: "http://localhost/unihub/users/viewUser",
            type: "POST", // or 'GET' depending on your needs
            data: {
                name: userName,
            },
            success: function (response) {
                console.log("AJAX request successful:", response);
            },
            error: function (error) {
                // Handle the error response
                console.error("AJAX request failed:", error);
            },
        });
    }

</script>

<script>
    function profileFriendBtnOption() {
        var btnText = $("#friendBtn").text();
        if (btnText == "Follow") {
            $.ajax({
                url: "http://localhost/unihub/users/addFriend",
                type: "POST",
                data: {
                    friendId: <?php echo $data['user']->id ?>,
                    userId: <?php echo $_SESSION['user_id'] ?>

                },

                success: function (response) {
                    console.log("AJAX request successful:", response);
                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                },
            });
        }
        else if (btnText == "Requested") {
            $.ajax({
                url: "http://localhost/unihub/users/cancelRequest",
                type: "POST",
                data: {
                    friendId: <?php echo $data['user']->id ?>,
                    userId: <?php echo $_SESSION['user_id'] ?>

                },

                success: function (response) {
                    console.log("AJAX request successful:", response);
                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                },
            });
        }

        else if (btnText == "Accept") {
            acceptRequest(<?php echo $data['user']->id; ?>)
        }

        else if (btnText == "Friends") {
            $.ajax({
                url: "http://localhost/unihub/users/unfollowFriend",
                type: "POST",
                data: {
                    friendId: <?php echo $data['user']->id ?>,
                    userId: <?php echo $_SESSION['user_id'] ?>

                },

                success: function (response) {
                    console.log("AJAX request successful:", response);
                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                },
            });
        }
        setTimeout(function () {
            window.location.reload();
        }, 500);
    }
</script>
<script src="<?php echo URLROOT ?>/js/users/undergraduate/myprofile.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>