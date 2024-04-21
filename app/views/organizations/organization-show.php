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
            <a href="" class="profile-dashboard">
                <i class="fa-solid fa-bars"></i>
                <div class="dashboard-txt">
                    Dashboard
                </div>
            </a>
            <a href="<?php echo URLROOT ?>/organizations/addActivity/<?php echo $data['organization']->organization_id ?>"
                class="activities">
                Activities
            </a>

            <a href="<?php echo URLROOT ?>/organizations/addNews/<?php echo $data['organization']->organization_id ?>"
                class="activities">
                News
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
                            <div class="activity-content">
                                <div class="activity-description-plain">
                                    <?php echo $activity->activity_description ?>
                                </div>
                            </div>
                            <hr>
                        <?php elseif ($activity->activity_id % 2 == 0): ?>
                            <!-- HTML structure for odd indexes -->
                            <div class="activity-title"><?php echo $activity->activity_title ?></div>
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
                            <div class="activity-title"><?php echo $activity->activity_title ?></div>
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
                            <div class="news-title"><?php echo $news->news_title ?></div>
                            <div class="news-timestamp"><?php echo date('F j, Y g:i A', strtotime($news->news_timestamp)) ?>
                            </div>
                            <div class="news-text"><?php echo $news->news_text ?></div>
                        </div>
                        <hr>
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

    $(document).ready(function () {
        // Function to handle liking a post via AJAX
        function followOrganization(organizationId) {
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


            if (followedUsers.includes(currentUserId.toString())) {
                $(this).find('.fa-regular').removeClass('fa-regular').addClass('fa-solid');
            }
        });
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>