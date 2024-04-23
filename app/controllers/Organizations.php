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
        'university' => (trim($_POST['university']) == 'Select University' ? '' : trim($_POST['university'])),
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'website_url' => trim($_POST['website_url']),
        'contact_email' => trim($_POST['contact_email']),
        'contact_number' => trim($_POST['contact_number']),
        'instagram' => trim($_POST['instagram']),
        'facebook' => trim($_POST['facebook']),
        'linkedin' => trim($_POST['linkedin']),
        'number_of_members' => trim($_POST['number_of_members']),
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
        $data['contact_email_err'] = 'Please enter the contact email';
      }

      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Please enter the contact number';
      }


      if (empty($data['number_of_members'])) {
        $data['number_of_members_err'] = 'Please enter the number of members';
      }

      
      ;
      // Make sure errors are empty
      if (
        empty($data['organization_name_err']) &&
        empty($data['short_caption_err']) &&
        empty($data['description_err']) &&
        empty($data['categories_err']) &&
        empty($data['website_url_err']) &&
        empty($data['contact_email_err']) &&
        empty($data['contact_number_err']) &&
        empty($data['number_of_members_err'])
      ) {
        //Validated
        
        //organization-profile image adding
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

        
        if ($this->organizationModel->addOrganization($data)) {
          // flash('event_message', "Event Added Successfully");
          
          redirect('organizations');
        }
      } else {
        //load view with error
        $data['universities']=$universities;
        $data['organizationCategories']=$organizationCategories;
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
      $data['universities']=$universities;
      $data['organizationCategories']=$organizationCategories;
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

  public function show($id) 
  {
    $organization = $this->organizationModel->getOrganizationById($id);
    $organization_activties = $this->organizationModel->getActivitiesByOrganizationId($id);
    // $organizationAccount = $this->userModel->getUserByEmail($organization->contact_email);
    // $events = $this->eventModel->getEventById($id);
    $data = [
      'organization' => $organization,
      'organization_activities' => $organization_activties,
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

  public function totalOrgFilter(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize post data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $type = $_POST['value'];

    if($type == "all"){
      $organizations = $this->organizationModel->getAllOrganizations();
    }
   

    $data = [
      'organizations' => $organizations,
    ];

    $this->view('users/admin/organizationfilter', $data);

  }
  }


}



