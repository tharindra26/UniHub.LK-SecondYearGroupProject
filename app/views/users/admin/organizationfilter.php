<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>organization ID</th>
            <th>organization Title</th>
            <th>Category</th>
            <th>Contact Email</th>
            <th>University</th>
            <th>Status</th>
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
                    <td><?php echo $organization->category_names ?></td>
                    <td><?php echo $organization->contact_email ?></td>
                    <td><?php echo $organization->university ?></td>
                    <td>
                        <div class="<?php echo ($organization->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                                 if ($organization->status == 1):
                                     echo "Active";
                                 else:
                                     echo "Deactivated";
                                 endif;
                                 ?></div>
                    </td>
                    <td class="action">
                        <a href="<?php echo URLROOT ?>/organizations/show/<?php echo $organization->organization_id ?>"
                            class="view"><i class="fa-solid fa-eye"></i><a>
                                <a href="<?php echo URLROOT ?>/organizations/settings/<?php echo $organization->organization_id ?>"
                                    class="update"><i class="fa-solid fa-pen-to-square"></i></a>

                                <div class="activation-option" data-status="<?php echo $organization->status ?>"
                                    data-organization-id="<?php echo $organization->id ?>">
                                    <!-- <i class="fa-solid fa-toggle-off"></i> -->
                                </div>

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

<script src="<?php echo URLROOT ?>/js/users/admin/organizationfilter.js"></script>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    function changeOrganizationActivation(organizationId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/changeActivation',
            data: { organizationId: organizationId },
            success: function (response) {
                // Update the like count in the DOM
                var activationOption = $('.activation-option[data-organization-id="' + organizationId + '"]');
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

    // Attach click event listener to activation options
$('.activation-option').click(function () {
    var organizationId = $(this).data('organization-id'); // Use organizationId here
    changeOrganizationActivation(organizationId);
});

// Check and update the initial status of each organization
$('.activation-option').each(function () {
    var organizationId = $(this).data('organization-id');
    var organizationStatus = $(this).data('status');

    var activationOption = $('.activation-option[data-organization-id="' + organizationId + '"]');
    if (organizationStatus == 1) {
        activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
    } else {
        activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
    }
});


</script>