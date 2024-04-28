<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/opportunities/showOpportunity_style.css">

<?php
// Calculate remaining days for application deadline
$deadline = date_create($data['opportunity']->application_deadline);
$today = date_create();
$interval = date_diff($today, $deadline);
$remaining_days = max(0, $interval->days);
// Format the application deadline
$formatted_deadline = date_format($deadline, 'd M, Y');
?>
<div class="cover-image">
    <img src="<?php echo URLROOT ?>/img/opportunities/opportunities_cover_images/<?php echo $data['opportunity']->opportunity_cover_image ?>"
        alt="">
</div>

<div class="container">
    <div class="bottom-main-section">
        <div class="left-main-section">
            <div class="description-box">
                <div class="title">
                    <h3><?php echo $data['opportunity']->opportunity_title ?></h3>
                </div>
                <div class="description">
                    <div class="description-icon">
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <h3>Description</h3>
                    </div>
                    <p><?php echo $data['opportunity']->description ?></p>
                </div>
            </div>
            <div class="qualifications-box">
                <div class="qualifications-icon">
                    <i class="fa-solid fa-pen-nib"></i>
                    <h3>Qualifications</h3>
                </div>
                <ul>
                    <?php
                    // Explode the qualifications text by line breaks
                    $qualifications = explode("\n", $data['opportunity']->qualifications);
                    // Iterate through each qualification and display as list item
                    foreach ($qualifications as $qualification) {
                        // Trim the qualification to remove any leading or trailing whitespace
                        $qualification = trim($qualification);
                        // Skip empty qualifications
                        if (!empty($qualification)) {
                            echo "<li>$qualification</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="description-image-box">
                <img src="<?php echo URLROOT ?>/img/opportunities/description_images/<?php echo $data['opportunity']->description_image ?>"
                    alt="">
            </div>

            <div class="additional-information-box">
                <?php if (!empty($data['opportunity']->additional_information)): ?>
                    <div class="additional-icon">
                        <i class="fa-solid fa-circle-info"></i>
                        <h3>Additional Information</h3>
                    </div>
                    <ul>
                        <?php
                        $additional_info_items = explode("\n", $data['opportunity']->additional_information);
                        foreach ($additional_info_items as $info):
                            ?>
                            <li><?php echo $info; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>


        <div class="right-main-section">
            <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'undergraduate' || $_SESSION['user_type'] === 'admin')): ?>
                <div class="email-apply-box">
                    <div class="email-box">
                        <a href="mailto:<?php echo $data['opportunity']->contact_email ?>?subject=Job Application"
                            target="_blank">
                            <i class="fa-regular fa-paper-plane"></i>
                            <p>Apply by email</p>
                        </a>
                    </div>

                    <div class="bookmark-box" id="addBookmarkBtn">
                        <i class="fa-solid fa-bookmark" id="add-to-calendar"></i>
                        <p id="bookmarkStatus">Add Bookmark</p>
                    </div>

                </div>
            <?php endif; ?>

            <div class="date-box">
                <div class="countdown">
                    <p><span><?php echo $remaining_days ?></span> days to deadline</p>
                </div>
                <div class="deadline-text">
                    <h3>Deadline</h3>
                </div>
                <div class="date">
                    <p><?php echo $formatted_deadline ?></p>
                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'undergraduate' || $_SESSION['user_type'] === 'admin')): ?>
                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo urlencode($data['opportunity']->opportunity_title); ?>&dates=<?php echo urlencode(date_format(date_create($data['opportunity']->application_deadline), 'Ymd\THis')); ?>/<?php echo urlencode(date_format(date_create($data['opportunity']->application_deadline), 'Ymd\THis')); ?>&details=Reminder%20for%20opportunity%20published%20in%20unihub.lk"
                            target="_blank" class="googe-calendar-reminder">
                            <i class="fa-regular fa-calendar-plus"></i>
                            <p>Add to Google Calendar</p>
                        </a>
                    <?php endif; ?>
                </div>
                <hr>
                <div class="working-mod">
                    <p><?php echo $data['opportunity']->working_type ?></p>
                </div>
            </div>

            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin'): ?>
                <div class="opportunity-settings-box">
                    <a href="<?php echo URLROOT ?>/opportunities/settings/<?php echo $data['opportunity']->id ?>">
                        <i class="fa-solid fa-gear"></i>
                        <p>Settings</p>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();
    // Add click event to the button
    function checkOpportunityUserBookmark() {
        $.ajax({
            url: 'http://localhost/unihub/opportunities/checkUserOpportunityBookmark',
            type: 'POST',
            data: {
                opportunity_id: <?php echo $data['opportunity']->id ?>,
                user_id: <?php echo $_SESSION['user_id'] ?>,
            },
            success: function (response) {
                // Handle the success response
                console.log("Check user opportunity bookmark - AJAX request successful:", response);

                var addBookmarkBtn = $("#addBookmarkBtn");

                if (response === '1') {
                    document.getElementById('bookmarkStatus').innerText = 'Bookmark Added';
                } else {
                    document.getElementById('bookmarkStatus').innerText = 'Add Bookmark';
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
                console.error("Check user opportunity bookmark - AJAX request failed:", status, error);
            }
        });
    }
    checkOpportunityUserBookmark();

    $(document).ready(function () {
        $("#addBookmarkBtn").on("click", function (e) {
            // console.log("Click");
            e.preventDefault(); // Prevent the default link behavior

            // // Store reference to the button element
            var addBookmarkBtn = $("#addBookmarkBtn");

            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/opportunities/addBookmark',
                type: 'POST', // or 'GET' depending on your needs
                data: {
                    opportunity_id: <?php echo $data['opportunity']->id ?>,
                    user_id: <?php echo $_SESSION['user_id'] ?>,
                },
                success: function (response) {
                    // Handle the success response
                    console.log("Bookmark AJAX request successful:", response);

                    // Update the text content on success
                    // interestedBtn.find('span').text(response);   
                    if (response === '1') {
                        // addBookmarkBtn.addClass("new-class");
                        document.getElementById('bookmarkStatus').innerText = 'Bookmark Added';
                    } else {
                        // addBookmarkBtn.removeClass("new-class");
                        document.getElementById('bookmarkStatus').innerText = 'Add Bookmark';
                    }


                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                }
            });
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script src="<?php echo URLROOT ?>/js/opportunities/showOpportunity.js"></script>