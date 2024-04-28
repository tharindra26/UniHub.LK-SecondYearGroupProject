<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organization-show_style.css">
<style>
    .organization-cover-image {
        background-image: url('<?php echo URLROOT ?>/img/organizations/organization_cover_images/<?php echo $data['organization']->organization_cover_image ?>');
    }
</style>


<div class="organization-header">
    <div class="organization-cover-image"></div>
    <div class="logo-section">
        <div class="logo-box">
            <img src="<?php echo URLROOT ?>/img/organizations/organization_profile_images/<?php echo $data['organization']->organization_profile_image ?>"
                alt="">
        </div>
    </div>
    <div class="organization-title-section">
        <div class="title">
            <?php echo $data['organization']->organization_name ?>
        </div>
        <div class="organization-university">
            <?php echo $data['organization']->university_name ?>
        </div>
    </div>

    <div class="organization-brief">
        <?php echo $data['organization']->short_caption ?>
    </div>
</div>

<div class="container">
    <div class="inner-body-container">
        <div class="left-section">
            <div class="profile-logo">
                <img src="<?php echo URLROOT ?>/img/organizations/organization_profile_images/<?php echo $data['organization']->organization_profile_image ?>"
                    alt="">
            </div>
            <div class="name-card">
                <?php echo $data['organization']->organization_name ?>
            </div>
            <div class="university-card">
                <?php echo $data['organization']->university_name ?>
            </div>
            <div class="social-media-box">
                <a href="<?php echo $data['organization']->wesite_url ?>" class="social-media web">
                    <i class="fa-solid fa-globe"></i>
                </a>
                <a href="<?php echo $data['organization']->facebook ?>" class="social-media facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="<?php echo $data['organization']->instagram ?>" class="social-media instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="<?php echo $data['organization']->linkedin ?>" class="social-media linkedin">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
            <div class="follow-btn" href="#" data-organization-id="<?php echo $data['organization']->organization_id ?>"
                data-followed-users='<?php echo json_encode(explode(',', $data['organization']->organization_followers)) ?>'>
                <i class="fa-regular fa-thumbs-up"></i>
                <div class="follow-btn-txt">
                    Follow us
                </div>
            </div>
            <a href="<?php echo URLROOT ?>/organizations/settings/<?php echo $data['organization']->organization_id ?>"
                class="profile-dashboard">
                <i class="fa-solid fa-bars"></i>
                <div class="dashboard-txt">
                    Dashboard
                </div>
            </a>
        </div>
        <div class="right-section">
            <div class="about-us">
                <div class="about-us-title">About Us</div>
                <div class="about-us-content">
                    <?php echo $data['organization']->description ?>
                </div>
            </div>
            <hr>
            <div class="board-members-section">
                <div class="board-members-title">
                    Board Members
                </div>
                <div class="board-members-image">
                    <img src="<?php echo URLROOT ?>/img/organizations/board_members_images/<?php echo $data['organization']->board_members_image ?>"
                        alt="">
                </div>
            </div>
            <hr>

            <div class="organization_activities">
                <div class="organization-activities-titile">
                    Past Actvities & Events
                </div>
                <?php if (!empty($data['organization_activities'][0]->activity_id)): ?>
                    <?php foreach ($data['organization_activities'] as $activity): ?>
                        <?php if (empty($activity->activity_image)): ?>
                            <!-- HTML structure for activity with image -->
                            <div class="activity-title"><?php echo $activity->activity_title ?></div>
                            <div class="activity-options">
                                <a href="<?php echo URLROOT ?>/organizations/updateActivity/<?php echo $activity->activity_id ?>"
                                    class="activity-update">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <div class="activity-delete"
                                    onclick="openPopup('activityDelete-popup-<?php echo $activity->activity_id ?>')">
                                    <i class="fa-solid fa-square-minus"></i>
                                </div>
                            </div>
                            <div class="activity-content">
                                <div class="activity-description-plain">
                                    <?php echo $activity->activity_description ?>
                                </div>
                            </div>
                            <hr>
                        <?php elseif ($activity->activity_id % 2 == 0): ?>
                            <!-- HTML structure for odd indexes -->
                            <div class="activity-title">
                                <?php echo $activity->activity_title ?>
                            </div>
                            <div class="activity-options">
                                <a href="<?php echo URLROOT ?>/organizations/updateActivity/<?php echo $activity->activity_id ?>"
                                    class="activity-update">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <div class="activity-delete"
                                    onclick="openPopup('activityDelete-popup-<?php echo $activity->activity_id ?>')">
                                    <i class="fa-solid fa-square-minus"></i>
                                </div>
                            </div>
                            <div class="activity-content">
                                <div class="activity-description-left">
                                    <?php echo $activity->activity_description ?>
                                </div>
                                <div class="activity-image">
                                    <img src="<?php echo URLROOT ?>/img/organizations/activity_images/<?php echo $activity->activity_image ?>"
                                        alt="">
                                </div>
                            </div>
                            <hr>
                        <?php else: ?>
                            <!-- HTML structure for even indexes -->
                            <div class="activity-title">
                                <?php echo $activity->activity_title ?>
                            </div>
                            <div class="activity-options">
                                <a href="<?php echo URLROOT ?>/organizations/updateActivity/<?php echo $activity->activity_id ?>"
                                    class="activity-update">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <div class="activity-delete"
                                    onclick="openPopup('activityDelete-popup-<?php echo $activity->activity_id ?>')">
                                    <i class="fa-solid fa-square-minus"></i>
                                </div>
                            </div>
                            <div class="activity-content">
                                <div class="activity-image">
                                    <img src="<?php echo URLROOT ?>/img/organizations/activity_images/<?php echo $activity->activity_image ?>"
                                        alt="">
                                </div>
                                <div class="activity-description-right">
                                    <?php echo $activity->activity_description ?>
                                </div>
                            </div>
                            <hr>
                        <?php endif; ?>
                        <!-- popupModal -->

                        <span class="overlay"></span>
                        <div class="modal-box" id="activityDelete-popup-<?php echo $activity->activity_id ?>">
                            <i class="fa-solid fa-trash-can"></i>
                            <h2>Delete Organization Activity</h2>
                            <h3>Activity:
                                <?php echo $activity->activity_id ?>
                            </h3>

                            <div class="buttons">
                                <button class="close-btn"
                                    onclick="deleteActivity(<?php echo $activity->activity_id ?>)">Ok,Delete</button>
                            </div>
                        </div>

                        <!-- popupModal -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No past activities & events are available.</p>
                    <hr>
                <?php endif; ?>
            </div>





            <div class="news-feed">
                <div class="news-feed-title">
                    News Feed
                </div>
                <?php if (!empty($data['organization_news'][0]->news_id)): ?>
                    <?php foreach ($data['organization_news'] as $news): ?>
                        <div class="news">
                            <div class="news-title">
                                <?php echo $news->news_title ?>
                            </div>
                            <div class="news-timestamp">
                                <?php echo date('F j, Y g:i A', strtotime($news->news_timestamp)) ?>
                            </div>
                            <div class="news-options">
                                <a href="<?php echo URLROOT ?>/organizations/updateNews/<?php echo $news->news_id ?>"
                                    class="news-update"><i class="fa-solid fa-pen-to-square"></i></a>
                                <div class="news-delete" onclick="openPopup('newsDelete-popup-<?php echo $news->news_id ?>')"><i
                                        class="fa-solid fa-square-minus"></i></div>
                            </div>
                            <div class="news-text"><?php echo $news->news_text ?></div>
                        </div>
                        <hr>

                        <!-- popupModal -->

                        <span class="overlay"></span>
                        <div class="modal-box" id="newsDelete-popup-<?php echo $news->news_id ?>">
                            <i class="fa-solid fa-trash-can"></i>
                            <h2>Delete OrganizationNews</h2>
                            <h3>News:
                                <?php echo $news->news_id ?>
                            </h3>

                            <div class="buttons">
                                <button class="close-btn" onclick="deleteNews(<?php echo $news->news_id ?>)">Ok,Delete</button>
                            </div>
                        </div>

                        <!-- popupModal -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No news available.</p>
                <?php endif; ?>
            </div>


        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/organizations/organizations-show.js"></script>
