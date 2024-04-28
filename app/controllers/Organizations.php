<?php
class Organizations extends Controller
{
  public function __construct()
  {
    // if(!isLoggedIn()){
    //     redirect('/users/login');
    // }

    $this->organizationModel = $this->model('Organization');
    $this->userModel = $this->model('User');
    $this->universityModel = $this->model('University');
  }
  public function index()
  {
    //get Posts
    $organizationCategories = $this->organizationModel->getOrganizationCategories();
    // var_dump($organizations);
    // die();
    $data = [
      'organization_categories' => $organizationCategories
    ];

    $this->view('organizations/organizations-index', $data);
  }
  public function add()
  {


    $universities = $this->universityModel->getUniversities();
    $organizationCategories = $this->organizationModel->getOrganizationCategories();
    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



      //Init data
      $data = [
        'organization_name' => trim($_POST['organization_name']),
        'short_caption' => trim($_POST['short_caption']),
        'description' => trim($_POST['description']),
        'university' => trim($_POST['university']),
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'website_url' => trim($_POST['website_url']),
        'contact_email' => trim($_POST['contact_email']),
        'contact_number' => trim($_POST['contact_number']),
        'instagram' => trim($_POST['instagram']),
        'facebook' => trim($_POST['facebook']),
        'linkedin' => trim($_POST['linkedin']),
        'number_of_members' => trim($_POST['number_of_members']),
        'organization_profile_image' => trim($_POST['organization_profile_image']),
        'organization_cover_image' => trim($_POST['organization_cover_image']),
        'board_members_image' => trim($_POST['board_members_image']),



        'organization_name_err' => '',
        'short_caption_err' => '',
        'description_err' => '',
        'university_err' => '',
        'categories_err' => '',
        'website_url_err' => '',
        'contact_email_err' => '',
        'contact_number_err' => '',
        'instagram_err' => '',
        'facebook_err' => '',
        'linkedin_err' => '',
        'number_of_members_err' => '',
        'organization_profile_image_err' => '',
        'organization_cover_image_err' => '',
        'board_members_image_err' => '',

      ];


      if (isset($_FILES['organization_profile_image']['name']) and !empty($_FILES['organization_profile_image']['name'])) {


        $img_name = $_FILES['organization_profile_image']['name'];
        $tmp_name = $_FILES['organization_profile_image']['tmp_name'];
        $error = $_FILES['organization_profile_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_organization_profile_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/organization_profile_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['organization_profile_image'] = $new_img_name;
          }
        }
      }


