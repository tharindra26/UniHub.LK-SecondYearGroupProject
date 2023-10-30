<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/users/admin/edit-user_style.css">
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
          <button class="search-button">
              <i class="fa fa-search"
                style="font-size: 18px;">
              </i>
          </button>
        </form>
      </div>

      <div class="quick-shortcut-bar">
        <div class="section-name">Admin Profile</div>
        <div class="shortcut-set">
          <nav class="shortcut-options">
            <ul>
              <li><a  href="<?php echo URLROOT ?>/users/adminaccounthandling">User Accounts</a></li>
              <li><a  href="#">Review Events</a></li>
              <li><a  href="#">Reports</a></li>
            </ul>
          </nav>
          
        </div>
      </div>


      <div class="outer-body-container">
        
        <div class="content-outer-box">
            <div class="left-section">
                <div class="action-box">

                    <a  href="<?php echo URLROOT ?>/users/adminaccounthandling">
                        <div class="all-users">
                            <i class="fa-solid fa-address-card"></i>
                            &nbsp All Users
                        </div>
                    </a>

                    <a  href="<?php echo URLROOT ?>/users/add">
                        <div class="create-user">
                            <i class="fa-solid fa-address-card"></i>
                            &nbsp Create User
                        </div>
                    </a>
                </div>
            </div>

            <div class="middle-section">
                <div class="add-user-section">
                <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id'] ?>" method="post" >
                      <div class="container">
                          <label for="name"><b>Name</b></label>
                          <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>" >
                          <?php if (!empty($data['name_err'])): ?>
                              <span class="error-message"><?php echo $data['name_err']; ?></span>
                          <?php endif; ?>

                          <label for="user_type"><b>Account Type</b></label>
                          <input type="text" placeholder="Enter User Type" name="user_type" value="<?php echo $data['user_type'] ?>" >
                          <?php if (!empty($data['user_type_err'])): ?>
                              <span class="error-message"><?php echo $data['user_type_err']; ?></span>
                          <?php endif; ?>

                          <label for="email"><b>Email</b></label>
                          <input type="email" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>" >
                          <?php if (!empty($data['name_err'])): ?>
                              <span class="error-message"><?php echo $data['email_err']; ?></span>
                          <?php endif; ?>

                          <label for="password"><b>Password</b></label>
                          <input type="password" placeholder="Enter Password" name="password" value="<?php echo $data['password'] ?>" >
                          <?php if (!empty($data['password_err'])): ?>
                              <span class="error-message"><?php echo $data['password_err']; ?></span>
                          <?php endif; ?>

                          <label for="confirm_password"><b>Confirm Password</b></label>
                          <input type="password" placeholder="Confirm Password" name="confirm_password" value="<?php echo $data['confirm_password'] ?>" >
                          <?php if (!empty($data['confirm_password_err'])): ?>
                              <span class="error-message"><?php echo $data['confirm_password_err']; ?></span>
                          <?php endif; ?>

                          <button class="register-button" type="submit">Update User</button>
                      </div>

                  </form>
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