<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/event-show_style.css">

<div class="event-header">
    <div class="cover-image-section">
        <img src="<?php echo URLROOT ?>/img/events/events_cover_images/<?php echo $data['event']->event_cover_image ?>"
            alt="event cover image">
        <div class="title-overlay">
            <h1>
                <?php echo $data['event']->title ?>
            </h1>
        </div>
    </div>
    <div class="secondary-section">
        <div class="countdown-section">
            <div class="countdown-header">
                <div class="countdown-header-text">
                    <?php echo $data['event']->countdown_text ?>
                </div>
            </div>
            <div class="countdown">
                <div class="days countdown-box">
                    <p id="days"></p>
                    <span>DAYS</span>
                </div>
                <div class="hours countdown-box">
                    <p id="hours"></p>
                    <span>HOURS</span>
                </div>
                <div class="mins countdown-box">
                    <p id="minutes"></p>
                    <span>MINS</span>
                </div>
                <div class="sec countdown-box">
                    <p id="seconds"></p>
                    <span>SECS</span>
                </div>
                <a class="main-action-button-link" href="<?php echo $data['event']->main_button_link ?>">
                    <div class="main-action-button">
                        <span>
                            <?php echo $data['event']->main_button_action ?>
                        </span>
                        <i class="fa-solid fa-angles-right"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="event-profile-image-section">
            <div class="event-profile-image">
                <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $data['event']->event_profile_image ?>"
                    alt="">
            </div>
        </div>
        <div class="event-reaction-section">
            <a href="#" id="interested-btn-id" class="interested-btn">
                <i class="fa-regular fa-face-grin-hearts"></i>
                <span>&nbsp Interested</span>
            </a>
            <!-- <a href="#" id="going-btn-id" class="going-btn">
                <i class="fa-regular fa-face-grin-hearts"></i>
                <span>&nbsp Going</span>
            </a> -->
        </div>
    </div>
</div>

<div class="container">
    <div class="bottom-main-section">

        <!-- left-section -->
        <div class="left-section">
            <?php if (!empty($data['event']->web) || !empty($data['event']->linkedin) || !empty($data['event']->facebook) || !empty($data['event']->instagram)): ?>
                <div class="social-media">
                    <div class="social-media-title">
                        Follow us on
                    </div>
                    <div class="icons">
                        <?php if (!empty($data['event']->web)): ?>
                            <a href="#">
                                <div class="social-icon">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($data['event']->linkedin)): ?>
                            <a href="#">
                                <div class="social-icon">
                                    <i class="fa-brands fa-linkedin"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($data['event']->facebook)): ?>
                            <a href="#">
                                <div class="social-icon">
                                    <i class="fa-brands fa-facebook"></i>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($data['event']->instagram)): ?>
                            <a href="#">
                                <div class="social-icon">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>



            <div class="event-announcements">
                <a href="<?php echo URLROOT ?>/events/addAnnouncement/<?php echo $data['event']->id ?>"
                    class="event-announcements-link">
                    <div class="event-settings-btn">
                        <i class="fa-solid fa-bullhorn"></i> &nbsp Add Announcement
                    </div>
                </a>
            </div>

            <div class="event-settings">
                <a href="<?php echo URLROOT ?>/events/settings/<?php echo $data['event']->id ?>"
                    class="event-settings-link">
                    <div class="event-settings-btn">
                        <i class="fa-solid fa-gear"></i> &nbsp Event Settings
                    </div>
                </a>
            </div>
        </div>
        <!-- left-section -->

        <!-- middle-section -->
        <div class="middle-section">
            <div class="event-description">

                <?php
                $description = $data['event']->description; // Assuming $data['event']->description contains the full text
                $words = explode(' ', $description);
                $first100Words = implode(' ', array_slice($words, 0, 100));
                $remainingWords = implode(' ', array_slice($words, 100));
                ?>
                <div class="description-title">
                    <?php echo $data['event']->title ?>
                </div>
                <div class="description">
                    <p>
                        <?php echo $first100Words ?>
                        <span class="read-more-text">
                            <?php echo $remainingWords ?>
                        </span>
                    </p>
                    <span class="read-more-btn">Read More</span>
                </div>

            </div>

            <?php if (!empty($data['announcements'])): ?>
                <div class="announcements-section">
                    <div class="announcement-title">Announcements</div>


                    <?php foreach ($data['announcements'] as $announcement): ?>
                        <div class="announcement">
                            <div class="ann-date-section">
                                <?php
                                // Assuming $announcement['announcement_date'] contains the date in Y-m-d H:i:s format
                                $formattedDate = date('F j, Y g:i A', strtotime($announcement->announcement_date));
                                echo $formattedDate;
                                ?>
                            </div>
                            <div class="ann-content-section">
                                <?php echo $announcement->announcement_text; ?>
                            </div>


                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
        </div>
        <!-- middle-section -->

        <!-- right-section -->
        <div class="right-section">
            <div class="placement">
                <div class="date-time">
                    <?php
                    // Assuming $data['event']->date contains the datetime string
                    $original_start_datetime = $data['event']->start_datetime;

                    // Create a DateTime object from the original datetime string
                    $dateTime = new DateTime($original_start_datetime);

                    // Format the datetime as 'Y-m-d h:i A'
                    $formattedDatetime = $dateTime->format('Y-m-d h:i A');
                    ?>
                    <i class="fa-solid placement-icons fa-calendar-days"></i> &nbsp
                    <?php echo $formattedDatetime ?>
                </div>
                <div class="venue">
                    <i class="fa-solid placement-icons fa-location-dot"></i> &nbsp
                    <?php echo $data['event']->venue ?>
                </div>
                <div class="organization">
                    <i class="fa-solid placement-icons fa-medal"></i> &nbsp
                    <?php echo $data['event']->organized_by ?>
                </div>
            </div>

            <div class="event-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902932303577!2d79.85857797365264!3d6.902210818649357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25963120b1509%3A0x2db2c18a68712863!2sUniversity%20of%20Colombo%20School%20of%20Computing%20(UCSC)!5e0!3m2!1sen!2slk!4v1702927569124!5m2!1sen!2slk"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- right-section -->
    </div>
    <?php
    $starting_datetime = $data['event']->countdown_datetime;
    $starting_date_object = new DateTime($starting_datetime);
    $formatted_starting_datetime = $starting_date_object->format("M d, Y H:i:s");
    ?>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>





