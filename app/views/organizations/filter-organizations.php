<?php if (!empty($data['organizations'][0]->organization_id)): ?>
    <?php foreach ($data['organizations'] as $organization): ?>
        <div class="organization-card">
            <div class="organization-card-inner">
                <div class="left-section">
                    <div class="logo-box">
                        <img src="<?php echo URLROOT ?>/img/organizations/organization_profile_images/<?php echo $organization->organization_profile_image ?>" alt="img">
                    </div>
                    <div class="organization-info">
                        <div class="organization-name"><?php echo $organization->organization_name ?></div>
                        <div class="organization-university"><?php echo $organization->university_name ?></div>
                    </div>
                </div>
                <div class="right-section">
                    <div class="followers-count">2.3k followers</div>
                    <a class="view-profile-btn" href="<?php echo URLROOT ?>/organizations/show/<?php echo $organization->organization_id ?>">
                        View Profile
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p>No organizations available.</p>
<?php endif; ?>