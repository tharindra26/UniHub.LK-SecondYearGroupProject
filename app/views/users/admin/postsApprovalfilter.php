<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/postApprovalFilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Post Title</th>
            <th>User Id</th>
            <th>Link</th>
            <th>Approval</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['posts'][0]->post_id)): ?>
            <?php foreach ($data['posts'] as $post):
                if (empty($post)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $postId = $post->post_id; ?>
                <tr>
                    <td><?php echo $post->post_id ?></td>
                    <td><?php echo $post->post_title ?></td>
                    <td><?php echo $post->user_id ?></td>
                    <td >
                        <?php echo $post->material_link ?>
                    </td>
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
                    <td class="action">
                        <div class="post-approval-action" data-post-approval="<?php echo $post->approval ?>"
                            data-post-id="<?php echo $post->post_id ?>">
                            <select name="post-approval" id="post-approval-filter-value" placeholder="Approval"
                                class="dropdown-menu">
                                <option value="approved" <?php if ($post->approval == 'approved')
                                    echo 'selected'; ?>>Approved
                                </option>
                                <option value="pending" <?php if ($post->approval == 'pending')
                                    echo 'selected'; ?>>Pending
                                </option>
                                <option value="rejected" <?php if ($post->approval == 'rejected')
                                    echo 'selected'; ?>>Rejected
                                </option>
                            </select>

                        </div>

                    </td>
                    <td>
                        <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->post_id ?>" class="view-btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>

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
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    
    // Check if the user has liked each post and update the heart icon accordingly


    $('table.user-table tbody tr').on('change', '.post-approval-action select[name="post-approval"]', function () {
        // Get the selected value
        var selectedPostApproval = $(this).val();
        // Get the event ID
        var postId = $(this).closest('tr').find('.post-approval-action').data('post-id');
        // Call a function to handle the selected value
        handleSelectedPostApproval(postId, selectedPostApproval);
    });


    function handleSelectedPostApproval(postId, selectedPostApproval) {
        console.log(postId,selectedPostApproval);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/changeApproval',
            data: {
                postId: postId,
                selectedPostApproval: selectedPostApproval
            },
            success: function (response) {
                // Update the like count in the DOM
                console.log(response);
                $('#post-filter-value').val('pending');
                // Manually trigger the change event to apply the selection
                $('#post-filter-value').change();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

</script>