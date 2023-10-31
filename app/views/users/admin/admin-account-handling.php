<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/users/admin/admin-account-handling_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <div class="border-container">

      <div class="search">
        <form action="#">
          <input type="text"
                class="search-input"
                placeholder=" Search "
                name="search">
        </form>
      </div>

      <div class="quick-shortcut-bar">
        <div class="section-name">Admin Profile</div>
        <div class="shortcut-set">
          <nav class="shortcut-options">
            <ul>
              <li><a  href="<?php echo URLROOT ?>/users/adminaccounthandling">User Accounts</a></li>
              <li><a  href="#">Review Events</a></li>
              <li><a  href="#">Reports Handling</a></li>
            </ul>
          </nav>
          
        </div>
      </div>


      <div class="outer-body-container">
        
        <div class="content-outer-box">
            <div class="left-section">
                <div class="action-box">

                    <a  href="<?php echo URLROOT ?>/users/adminaccounthandling">
                        <div class="add-calender-event">
                            <i class="fa-solid fa-address-card"></i>
                            &nbsp All Users
                        </div>
                    </a>

                    <a  href="<?php echo URLROOT ?>/users/add">
                        <div class="add-calender-event">
                            <i class="fa-solid fa-address-card"></i>
                            &nbsp Create User
                        </div>
                    </a>
                </div>
            </div>

            <div class="middle-section">
                <div class="table-section">
                 <table class="user-table">
                        <tr class="row">
                            <th class="heading">ID</th>
                            <th class="heading">Name</th>
                            <th class="heading">Type</th>
                            <th class="heading">Email</th>
                            <th class="heading">Update</th>
                            <th class="heading">Delete</th>
                        </tr>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr class="row">
                                <td class="data"><?php echo $user->id; ?></td>
                                <td class="data"><?php echo $user->name; ?></td>
                                <td class="data"><?php echo $user->user_type; ?></td>
                                <td class="data"><?php echo $user->email; ?></td>
                                <td class="data">
                                    <a href="<?php echo URLROOT ?>/users/edit/<?php echo $user->id; ?>" class="update">Update</a>
                                </td>
                                <td class="data">
                                    <form  action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id; ?>" method="post">
                                        <input type="submit" value="Delete" class="delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>

            <div class="right-section">
 
            </div>
        </div>
        
      </div>


      <!-- script for card loading -->
      <!-- <script src="<?php echo URLROOT; ?>/js/events/events-main-script.js"></script> -->


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>