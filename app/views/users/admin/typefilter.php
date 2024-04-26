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
                    <td>
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
                        <a href="#" class="update" onclick="updateUser('<?php echo $confirm; ?>')"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                    </td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <td colspan="5" class="no-users-found">No users found.</td>

        <?php endif; ?>

    </tbody>
</table>


<script src="<?php echo URLROOT ?>/js/users/admin/typefilter.js"></script>