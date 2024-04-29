<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Post Title</th>
            <th>User ID</th>
            <th>Time Stamp</th>
            <th>Approval</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['post'][0]->post_id)): ?>
            <?php foreach ($data['post'] as $post):
                if (empty($post)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $postId = $post->post_id; ?>
                <tr>
                    <td><?php echo $post->post_id ?></td>
                    <td><?php echo $post->post_title ?></td>
                    <td><?php echo $post->user_id ?></td>
                    <td><?php echo date('d M, Y h:i A', strtotime($post->post_timestamp_created)); ?></td>
                    <td>
                        <div
                            class="<?php echo ($post->approval == "approved") ? 'approved' : (($post->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($post->approval == "approved"):
                                echo "Approved";
                            elseif ($post->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="<?php echo ($post->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                                 if ($post->status == 1):
                                     echo "Active";
                                 else:
                                     echo "Deactivated";
                                 endif;
                                 ?></div>
                    </td>
                    <td class="action">
                        <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->post_id ?>" class="view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?php echo URLROOT ?>/posts/settings/<?php echo $post->post_id ?>" class="update">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <div class="activation-option" data-status="<?php echo $post->status ?>"
                            data-post-id="<?php echo $post->post_id ?>">
                            <!-- <i class="fa-solid fa-toggle-off"></i> -->
                        </div>
                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No posts found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<script>
    function changePostActivation(postId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/changeActivation',
            data: { postId: postId },
            success: function (response) {
                // Update the like count in the DOM
                var activationOption = $('.activation-option[data-post-id="' + postId + '"]');
                if (response == 'deactivated') {
                    activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
                    handlePostFilters();
                } else {
                    activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
                    handlePostFilters();
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.activation-option').click(function () {
        var postId = $(this).data('post-id');
        changePostActivation(postId);
    });

    // Check if the user has liked each post and update the heart icon accordingly


    $('.activation-option').each(function () {
        var postId = $(this).data('post-id');
        var postStatus = $(this).data('status');

        var activationOption = $('.activation-option[data-post-id="' + postId + '"]');
        if (postStatus == 1) {
            activationOption.html('<i class="fa-solid fa-toggle-on"></i>');
        } else {
            activationOption.html('<i class="fa-solid fa-toggle-off"></i>');
        }
    });
</script>