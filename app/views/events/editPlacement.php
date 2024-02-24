<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editPlacement_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Placement Details</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/events/editPlacement/<?php echo $data['id'] ?>"
                        method="post" enctype="multipart/form-data">
                       
                        <div class="column">
                            <div class="input-box">
                                <label for="">Venue</label>
                                <input type="text" name="venue" value="<?php echo $data['venue'] ?>" id=""
                                    placeholder="Enter event venue">
                                <?php if (!empty($data['venue_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['venue_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="input-box">
                                <label for="">Embed Google map link</label>
                                <input type="text" name="map_navigation" value="<?php echo htmlspecialchars($data['map_navigation']) ?>"
                                    id="" placeholder="Enter embed Google map link">
                                <?php if (!empty($data['map_navigation_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['map_navigation_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <?php
                                // Get the current date and time in the format required by datetime-local input
                                $currentDateTime = date('Y-m-d\TH:i', time());
                                ?>
                                <label for="">Start date-time</label>

                                <input type="datetime-local" name="start_datetime"
                                    value="<?php echo $data['start_datetime'] ?>" id="start_datetime"
                                    min="<?php echo $currentDateTime; ?>">
                                <?php if (!empty($data['start_datetime_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['start_datetime_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="input-box">
                                <label for="">End date-time</label>
                                <input type="datetime-local" name="end_datetime"
                                    value="<?php echo $data['end_datetime'] ?>" id="">
                                <?php if (!empty($data['end_datetime_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['end_datetime_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">Update</button>
                    </form>
                </div>
            </div>

            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/editPlacement.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>