<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table id="user-table" class="user-table">
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Title</th>
            <th>User ID</th>
            <th>Category</th>
            <th>Contact</th>
            <th>Approval</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['events'][0]->id)): ?>
            <?php foreach ($data['events'] as $event):
                if (empty($event)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $eventId = $event->id; ?>
                <tr>
                    <td><?php echo $event->id ?></td>
                    <td><?php echo $event->title ?></td>
                    <td><?php echo $event->user_id ?></td>
                    <td><?php echo $event->category_names ?></td>
                    <td><?php echo $event->contact_number ?></td>
                    <td>
                        <div
                            class="<?php echo ($event->approval == "approved") ? 'approved' : (($event->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($event->approval == "approved"):
                                echo "Approved";
                            elseif ($event->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="<?php echo ($event->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                                 if ($event->status == 1):
                                     echo "Active";
                                 else:
                                     echo "Deactivated";
                                 endif;
                                 ?></div>
                    </td>
                    <td class="action">
                        <a href="<?php echo URLROOT ?>/events/show/<?php echo $event->id ?>" class="view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?php echo URLROOT ?>/events/settings/<?php echo $event->id ?>" class="update">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <div class="activation-option" data-status="<?php echo $event->status ?>"
                            data-event-id="<?php echo $event->id ?>">
                            <!-- <i class="fa-solid fa-toggle-off"></i> -->
                        </div>

                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No events found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>
<button onclick="generatePDF()">Download PDF</button> <!-- Add this button for PDF download -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    function generatePDF() {
        var element = document.getElementById('user-table'); // Get the table element
        var opt = {
            margin:       1,
            filename:     'events.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'A3', orientation: 'portrait' }
        };
        var pdf = new html2pdf(element, opt); // Create HTML2PDF instance
        pdf.save(); // Save the PDF
    }

    function changeEventActivation(eventId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/changeActivation',
            data: { eventId: eventId },
            success: function (response) {
                // Update the like count in the DOM
                var activationOption = $('.activation-option[data-event-id="' + eventId + '"]');
                if (response == 'deactivated') {
                    activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
                    handleFilters();
                } else {
                    activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
                    handleFilters();
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.activation-option').click(function () {
        var eventId = $(this).data('event-id');
        changeEventActivation(eventId);
    });

    // Check if the user has liked each post and update the heart icon accordingly


    $('.activation-option').each(function () {
        var eventId = $(this).data('event-id');
        var eventStatus = $(this).data('status');

        var activationOption = $('.activation-option[data-event-id="' + eventId + '"]');
        if (eventStatus == 1) {
            activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
        } else {
            activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
        }
    });

   

</script>