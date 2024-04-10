<?php if (!empty($data['opportunities'][0]->id)): ?>
    <?php foreach ($data['opportunities'] as $opportunity): ?>
        <?php
        // Calculate remaining days for application deadline
        $deadline = date_create($opportunity->application_deadline);
        $today = date_create();
        $interval = date_diff($today, $deadline);
        $remaining_days = $interval->days;

        // Format the application deadline
        $formatted_deadline = date_format($deadline, 'd M, Y');
        ?>
        <a class="opportunity-card-link" href="<?php echo URLROOT ?>/opportunities/show/<?php echo $opportunity->id ?>">
            <div class="opportunity-card">
                <div class="left-color-bar"></div>
                <div class="image-section">
                    <img src="<?php echo URLROOT ?>/img/opportunities/opportunities_card_images/<?php echo $opportunity->opportunity_card_image ?>"
                        alt="">
                </div>
                <div class="title-section">
                    <div class="title-text"><?php echo $opportunity->opportunity_title ?></div>
                    <div class="days-left">
                        <div class="day-count-box">
                            <div class="day-count"><i class="fa-solid fa-circle"></i><?php echo $remaining_days ?> days left
                            </div>
                        </div>
                        <div class="working-mod-box">
                            <div class="working-mod"><i class="fa-solid fa-building"></i> Physical</div>
                        </div>
                    </div>
                    <div class="interesting-count">
                        <div class="interesting-box">
                            <p><span>253</span> Interesting </p>
                        </div>
                        <div class="bookmark"><i class="fa-solid fa-bookmark"></i>
                            <p>Add Bookmark</p>
                        </div>
                    </div>
                </div>
                <div class="details-section">
                    <div class="posted-by">
                        <i class="fa-solid fa-flag"></i>
                        <p><?php echo $opportunity->organization_name ?></p>
                    </div>
                    <div class="duration">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p><?php echo $formatted_deadline ?></p>
                    </div>
                    <div class="tags">
                        <i class="fa-solid fa-tags"></i>
                        <?php $tags = explode(',', $opportunity->tags); ?>
                        <?php foreach ($tags as $tag): ?>
                            <div class="tag"><?php echo $tag ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="right-color-bar">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
<?php else: ?>
    <p>No opportunities available.</p>
<?php endif; ?>