<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    <?php if (isset($_SESSION['user_id'])): ?>
        var currentUserId = <?php echo $_SESSION['user_id']; ?>;
    <?php else: ?>
        var currentUserId = -1;
    <?php endif; ?>


    <?php
    if (!empty($data['organization_news']) || !empty($data['organization_activities'])) {
        ?>
        // popup modal script
        const overlay = document.querySelector(".overlay");
        const modalBox = document.querySelector(".modal-box");

        <?php
    }
    ?>

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
        // Find all elements with the "active" class
        var activeElements = document.querySelectorAll('.active');

        // Remove the "active" class from each element
        activeElements.forEach(function (element) {
            element.classList.remove("active");
        });
    });

    // popup modal script



    // Function to handle the deletion of a category
    function deleteActivity(activityId) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/deleteActivity', // Replace with the URL of your server-side script
            data: {
                activityId: activityId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Organization Activity deleted successfully');
                    closePopup('activityDelete-popup-' + activityId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting activity:', error);
            }
        });
    }

    function deleteNews(newsId) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/deleteNews', // Replace with the URL of your server-side script
            data: {
                newsId: newsId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Organization News deleted successfully');
                    closePopup('newsDelete-popup-' + newsId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting activity:', error);
            }
        });
    }


    $(document).ready(function () {
        // Function to handle liking a post via AJAX
        function followOrganization(organizationId) {
            console.log('Following organization:', organizationId);
            $.ajax({

                type: 'POST',
                url: URLROOT + '/organizations/addFollow',
                data: { organizationId: organizationId },
                success: function (response) {
                    // Update the like count in the DOM
                    var followOption = $('.follow-btn[data-organization-id="' + organizationId + '"]');
                    if (response == 1) {
                        followOption.find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
                        followOption.find('.follow-btn-txt').text('Followed');
                    } else {
                        followOption.find('.fa-solid').removeClass('fa-solid').addClass('fa-regular');
                        followOption.find('.follow-btn-txt').text('Follow us');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Failed to follow the organization:', error);
                }
            });
        }

        // Attach click event listener to like buttons
        $('.follow-btn').click(function () {
            var organizationId = $(this).data('organization-id');
            followOrganization(organizationId);
        });

        // Check if the user has liked each post and update the heart icon accordingly


        $('.follow-btn').each(function () {
            var organizationId = $(this).data('organization-id');
            var followedUsers = $(this).data('followed-users');
            var followOption = $('.follow-btn[data-organization-id="' + organizationId + '"]');


            if (followedUsers.includes(currentUserId.toString())) {
                console.log(followedUsers.includes(currentUserId.toString()));
                $(this).find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
                followOption.find('.follow-btn-txt').text('Followed');
            }
        });
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>