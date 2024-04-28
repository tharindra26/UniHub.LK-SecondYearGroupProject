<?php
class Opportunities extends Controller
{

  public function __construct()
  {
    // if(!isLoggedIn()){
    //     redirect('/users/login');
    // }

    //test comment
    $this->userModel = $this->model('User');
    $this->opportunityModel = $this->model('opportunity');

  }


  public function index()
  {
    // $events= $this->eventModel->getEvents();
    $data = [
      // 'events'=> $events
    ];

    $this->view('opportunities/opportunities-index', $data);
  }

  public function show($id) //14
  {

    $addView = $this->opportunityModel->addOpportunityView($id);
    $opportunity = $this->opportunityModel->getOpportunityById($id);
    $data = [
      'opportunity' => $opportunity,
    ];
    $this->view('opportunities/showOpportunity', $data);
  }

  public function add()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $website_url = trim($_POST['website_url']);
      $linkedin = trim($_POST['linkedin']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'opportunity_title' => trim($_POST['opportunity_title']),
        'organization_name' => trim($_POST['organization_name']),
        'contact_person' => trim($_POST['contact_person']),
        'contact_email' => trim($_POST['contact_email']),
        'contact_phone' => trim($_POST['contact_phone']),
        'opportunity_type' => trim($_POST['opportunity_type']),
        'working_type' => trim($_POST['working_type']),
        'title_positions' => trim($_POST['title_positions']),
        'tags' => trim($_POST['tags']),
        'description' => trim($_POST['description']),
        'qualifications' => trim($_POST['qualifications']),
        'additional_information' => trim($_POST['additional_information']),
        'application_deadline' => trim($_POST['application_deadline']),
        'website_url' => $website_url,
        'linkedin' => $linkedin,
        'opportunity_card_image' => '',
        'opportunity_cover_image' => '',
        'description_image' => '',


        'opportunity_title_err' => '',
        'organization_name_err' => '',
        'contact_person_err' => '',
        'contact_email_err' => '',
        'contact_phone_err' => '',
        'opportunity_type_err' => '',
        'working_type_err' => '',
        'title_positions_err' => '',
        'tags_err' => '',
        'description_err' => '',
        'qualifications_err' => '',
        'additional_information_err' => '',
        'application_deadline_err' => '',
        'website_url_err' => '',
        'linkedin_err' => '',
        'opportunity_card_image_err' => '',
        'opportunity_cover_image_err' => '',
        'description_image_err' => '',

      ];

