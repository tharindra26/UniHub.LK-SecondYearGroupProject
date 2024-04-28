<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/register_style.css">


<div class="container">
    <div class="inner-container">
        <div class="register-form">
            <header>Sign Up</header>
            <form class="form" action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="input-box">
                    <span>
                        <i class="fa-solid fa-envelope"></i>
                        <label>&nbsp;University Email</label>
                    </span>

                    <input type="email" value="<?php echo $data['email'] ?>" name="email"
                        placeholder="Enter university email">
                    <?php if (!empty($data['email_err'])): ?>
                        <span class="error-message"><?php echo $data['email_err']; ?></span>
                    <?php endif; ?>
                </div>


                <div class="column">
                    <div class="input-box">
                        <span>
                            <i class="fa-solid fa-user"></i>
                            <label>&nbsp;First Name</label>
                        </span>

                        <input type="text" value="<?php echo $data['fname']; ?>" name="fname"
                            placeholder="Enter first name">
                        <?php if (!empty($data['fname_err'])): ?>
                            <span class="error-message"><?php echo $data['fname_err']; ?></span>
                        <?php endif; ?>
                    </div>


                    <div class="input-box">
                        <span>
                            <i class="fa-solid fa-user"></i>
                            <label>&nbsp;Last Name</label>
                        </span>
                        <input type="text" value="<?php echo $data['lname'] ?>" name="lname"
                            placeholder="Enter last name">
                        <?php if (!empty($data['lname_err'])): ?>
                            <span class="error-message"><?php echo $data['lname_err']; ?></span>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- dob input -->
                <div class="column">
                    <div class="input-box dob-input-box">
                        <span>
                            <i class="fa-solid fa-calendar"></i>
                            <label class="dob-label">&nbsp;Date of Birth</label>
                        </span>
                        <input type="date" value="<?php echo $data['dob'] ?>" name="dob">
                        <?php if (!empty($data['dob_err'])): ?>
                            <span class="error-message"><?php echo $data['dob_err']; ?></span>
                        <?php endif; ?>
                    </div>



                    <div class="input-box">
                        <span>
                            <i class="fa-solid fa-graduation-cap"></i>
                            <label for="">&nbsp;University</label>
                        </span>
                        <div class="select-box">
                            <select name="university_id" id="selection">
                                <option hidden value="" <?php if (empty($data['university_id']))
                                    echo 'selected'; ?>>Select
                                    University</option>
                                <?php foreach ($data['universities'] as $university): ?>
                                    <option value="<?php echo $university->id ?>" <?php if ($data['university_id'] == $university->id)
                                           echo 'selected'; ?>>
                                        <?php echo $university->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (!empty($data['university_err'])): ?>
                            <span class="error-message"><?php echo $data['university_err']; ?></span>
                        <?php endif; ?>
                    </div>


                </div>

                <div class="column">
                    <div class="input-box">
                        <span>
                            <i class="fa-solid fa-lock"></i>
                            <label>&nbsp;Password</label>
                        </span>
                        <input type="password" value="<?php echo $data['password'] ?>" name="password"
                            placeholder="Enter password">
                        <?php if (!empty($data['password_err'])): ?>
                            <span class="error-message"><?php echo $data['password_err']; ?></span>
                        <?php endif; ?>
                    </div>



                    <div class="input-box">
                        <span>
                            <i class="fa-solid fa-lock"></i>
                            <label>&nbsp;Confirm Password</label>
                        </span>
                        <input type="password" value="<?php echo $data['confirm_password'] ?>" name="confirm_password"
                            placeholder="Enter password again">
                        <?php if (!empty($data['confirm_password_err'])): ?>
                            <span class="error-message"><?php echo $data['confirm_password_err']; ?></span>
                        <?php endif; ?>
                    </div>

                </div>


                <div class="terms">
                    <label><input type="checkbox" name="" id="">&nbsp;&nbsp;I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="submit-btn">Register</button>
                <div class="register-link">
                    <p>Already have an account? <a href="<?php echo URLROOT ?>/users/login">Sign In</a></p>
                </div>

            </form>

        </div>

        <!-- <div class="content">
                
                <div class="description">
                    <p class="description">Revolutionizing University Connectivity and Organizations Showcase.....</p>
                </div>
                
                <div class="organization-btn">
                    <a href="#" class="reg-btn">Register As An Organization</a>
                </div> 
                
                    
            </div> -->
    </div>
</div>


<script src="<?php echo URLROOT ?>/js/register.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>