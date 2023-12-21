<?php if (!empty($data['events'][0]->id)) : ?>
    <?php var_dump($data['events']);
    die(); ?>
    <?php foreach ($data['events'] as $event) : ?>
        <?php
            $eventStartDate = $event->start_datetime;
            // Convert MySQL datetime to DateTime object
            $dateTime = new DateTime($eventStartDate);
            // Format the DateTime object to extract only THU NOV 16
            $extractedDate = $dateTime->format('D M j');
            // Format the DateTime object to extract only the time (06.00PM)
            $extractedTime = $dateTime->format('h:i A');
        ?>

        <div class="event-card">
            <div class="image-section">
                <img src="<?php echo URLROOT ?>/img/events/events_profile_images/<?php echo $event->event_profile_image ?>" alt="event-profile-image">
            </div>
            <div class="details-section">
                <div class="date-section">
                    <i class="fa-regular fa-calendar-days"></i> &nbsp <?php echo $extractedDate ?> &nbsp &nbsp
                    <i class="fa-solid fa-clock"></i> &nbsp <?php echo $extractedTime ?>
                </div>
                <div class="title-section"><?php echo $event->title ?></div>
                <div class="category-section">
                    <?php $categories = explode(',', $event->category_names);
                    foreach ($categories as $category): ?>
                        <div class="category"><?php echo $category; ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="venue-section"><?php echo $event->venue ?></div>
                <a href="<?php echo URLROOT ?>/events/show/<?php echo $event->id ?>" class="view-event-button">
                    <div class="">View Event</div>
                </a>
            </div>
        </div>

    <?php endforeach; ?>
<?php else : ?>
    <p>No events available.</p>
<?php endif; ?>
