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
                             
                            <input type="email" value="<?php echo $data['email'] ?>" name="email" placeholder="Enter university email">  
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
                            
                            <input type="text" value="<?php echo $data['fname']; ?>" name="fname" placeholder="Enter first name">  
                            <?php if (!empty($data['fname_err'])): ?>
                                <span class="error-message"><?php echo $data['fname_err']; ?></span>
                            <?php endif; ?> 
                        </div>
                        

                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-user"></i>
                                <label>&nbsp;Last Name</label>
                            </span> 
                            <input type="text" value="<?php echo $data['lname'] ?>" name="lname" placeholder="Enter last name">  
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
                                <select name="university" id="selection" >
                                    <option hidden <?php if (empty($data['university'])) echo 'selected'; ?>>Select University</option>
                                    <option value="University of Colombo" <?php if ($data['university'] == 'University of Colombo') echo 'selected'; ?>>University of Colombo</option>
                                    <option value="University of Peradeniya" <?php if ($data['university'] == 'University of Peradeniya') echo 'selected'; ?>>University of Peradeniya</option>
                                    <option value="University of Moratuwa" <?php if ($data['university'] == 'University of Moratuwa') echo 'selected'; ?>>University of Moratuwa</option>
                                    <option value="University of Kelaniya" <?php if ($data['university'] == 'University of Kelaniya') echo 'selected'; ?>>University of Kelaniya</option>
                                    <option value="University of Sri Jayewardenepura" <?php if ($data['university'] == 'University of Sri Jayewardenepura') echo 'selected'; ?>>University of Sri Jayewardenepura</option>
                                    <option value="University of Ruhuna" <?php if ($data['university'] == 'University of Ruhuna') echo 'selected'; ?>>University of Ruhuna</option>
                                    <option value="University of Jaffna" <?php if ($data['university'] == 'University of Jaffna') echo 'selected'; ?>>University of Jaffna</option>
                                    <option value="University of Sabaragamuwa" <?php if ($data['university'] == 'University of Sabaragamuwa') echo 'selected'; ?>>University of Sabaragamuwa</option>
                                    <option value="Eastern University, Sri Lanka" <?php if ($data['university'] == 'Eastern University, Sri Lanka') echo 'selected'; ?>>Eastern University, Sri Lanka</option>
                                    <option value="South Eastern University of Sri Lanka" <?php if ($data['university'] == 'South Eastern University of Sri Lanka') echo 'selected'; ?>>South Eastern University of Sri Lanka</option>
                                    <option value="Rajarata University of Sri Lanka" <?php if ($data['university'] == 'Rajarata University of Sri Lanka') echo 'selected'; ?>>Rajarata University of Sri Lanka</option>
                                    <option value="Wayamba University of Sri Lanka" <?php if ($data['university'] == 'Wayamba University of Sri Lanka') echo 'selected'; ?>>Wayamba University of Sri Lanka</option>
                                    <option value="Uva Wellassa University" <?php if ($data['university'] == 'Uva Wellassa University') echo 'selected'; ?>>Uva Wellassa University</option>
                                    <option value="University of the Visual and Performing Arts" <?php if ($data['university'] == 'University of the Visual and Performing Arts') echo 'selected'; ?>>University of the Visual and Performing Arts</option>
                                    <option value="Sabaragamuwa University of Sri Lanka" <?php if ($data['university'] == 'Sabaragamuwa University of Sri Lanka') echo 'selected'; ?>>Sabaragamuwa University of Sri Lanka</option>
                                    <option value="Open University of Sri Lanka" <?php if ($data['university'] == 'Open University of Sri Lanka') echo 'selected'; ?>>Open University of Sri Lanka</option>
                                    <option value="General Sir John Kotelawala Defence University" <?php if ($data['university'] == 'General Sir John Kotelawala Defence University') echo 'selected'; ?>>General Sir John Kotelawala Defence University</option>
                                    <option value="Sri Lanka Institute of Information Technology (SLIIT)" <?php if ($data['university'] == 'Sri Lanka Institute of Information Technology (SLIIT)') echo 'selected'; ?>>Sri Lanka Institute of Information Technology (SLIIT)</option>
                                    <option value="Informatics Institute of Technology (IIT)" <?php if ($data['university'] == 'Informatics Institute of Technology (IIT)') echo 'selected'; ?>>Informatics Institute of Technology (IIT)</option>
                                    <option value="General Sir John Kotelawala Defence University - Southern Campus" <?php if ($data['university'] == 'General Sir John Kotelawala Defence University - Southern Campus') echo 'selected'; ?>>General Sir John Kotelawala Defence University - Southern Campus</option>
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
                            <input type="password" value="<?php echo $data['password'] ?>" name="password" placeholder="Enter password">
                            <?php if (!empty($data['password_err'])): ?>
                                <span class="error-message"><?php echo $data['password_err']; ?></span>
                            <?php endif; ?>
                        </div>    
                        
                        

                        <div class="input-box">
                            <span>
                                <i class="fa-solid fa-lock"></i>
                                <label>&nbsp;Confirm Password</label>
                            </span>
                            <input type="password" value="<?php echo $data['confirm_password'] ?>" name="confirm_password" placeholder="Enter password again">
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