<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
        $this->organizationalModel = $this->model('Organization');
    }


    /////////////////////////////////////////////////////////////////////////////////////////////
    Public function register(){
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data =[
                'email' =>trim($_POST['email']),
                'fname' =>trim($_POST['fname']),
                'lname' =>trim($_POST['lname']),
                'dob' =>trim($_POST['dob']),
                'university' =>trim($_POST['university']),
                'password' =>trim($_POST['password']),
                'confirm_password' =>trim($_POST['confirm_password']),
                'email_err' =>'',
                'fname_err' =>'',
                'lname_err' =>'',
                'dob_err' =>'',
                'university_err' =>'',
                'password_err' =>'',
                'confirm_password_err' =>'',
                'verification_code' => sha1($_POST['email'] .time()),
            ];

          

            // Validate Email
         if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }else{
            //check email is already exists
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email is already taken';
            }
          }
  
          // Validate Name
          if(empty($data['fname'])){
            $data['fname_err'] = 'Pleae enter first name';
          }

          // Validate Name
          if(empty($data['lname'])){
            $data['lname_err'] = 'Pleae enter last name';
          }

          // Validate Name
          if(empty($data['dob'])){
            $data['dob_err'] = 'Pleae enter date of birth';
          }

          // Validate Name
          if(empty($data['university'])){
            $data['university_err'] = 'Pleae select University';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Pleae enter password';
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
          }
  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Pleae confirm password';
          } else {
            if($data['password'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }
  
          // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['dob_err']) && empty($data['university_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            // Validated
           
            //Hash Password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if($this->userModel->register($data)){

                //mail sending code
                $verification_URL = 'http://localhost/unihub/users/emailVerification/' . $data['verification_code'];

                  $to             = $data['email'];
                  $sender         = 'developer.unihub@gmail.com';
                  $mail_subject   = 'Verify Email Address';
                  
                  // Initialize $email_body properly and append to it
                  $email_body = '<p>Dear ' . $data['fname'] . ' ' . $data['lname'] . '</p>';
                  $email_body .= '<p>Thank you for signing up. There is one more step. Click below link to verify your email address in order to activate your account.</p>';
                  $email_body .= '<p>' . $verification_URL . '</p>';
                  $email_body .= '<p>Thank You, <br>UniHub.lk </p>';
                  
                  $header = "From: {$sender}\r\n";
                  $header .= "Content-Type: text/html;";
                  
                  $send_mail_result = mail($to, $mail_subject, $email_body, $header);
                  
                  
                  if ($send_mail_result) {
                      echo 'Please check your email';
                  } else {
                      echo 'Error.';
                  }
                  

                // flash('register_success', 'You are registered and can log in');
                redirect('users/login'); //redirect back to login page if register is successful
            }else{
                die("Something went wrong");
            }
          } else {
            // Load view with errors
            $this->view('register', $data);
          }
  
        } else {
          // Init data
          $data =[
            'email' =>'',
            'fname' =>'',
            'lname' =>'',
            'dob' =>'',
            'university' =>'',
            'password' =>'',
            'confirm_password' =>'',
            'email_err' =>'',
            'fname_err' =>'',
            'lname_err' =>'',
            'dob_err' =>'',
            'university_err' =>'',
            'password_err' =>'',
            'confirm_password_err' =>'',
            'verification_code' =>'',
          ];
  
          // Load view
          $this->view('register', $data);
        }
      }

    
      public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }
  
          // Check for user/email
          if (!$this->userModel->findUserByEmail($data['email'])) {
            // User not found
              $data['email_err'] = 'No user found';
          } else {
              // User found, check status
              $status = $this->userModel->getUserStatusByEmail($data['email']);

              if ($status == 0) {
                  $data['email_err'] = 'Account is not activated.';
                  $this->view('signin', $data);
                  return; // Add this return statement to stop further execution
              }
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            // Check and set logged in user
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            $status = $this->userModel->getUserStatusByEmail($data['email']);
            
  
            if($loggedInUser){
              // Create Session
              $this->createUserSession($loggedInUser);
            } else {
              $data['password_err'] = 'Password incorrect';
              $this->view('signin', $data);
            }
          } else {
            // Load view with errors
            $this->view('signin', $data);
          }
  
  
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',        
          ];
  
          // Load view
          $this->view('signin', $data);
        }

      }

      public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->fname;
        $_SESSION['user_type'] = $user->type;
        $_SESSION['user_profile_image'] = $user->profile_image;
        redirect('pages');
      }

      public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);
        unset($_SESSION['user_profile_image']);
        session_destroy();
        redirect('users/login');
      }

      // public function show($id){
      //   $user = $this->userModel->getUserById($id);
      //   $data =[
      //     'user' =>$user,
      //   ];

      //   if($user->user_type=='admin'){
      //     $this->view('users/users-show-admin', $data);
      //   }else if($user->user_type=='org'){
      //     $organization = $this->organizationalModel->getOrganizationByUserId($user->id);
      //     $user = $this->userModel->getUserById($organization->user_id);
      //     $data =[
      //       'organization' =>$organization,
      //       'user' =>$user,
      //     ];
      //     $this->view('organizations/organizations-show', $data);
      //   }else{
      //     $this->view('users/users-show-und', $data);
      //   }
        
      // }
      public function show(){
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $data =[
          'user' =>$user,
        ];

        if($user->type=='Undergraduate'){
          $this->view('users/undergraduate/profile', $data);
        }else if($user->type=='admin'){
          $this->view('users/admin/profile', $data);
        }else{

        }


      }

      public function adminaccounthandling(){
        $admin = $this->userModel->getUserById($_SESSION['user_id']);
        $users = $this->userModel->getUsers();
        $data =[
          'admin' =>$admin,
          'users' =>$users,
        ];

        if($admin->user_type=='admin'){
          $this->view('users/admin/admin-account-handling', $data);
        }
        
      }

      Public function add(){
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data =[
                'name' =>trim($_POST['name']),
                'user_type' =>trim($_POST['user_type']),
                'email' =>trim($_POST['email']),
                'password' =>trim($_POST['password']),
                'confirm_password' =>trim($_POST['confirm_password']),
                'name_err' =>'',
                'user_type_err' =>'',
                'email_err' =>'',
                'password_err' =>'',
                'confirm_password_err' =>'',
            ];

          

            // Validate Email
         if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }else{
            //check email is already exists
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email is already taken';
            }
          }
  
          // Validate Name
          if(empty($data['name'])){
            $data['name_err'] = 'Pleae enter name';
          }

          // Validate Name
          if(empty($data['user_type'])){
            $data['user_type_err'] = 'Pleae enter type';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Pleae enter password';
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
          }
  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Pleae confirm password';
          } else {
            if($data['password'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }
  
          // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['user_type_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
            // Validated
           
            //Hash Password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register User
            if($this->userModel->addUser($data)){
                flash('register_success', 'Account has been added successfully');
                redirect('users/adminaccounthandling'); //redirect back to login page if register is successful
            }else{
                die("Something went wrong");
            }
          } else {
            // Load view with errors
            $this->view('users/admin/add-user', $data);
          }
  
        } else {
          // Init data
          $data =[
            'name' => '',
            'user_type' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'user_type_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
  
          // Load view
          $this->view('users/admin/add-user', $data);
        }
      }


      public function edit($id){

        //check the user is a registered user
        if(!isLoggedIn()){
            redirect('/users/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data =[
                'id' => $id,
                'name' =>trim($_POST['name']),
                'user_type' =>trim($_POST['user_type']),
                'email' =>trim($_POST['email']),
                'password' =>trim($_POST['password']),
                'confirm_password' =>trim($_POST['confirm_password']),
                'name_err' =>'',
                'user_type_err' =>'',
                'email_err' =>'',
                'password_err' =>'',
                'confirm_password_err' =>'',
            ];

          

            // Validate Email
         if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }else{
            //check email is already exists
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email is already taken';
            }
          }
  
          // Validate Name
          if(empty($data['name'])){
            $data['name_err'] = 'Pleae enter name';
          }

          // Validate Name
          if(empty($data['user_type'])){
            $data['user_type_err'] = 'Pleae enter type';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Pleae enter password';
          } elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
          }
  
          // Validate Confirm Password
          if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Pleae confirm password';
          } else {
            if($data['password'] != $data['confirm_password']){
              $data['confirm_password_err'] = 'Passwords do not match';
            }
          }
          
  
            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['user_type_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
              // Validated
             
              //Hash Password
              $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
  
              //Register User
              if($this->userModel->updateUser($data)){
                  flash('register_success', 'Account has been updated successfully');
                  redirect('users/adminaccounthandling'); //redirect back to login page if register is successful
              }else{
                  die("Something went wrong");
              }
            } else {
              // Load view with errors
              $this->view('users/admin/edit-user', $data);
            }
            
  
        } else {
          //get existing post from model
          $user= $this->userModel->getUserById($id);

          // //check for owner
          // if($event->user_id != $_SESSION['user_id']){
          //   redirect('events');
          // }
          // Init data
          $data =[
            'id' => $id,
            'name' => $user->name,
            'user_type' => $user->user_type,
            'email' => $user->email,
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'user_type_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
          ];
  
          // Load view
          $this->view('users/admin/edit-user', $data);
        }
        
    }


    
    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Get existing post from model
        $user = $this->userModel->getUserById($id);
        
        // // Check for owner
        // if($event->user_id != $_SESSION['user_id']){
        //   redirect('events');
        // }

        if($this->userModel->deleteUser($id)){
          flash('event_message', 'User Removed');
          redirect('users/adminaccounthandling');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('users/adminaccounthandling');
      }
    }

    public function emailVerification($code){
      if(isset($code)){
        $result = $this->userModel->getUserByVerificationCode($code);

        if($result['rowCount']==1){ //check number of raws using mysqli_num_rows
          if($this->userModel->activateUser($code)){
            echo 'Email address verified successfully';
          }else{
            echo 'Invalid verification code';
          }
        }else{
          echo 'Invalid verification code';
        }
      }
    }

      
  

}