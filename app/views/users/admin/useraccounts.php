<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<h1 class="section-title">User Accounts</h1>

        <div class="sub-menu">
            <div class="items" id="und" onclick="typefilter('Undergraduate');" >
                <div class="icons" ><i class="fa-solid fa-user-graduate"></i></div>
                <span class="num" data-val="2240">0000</span>
                <h3>Undergraduates</h3>
            </div>

            <div class="items" id="uni-rep"  onclick="typefilter('uni-rep');" >
                <div class="icons" ><i class="fa-solid fa-users-gear"></i></div>
                <span class="num" data-val="340">000</span>
                <h3>Uni Representors</h3>
            </div>

            <div class="items" id="org-rep" onclick="typefilter('org-rep');" >
                <div class="icons" ><i class="fa-solid fa-users"></i></div>
                <span class="num" data-val="250">000</span>
                <h3>Org Representors</h3>
            </div>

            <div class="items" id="admin" onclick="typefilter('admin');" >
                <div class="icons" ><i class="fa-solid fa-user-gear"></i></div>
                <span class="num" data-val="12">00</span>
                <h3>Administrators</h3>
            </div>
        </div>

        <div class="user-info">
            
            <div class="user-head">
                <div class="search-bar-container">
                    <form action="" class="search-bar">
                        <input type="text" name="searchInput" placeholder="Search Users" id="search-bar-input">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <a href="#" onclick="typefilter('all');">
                    <div class="view-all-button" >
                        <i class="fa-solid fa-eye"></i>
                        <span>View All Users</span>
                    </div>
                </a>
                
                <a href="#">
                    <div class="view-all-button">
                    <i class="fa-solid fa-plus"></i>
                        <span>Add New Users</span>
                    </div>
                </a>
            </div>

            <div class="user-head">
                <h2>Recent Users</h2>
            </div>

            
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
                <?php if (!empty($data['user'][0]->id)) : ?> 
                        <?php foreach($data['user'] as $user) :  
                            if (empty($user)):
                                break;
                            endif;
                            // $popupId = "popup" . $user->id; 
                            $confirm = $user->id; ?>
                        
                            <tr>
                                <td><?php echo $user->fname , " " , $user->lname ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->type ?></td>
                                <td><?php
                                    if ($user->status == 1):
                                        echo "Active";
                                    else:
                                        echo "Deactivated";
                                    endif;
                                ?>
                                </td>
                                <td id="action">
                                <?php if ($user->type != 'admin'):?>
                                    <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                                <?php endif; ?>
                                    <a href="#" class="update" onclick="updateUser('<?php echo $confirm; ?>')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <?php
                                    if ($user->status == 0):?>
                                    <div class="activate">
                                        <a href="#" class="delete" onclick="openPopup('<?php echo $confirm; ?>')" ><i class="fa-solid fa-bell"></i></a>
                                        <div class="del-popup" id="<?php echo $confirm; ?>" >
                                            <div class="del-img"><img src="<?php echo URLROOT ?>/img/users/admin/activate.jpg" alt=""></div>
                                            <div class="del-content">
                                                <h2>Confirm Activation</h2>
                                                <p>Are you sure you want to active the accout. UserId: <?php echo $user->id; ?></p>
                                                <button class="confirm-btn" onclick="confirmActivate('<?php echo $confirm; ?>')" >Activate</button>
                                                <button class="confirm-btn" onclick="closePopup('<?php echo $confirm; ?>')">Cancel</button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                        
                                    <?php else: ?> 
                                    <div class="deactivate">
                                        <a href="#" class="delete" onclick="openPopup('<?php echo $confirm; ?>')" ><i class="fa-solid fa-trash-can"></i></a>
                                        <div class="del-popup" id="<?php echo $confirm; ?>" >
                                            <div class="del-img"><img src="<?php echo URLROOT ?>/img/users/admin/delete.jpg" alt=""></div>
                                            <div class="del-content">
                                                <h2>Confirm Deactivation</h2>
                                                <p>Are you sure you want to deactivate the accout. UserId: <?php echo $user->id; ?></p>
                                                <button class="confirm-btn" onclick="confirmDeactivate('<?php echo $confirm; ?>')" >Deactivate</button>
                                                <button class="confirm-btn" onclick="closePopup('<?php echo $confirm; ?>')">Cancel</button>
                                        </div>
                                    
                                    </div>
                                    <?php endif; ?>    
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>
                   
                </tbody>
            </table>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/useraccounts.js"></script>
<script>


</script>



