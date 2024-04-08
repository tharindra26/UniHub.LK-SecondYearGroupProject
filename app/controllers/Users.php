<?php

require_once '../vendor/autoload.php';
class Users extends Controller
{
  public $userModel = null;
  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->organizationalModel = $this->model('Organization');
    $this->universityModel = $this->model('University');
    $this->eventModel = $this->model('Event');
  }


  /////////////////////////////////////////////////////////////////////////////////////////////
  public function register()
  {
    //Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'email' => trim($_POST['email']),
        'fname' => trim($_POST['fname']),
        'lname' => trim($_POST['lname']),
        'dob' => trim($_POST['dob']),
        'university' => trim($_POST['university']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'email_err' => '',
        'fname_err' => '',
        'lname_err' => '',
        'dob_err' => '',
        'university_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
        'verification_code' => sha1($_POST['email'] . time()),
      ];



      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      } else {
        //check email is already exists
        if ($this->userModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Please is already taken';
        }
      }

      // Validate Name
      if (empty($data['fname'])) {
        $data['fname_err'] = 'Please enter first name';
      }

      // Validate Name
      if (empty($data['lname'])) {
        $data['lname_err'] = 'Please enter last name';
      }

      // Validate Name
      if (empty($data['dob'])) {
        $data['dob_err'] = 'Please enter date of birth';
      }

      // Validate Name
      if (empty($data['university'])) {
        $data['university_err'] = 'Please select University';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please confirm password';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Passwords do not match';
        }
      }

      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['dob_err']) && empty($data['university_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // Validated

        //Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Universe id
        $data['university_id'] = $this->universityModel->getUniIdByName($data['university']);


        //Register User
        if ($this->userModel->register($data)) {

          //mail sending code
          $verification_URL = 'http://localhost/unihub/users/emailVerification/' . $data['verification_code'];

          $to = $data['email'];
          $sender = 'developer.unihub@gmail.com';
          $mail_subject = 'Verify Email Address';

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

          $user = $this->userModel->getUserByEmail($data['email']); // Get user ID
          $user_id = $user->id; // Get user ID
          $last_authentication_date = date('Y-m-d H:i:s'); // Current date and time

          // Add record to user_authentication table
          if ($this->userModel->addUserAuthenticationRecord($user_id, $last_authentication_date)) {
            // Mail sending code...
            // Redirect or display appropriate message
            redirect('users/login');
          } else {
            die("Something went wrong adding user authentication record");
          }


          // flash('register_success', 'You are registered and can log in');
          redirect('users/login'); //redirect back to login page if register is successful
        } else {
          die("Something went wrong");
        }
      } else {
        // Load view with errors
        $this->view('register', $data);
      }

    } else {
      // Init data
      $data = [
        'email' => '',
        'fname' => '',
        'lname' => '',
        'dob' => '',
        'university' => '',
        'password' => '',
        'confirm_password' => '',
        'email_err' => '',
        'fname_err' => '',
        'lname_err' => '',
        'dob_err' => '',
        'university_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
        'verification_code' => '',
      ];

      // Load view
      $this->view('register', $data);
    }
  }

  public function googleLogin()
  {


    //Google Authentication credentials
    $clientID = '472800178666-2lruamt57kjllkgvqr7t2amcmm644289.apps.googleusercontent.com'; // your client id
    $clientSecret = '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'; // your client secret
    $redirectUri = 'http://localhost/unihub/users/googleLogin';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");



    if (isset($_GET['code'])) {
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      // $client->setAccessToken($token['access_token']);

      // get profile info
      $google_oauth = new Google_Service_Oauth2($client);
      $google_account_info = $google_oauth->userinfo->get();
      $email = $google_account_info->email;
      $name = $google_account_info->name;


      if ($this->userModel->findUserByEmail($email)) {
        $user = $this->userModel->getUserByEmail($email);
        $currentDate = new DateTime();
        $currentDateString = $currentDate->format('Y-m-d H:i:s');
        $this->userModel->updateLastAuthenticationDate($user->id, $currentDateString);
        $this->userModel->setGoogleAuthRequired($user->id, false);
        $this->userModel->updateSuccessfullyAuthenticated($user->id, true);
        $data = [
          'email' => $email,
          'password' => '',
          'password_err' => 'Google authentication succeeded. Please provide your password to continue.',
        ];
        $this->view('signin', $data);
      } else {
        echo "Google authentication failed. Please try again.";
      }
    } else {

      //redirect to google
      $authUrl = $client->createAuthUrl();
      header('Location: ' . $authUrl);
    }



  }


  public function login()
  {


    // $data = [];
    // $this->view('google-auth', $data);
    // die();
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Init data
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
      }

      // Validate Password
      if (empty($data['password'])) {
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
          $_SESSION['login_status'] = 'invalid';
          $this->view('signin', $data);
          return; // Add this return statement to stop further execution
        }
      }

      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['password_err'])) {
        // Validated
        // Check and set logged in user
        $user = $this->userModel->getUserByEmail($data['email']);


        // $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        // $status = $this->userModel->getUserStatusByEmail($data['email']);

        if ($user->type == 'undergraduate') {
          $lastAuthDate = new DateTime($user->last_authentication_date);
          $currentDate = new DateTime();
          $interval = $currentDate->diff($lastAuthDate);

          // Check if it's been more than 7 days since the last authentication
          if ($interval->days >= 7) {
            // Set google_auth_required flag to true
            $this->userModel->setGoogleAuthRequired($user->id, true);
            $data = [
              'user_id' => $user->id,
            ];
            $this->view('google-auth', $data);
            die();
          }
        }

        $loggedInUser = $this->userModel->login($data['email'], $data['password']);


        if ($loggedInUser) {
          // Create Session
          if ($loggedInUser->type == 'undergraduate') {
            if ($loggedInUser->google_auth_required == false && $loggedInUser->successfully_authenticated == true) {
              $this->createUserSession($loggedInUser);
              $this->userModel->addLoginRecord($_SESSION['user_id']);
            }
          }else{
            $this->createUserSession($loggedInUser);
            $this->userModel->addLoginRecord($_SESSION['user_id']);
          }
          

        } else {
          $data['password_err'] = 'Password incorrect';
          $_SESSION['login_status'] = 'invalid';
          $this->view('signin', $data);
        }
      } else {
        // Load view with errors
        $_SESSION['login_status'] = 'invalid';
        $this->view('signin', $data);
      }


    } else {
      // Init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Load view
      $this->view('signin', $data);
    }

  }

  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->fname;
    $_SESSION['user_type'] = $user->type;
    $_SESSION['user_profile_image'] = $user->profile_image;
    redirect('pages');
  }

  public function logout()
  {
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
  public function show($id)
  {
    $user = $this->userModel->getUserById($id);
    $university = $this->universityModel->getUniversityById($user->university_id);
    $event = $this->eventModel->getEventByUser($id);
    $interestEvents = $this->eventModel->getInterestEventsByUser($id);
    $education = $this->userModel->getEducationByUserId($id);
    $qualifications = $this->userModel->getQualificationByUserId($id);
    $skills = $this->userModel->getSkillsByUserId($id);
    $requests = $this->userModel->getFriendRequestsById($id);
    // $friends = $this->userModel->getFriendsByUserId($user->id);

    $data = [
      'user' => $user,
      'university' => $university,
      'event' => $event,
      'interestEvents' => $interestEvents,
      'education' => $education,
      'qualifications' => $qualifications,
      'skills' => $skills,
      'requests' => $requests
      // 'friends' => $friends
    ];

    if ($user->type == 'admin') {
      $this->view('users/admin/adminprofile', $data);
    } else if ($user->type == 'unirep') {
      $this->view('users/unirep/profile', $data);
    } else if ($user->type == 'orgrep') {
      $this->view('users/orgrep/profile', $data);
    } else {
      $this->view('users/undergraduate/myprofile', $data);
    }
  }

  public function showFriends($user_id)
  {
    $friends = $this->userModel->getFriendsByUserId($user_id);

    $data = [
      'friends' => $friends
    ];

    $this->view('users/undergraduate/myFriends', $data);
  }

  public function unFollow()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $follower_relationship_id = $_POST['follower_relationship_id'];
      $data = [
        'follower_relationship_id' => $follower_relationship_id
      ];
      if ($this->userModel->UnfollowFriend($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function acceptRequest()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $follower_relationship_id = $_POST['follower_relationship_id'];
      $data = [
        'follower_relationship_id' => $follower_relationship_id
      ];
      if ($this->userModel->acceptRequestById($data)) {
        echo 1;
      } else {
        echo 0;
      }
    }
  }

  public function rejectRequest()
  {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $follower_relationship_id = $_POST['follower_relationship_id'];
    $data = [
      'follower_relationship_id' => $follower_relationship_id
    ];
    if ($this->userModel->UnfollowFriend($data)) {
      echo 1;
    } else {
      echo 0;
    }
  }

  public function checkFriendStatus()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user_id = $_POST['user_id'];
      $loggedin_id = $_POST['loggedin_id'];
      $data = [
        'user_id' => $user_id,
        'loggedin_id' => $loggedin_id
      ];

      $result = $this->userModel->checkFriendStatus($data);
      if ($result) {
        if ($result->status == "accepted") {
          echo "Friends";
        } else if ($result->status == "pending") {
          if ($result->following_id == $loggedin_id) {
            echo "Accept";
          } else if ($result->follower_id == $loggedin_id) {
            echo "Requested";
          }
        }
      } else {
        echo "Follow";
      }
    }
  }

  public function showAllInterestedEvents($id)
  {
    $interestEvents = $this->userModel->getAllInterestedEventsByUserId($id);
    $data = [
      'events' => $interestEvents
    ];

    $this->view('users/undergraduate/showInterestedEvents', $data);
  }

  public function removeInterestedEvent()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $participation_id = $_POST['participation_id'];
      $data = [
        'participation_id' => $participation_id
      ];
      if ($this->userModel->RemoveInterestedEvent($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }


  public function adminaccounthandling()
  {
    $admin = $this->userModel->getUserById($_SESSION['user_id']);
    $users = $this->userModel->getUsers();
    $data = [
      'admin' => $admin,
      'users' => $users,
    ];

    if ($admin->user_type == 'admin') {
      $this->view('users/admin/admin-account-handling', $data);
    }

  }

  public function add()
  {
    //Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'name' => trim($_POST['name']),
        'user_type' => trim($_POST['user_type']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'user_type_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
      ];



      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
      } else {
        //check email is already exists
        if ($this->userModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate Name
      if (empty($data['name'])) {
        $data['name_err'] = 'Pleae enter name';
      }

      // Validate Name
      if (empty($data['user_type'])) {
        $data['user_type_err'] = 'Pleae enter type';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Pleae enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Pleae confirm password';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Passwords do not match';
        }
      }

      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['name_err']) && empty($data['user_type_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // Validated

        //Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Register User
        if ($this->userModel->addUser($data)) {
          flash('register_success', 'Account has been added successfully');
          redirect('users/adminaccounthandling'); //redirect back to login page if register is successful
        } else {
          die("Something went wrong");
        }
      } else {
        // Load view with errors
        $this->view('users/admin/add-user', $data);
      }

    } else {
      // Init data
      $data = [
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


  public function edit($id)
  {

    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('/users/login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'id' => $id,
        'name' => trim($_POST['name']),
        'user_type' => trim($_POST['user_type']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'user_type_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
      ];



      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
      } else {
        //check email is already exists
        if ($this->userModel->findUserByEmail($data['email'])) {
          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate Name
      if (empty($data['name'])) {
        $data['name_err'] = 'Pleae enter name';
      }

      // Validate Name
      if (empty($data['user_type'])) {
        $data['user_type_err'] = 'Pleae enter type';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Pleae enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Pleae confirm password';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Passwords do not match';
        }
      }


      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['name_err']) && empty($data['user_type_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // Validated

        //Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Register User
        if ($this->userModel->updateUser($data)) {
          flash('register_success', 'Account has been updated successfully');
          redirect('users/adminaccounthandling'); //redirect back to login page if register is successful
        } else {
          die("Something went wrong");
        }
      } else {
        // Load view with errors
        $this->view('users/admin/edit-user', $data);
      }


    } else {
      //get existing post from model
      $user = $this->userModel->getUserById($id);

      // //check for owner
      // if($event->user_id != $_SESSION['user_id']){
      //   redirect('events');
      // }
      // Init data
      $data = [
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



  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Get existing post from model
      $user = $this->userModel->getUserById($id);

      // // Check for owner
      // if($event->user_id != $_SESSION['user_id']){
      //   redirect('events');
      // }

      if ($this->userModel->deleteUser($id)) {
        flash('event_message', 'User Removed');
        redirect('users/adminaccounthandling');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('users/adminaccounthandling');
    }
  }

  public function emailVerification($code)
  {
    if (isset($code)) {
      $result = $this->userModel->getUserByVerificationCode($code);

      if ($result['rowCount'] == 1) { //check number of raws using mysqli_num_rows
        if ($this->userModel->activateUser($code)) {
          echo 'Email address verified successfully';
        } else {
          echo 'Invalid verification code';
        }
      } else {
        echo 'Invalid verification code';
      }
    }
  }

  public function updatemyprofile($id)
  {
    $data = [
      'id' => $id,
    ];
    $this->view('users/undergraduate/updatemyprofile', $data);
  }

//Search Profiles
public function searchUsers()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // echo $_POST['value'];

    $users = $this->userModel->searchUsers($_POST);

    $data = [
      'users' => $users, 
    ];

    $this->view('users/undergraduate/searchUser', $data);

  }
}

//Admin
  public function dashboard()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/dashboard', $data);
    }
  }

  public function useraccounts()
  {
    $user = $this->userModel->getRecentlyLoggedInUsers();
    $data = [
      'user' => $user
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/useraccounts', $data);
    }

  }

  public function typefilter()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo $_POST['value'];

      $users = $this->userModel->getUsersByType($_POST);

      $data = [
        'users' => $users,
      ];

      $this->view('users/admin/typefilter', $data);

    }
  }


  //filter-users-function==============================================================
  public function filterUsers()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo $_POST['value'];

      $users = $this->userModel->filterUsers($_POST);

      $data = [
        'users' => $users,
      ];

      $this->view('users/admin/typefilter', $data);

    }
  }
  //filter-users-function==============================================================



  public function updateUser()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //echo $_POST['value'];

      $user = $this->userModel->getUserById($_POST['user_id']);

      $data = [
        'users' => $user,
      ];

      $this->view('users/admin/updateuser', $data);

    }
  }



  public function deactivateUser()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user_id = $_POST['user_id'];
      $data = [
        'user_id' => $user_id
      ];
      if ($this->userModel->DeactivateAccount($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function activateUser()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user_id = $_POST['user_id'];
      $data = [
        'user_id' => $user_id
      ];
      if ($this->userModel->ActivateAccount($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }




  public function events()
  {
    $event = $this->eventModel->getAllEvents();
    $data = [
      'events' => $event
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/events', $data);
    }
  }

  public function organizations()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/organizations', $data);
    }
  }

  public function knowledgehub()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/knowledgehub', $data);
    }
  }

  public function opportunities()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/opportunities', $data);
    }
  }

  public function requests()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/requests', $data);
    }
  }

  public function reports()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/reports', $data);
    }
  }

  public function settings()
  {
    $data = [

    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->view('users/admin/settings', $data);
    }
  }

  //update myprofile
  public function updateContactDetails($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $web = trim($_POST['web']);
      $email = trim($_POST['email']);
      $linkedin = trim($_POST['linkedin']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'contact_number' => trim($_POST['contact_number']),
        'web' => $web,
        'email' => $email,
        'linkedin' => $linkedin,

        'web_err' => '',
        'email_err' => '',
        'linkedin_err' => '',
      ];


      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter the email';
      }


      // Make sure errors are empty
      if (empty($data['email_err'])) {
        //Validated

        if ($this->userModel->updateContactDetails($data)) {
          // 
          echo "success";
        }


      } else {

        //load view with errors
        $this->view('users/undergraduate/editContactDetails', $data);

      }


    } else {
      //get existing post from model
      $user = $this->userModel->getUserById($id);

      // Init data
      $data = [
        'id' => $id,
        'email' => $user->email,
        'contact_number' => $user->contact_number,
        'web' => $user->web,
        'linkedin' => $user->linkedin,

        'email_err' => '',
        'contact_number_err' => '',
        'web_err' => '',
        'linkedin_err' => '',
      ];

      // Load view
      $this->view('users/undergraduate/editContactDetails', $data);
    }
  }

  //change profile description

  public function editDescription($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $profile_title = trim($_POST['profile_title']);
      $description = trim($_POST['description']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'profile_title' => $profile_title,
        'description' => $description,

        'profile_title_err' => '',
        'description_err' => '',
      ];

      if (empty($data['profile_title'])) {
        $data['profile_title_err'] = 'Pleae enter the profile title';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }



      // Make sure errors are empty
      if (empty($data['description_err'])) {
        //Validated
        if ($this->userModel->updateDescription($data)) {
          // 
          echo "success";
        }
      } else {

        //load view with errors
        $this->view('users/undergraduate/editContactDetails', $data);

      }
    } else {
      //get existing post from model
      $user = $this->userModel->getUserById($id);

      // Init data
      $data = [
        'id' => $id,
        'profile_title' => $user->profile_title,
        'description' => $user->description,

        'profile_title_err' => '',
        'description_err' => '',
      ];

      // Load view
      $this->view('users/undergraduate/update-description', $data);
    }
  }

  //Update Qualification
  public function showQualifications($id)
  {
    $qualification = $this->userModel->getQualificationByUserId($id);
    $user = $this->userModel->getUserById($id);

    $data = [
      'qualification' => $qualification,
      'user' => $user
    ];


    $this->view('users/undergraduate/showQualification', $data);
  }

  public function editQualification($qualification_id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $qualification_name = trim($_POST['qualification_name']);
      $institution = trim($_POST['institution']);
      $completion_date = trim($_POST['completion_date']);
      $description = trim($_POST['description']);



      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'qualification_id' => $qualification_id,
        'qualification_name' => $qualification_name,
        'institution' => $institution,
        'description' => $description,
        'completion_date' => $completion_date,

        'qualification_name_err' => '',
        'institution_err' => '',
        'description_err' => '',
        'completion_date_err' => ''
      ];

      if (empty($data['qualification_name'])) {
        $data['qualification_name_err'] = 'Pleae enter the qualification name';
      }

      if (empty($data['institution'])) {
        $data['institution_err'] = 'Pleae enter the institution';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }

      if (empty($data['completion_date'])) {
        $data['completion_date_err'] = 'Pleae enter the completion date';
      }

      // Make sure errors are empty
      if (empty($data['qualification_name_err']) && empty($data['institution_err']) && empty($data['description_err']) && empty($data['completion_date_err'])) {
        //Validated
        if ($this->userModel->updateQualification($data)) {
          // 
          redirect('users/showQualifications/' . $_SESSION['user_id']);
        }
      } else {

        //load view with errors
        $this->view('users/undergraduate/editQualification', $data);

      }
    } else {
      //get existing post from model
      $qualification = $this->userModel->getQualificationById($qualification_id);

      // Init data
      $data = [
        'qualification_id' => $qualification->qualification_id,
        'qualification_name' => $qualification->qualification_name,
        'institution' => $qualification->institution,
        'description' => $qualification->description,
        'completion_date' => $qualification->completion_date,

        'qualification_name_err' => '',
        'institution_err' => '',
        'description_err' => '',
        'completion_date_err' => ''
      ];

      // Load view
      $this->view('users/undergraduate/editQualification', $data);
    }
  }

  public function deleteQualification()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $qualification_id = $_POST['qualification_id'];
      $data = [
        'qualification_id' => $qualification_id
      ];
      if ($this->userModel->deleteQualification($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function addQualification()
  {
    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      $qualification_name = trim($_POST['qualification_name']);
      $institution = trim($_POST['institution']);
      $description = trim($_POST['description']);
      $completion_date = trim($_POST['completion_date']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'qualification_name' => $qualification_name,
        'institution' => $institution,
        'description' => $description,
        'completion_date' => $completion_date,

        'qualification_name_err' => '',
        'institution_err' => '',
        'description_err' => '',
        'completion_date_err' => '',
      ];



      if (empty($data['qualification_name'])) {
        $data['qualification_name_err'] = 'Pleae enter the qualification name';
      }
      if (empty($data['institution'])) {
        $data['institution_err'] = 'Pleae enter event institution';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }

      if (empty($data['completion_date'])) {
        $data['completion_date_err'] = 'Pleae enter the completion date';
      }

      // Make sure errors are empty
      if (empty(empty($data['qualification_name_err']) && $data['institution_err']) && empty($data['description_err']) && empty($data['completion_date_err'])) {
        //Validated

        if ($this->userModel->addQualification($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('users/showQualifications/' . $_SESSION['user_id']);
        }
      } else {
        //load view with error
        $this->view('users/undergraduate/addQualification', $data);

      }


    } else {
      // Init data
      $data = [
        'qualification_name' => '',
        'institution' => '',
        'description' => '',
        'completion_date' => '',

        'qualification_name_err' => '',
        'institution_err' => '',
        'description_err' => '',
        'completion_date_err' => '',
      ];

      // Load view
      $this->view('users/undergraduate/addQualification', $data);
    }
  }

  //Update Education
  public function showEducation($id)
  {
    $education = $this->userModel->getEducationByUserId($id);
    $user = $this->userModel->getUserById($id);

    $data = [
      'education' => $education,
      'user' => $user
    ];


    $this->view('users/undergraduate/showEducation', $data);
  }

  public function editEducation($education_id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $institution = trim($_POST['institution']);
      $description = trim($_POST['description']);
      $start_year = trim($_POST['start_year']);
      $end_year = trim($_POST['end_year']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'education_id' => $education_id,
        'institution' => $institution,
        'description' => $description,
        'start_year' => $start_year,
        'end_year' => $end_year,

        'institution_err' => '',
        'description_err' => '',
        'start_year_err' => '',
        'end_year_err' => ''
      ];

      if (empty($data['institution'])) {
        $data['institution_err'] = 'Pleae enter the institution';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }

      if (empty($data['start_year'])) {
        $data['start_year_err'] = 'Pleae enter the start year';
      }

      if (empty($data['end_year'])) {
        $data['end_year_err'] = 'Pleae enter the end year';
      }

      // Make sure errors are empty
      if (empty($data['institution_err']) && empty($data['description_err']) && empty($data['start_year_err']) && empty($data['end_year_err'])) {
        //Validated
        if ($this->userModel->updateEducation($data)) {
          // 
          redirect('users/showEducation/' . $_SESSION['user_id']);
        }
      } else {

        //load view with errors
        $this->view('users/undergraduate/editEducation', $data);

      }
    } else {
      //get existing post from model
      $education = $this->userModel->getEducationById($education_id);

      // Init data
      $data = [
        'education_id' => $education->education_id,
        'institution' => $education->institution,
        'description' => $education->description,
        'start_year' => $education->start_year,
        'end_year' => $education->end_year,

        'institution_err' => '',
        'description_err' => '',
        'start_year_err' => '',
        'end_year_err' => ''
      ];

      // Load view
      $this->view('users/undergraduate/editEducation', $data);
    }
  }

  public function deleteEducation()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $education_id = $_POST['education_id'];
      $data = [
        'education_id' => $education_id
      ];
      if ($this->userModel->deleteEducation($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function addEducation()
  {
    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $institution = trim($_POST['institution']);
      $description = trim($_POST['description']);
      $start_year = trim($_POST['start_year']);
      $end_year = trim($_POST['end_year']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'institution' => $institution,
        'description' => $description,
        'start_year' => $start_year,
        'end_year' => $end_year,

        'institution_err' => '',
        'description_err' => '',
        'start_year_err' => '',
        'end_year_err' => '',
      ];



      if (empty($data['institution'])) {
        $data['institution_err'] = 'Pleae enter event institution';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }
      if (empty($data['start_year'])) {
        $data['start_year_err'] = 'Pleae enter the start year';
      }
      if (empty($data['end_year'])) {
        $data['end_year_err'] = 'Pleae enter the end year';
      }

      // Make sure errors are empty
      if (empty($data['institution_err']) && empty($data['description_err']) && empty($data['start_year_err']) && empty($data['end_year_err'])) {
        //Validated

        if ($this->userModel->addEducation($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('users/showEducation/' . $_SESSION['user_id']);
        }
      } else {
        //load view with error
        $this->view('users/undergraduate/addEducation', $data);

      }


    } else {
      // Init data
      $data = [
        'institution' => '',
        'description' => '',
        'start_year' => '',
        'end_year' => '',

        'institution_err' => '',
        'description_err' => '',
        'start_year_err' => '',
        'end_year_err' => '',
      ];

      // Load view
      $this->view('users/undergraduate/addEducation', $data);
    }
  }


  //change profile images

  public function updateProfileImage($id)
  {
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //   //process form

    //   //Sanitize post data
    //   $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //   //Init data
    //   $data = [
    //     'id' => $id,
    //     'profile_image' => trim($_POST['profile_image']),
    //     'cover_image' => trim($_POST['cover_image']),
    //     'profile_image_err' => '',
    //     'cover_image_err' => '',

    //   ];


    //   // if (empty($data['event_title'])) {
    //   //   $data['event_title_err'] = 'Pleae enter event title';
    //   // }

    //   // if (empty($data['event_type'])) {
    //   //   $data['event_type_err'] = 'Pleae enter event type';
    //   // }

    //   // if (empty($data['description'])) {
    //   //   $data['description_err'] = 'Pleae enter event description';
    //   // }

    //   // if (empty($data['date'])) {
    //   //   $data['date_err'] = 'Pleae enter date';
    //   // }

    //   // if (empty($data['location'])) {
    //   //   $data['location_err'] = 'Pleae enter location';
    //   // }



    //   // Make sure errors are empty
    //   if (empty($data['event_title_err']) && empty($data['event_type_err']) && empty($data['description_err']) && empty($data['date_err']) && empty($data['location_err'])) {
    //     //Validated
    //     if (isset($_FILES['event_card_image']['name']) and !empty($_FILES['event_card_image']['name'])) {


    //       $img_name = $_FILES['event_card_image']['name'];
    //       $tmp_name = $_FILES['event_card_image']['tmp_name'];
    //       $error = $_FILES['event_card_image']['error'];

    //       if ($error === 0) {
    //         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    //         $img_ex_to_lc = strtolower($img_ex);

    //         $allowed_exs = array('jpg', 'jpeg', 'png');
    //         if (in_array($img_ex_to_lc, $allowed_exs)) {
    //           $new_img_name = $data['event_title'] . '-event-card-image.' . $img_ex_to_lc;
    //           $img_upload_path = "../public/img/event-card-images/" . $new_img_name;
    //           move_uploaded_file($tmp_name, $img_upload_path);

    //           $data['event_card_image'] = $new_img_name;
    //         }
    //       }
    //     }

    //     if (isset($_FILES['event_cover_image']['name']) and !empty($_FILES['event_cover_image']['name'])) {


    //       $img_name = $_FILES['event_cover_image']['name'];
    //       $tmp_name = $_FILES['event_cover_image']['tmp_name'];
    //       $error = $_FILES['event_cover_image']['error'];

    //       if ($error === 0) {
    //         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    //         $img_ex_to_lc = strtolower($img_ex);

    //         $allowed_exs = array('jpg', 'jpeg', 'png');
    //         if (in_array($img_ex_to_lc, $allowed_exs)) {
    //           $new_img_name = $data['event_title'] . '-event-cover-image.' . $img_ex_to_lc;
    //           $img_upload_path = "../public/img/event-cover-images/" . $new_img_name;
    //           move_uploaded_file($tmp_name, $img_upload_path);

    //           $data['event_cover_image'] = $new_img_name;
    //         }
    //       }
    //     }

    //     if ($this->eventModel->updateEvent($data)) {
    //       flash('event_message', "Event Updated Successfully");
    //       redirect('events');
    //     }
    //   } else {

    //     //load view with error
    //     $this->view('events/events-edit', $data);

    //   }


    // } else {
    //   //get existing post from model
    //   $event = $this->eventModel->getEventById($id);

    //   //check for owner
    //   // if ($event->user_id != $_SESSION['user_id']) {
    //   //   redirect('events');
    //   // }
    //   // Init data
    //   $data = [
    //     'id' => $id,
    //     'event_profile_image' => $event->event_profile_image,
    //     'event_cover_image' => $event->event_cover_image,
    //     'event_card_image_err' => '',
    //     'event_cover_image_err' => '',

    //   ];

    //   // Load view
    //   $this->view('events/editProfileImage', $data);
    // }
  }






}