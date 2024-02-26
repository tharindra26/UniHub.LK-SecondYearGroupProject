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
                                    
                                    <a href="<?php echo URLROOT ?>/users/show/<?php echo $friends->id ?>">
                                    <div class="friend">
                                    <div class="friend_img">
                                    <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $friends->profile_image ?>" alt="">
                                    </div>
                                    <div class="friend-info">
                                        <div class="friend-name"><?php echo $friends->fname , " " , $friends->lname  ?></div>
                                        <div class="friend-uni"><?php 
                                            $uni = $friends->university_name;
                                            $string = strip_tags($uni);
                                            if(strlen($string) > 30):
                                                $stringCut = substr($string, 0, 26);
                                                $endPoint = strrpos($stringCut, '');
                                                $string = $endPoint?substr($stringCut, 0, $endPoint):substr($stringCut,0);
                                                echo $string;
                                        ?>
                                        <span class="see-more-btn">...</span>
                                        <?php
                                            else :
                                            echo $string;
                                            endif;
                                        ?>
                                    </div>
                                    </div>
                                    </div>
                                    
                                </a> 

                             
                                    <div class="edu-btn">
                                        <a href="#" class="button" onclick="openPopup('<?php echo $friend_id; ?>')">
                                            <div class="unfollow-btn">
                                                <i class="fa-solid fa-user-minus"></i>
                                                <div class="btn-text">Unfollow</div>
                                            </div>
                                        </a>
                                        <!-- popupModal -->

                        <span class="overlay"></span>
                        <div class="modal-box" id="<?php echo $friend_id; ?>">
                        <!-- <i class="fa-solid fa-xmark"></i> -->
                        <i class="fa-solid fa-trash-can"></i>
                            <h2>Are you Sure??? </h2>
                            <p>Unfollow : <?php echo $friends->fname , " " , $friends->lname  ?></p>
                        <div class="btn">
                            <button class="close-btn" onclick="unfollow('<?php echo $friend_id; ?>')">Delete</button>
                            <button class="close-btn" onclick="closePopup('<?php echo $friend_id; ?>')">Cancel</button>
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