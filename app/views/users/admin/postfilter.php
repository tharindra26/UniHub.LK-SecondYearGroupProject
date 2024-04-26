<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Post Title</th>
            <th>User ID</th>
            <th>Category</th>
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
                    <td><?php echo $post->user_id?></td>
                    <td><?php echo $post->category_names ?></td>
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
                        <a href="<?php echo URLROOT ?>/posts/settings/<?php echo $post->id ?>" class="update">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <div class="activation-option" data-status="<?php echo $post->status ?>"
                            data-event-id="<?php echo $post->post_id ?>">
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
    
</script>