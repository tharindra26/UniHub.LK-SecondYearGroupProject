<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>

<div class="table" id="filter-section">
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
                <?php foreach ($data['users'] as $user): ?>
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
                            <?php
                            if ($user->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                            ?>
                        </td>
                        <td>
                            <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="delete"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <td colspan="5" class="no-users-found">No users found.</td>
                
            <?php endif; ?>

        </tbody>
    </table>
</div>

<script src="<?php echo URLROOT ?>/js/users/admin/typefilter.js"></script>