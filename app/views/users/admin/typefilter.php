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
                            <?php
                            if ($user->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                            ?>
                        </td>
                        <td id="action">
                            <?php if ($user->type != 'admin'): ?>
                                <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            <?php endif; ?>
                            <a href="#" class="update" onclick="updateUser('<?php echo $confirm; ?>')"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <?php
                            if ($user->status == 0): ?>
                                <div class="activate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $confirm; ?>')"><i
                                            class="fa-solid fa-bell"></i></a>
                                    <div class="del-popup" id="<?php echo $confirm; ?>">
                                        <div class="del-img"><img src="<?php echo URLROOT ?>/img/users/admin/activate.jpg" alt="">
                                        </div>
                                        <div class="del-content">
                                            <h2>Confirm Activation</h2>
                                            <p>Are you sure you want to active the accout. UserId:
                                                <?php echo $user->id; ?>
                                            </p>
                                            <button class="confirm-btn"
                                                onclick="confirmActivate('<?php echo $confirm; ?>')">Activate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $confirm; ?>')">Cancel</button>
                                        </div>
                                    </div>

                                </div>

                            <?php else: ?>
                                <div class="deactivate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $confirm; ?>')"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                    <div class="del-popup" id="<?php echo $confirm; ?>">
                                        <div class="del-img"><img src="<?php echo URLROOT ?>/img/users/admin/delete.jpg" alt="">
                                        </div>
                                        <div class="del-content">
                                            <h2>Confirm Deactivation</h2>
                                            <p>Are you sure you want to deactivate the accout. UserId:
                                                <?php echo $user->id; ?>
                                            </p>
                                            <button class="confirm-btn"
                                                onclick="confirmDeactivate('<?php echo $confirm; ?>')">Deactivate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $confirm; ?>')">Cancel</button>
                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <td colspan="5" class="no-users-found">No users found.</td>
                
            <?php endif; ?>

        </tbody>
    </table>


<script src="<?php echo URLROOT ?>/js/users/admin/typefilter.js"></script>