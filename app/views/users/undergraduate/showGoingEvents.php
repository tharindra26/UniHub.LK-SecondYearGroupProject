<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/going-events_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <div class="title">
                <p>Going Events</p>
            </div>

        </div>
        <div class="bottom-part">
            <div class="left-box">
                <div class="form-outer-box">
                        <div class="row">
                            <?php if (!empty($data['events'][0]->id)) : ?> 
                                <?php foreach ($data['events'] as $goingEvents) : 
                                    $participation_id = $goingEvents->participation_id; ?>
                                    <?php
                                    $eventStartDate = $goingEvents->start_datetime;
                                    // Convert MySQL datetime to DateTime object
                                    $dateTime = new DateTime($eventStartDate);
                                    // Format the DateTime object to extract only THU NOV 16
                                    $extractedDate = $dateTime->format('D M j');
                                    // Format the DateTime object to extract only the time (06.00PM)
                                    $extractedTime = $dateTime->format('h:i A');
                            ?>
                                <div class="content">
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
                                    <div class="edu-btn">
                                        <a href="#" class="button" onclick="openPopup('<?php echo $participation_id; ?>')"><i class="fa-solid fa-xmark"></i></a>
                                        <!-- popupModal -->

                        <span class="overlay"></span>
                        <div class="modal-box" id="<?php echo $participation_id; ?>">
                        <!-- <i class="fa-solid fa-xmark"></i> -->
                        <i class="fa-solid fa-trash-can"></i>
                            <h2>Confirm Deletion</h2>
                            <p>Are you sure you want to remove this event from the list</p>
                        <div class="btn">
                            <button class="close-btn" onclick="confirmDelete('<?php echo $participation_id ?>')">Delete</button>
                            <button class="close-btn" onclick="closePopup('<?php echo $participation_id_id ?>')">Cancel</button>
                        </div>
                        </div>

                        <!-- popupModal -->
                                    </div>
                                </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div>
        </div>
    </div>
</div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/undergraduate/showQualification.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>