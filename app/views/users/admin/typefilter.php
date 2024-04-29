<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>


<table class="user-table">
    <thead>
        <tr>
            <th>User Name</th>
            <th>User Email</th>
            <th>Account Type</th>
            <th>Account Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['users'][0]->id)): ?>
            <?php foreach ($data['users'] as $user):
                if (empty($user)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $confirm = $user->id; ?>

                <tr>
                    <td>
                        <?php echo $user->fname, " ", $user->lname ?>
                    </td>
                    <td>
                        <?php echo $user->email ?>
                    </td>
                    <td>
                        <?php echo $user->type ?>
                    </td>
                    <td class="approval">
                        <div class="<?php echo ($user->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                                 if ($user->status == 1):
                                     echo "Active";
                                 else:
                                     echo "Deactivated";
                                 endif;
                                 ?></div>
                    </td>
                    <td id="action">
                        <?php if ($user->type != 'admin'): ?>
                            <a href="<?php echo URLROOT ?>/users/show/<?php echo $confirm ?>" class="view"><i
                                    class="fa-solid fa-eye"></i></a>
                        <?php endif; ?>

                        <div class="activation-option" data-status="<?php echo $user->status ?>"
                            data-user-id="<?php echo $user->id ?>">
                            <!-- <i class="fa-solid fa-toggle-off"></i> -->
                        </div>

                    </td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="5" class="no-users-found">No users found.</td>

        <?php endif; ?>

    </tbody>
</table>


<script src="<?php echo URLROOT ?>/js/users/admin/typefilter.js"></script>
<script>
    function changeEventActivation(userId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/changeActivation',
            data: { userId: userId },
            success: function (response) {
                // Update the like count in the DOM
                var activationOption = $('.activation-option[data-user-id="' + userId + '"]');
                if (response == 'deactivated') {
                    activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
                    handleUserFilters();
                } else {
                    activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
                    handleUserFilters();
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.activation-option').click(function () {
        var userId = $(this).data('user-id');
        changeEventActivation(userId);
    });

    // Check if the user has liked each post and update the heart icon accordingly


    $('.activation-option').each(function () {
        var userId = $(this).data('user-id');
        var userStatus = $(this).data('status');

        var activationOption = $('.activation-option[data-user-id="' + userId + '"]');
        if (userStatus == 1) {
            activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
        } else {
            activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
        }
    });
</script>