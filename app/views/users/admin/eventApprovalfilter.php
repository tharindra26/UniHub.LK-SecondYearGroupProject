<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/eventApprovalFilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Title</th>
            <th>Organization</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Approval</th>
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
                    <td><?php echo $event->organized_by ?></td>
                    <td><?php echo $event->email ?></td>
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
                    <td class="action">
                        <div class="approval-action" data-approval="<?php echo $event->approval ?>"
                            data-event-id="<?php echo $event->id ?>">
                            <select name="approval" id="column-approval-filter-value" placeholder="Approval"
                                class="dropdown-menu">
                                <option value="approved" <?php if ($event->approval == 'approved')
                                    echo 'selected'; ?>>Approved
                                </option>
                                <option value="pending" <?php if ($event->approval == 'pending')
                                    echo 'selected'; ?>>Pending
                                </option>
                                <option value="rejected" <?php if ($event->approval == 'rejected')
                                    echo 'selected'; ?>>Rejected
                                </option>
                            </select>

                        </div>

                    </td>
                    <td>
                        <a href="<?php echo URLROOT ?>/events/show/<?php echo $event->id ?>" class="view-btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>

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


<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

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
                } else {
                    activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
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

    $('table.user-table tbody tr').on('change', '.approval-action select[name="approval"]', function () {
        // Get the selected value
        var selectedApproval = $(this).val();
        // Get the event ID
        var eventId = $(this).closest('tr').find('.approval-action').data('event-id');
        // Call a function to handle the selected value
        handleSelectedApproval(eventId, selectedApproval);
    });


    function handleSelectedApproval(eventId, selectedApproval) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/changeApproval',
            data: {
                eventId: eventId,
                selectedApproval: selectedApproval
            },
            success: function (response) {
                // Update the like count in the DOM
                console.log(response);
                $('#approval-filter-value').val('pending');
                // Manually trigger the change event to apply the selection
                $('#approval-filter-value').change();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }


</script>