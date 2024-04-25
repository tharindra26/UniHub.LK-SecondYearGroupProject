<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/organizationApprovalFilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Organization ID</th>
            <th>Organization Name</th>
            <th>Email</th>
            <th>University</th>
            <th>Contact Number</th>
            <th>Approval</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['organizations'][0]->organization_id)): ?>
            <?php foreach ($data['organizations'] as $organization):
                if (empty($organization)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $organizationId = $organization->organization_id; ?>
                <tr>
                    <td><?php echo $organization->organization_id ?></td>
                    <td><?php echo $organization->organization_name ?></td>
                    <td class="email-column" data-full-text="long.email.address@example.com"><?php echo $organization->contact_email ?></td>
                    <td><?php echo $organization->university_name ?></td>
                    <td><?php echo $organization->contact_number ?></td>
                    <td>
                        <div
                            class="<?php echo ($organization->approval == "approved") ? 'approved' : (($organization->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($organization->approval == "approved"):
                                echo "Approved";
                            elseif ($organization->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                            ?>
                        </div>
                    </td>
                    <td class="action">
                        <div class="organization-approval-action" data-organization-approval="<?php echo $organization->approval ?>"
                            data-organization-id="<?php echo $organization->organization_id ?>">
                            <select name="organization-approval" id="organization-approval-filter-value" placeholder="Approval"
                                class="dropdown-menu">
                                <option value="approved" <?php if ($organization->approval == 'approved')
                                    echo 'selected'; ?>>Approved
                                </option>
                                <option value="pending" <?php if ($organization->approval == 'pending')
                                    echo 'selected'; ?>>Pending
                                </option>
                                <option value="rejected" <?php if ($organization->approval == 'rejected')
                                    echo 'selected'; ?>>Rejected
                                </option>
                            </select>

                        </div>

                    </td>
                    <td>
                        <a href="<?php echo URLROOT ?>/Organizations/show/<?php echo $organization->organization_id ?>" class="view-btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No organizations found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>


<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    
    // Check if the user has liked each post and update the heart icon accordingly


    $('table.user-table tbody tr').on('change', '.organization-approval-action select[name="organization-approval"]', function () {
        // Get the selected value
        var selectedOrganizationApproval = $(this).val();
        // Get the event ID
        var organizationId = $(this).closest('tr').find('.organization-approval-action').data('organization-id');
        // Call a function to handle the selected value
        handleSelectedOrganizationApproval(organizationId, selectedOrganizationApproval);
    });


    function handleSelectedOrganizationApproval(organizationId, selectedOrganizationApproval) {
        console.log(organizationId,selectedOrganizationApproval);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/changeApproval',
            data: {
                organizationId: organizationId,
                selectedOrganizationApproval: selectedOrganizationApproval
            },
            success: function (response) {
                // Update the like count in the DOM
                console.log(response);
                $('#organization-filter-value').val('pending');
                // Manually trigger the change event to apply the selection
                $('#organization-filter-value').change();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

</script>