<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo SITENAME; ?> </title>
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/register_style.css">
</head>
<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <div class="border-container">
        <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <!-- <div class="imgcontainer">
                    <img src="img_avatar2.png" alt="Avatar" class="avatar">
                </div> -->

                <div class="container">
                    <label for="name"><b>Name</b></label>
                    <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>" >
                    <?php if (!empty($data['name_err'])): ?>
                        <span class="error-message"><?php echo $data['name_err']; ?></span>
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

                    <button type="submit">Register</button>
                    <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <span class="psw">Have an account? <a href="<?php echo URLROOT; ?>/users/login">Login</a></span>
                </div>
            </form>


<!-- <h1><?php echo $data['title']; ?></h1> -->
<?php require APPROOT .'/views/inc/footer.php'; ?>