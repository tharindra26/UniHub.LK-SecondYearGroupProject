<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/organizationApprovalFilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Approval</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['opportunities'][0]->id)): ?>
            <?php foreach ($data['opportunities'] as $opportunity):
                if (empty($opportunity)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $opportunityId = $opportunity->id; ?>
                <tr>
                    <td><?php echo $opportunity->id ?></td>
                    <td><?php echo $opportunity->opportunity_title ?></td>
                    <td><?php echo $opportunity->contact_person ?></td>
                    <td><?php echo $opportunity->contact_email ?></td>
                    <td><?php echo $opportunity->contact_phone ?></td>
                    <td>
                        <div
                            class="<?php echo ($opportunity->approval == "approved") ? 'approved' : (($opportunity->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($opportunity->approval == "approved"):
                                echo "Approved";
                            elseif ($opportunity->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                            ?>
                        </div>
                    </td>
                    <td class="action">
                        <div class="opportunity-approval-action" data-opportunity-approval="<?php echo $opportunity->approval ?>"
                            data-opportunity-id="<?php echo $opportunity->id ?>">
                            <select name="opportunity-approval" id="opportunity-approval-filter-value" placeholder="Approval"
                                class="dropdown-menu">
                                <option value="approved" <?php if ($opportunity->approval == 'approved')
                                    echo 'selected'; ?>>Approved
                                </option>
                                <option value="pending" <?php if ($opportunity->approval == 'pending')
                                    echo 'selected'; ?>>Pending
                                </option>
                                <option value="rejected" <?php if ($opportunity->approval == 'rejected')
                                    echo 'selected'; ?>>Rejected
                                </option>
                            </select>

                        </div>

                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No opportunities found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>


<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    
    // Check if the user has liked each post and update the heart icon accordingly


    $('table.user-table tbody tr').on('change', '.opportunity-approval-action select[name="opportunity-approval"]', function () {
        // Get the selected value
        var selectedOpportunityApproval = $(this).val();
        // Get the event ID
        var opportunityId = $(this).closest('tr').find('.opportunity-approval-action').data('opportunity-id');
        // Call a function to handle the selected value
        handleSelectedOpportunityApproval(opportunityId, selectedOpportunityApproval);
    });


    function handleSelectedOpportunityApproval(opportunityId, selectedOpportunityApproval) {
        console.log(opportunityId,selectedOpportunityApproval);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/opportunities/changeApproval',
            data: {
                opportunityId: opportunityId,
                selectedOpportunityApproval: selectedOpportunityApproval
            },
            success: function (response) {
                // Update the like count in the DOM
                console.log(response);
                $('#opportunity-filter-value').val('pending');
                // Manually trigger the change event to apply the selection
                $('#opportunity-filter-value').change();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

</script>