      if (isset($_FILES['opportunity_card_image']['name']) and !empty($_FILES['opportunity_card_image']['name'])) {


        $img_name = $_FILES['opportunity_card_image']['name'];
        $tmp_name = $_FILES['opportunity_card_image']['tmp_name'];
        $error = $_FILES['opportunity_card_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['opportunity_title'] . '_opportunity_card_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/opportunities/opportunities_card_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['opportunity_card_image'] = $new_img_name;
          }
        }
      }


      //event-cover image adding
      if (isset($_FILES['opportunity_cover_image']['name']) and !empty($_FILES['opportunity_cover_image']['name'])) {


        $img_name = $_FILES['opportunity_cover_image']['name'];
        $tmp_name = $_FILES['opportunity_cover_image']['tmp_name'];
        $error = $_FILES['opportunity_cover_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['opportunity_title'] . '_opportunity_cover_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/opportunities/opportunities_cover_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['opportunity_cover_image'] = $new_img_name;
          }
        }
      }

      if (isset($_FILES['description_image']['name']) and !empty($_FILES['description_image']['name'])) {


        $img_name = $_FILES['description_image']['name'];
        $tmp_name = $_FILES['description_image']['tmp_name'];
        $error = $_FILES['description_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['opportunity_title'] . '_description_image_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/opportunities/description_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['description_image'] = $new_img_name;
          }
        }
      }




      if (empty($data['opportunity_title'])) {
        $data['opportunity_title_err'] = 'Pleae enter the opportunity title';
      }
      if (empty($data['organization_name'])) {
        $data['organization_name_err'] = 'Pleae select the organization name';
      }
      if (empty($data['contact_person'])) {
        $data['contact_person_err'] = 'Pleae enter the contact person name';
      }
      if (empty($data['contact_email'])) {
        $data['contact_email_err'] = 'Pleae enter the contact email address';
      }

      if (empty($data['contact_phone'])) {
        $data['contact_phone_err'] = 'Please enter the contact phone number';
      } elseif (strlen($data['contact_phone']) !== 10) {
        $data['contact_phone_err'] = 'Phone number must be 10 digits';
      }

      if (empty($data['opportunity_type'])) {
        $data['opportunity_type_err'] = 'Pleae enter the opportunity type';
      }
      if (empty($data['working_type'])) {
        $data['working_type_err'] = 'Pleae enter the working type';
      }
      if (empty($data['title_positions'])) {
        $data['title_positions_err'] = 'Pleae add the title positions';
      }
      if (empty($data['tags'])) {
        $data['tags_err'] = 'Pleae add at least one tag';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }
      if (empty($data['qualifications'])) {
        $data['qualifications_err'] = 'Pleae enter qualifications';
      }

      if (empty($data['application_deadline'])) {
        $data['application_deadline_err'] = 'Please enter the application deadline';
      } elseif (strtotime($data['application_deadline']) < time()) {
        $data['application_deadline_err'] = 'Application deadline must be a future date';
      }

      if (empty($data['website_url'])) {
        $data['website_url_err'] = 'Pleae enter the website url';
      }
      if (empty($data['linkedin'])) {
        $data['linkedin_err'] = 'Pleae enter the linkedin';
      }
      if (empty($data['opportunity_cover_image'])) {
        $data['opportunity_cover_image_err'] = 'Pleae add the opportunity cover image';
      }
      if (empty($data['opportunity_card_image'])) {
        $data['opportunity_card_image_err'] = 'Pleae add the opportunity card image';
      }





      // Make sure errors are empty
      if (
        empty($data['opportunity_title_err'])
        && empty($data['organization_name_err'])
        && empty($data['contact_person_err'])
        && empty($data['contact_email_err'])
        && empty($data['contact_phone_err'])
        && empty($data['opportunity_type_err'])
        && empty($data['working_type_err'])
        && empty($data['title_positions_err'])
        && empty($data['tags_err'])
        && empty($data['description_err'])
        && empty($data['qualifications_err'])
        && empty($data['application_deadline_err'])
        && empty($data['website_url_err'])
        && empty($data['linkedin_err'])

      ) {
        //Validated

        //event-profile image adding



        // $data['category_id'] = $this->categoryModel->getCategoryIdByName($data['category']);
        // if (!empty($data['categories'])) {
        //   // Convert array of category names to category IDs
        //   $category_ids = [];
        //   foreach ($data['categories'] as $category_name) {
        //     $category_id = $this->categoryModel->getCategoryIdByName($category_name);
        //     if ($category_id !== false) {
        //       $category_ids[] = $category_id;
        //     }
        //   }
        //   $data['category_ids'] = $category_ids;
        // }
        // $data['university_id'] = $this->universityModel->getUniIdByName($data['university']);


        if ($this->opportunityModel->addOpportunity($data)) {
          // flash('event_message', "Event Added Successfully");
          $admins = $this->userModel->getAdminsEmails();

          foreach ($admins as $admin) {

            $to = $admin->secondary_email;
            $sender = 'developer.unihub@gmail.com';
            $mail_subject = 'New Opportunity Added - Review Required:' . $data['opportunity_title'];

            // Initialize $email_body properly and append to it
            $email_body = '<p>Hello,</p>';
            $email_body .= '<p>A new opportunity has been added and requires your attention.<br>Please review the opportunity details and take necessary actions.</p>';
            $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

            $header = "From: {$sender}\r\n";
            $header .= "Content-Type: text/html;";

            $send_mail_result = mail($to, $mail_subject, $email_body, $header);
          }

          $to = $data['contact_email'];
          $sender = 'developer.unihub@gmail.com';
          $mail_subject = 'Opportunity request Under Approval: ' . $data['opportunity_title'];

          // Initialize $email_body properly and append to it
          $email_body = '<p>Hello,</p>';
          $email_body .= '<p>We have received your job opportunity submission, ' . $data['opportunity_title'] . ' and it is currently under review by our team.</p>';
          $email_body .= '<p>For any further inquiries or information, please don t hesitate to contact us</p>';
          $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

          $header = "From: {$sender}\r\n";
          $header .= "Content-Type: text/html;";

          $send_mail_result = mail($to, $mail_subject, $email_body, $header);
          redirect('opportunities');
        }
      } else {
        //load view with error
        $this->view('opportunities/opportunity-add', $data);

      }


    } else {
      // Init data
      $data = [
        'opportunity_title' => '',
        'organization_name' => '',
        'contact_person' => '',
        'contact_email' => '',
        'contact_phone' => '',
        'opportunity_type' => '',
        'working_type' => '',
        'title_positions' => '',
        'tags' => '',
        'description' => '',
        'qualifications' => '',
        'additional_information' => '',
        'application_deadline' => '',
        'website_url' => '',
        'linkedin' => '',
        'opportunity_card_image' => '',
        'opportunity_cover_image' => '',
        'description_image' => '',


        'opportunity_title_err' => '',
        'organization_name_err' => '',
        'contact_person_err' => '',
        'contact_email_err' => '',
        'contact_phone_err' => '',
        'opportunity_type_err' => '',
        'working_type_err' => '',
        'title_positions_err' => '',
        'tags_err' => '',
        'description_err' => '',
        'qualifications_err' => '',
        'additional_information_err' => '',
        'application_deadline_err' => '',
        'website_url_err' => '',
        'linkedin_err' => '',
        'opportunity_card_image_err' => '',
        'opportunity_cover_image_err' => '',
        'description_image_err' => '',

      ];

      // Load view
      $this->view('opportunities/opportunity-add', $data);
    }
  }

  public function searchOpportunities()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $opportunities = $this->opportunityModel->searchOpportunitiesByKeyword($_POST);

      $data = [
        'opportunities' => $opportunities,
      ];

      $this->view('opportunities/filter-opportunities', $data);

    }
  }

  public function quickShortcut()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo $_POST['value'];

      $opportunities = $this->opportunityModel->getOpportuntiesByShortcut($_POST);

      $data = [
        'opportunities' => $opportunities,
      ];

      $this->view('opportunities/filter-opportunities', $data);

    }
  }

  public function addBookmark()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $opportunity_id = $_POST['opportunity_id'];
      $user_id = $_POST['user_id'];
      if ($user_id == null) {
        echo 0;
      }
      $data = [
        'opportunity_id' => $opportunity_id,
        'user_id' => $user_id
      ];
      if (!$this->opportunityModel->checkUserOpportunityBookmark($data)) {
        if ($status = $this->opportunityModel->addUserOpportunityBookmark($data)) {
          echo $status;
        }
      } else {
        $this->opportunityModel->deleteUserOpportunityBookmark($data);
        echo 0;
      }

    }
  }

  public function checkUserOpportunityBookmark()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $opportunity_id = $_POST['opportunity_id'];
      $user_id = $_POST['user_id'];
      $data = [
        'opportunity_id' => $opportunity_id,
        'user_id' => $user_id
      ];
      if ($this->opportunityModel->checkUserOpportunityBookmark($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function settings($id)
  {
    $data = [
      'id' => $id,
    ];
    $this->view('opportunities/settings', $data);

  }


  public function updateOpportunity($id)
  {

    $opportunity = $this->opportunityModel->getOpportunityById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $website_url = trim($_POST['website_url']);
      $linkedin = trim($_POST['linkedin']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'id' => $id,
        'opportunity_title' => trim($_POST['opportunity_title']),
        'organization_name' => trim($_POST['organization_name']),
        'contact_person' => trim($_POST['contact_person']),
        'contact_email' => trim($_POST['contact_email']),
        'contact_phone' => trim($_POST['contact_phone']),
        'opportunity_type' => trim($_POST['opportunity_type']),
        'working_type' => trim($_POST['working_type']),
        'title_positions' => trim($_POST['title_positions']),
        'tags' => trim($_POST['tags']),
        'description' => trim($_POST['description']),
        'qualifications' => trim($_POST['qualifications']),
        'additional_information' => trim($_POST['additional_information']),
        'application_deadline' => trim($_POST['application_deadline']),
        'website_url' => $website_url,
        'linkedin' => $linkedin,
        'opportunity_card_image' => $opportunity->opportunity_card_image,
        'opportunity_cover_image' => $opportunity->opportunity_cover_image,
        'description_image' => $opportunity->description_image,


        'opportunity_title_err' => '',
        'organization_name_err' => '',
        'contact_person_err' => '',
        'contact_email_err' => '',
        'contact_phone_err' => '',
        'opportunity_type_err' => '',
        'working_type_err' => '',
        'title_positions_err' => '',
        'tags_err' => '',
        'description_err' => '',
        'qualifications_err' => '',
        'additional_information_err' => '',
        'application_deadline_err' => '',
        'website_url_err' => '',
        'linkedin_err' => '',
        'opportunity_card_image_err' => '',
        'opportunity_cover_image_err' => '',
        'description_image_err' => '',

      ];



      if (empty($data['opportunity_title'])) {
        $data['opportunity_title_err'] = 'Pleae enter the opportunity title';
      }
      if (empty($data['organization_name'])) {
        $data['organization_name_err'] = 'Pleae select the organization name';
      }
      if (empty($data['contact_person'])) {
        $data['contact_person_err'] = 'Pleae enter the contact person name';
      }
      if (empty($data['contact_email'])) {
        $data['contact_email_err'] = 'Pleae enter the contact email address';
      }
      if (empty($data['contact_phone'])) {
        $data['contact_phone_err'] = 'Pleae enter the contact phone number';
      }
      if (empty($data['opportunity_type'])) {
        $data['opportunity_type_err'] = 'Pleae enter the opportunity type';
      }
      if (empty($data['working_type'])) {
        $data['working_type_err'] = 'Pleae enter the working type';
      }
      if (empty($data['title_positions'])) {
        $data['title_positions_err'] = 'Pleae add the title positions';
      }
      if (empty($data['tags'])) {
        $data['tags_err'] = 'Pleae add at least one tag';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }
      if (empty($data['qualifications'])) {
        $data['qualifications_err'] = 'Pleae enter qualifications';
      }
      if (empty($data['application_deadline'])) {
        $data['application_deadline_err'] = 'Pleae enter the application deadline';
      }
      if (empty($data['website_url'])) {
        $data['website_url_err'] = 'Pleae enter the website url';
      }
      if (empty($data['linkedin'])) {
        $data['linkedin_err'] = 'Pleae enter the linkedin';
      }




      // Make sure errors are empty
      if (
        empty($data['opportunity_title_err'])
        && empty($data['organization_name_err'])
        && empty($data['contact_person_err'])
        && empty($data['contact_email_err'])
        && empty($data['contact_phone_err'])
        && empty($data['opportunity_type_err'])
        && empty($data['working_type_err'])
        && empty($data['title_positions_err'])
        && empty($data['tags_err'])
        && empty($data['description_err'])
        && empty($data['qualifications_err'])
        && empty($data['application_deadline_err'])
        && empty($data['website_url_err'])
        && empty($data['linkedin_err'])

      ) {
        //Validated

        //event-profile image adding
        if (isset($_FILES['opportunity_card_image']['name']) and !empty($_FILES['opportunity_card_image']['name'])) {


          $img_name = $_FILES['opportunity_card_image']['name'];
          $tmp_name = $_FILES['opportunity_card_image']['tmp_name'];
          $error = $_FILES['opportunity_card_image']['error'];

          // if($error === 0){
          //    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          //    $img_ex_to_lc = strtolower($img_ex);

          //    $allowed_exs = array('jpg', 'jpeg', 'png');
          //    if(in_array($img_ex_to_lc, $allowed_exs)){
          //       $new_img_name = $data['event_title'] . '-event-profile-image.' . $img_ex_to_lc;
          //       $img_upload_path = "../public/img/event-profile-images/".$new_img_name;
          //       move_uploaded_file($tmp_name, $img_upload_path);

          //       $data['event_profile_image']=$new_img_name;
          //    }
          // }
          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['opportunity_title'] . '_opportunity_card_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/opportunities/opportunities_card_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['opportunity_card_image'] = $new_img_name;
            }
          }
        }


        //event-cover image adding
        if (isset($_FILES['opportunity_cover_image']['name']) and !empty($_FILES['opportunity_cover_image']['name'])) {


          $img_name = $_FILES['opportunity_cover_image']['name'];
          $tmp_name = $_FILES['opportunity_cover_image']['tmp_name'];
          $error = $_FILES['opportunity_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['opportunity_title'] . '_opportunity_cover_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/opportunities/opportunities_cover_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['opportunity_cover_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['description_image']['name']) and !empty($_FILES['description_image']['name'])) {


          $img_name = $_FILES['description_image']['name'];
          $tmp_name = $_FILES['description_image']['tmp_name'];
          $error = $_FILES['description_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['opportunity_title'] . '_description_image_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/opportunities/description_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['description_image'] = $new_img_name;
            }
          }
        }


        // $data['category_id'] = $this->categoryModel->getCategoryIdByName($data['category']);
        // if (!empty($data['categories'])) {
        //   // Convert array of category names to category IDs
        //   $category_ids = [];
        //   foreach ($data['categories'] as $category_name) {
        //     $category_id = $this->categoryModel->getCategoryIdByName($category_name);
        //     if ($category_id !== false) {
        //       $category_ids[] = $category_id;
        //     }
        //   }
        //   $data['category_ids'] = $category_ids;
        // }
        // $data['university_id'] = $this->universityModel->getUniIdByName($data['university']);


        if ($this->opportunityModel->updateOpportunity($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('opportunities');
        }
      } else {
        //load view with error
        $this->view('opportunities/opportunity-update', $data);

      }


    } else {
      // Init data
      $opportunity = $this->opportunityModel->getOpportunityById($id);
      // Concatenate tags into one string separated by commas

      // Prepare the data array
      $data = [
        'id' => $id,
        'opportunity_title' => $opportunity->opportunity_title,
        'organization_name' => $opportunity->organization_name,
        'contact_person' => $opportunity->contact_person,
        'contact_email' => $opportunity->contact_email,
        'contact_phone' => $opportunity->contact_phone,
        'opportunity_type' => $opportunity->opportunity_type,
        'working_type' => $opportunity->working_type,
        'title_positions' => $opportunity->title_positions,
        'tags' => $opportunity->tags, // Concatenated tags string
        'description' => $opportunity->description,
        'qualifications' => $opportunity->qualifications,
        'additional_information' => $opportunity->additional_information,
        'application_deadline' => $opportunity->application_deadline,
        'website_url' => $opportunity->website_url,
        'linkedin' => $opportunity->linkedin,
        'opportunity_card_image' => $opportunity->opportunity_card_image,
        'opportunity_cover_image' => $opportunity->opportunity_cover_image,
        'description_image' => $opportunity->description_image,

        'opportunity_title_err' => '',
        'organization_name_err' => '',
        'contact_person_err' => '',
        'contact_email_err' => '',
        'contact_phone_err' => '',
        'opportunity_type_err' => '',
        'working_type_err' => '',
        'title_positions_err' => '',
        'tags_err' => '',
        'description_err' => '',
        'qualifications_err' => '',
        'additional_information_err' => '',
        'application_deadline_err' => '',
        'website_url_err' => '',
        'linkedin_err' => '',
        'opportunity_card_image_err' => '',
        'opportunity_cover_image_err' => '',
        'description_image_err' => '',
      ];

      // Load view
      $this->view('opportunities/opportunity-update', $data);
    }
  }

  public function deleteOpportunity()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $id = $_POST['opportunityId'];

      if ($this->opportunityModel->deleteOpportunityById($id)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function filterOpportunitiesByApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $opportunities = $this->opportunityModel->getFilterOpportunities($_POST);

      $data = [
        'opportunities' => $opportunities,
      ];

      $this->view('users/admin/opportunityApprovalfilter', $data);

    }
  }

  public function filterOpportunities()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $opportunities = $this->opportunityModel->getFilterOpportunities($_POST);

      $data = [
        'opportunities' => $opportunities,
      ];

      $this->view('users/admin/opportunityfilter', $data);

    }
  }

  public function changeApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $opportunityId = $_POST['opportunityId'];
      $selectedOpportunityApproval = $_POST['selectedOpportunityApproval'];
      $data = [
        'opportunityId' => $opportunityId,
        'selectedOpportunityApproval' => $selectedOpportunityApproval,
      ];

      if ($this->opportunityModel->changeApproval($data)) {

        $opp = $this->opportunityModel->getOpportunityById($opportunityId);
        $email = $opp->contact_email;

        $to = $email;
        $sender = 'developer.unihub@gmail.com';
        $mail_subject = 'Post ' . $selectedOpportunityApproval . ': ' . $opp->opportunity_title;

        // Initialize $email_body properly and append to it
        $email_body = '<p>Hello,</p>';
        $email_body .= '<p>Your opportunity has been ' . $selectedOpportunityApproval . ' . Thank you for your submission.</p>';
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

  public function changeActivation()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $opportunityId = $_POST['opportunityId'];
      $data = [
        'opportunityId' => $opportunityId
      ];

      if ($this->opportunityModel->checkStatusByOpportunityId($opportunityId) == true) {
        if ($this->opportunityModel->deactivateOpportunityById($opportunityId)) {
          echo 'deactivated';
        }
      } else {
        if ($this->opportunityModel->activateOpportunityById($opportunityId)) {
          echo 'activated';
        }
      }

    }

  }

  public function filterByUserId()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $userId = $_POST['userId'];
      $opportunities = $this->opportunityModel->filterByUserId($userId);

      $data = [
        'opportunities' => $opportunities,
      ];


      $this->view('opportunities/filter-opportunities', $data);

    }
  }


}

