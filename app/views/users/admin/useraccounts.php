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
                <a href="#" onclick="typefilter('all');">
                    <div class="view-all-button" >
                        <i class="fa-solid fa-eye"></i>
                        <span>View All Users</span>
                    </div>
                </a>
                <div class="search-bar-container">
                    <form action="" class="search-bar">
                        <input type="text" name="searchInput" placeholder="Search Users" id="search-bar-input">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                
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
                        <?php for ($i = 0; $i < 4; $i++ ) : 
                            $user = $data['user'][$i]; 
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
                                    <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                                    <a href="#" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <div class="deactivate">
                                        <a href="#" class="delete" onclick="openPopup('<?php echo $confirm; ?>')" ><i class="fa-solid fa-trash-can"></i></a>
                                        <div class="del-popup" id="<?php echo $confirm; ?>" >
                                            <h2>Confirm Deletion</h2>
                                            <p>Are you sure you want to deactivate the accout. UserId: <?php echo $user->id; ?></p>
                                            <button  onclick="confirmDeactivate('<?php echo $confirm; ?>')" >Yes</button>
                                            <button onclick="closePopup('<?php echo $confirm; ?>')">Cancel</button>
                                    </div>
                                    
                                    </div>
                                </td>
                            </tr>

                        <?php endfor; ?>
                    <?php endif; ?>
                   
                </tbody>
            </table>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/useraccounts.js"></script>
<script>
//     $(document).ready(function() {
//         // Add click event to the button
//         $("#confirm").on("click", function (e) {
//             // console.log("Click");
//             e.preventDefault(); // Prevent the default link behavior

//             // // Store reference to the button element
//             var confirmBtn = $("#confirm");

//             // // Your AJAX function here
//             $.ajax({
//                 url: 'http://localhost/unihub/users/deactivateUser',
//                 type: 'POST', // or 'GET' depending on your needs
//                 data: {
//                     user_id: <?php echo $user->id ?>,
//                 },
//                 success: function (response) {
//                     // Handle the success response
//                     console.log("AJAX request successful:", response);

//                     // Update the text content on success
//                     // interestedBtn.find('span').text(response);   
//                     if (response === '1') {
//                         confirmBtn.removeClass("open-popup");
//                     } else {
//                         confirmBtn.addClass("new-class");
//                     }


//                 },
//                 error: function (error) {
//                     // Handle the error response
//                     console.error("AJAX request failed:", error);
//                 }
//             });
//         });
//     });
</script>



