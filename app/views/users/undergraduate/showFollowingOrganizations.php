<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/interested-events_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <div class="title">
                <p>Liked Posts</p>
            </div>

        </div>
        <div class="bottom-part">
            <div class="left-box">
                <div class="form-outer-box">
                    <div class="row">
                        <?php if (!empty($data['organizations'])): ?>
                            <?php foreach ($data['organizations'] as $org):
                                $orgId = $org->id; ?>
                                <div class="content">
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
                                            <div class="edu-btn">
                                                <a href="#" class="button"
                                                    onclick="openPopup('<?php echo $orgId; ?>')"><i
                                                        class="fa-solid fa-xmark"></i></a>
                                                <!-- popupModal -->

                                                <span class="overlay"></span>
                                                <div class="modal-box" id="<?php echo $orgId; ?>">
                                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    <h2>Confirm Deletion</h2>
                                                    <p>Are you sure you want to remove this post from the list</p>
                                                    <div class="btn">
                                                        <button class="close-btn"
                                                            onclick="confirmDelete('<?php echo $orgId ?>')">Delete</button>
                                                        <button class="close-btn"
                                                            onclick="closePopup('<?php echo $orgId ?>')">Cancel</button>
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
<script src="<?php echo URLROOT ?>/js/users/undergraduate/showFollowingOrganizations.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