      //organization-cover image adding
      if (isset($_FILES['organization_cover_image']['name']) and !empty($_FILES['organization_cover_image']['name'])) {


        $img_name = $_FILES['organization_cover_image']['name'];
        $tmp_name = $_FILES['organization_cover_image']['tmp_name'];
        $error = $_FILES['organization_cover_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_organization_cover_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/organization_cover_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['organization_cover_image'] = $new_img_name;
          }
        }
      }


      //organization-cover image adding
      if (isset($_FILES['board_members_image']['name']) and !empty($_FILES['board_members_image']['name'])) {


        $img_name = $_FILES['board_members_image']['name'];
        $tmp_name = $_FILES['board_members_image']['tmp_name'];
        $error = $_FILES['board_members_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_board_members_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/board_members_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['board_members_image'] = $new_img_name;
          }
        }
      }

      if (empty($data['organization_name'])) {
        $data['organization_name_err'] = 'Please enter the organization name';
      }

      if (empty($data['short_caption'])) {
        $data['short_caption_err'] = 'Please enter the short caption';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Please enter the description';
      }

      if (empty($data['university'])) {
        $data['university_err'] = 'Please enter the university';
      }

      if (empty($data['categories'])) {
        $data['categories_err'] = 'Please select at least one category';
      }

      if (empty($data['contact_email'])) {
        $data['contact_email_err'] = 'Please enter the organization email';
      }



      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Please enter the contact number';
      }
      if (strlen($data['contact_number']) !== 10) {
        $data['contact_number_err'] = 'Contact number must be 10 digits long';
      }

      if (empty($data['organization_profile_image'])) {
        $data['organization_profile_image_err'] = 'Please add the organization profile image';
      }

      if (empty($data['organization_cover_image'])) {
        $data['organization_cover_image_err'] = 'Please add the organization cover image';
      }

      if (empty($data['board_members_image'])) {
        $data['board_members_image_err'] = 'Please add the board members image';
      }

      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Please enter the contact number';
      }


      if (empty($data['number_of_members'])) {
        $data['number_of_members_err'] = 'Please enter the number of members';
      } elseif (!is_numeric($data['number_of_members'])) {
        $data['number_of_members_err'] = 'Please enter a valid number';
      }



      // Make sure errors are empty
      if (
        empty($data['organization_name_err']) &&
        empty($data['short_caption_err']) &&
        empty($data['description_err']) &&
        empty($data['university_err']) &&
        empty($data['categories_err']) &&
        empty($data['website_url_err']) &&
        empty($data['contact_email_err']) &&
        empty($data['contact_number_err']) &&
        empty($data['number_of_members_err'])
      ) {
        //Validated

        //organization-profile image adding



        if ($this->organizationModel->addOrganization($data)) {
          // flash('event_message', "Event Added Successfully");

          $admins = $this->userModel->getAdminsEmails();
          foreach ($admins as $admin) {

            $to = $admin->secondary_email;
            $sender = 'developer.unihub@gmail.com';
            $mail_subject = 'New Organization Added - Review Required';

            // Initialize $email_body properly and append to it
            $email_body = '<p>Hello,</p>';
            $email_body .= '<p>A new organization has been requested and requires your attention.<br>Please review the organization details and take necessary actions.</p>';
            $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

            $header = "From: {$sender}\r\n";
            $header .= "Content-Type: text/html;";

            $send_mail_result = mail($to, $mail_subject, $email_body, $header);
          }


          $to = $data['contact_email'];
          $sender = 'developer.unihub@gmail.com';
          $mail_subject = 'Organization Under Approval: ' . $data['organization_name'];

          // Initialize $email_body properly and append to it
          $email_body = '<p>Hello,</p>';
          $email_body .= '<p>Your organization is currently under review. We will notify you once the approval process is completed.</p>';
          $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

          $header = "From: {$sender}\r\n";
          $header .= "Content-Type: text/html;";

          $send_mail_result = mail($to, $mail_subject, $email_body, $header);

          redirect('organizations');
        }
      } else {
        //load view with error
        $data['universities'] = $universities;
        $data['organizationCategories'] = $organizationCategories;
        $this->view('organizations/organization-add', $data);

      }


    } else {
      // Init data
      $data = [
        'organization_name' => '',
        'short_caption' => '',
        'description' => '',
        'university' => '',
        'categories' => [],
        'website_url' => '',
        'contact_email' => '',
        'contact_number' => '',
        'instagram' => '',
        'facebook' => '',
        'linkedin' => '',
        'number_of_members' => '',
        'organization_profile_image' => '',
        'organization_cover_image' => '',
        'board_members_image' => '',



        'organization_name_err' => '',
        'short_caption_err' => '',
        'description_err' => '',
        'university_err' => '',
        'categories_err' => '',
        'website_url_err' => '',
        'contact_email_err' => '',
        'contact_number_err' => '',
        'instagram_err' => '',
        'facebook_err' => '',
        'linkedin_err' => '',
        'number_of_members_err' => '',
        'organization_profile_image_err' => '',
        'organization_cover_image_err' => '',
        'board_members_image_err' => '',

      ];

      // Load view
      $data['universities'] = $universities;
      $data['organizationCategories'] = $organizationCategories;
      $this->view('organizations/organization-add', $data);
    }
  }

  public function searchOrganizations()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $organizations = $this->organizationModel->getOrganizationsBySearch($_POST);

      $data = [
        'organizations' => $organizations,
      ];

      $this->view('organizations/filter-organizations', $data);

    }
  }

  public function filterByCategory()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $organizations = $this->organizationModel->filterByCategory($category);

      $data = [
        'organizations' => $organizations,
      ];

      $this->view('organizations/filter-organizations', $data);

    }
  }

  public function userFollowedOrganizations()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $userId = $_POST['userId'];
      $organizations = $this->organizationModel->filterByUserId($userId);

      $data = [
        'organizations' => $organizations,
      ];

      $this->view('organizations/filter-organizations', $data);

    }
  }

  public function show($id)
  {
    $addView = $this->organizationModel->addOrganizationView($id);
    $organization = $this->organizationModel->getOrganizationById($id);
    $organization_activties = $this->organizationModel->getActivitiesByOrganizationId($id);
    $organization_news = $this->organizationModel->getNewsByOrganizationId($id);
    $data = [
      'organization' => $organization,
      'organization_activities' => $organization_activties,
      'organization_news' => $organization_news
    ];
    $this->view('organizations/organization-show', $data);
  }


  public function filterOrganizations()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $organizations = $this->organizationModel->getFilterOrganizations($_POST);

      $data = [
        'organizations' => $organizations,
      ];

      $this->view('users/admin/organizationfilter', $data);

    }
  }

  public function filterOrganizationsByApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $organizations = $this->organizationModel->getFilterOrganizations($_POST);

      $data = [
        'organizations' => $organizations,
      ];

      $this->view('users/admin/organizationApprovalfilter', $data);

    }
  }

  public function totalOrgFilter()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $type = $_POST['value'];

      if ($type == "all") {
        $organizations = $this->organizationModel->getAllOrganizations();
      }


      $data = [
        'organizations' => $organizations,
      ];

      $this->view('users/admin/organizationfilter', $data);

    }
  }


  public function addActivity($id)
  {

    //check the user is a registered user
    // if (!isLoggedIn()) {
    //   redirect('/users/login');
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'organization_id' => $id,
        'activity_title' => trim($_POST['activity_title']),
        'activity_description' => trim($_POST['activity_description']),
        'activity_image' => '',

        'activity_title_err' => '',
        'activity_description_err' => '',
        'activity_image_err' => ''

      ];




      if (empty($data['activity_title'])) {
        $data['activity_title_err'] = 'Pleae enter the acitivity title';
      }
      if (empty($data['activity_description'])) {
        $data['activity_description_err'] = 'Pleae enter the acitivity description';
      }

      if (isset($_FILES['activity_image']['name']) and !empty($_FILES['activity_image']['name'])) {


        $img_name = $_FILES['activity_image']['name'];
        $tmp_name = $_FILES['activity_image']['tmp_name'];
        $error = $_FILES['activity_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['activity_title'] . '-activity-image.' . time() . '.' . $img_ex_to_lc;
            ;
            $img_upload_path = "../public/img/organizations/activity_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['activity_image'] = $new_img_name;
          }
        }
      }

      // Make sure errors are empty
      if (empty($data['activity_title_err']) && empty($data['activity_description_err'])) {

        //Validated



        if ($this->organizationModel->addActivity($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('organizations/show/' . $id);
        }
      } else {
        //load view with error
        $this->view('organizations/add-activity', $data);

      }



    } else {
      // Init data
      $data = [
        'organization_id' => $id,
        'activity_title' => '',
        'activity_description' => '',
        'activity_image' => '',

        'activity_title_err' => '',
        'activity_description_err' => '',
        'activity_image_err' => ''
      ];

      // Load view
      $this->view('organizations/add-activity', $data);
    }

  }

  public function updateActivity($id)
  {

    //check the user is a registered user
    // if (!isLoggedIn()) {
    //   redirect('/users/login');
    // }
    $activity = $this->organizationModel->getActivityByActivityId($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'activity_id' => $id,
        'activity_title' => trim($_POST['activity_title']),
        'activity_description' => trim($_POST['activity_description']),
        'activity_image' => $activity->activity_image,

        'activity_title_err' => '',
        'activity_description_err' => '',
        'activity_image_err' => ''

      ];

      if (empty($data['activity_title'])) {
        $data['activity_title_err'] = 'Pleae enter the acitivity title';
      }
      if (empty($data['activity_description'])) {
        $data['activity_description_err'] = 'Pleae enter the acitivity description';
      }

      if (isset($_FILES['activity_image']['name']) and !empty($_FILES['activity_image']['name'])) {


        $img_name = $_FILES['activity_image']['name'];
        $tmp_name = $_FILES['activity_image']['tmp_name'];
        $error = $_FILES['activity_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['activity_title'] . '-activity-image.' . time() . '.' . $img_ex_to_lc;
            ;
            $img_upload_path = "../public/img/organizations/activity_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['activity_image'] = $new_img_name;
          }
        }
      }

      // Make sure errors are empty
      if (empty($data['activity_title_err']) && empty($data['activity_description_err'])) {

        //Validated

        if ($this->organizationModel->updateActivity($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('organizations/show/' . $activity->organization_id);
        }
      } else {
        //load view with error
        $this->view('organizations/update-activity', $data);

      }



    } else {
      // Init data
      $data = [
        'activity_id' => $id,
        'activity_title' => $activity->activity_title,
        'activity_description' => $activity->activity_description,
        'activity_image' => $activity->activity_image,

        'activity_title_err' => '',
        'activity_description_err' => '',
        'activity_image_err' => ''
      ];

      // Load view
      $this->view('organizations/update-activity', $data);
    }

  }




  public function addNews($id)
  {

    //check the user is a registered user
    // if (!isLoggedIn()) {
    //   redirect('/users/login');
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'organization_id' => $id,
        'news_title' => trim($_POST['news_title']),
        'news_text' => trim($_POST['news_text']),
        'sharing_option' => trim($_POST['sharing_option']),

        'news_title_err' => '',
        'news_text_err' => '',
        'sharing_option_err' => ''

      ];




      if (empty($data['news_title'])) {
        $data['news_title_err'] = 'Pleae enter the news title';
      }
      if (empty($data['news_text'])) {
        $data['news_text_err'] = 'Pleae enter the news text';
      }


      // Make sure errors are empty
      if (empty($data['news_title_err']) && empty($data['news_text_err'])) {

        //Validated



        if ($this->organizationModel->addNews($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('organizations/show/' . $id);
        }
      } else {
        //load view with error
        $this->view('organizations/add-news', $data);

      }



    } else {
      // Init data
      $data = [
        'organization_id' => $id,
        'news_title' => '',
        'news_text' => '',
        'sharing_option' => '',

        'news_title_err' => '',
        'news_text_err' => '',
        'sharing_option_err' => ''
      ];

      // Load view
      $this->view('organizations/add-news', $data);
    }

  }

  public function updateNews($id)
  {

    //check the user is a registered user
    // if (!isLoggedIn()) {
    //   redirect('/users/login');
    // }
    $news = $this->organizationModel->getNewsByNewsId($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'news_id' => $id,
        'news_title' => trim($_POST['news_title']),
        'news_text' => trim($_POST['news_text']),
        'sharing_option' => trim($_POST['sharing_option']),

        'news_title_err' => '',
        'news_text_err' => '',
        'sharing_option_err' => ''

      ];




      if (empty($data['news_title'])) {
        $data['news_title_err'] = 'Pleae enter the news title';
      }
      if (empty($data['news_text'])) {
        $data['news_text_err'] = 'Pleae enter the news text';
      }


      // Make sure errors are empty
      if (empty($data['news_title_err']) && empty($data['news_text_err'])) {

        //Validated



        if ($this->organizationModel->updateNews($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('organizations/show/' . $news->organization_id);
        }
      } else {
        //load view with error
        $this->view('organizations/update-news', $data);

      }



    } else {
      // Init data
      $data = [
        'news_id' => $news->news_id,
        'news_title' => $news->news_title,
        'news_text' => $news->news_text,
        'sharing_option' => $news->sharing_option,

        'news_title_err' => '',
        'news_text_err' => '',
        'sharing_option_err' => ''
      ];

      // Load view
      $this->view('organizations/update-news', $data);
    }

  }

  public function addFollow()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $organizationId = $_POST['organizationId'];
      if (isset($_SESSION['user_id'])) {
        $followerId = $_SESSION['user_id'];
        $data = [
          'organizationId' => $organizationId,
          'followerId' => $followerId
        ];
        if (!$this->organizationModel->checkUserOrganizationFollow($data)) {
          if ($status = $this->organizationModel->addUserOrganizationFollow($data)) {
            echo $status;
          }
        } else {
          $this->organizationModel->deleteUserOrganizationFollow($data);
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function settings($id)
  {
    $organization = $this->organizationModel->getOrganizationById($id);
    $data = [
      'id' => $id,
      'organization' => $organization
    ];
    $this->view('organizations/settings', $data);

  }


  public function editGeneralDetails($organizationId)
  {
    $universities = $this->universityModel->getUniversities();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'organization_id' => $organizationId,
        'organization_name' => trim($_POST['organization_name']),
        'short_caption' => trim($_POST['short_caption']),
        'description' => trim($_POST['description']),
        'university' => trim($_POST['university']),
        'contact_number' => trim($_POST['contact_number']),
        'number_of_members' => trim($_POST['number_of_members']),
        'universities' => $universities,

        'organization_id_err' => '',
        'organization_name_err' => '',
        'short_caption_err' => '',
        'description_err' => '',
        'university_err' => '',
        'contact_number_err' => '',
        'number_of_members_err' => '',

      ];


      if (empty($data['organization_name'])) {
        $data['organization_name_err'] = 'Please enter the organization name';
      }

      if (empty($data['short_caption'])) {
        $data['short_caption_err'] = 'Please enter the short caption';
      }


      if (empty($data['description'])) {
        $data['description_err'] = 'Please enter the description';
      }

      if (empty($data['university'])) {
        $data['university_err'] = 'Please enter the university';
      }

      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Please enter the contact number';
      }

      if (empty($data['number_of_members'])) {
        $data['number_of_members_err'] = 'Please enter the number of members';
      }



      // Make sure errors are empty
      if (
        empty($data['organization_name_err']) &&
        empty($data['short_caption_err']) &&
        empty($data['description_err']) &&
        empty($data['number_of_members_err']) &&
        empty($data['contact_number_err'])
      ) {
        //Validated
        if ($this->organizationModel->updateGeneralDetails($data)) {
          redirect('organizations/show/' . $organizationId);
        }


      } else {

        //load view with errors
        $this->view('organizations/editGeneralDetails', $data);

      }


    } else {
      //get existing post from model
      $organization = $this->organizationModel->getOrganizationById($organizationId);

      // Init data
      $data = [
        'organization_id' => $organizationId,
        'organization_name' => $organization->organization_name,
        'short_caption' => $organization->short_caption,
        'description' => $organization->description,
        'university' => $organization->university_id,
        'contact_number' => $organization->contact_number,
        'number_of_members' => $organization->number_of_members,
        'universities' => $universities,

        'organization_id_err' => '',
        'organization_name_err' => '',
        'short_caption_err' => '',
        'description_err' => '',
        'university_err' => '',
        'contact_number_err' => '',
        'number_of_members_err' => '',
      ];

      // Load view
      $this->view('organizations/editGeneralDetails', $data);
    }
  }


  public function editProfileImage($organizationId)
  {
    $organization = $this->organizationModel->getOrganizationById($organizationId);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data

      $data = [

        'organization_id' => $organizationId,
        'organization_name' => $organization->organization_name,
        'organization_profile_image' => $organization->organization_profile_image,
        'organization_cover_image' => $organization->organization_cover_image,
        'board_members_image' => $organization->board_members_image,

        'organization_profile_image_err' => '',
        'organization_cover_image_err' => '',
        'board_members_image_err' => '',


      ];


      if (isset($_FILES['organization_profile_image']['name']) and !empty($_FILES['organization_profile_image']['name'])) {


        $img_name = $_FILES['organization_profile_image']['name'];
        $tmp_name = $_FILES['organization_profile_image']['tmp_name'];
        $error = $_FILES['organization_profile_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_organization_profile_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/organization_profile_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['organization_profile_image'] = $new_img_name;
          }
        }
      }


      //organization-cover image adding
      if (isset($_FILES['organization_cover_image']['name']) and !empty($_FILES['organization_cover_image']['name'])) {


        $img_name = $_FILES['organization_cover_image']['name'];
        $tmp_name = $_FILES['organization_cover_image']['tmp_name'];
        $error = $_FILES['organization_cover_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_organization_cover_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/organization_cover_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['organization_cover_image'] = $new_img_name;
          }
        }
      }


      //organization-cover image adding
      if (isset($_FILES['board_members_image']['name']) and !empty($_FILES['board_members_image']['name'])) {


        $img_name = $_FILES['board_members_image']['name'];
        $tmp_name = $_FILES['board_members_image']['tmp_name'];
        $error = $_FILES['board_members_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['organization_name'] . '_board_members_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/organizations/board_members_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['board_members_image'] = $new_img_name;
          }
        }
      }

      if (empty($data['organization_profile_image'])) {
        $data['organization_profile_image_err'] = 'Please enter the profile image';
      }

      if (empty($data['organization_cover_image'])) {
        $data['organization_cover_image_err'] = 'Please enter the cover image';
      }

      if (empty($data['board_members_image'])) {
        $data['board_members_image_err'] = 'Please enter the board members image';
      }

      // Make sure errors are empty
      if (
        empty($data['organization_profile_image_err']) &&
        empty($data['organization_cover_image_err']) &&
        empty($data['board_members_image_err'])
      ) {
        //Validated
        if ($this->organizationModel->updateProfileImage($data)) {
          redirect('organizations/show/' . $organizationId);
        }


      } else {

        //load view with errors
        $this->view('organizations/editProfileImage', $data);

      }


    } else {
      //get existing post from model

      // Init data
      $data = [
        'organization_id' => $organizationId,
        'organization_name' => $organization->organization_name,
        'organization_profile_image' => $organization->organization_profile_image,
        'organization_cover_image' => $organization->organization_cover_image,
        'board_members_image' => $organization->board_members_image,

        'organization_profile_image_err' => '',
        'organization_cover_image_err' => '',
        'board_members_image_err' => '',
      ];

      // Load view
      $this->view('organizations/editProfileImage', $data);
    }
  }

  public function editSocialMedia($organizationId)
  {
    $organization = $this->organizationModel->getOrganizationById($organizationId);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'organization_id' => $organizationId,
        'website_url' => trim($_POST['website_url']),
        'facebook' => trim($_POST['facebook']),
        'instagram' => trim($_POST['instagram']),
        'linkedin' => trim($_POST['linkedin']),

        'website_url_err' => '',
        'facebook_err' => '',
        'instagram_err' => '',
        'linkedin_err' => ''

      ];


      // if (empty($data['organization_name'])) {
      //   $data['organization_name_err'] = 'Please enter the organization name';
      // }



      // Make sure errors are empty
      if (
        empty($data['website_url_err']) &&
        empty($data['facebook_err']) &&
        empty($data['instagram_err']) &&
        empty($data['linkedin_err'])
      ) {
        //Validated
        if ($this->organizationModel->updateSocialMedia($data)) {
          redirect('organizations/show/' . $organizationId);
        }


      } else {

        //load view with errors
        $this->view('organizations/editSocialMedia', $data);

      }


    } else {
      //get existing post from model


      // Init data
      $data = [
        'organization_id' => $organizationId,
        'website_url' => $organization->website_url,
        'facebook' => $organization->facebook,
        'instagram' => $organization->instagram,
        'linkedin' => $organization->linkedin,

        'website_url_err' => '',
        'facebook_err' => '',
        'instagram_err' => '',
        'linkedin_err' => ''
      ];

      // Load view
      $this->view('organizations/editSocialMedia', $data);
    }
  }

  public function changeOrganizationCategories($organizationId)
  {
    $organizationCategories = $this->organizationModel->getOrganizationCategoriesById($organizationId);
    $allCategories = $this->organizationModel->getOrganizationCategories();
    $data = [
      'organizationId' => $organizationId,
      'organizationCategories' => $organizationCategories,
      'allCategories' => $allCategories
    ];
    $this->view('organizations/editCategories', $data);
  }

  public function addOrganizationCategory()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $organizationId = $_POST['organizationId'];

      $data = [
        'organizationId' => $organizationId,
        'categoryId' => $category
      ];

      if ($this->organizationModel->addOrganizationCategory($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function deleteOrganizationCategory()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $categoryId = $_POST['categoryId'];

      $data = [
        'categoryId' => $categoryId
      ];

      if ($this->organizationModel->deleteOrganizationCategory($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function changeActivation()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $organizationId = $_POST['organizationId'];
      $data = [
        'organizationId' => $organizationId
      ];

      if ($this->organizationModel->checkStatusByOrganizationId($organizationId) == true) {
        if ($this->organizationModel->deactivateOrganizationById($organizationId)) {
          echo 'deactivated';
        }
      } else {
        if ($this->organizationModel->activateOrganizationById($organizationId)) {
          echo 'activated';
        }
      }

    }
  }

  public function deleteActivity()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $activityId = $_POST['activityId'];

      $data = [
        'activityId' => $activityId
      ];

      if ($this->organizationModel->deleteActivityByActivityId($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function deleteNews()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $newsId = $_POST['newsId'];

      $data = [
        'newsId' => $newsId
      ];

      if ($this->organizationModel->deleteNewsByNewsId($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function changeApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $organizationId = $_POST['organizationId'];
      $selectedOrganizationApproval = $_POST['selectedOrganizationApproval'];
      $data = [
        'organizationId' => $organizationId,
        'selectedOrganizationApproval' => $selectedOrganizationApproval,
      ];

      if ($this->organizationModel->changeApproval($data)) {
        $organization = $this->organizationModel->getOrganizationById($organizationId);
        $organizationEmail = $organization->contact_email;

        $to = $organizationEmail;
        $sender = 'developer.unihub@gmail.com';
        $mail_subject = 'Organization ' . $selectedOrganizationApproval . ': ' . $organization->organization_name;

        // Initialize $email_body properly and append to it
        $email_body = '<p>Hello,</p>';
        $email_body .= '<p>Your organization request has been ' . $selectedOrganizationApproval . ' . Thank you for your submission.</p>';
        $email_body .= '<p>For further information or inquiries, please contact us at developer.unihub@gmail.com</p>';
        $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

        $header = "From: {$sender}\r\n";
        $header .= "Content-Type: text/html;";

        $send_mail_result = mail($to, $mail_subject, $email_body, $header);
        echo true;
      } else {
        echo false;
      }

    }
  }

  public function checkOrganizationExist($email)
  {

    if ($this->organizationModel->checkOrganizationExist($email)) {
      echo true;
    } else {
      echo false;
    }
  }

}










