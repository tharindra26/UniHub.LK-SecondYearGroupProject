<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/myprofile_style.css">
<div class="search" id="user-results">
        <!-- popupModal -->
        <span class="overlay"></span>
            <div class="modal-box" id="user-results">
            <div class="friends-content">
                <?php if (!empty($data['users'][0]->id)) : ?> 
                    <?php foreach ($data['users'] as $user) : 
                        $friend_id =$requests->follower_relationship_id;?>
                        <a href="<?php echo URLROOT ?>/users/show/<?php echo $user->id ?>" class="profile-link">
                        <div class="friend-profile">
                        <div class="friend-pic">
                            <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $user->profile_image ?>" alt="">
                        </div>
                        <div class="friend-info">
                            <h4><?php echo $user->fname , " " , $user->lname ?></h4>
                            <div class="friend-uni"><?php 
                                            $uni = $user->university_name;
                                            $string = strip_tags($uni);
                                            if(strlen($string) > 30):
                                                $stringCut = substr($string, 0, 23);
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
                        <hr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <span>No Users are available</span>
                <?php endif; ?>
                </div>    
                </div>
            <!-- popupModal -->
</div>