<script>

    var countDownDate = new Date("<?php echo $formatted_starting_datetime ?>").getTime();

    $(document).ready(function () {

        function checkEventParticipation() {
            $.ajax({
                url: 'http://localhost/unihub/events/checkEventParticipation',
                type: 'POST',
                data: {
                    event_id: <?php echo $data['event']->id ?>,
                    user_id: <?php echo $_SESSION['user_id'] ?>,
                },
                success: function (response) {
                    // Handle the success response
                    console.log("Check Event Participation - AJAX request successful:", response);

                    var interestedBtn = $("#interested-btn-id");

                    if (response === '1') {
                        interestedBtn.addClass("new-class");
                    } else {
                        interestedBtn.removeClass("new-class");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    console.error("Check Event Participation - AJAX request failed:", status, error);
                }
            });
        }

        // Add click event to the button
        $("#interested-btn-id").on("click", function (e) {
            // console.log("Click");
            e.preventDefault(); // Prevent the default link behavior

            // // Store reference to the button element
            var interestedBtn = $("#interested-btn-id");

            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/events/changeEventInterest',
                type: 'POST', // or 'GET' depending on your needs
                data: {
                    event_id: <?php echo $data['event']->id ?>,
                    user_id: <?php echo $_SESSION['user_id'] ?>,
                },
                success: function (response) {
                    // Handle the success response
                    console.log("AJAX request successful:", response);

                    // Update the text content on success
                    // interestedBtn.find('span').text(response);   
                    if (response === '1') {
                        interestedBtn.addClass("new-class");
                    } else {
                        interestedBtn.removeClass("new-class");
                    }


                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                }
            });
        });
        // Initial check on page load
        checkEventParticipation();
    });

</script>
<script src="<?php echo URLROOT ?>/js/events/event-show.js"></script>
<script>

    <?php
    // Your MySQL datetime value
    $mysqlDateTime = $data['event']->start_datetime;

    // Parse MySQL datetime string using DateTime
    $dateTime = new DateTime($mysqlDateTime);

    // Format the datetime value
    $formattedDateTime = $dateTime->format('F j, Y H:i:s');


    ?>
    var countDownDate = new Date('<?php echo $formattedDateTime ?>').getTime();
    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the countdown is over, clearInterval and display a message or take some action
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
            // You may want to display a message or take some action when the countdown expires
        }
    }, 1000);
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>