<!-- <?php $jsonData = json_encode($data['user']); ?> -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/requests_style.css">
<h1 class="section-title">Requests</h1>

<div class="requests-type">
    <div class="items events" id="events" >
        <div class="req-type"><h3>Events</h3></div>
        <div class="count"><span class="num" data-val="2240">0000</span></div>
    </div>

    <div class="items posts" id="posts" >   
        <div class="req-type"><h3>Posts</h3></div>
        <div class="count"><span class="num" data-val="340">000</span></div>
    </div>

    <div class="items organizations" id="organizations" >
        <div class="req-type"><h3>Organizations</h3></div>
        <div class="count"><span class="num" data-val="250">000</span></div>
    </div>

    <div class="items opportunities" id="opportunities" >  
        <div class="req-type"><h3>Opportunities</h3></div>
        <div class="count"><span class="num" data-val="12">00</span></div>
    </div>
</div>

<div class="user-head">
    <h2>Recent Users</h2>
</div>
<?php var_dump($data['requests']); ?>
<!-- user table -->
<div class="users" id="filter-table">
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
            <?php if (!empty($data['user'][0]->id)): ?>
                <?php foreach ($data['user'] as $user):
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
            <?php endif; ?>

        </tbody>
    </table>
    <div class="paging">
        <span></span>
        <div class="index-buttons"></div>
    </div>
</div>
