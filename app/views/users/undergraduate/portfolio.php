<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/portfolio_style.css">

<div class="print-portfolio">
    <div class="leftbar">
        <div class="profile-photo">
            <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $data['user']->profile_image ?>"
                alt="Profile Picture" class="profile-img">
        </div>
        <div class="contact">
            <div class="address">
                <i class="fa-solid fa-location-dot"></i>
                <p>Default address</p>
            </div>
            <div class="address">
                <i class="fa-solid fa-phone"></i>
                <p><?php echo $data['user']->contact_number ?></p>
            </div>
            <div class="address">
                <i class="fa-solid fa-envelope"></i>
                <p><?php echo $data['user']->email ?></p>
            </div>
            <div class="address">
                <i class="fa-brands fa-linkedin"></i>
                <p><?php echo $data['user']->linkedin ?></p>
            </div>
        </div>
        <div class="personal-info">
            <?php
            $birthday = $data['user']->dob;
            // Convert MySQL datetime to DateTime object
            $dateTime = new DateTime($birthday);
            // Format the DateTime object to extract only THU NOV 16
            $extractedDate = $dateTime->format('D M j');
            // Format the DateTime object to extract only the time (06.00PM)
            $extractedTime = $dateTime->format('h:i A');
            ?>
            <div class="info-heading">
                <h4>Personal Information</h4>
            </div>
            <div class="info-list">
                <ul>
                    <li>Date of Birth: <?php echo $data['user']->dob ?></li>
                    <li>Age: Calculate</li>
                    <li>Nationality: Sri Lankan</li>
                </ul>
            </div>
        </div>
        .

    </div>
    <div class="rightbar">
        <div class="name">
            <h1><?php echo $data['user']->fname, " ", $data['user']->lname ?></h1>
        </div>
        <div class="about">
            <p><?php echo $data['user']->description ?></p>
        </div>
        <div class="qualifications">
            <div class="info-heading">
                <h4>Qualifications</h4>
            </div>
            <div class="qualification-list">
                <?php if (!empty($data['qualifications'][0]->qualification_id)): ?>
                    <?php foreach ($data['qualifications'] as $qualification): ?>
                        <h4><?php echo $qualification->qualification_name ?> -
                            <?php echo $qualification->institution ?>
                        </h4>
                        <p>Completed date : <?php echo $qualification->completion_date ?></p>
                        <p><?php echo $qualification->description ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="qualifications">
            <div class="info-heading">
                <h4>Education</h4>
            </div>
            <div class="education-list">
                <?php if (!empty($data['education'][0]->education_id)): ?>
                    <?php foreach ($data['education'] as $education): ?>
                        <h4><?php echo $education->institution ?></h4>
                        <p><?php echo $education->start_year ?> - <?php echo $education->end_year ?></p>
                        <p><?php echo $education->description ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="qualifications">
            <div class="info-heading">
                <h4>Extra Curricular Activities</h4>
            </div>
            <div class="education-list">
                <?php if (!empty($data['organizations'][0]->id)): ?>
                    <?php foreach ($data['organizations'] as $organization): ?>
                        <h4><?php echo $organization->organization_name ?> -
                            <?php echo $organization->name ?>
                        </h4>
                        <p><?php echo $organization->role ?></p>
                        <p>Duration: <?php echo $organization->start_date ?> - <?php echo $organization->end_date ?>
                        </p>
                        <hr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>