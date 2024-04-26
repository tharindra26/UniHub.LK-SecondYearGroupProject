<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Organization Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Approval</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['opportunities'][0]->id)): ?>
            <?php foreach ($data['opportunities'] as $opp):
                if (empty($opp)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $opportunityId = $opp->id; ?>
                <tr>
                    <td><?php echo $opp->id ?></td>
                    <td><?php echo $opp->opportunity_title ?></td>
                    <td><?php echo $opp->organization_name ?></td>
                    <td><?php echo $opp->contact_email ?></td>
                    <td><?php echo $opp->contact_phone ?></td>
                    <td>
                        <div
                            class="<?php echo ($opp->approval == "approved") ? 'approved' : (($opp->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($opp->approval == "approved"):
                                echo "Approved";
                            elseif ($opp->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="<?php echo ($opp->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                                 if ($opp->status == 1):
                                     echo "Active";
                                 else:
                                     echo "Deactivated";
                                 endif;
                                 ?></div>
                    </td>
                    <td class="action">
                        <a href="<?php echo URLROOT ?>/opportunities/show/<?php echo $opp->id ?>" class="view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?php echo URLROOT ?>/opportunities/settings/<?php echo $opp->id ?>" class="update">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <div class="activation-option" data-status="<?php echo $opp->status ?>"
                            data-opp-id="<?php echo $opp->id ?>">
                            <!-- <i class="fa-solid fa-toggle-off"></i> -->
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

    function changeOpportunityActivation(opportunityId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/opportunities/changeActivation',
            data: { opportunityId: opportunityId },
            success: function (response) {
                // Update the like count in the DOM
                console.log(response);
                var activationOption = $('.activation-option[data-opp-id="' + opportunityId + '"]');
                if (response == 'deactivated') {
                    activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
                    handleOpportunityFilters()
                } else {
                    activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
                    handleOpportunityFilters()
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.activation-option').click(function () {
        var opportunityId = $(this).data('opp-id');
        changeOpportunityActivation(opportunityId);
    });

    // Check if the user has liked each post and update the heart icon accordingly


    $('.activation-option').each(function () {
        var opportunityId = $(this).data('opp-id');
        var opportunityStatus = $(this).data('status');

        var activationOption = $('.activation-option[data-opp-id="' + opportunityId + '"]');
        if (opportunityStatus == 1) {
            activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
        } else {
            activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
        }
    });

</script>