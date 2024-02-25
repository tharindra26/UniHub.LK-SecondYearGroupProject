<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/myFriends_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <div class="title">
                <p>Friends</p>
            </div>

        </div>
        <div class="bottom-part">
            <div class="left-box">
                        <div class="row">
                            <?php if (!empty($data['friends'][0]->id)) : ?> 
                                <?php foreach ($data['friends'] as $friends) : 
                                    $friend_id =$friends->follower_relationship_id;?>
                                <div class="content">
                                    <div class="material">
                                    <a href="<?php echo URLROOT ?>/users/show/<?php echo $friends->id ?>">
                                    <div class="friend">
                                    <div class="friend_img">
                                    <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $friends->profile_image ?>" alt="">
                                    </div>
                                    <div class="friend-name"><?php echo $friends->fname , " " , $friends->lname  ?></div>
                                </div>
                                    
                                </a> 
                                </div>
                             
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
                            <button class="close-btn" onclick="closePopup('<?php echo $participation_id ?>')">Cancel</button>
                        </div>
                        </div>

                        <!-- popupModal -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
<script src="<?php echo URLROOT ?>/js/users/undergraduate/myFriends.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>