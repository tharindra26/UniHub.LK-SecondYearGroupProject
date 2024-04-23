<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/myprofile_style.css">
<span class="overlay-search"></span>
<?php if (!empty($data['users'][0]->id)) : ?> 
    <?php foreach ($data['users'] as $users) : ?>
        <a href="<?php echo URLROOT ?>/users/show/<?php echo $users->id ?>" class="profile-link">
        <div class="search-results">
            <div class="profile-pic">
                <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $users->profile_image ?>" alt="">
            </div>
            <div class="account-name"><?php echo $users->fname , " " , $users->lname ?></div>
        </div> 
        </a>
        <hr>
    <?php endforeach; ?>
    <?php else: ?><div class="search-results"><p>No result found</p></div><hr>
<?php endif; ?>
