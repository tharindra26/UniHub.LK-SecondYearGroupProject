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
  }
  public function index()
  {
    //get Posts
    $organizations = $this->organizationModel->getOrganizations();
    // var_dump($organizations);
    // die();
    $data = [
      'organizations' => $organizations
    ];

    $this->view('organizations/organizations-index', $data);
  }

  public function add()
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
        'user_id' => trim($_POST['user_id']),
        'name' => trim($_POST['name']),
        'university' => trim($_POST['university']),
        'description' => trim($_POST['description']),
        'link' => trim($_POST['link']),
        'organization_card_image' => '',
        'organization_cover_image' => '',
        'user_id_err' => '',
        'name_err' => '',
        'university_err' => '',
        'description_err' => '',
        'link_err' => '',
        'organization_card_image_err' => '',
        'organization_cover_image_err' => '',

      ];


      if (empty($data['user_id'])) {
        $data['user_id_err'] = 'Pleae enter user id';
      }

      if (empty($data['name'])) {
        $data['name_err'] = 'Pleae enter organization name';
      }

      if (empty($data['university'])) {
        $data['university_err'] = 'Pleae enter university';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter organization description';
      }

      if (empty($data['link'])) {
        $data['link_err'] = 'Pleae enter link';
      }



      // Make sure errors are empty
      if (empty($data['user_id_err']) && empty($data['name_err']) && empty($data['university_err']) && empty($data['description_err']) && empty($data['link_err'])) {
        //Validated
        if (isset($_FILES['organization_card_image']['name']) and !empty($_FILES['organization_card_image']['name'])) {


          $img_name = $_FILES['organization_card_image']['name'];
          $tmp_name = $_FILES['organization_card_image']['tmp_name'];
          $error = $_FILES['organization_card_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['organization_title'] . '-organization-card-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/organization-card-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['organization_card_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['organization_cover_image']['name']) and !empty($_FILES['organization_cover_image']['name'])) {


          $img_name = $_FILES['organization_cover_image']['name'];
          $tmp_name = $_FILES['organization_cover_image']['tmp_name'];
          $error = $_FILES['organization_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['organization_title'] . '-organization-cover-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/organization-cover-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['organization_cover_image'] = $new_img_name;
            }
          }
        }



        if ($this->organizationModel->addOrganization($data)) {
          flash('event_message', "Organization Added Successfully");
          redirect('organizations');
        }
      } else {
        //load view with error
        $this->view('organizations/organizations-add', $data);

      }


    } else {
      // Init data
      $data = [
        'user_id' => '',
        'name' => '',
        'university' => '',
        'description' => '',
        'link' => '',
        'organization_card_image' => '',
        'organization_cover_image' => '',
        'user_id_err' => '',
        'name_err' => '',
        'university_err' => '',
        'description_err' => '',
        'link_err' => '',
        'organization_card_image_err' => '',
        'organization_cover_image_err' => '',

      ];

      // Load view
      $this->view('organizations/organizations-add', $data);
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
      var_dump($_POST);
      $data = [
        'id' => $id,
        'name' => trim($_POST['name']),
        'university' => trim($_POST['university']),
        'description' => trim($_POST['description']),
        'link' => trim($_POST['link']),
        'organization_card_image' => trim($_POST['organization_card_image']),
        'organization_cover_image' => trim($_POST['organization_cover_image']),
        'user_id_err' => '',
        'name_err' => '',
        'university_err' => '',
        'description_err' => '',
        'link_err' => '',
        'organization_card_image_err' => '',
        'organization_cover_image_err' => '',

      ];


      if (empty($data['user_id'])) {
        $data['user_id_err'] = 'Pleae enter user id';
      }

      if (empty($data['name'])) {
        $data['name_err'] = 'Pleae enter organization name';
      }

      if (empty($data['university'])) {
        $data['university_err'] = 'Pleae enter university';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter organization description';
      }

      if (empty($data['link'])) {
        $data['link_err'] = 'Pleae enter link';
      }



      // Make sure errors are empty
      if (empty($data['user_id_err']) && empty($data['name_err']) && empty($data['university_err']) && empty($data['description_err']) && empty($data['link_err'])) {
        //Validated
        if (isset($_FILES['organization_card_image']['name']) and !empty($_FILES['organization_card_image']['name'])) {


          $img_name = $_FILES['organization_card_image']['name'];
          $tmp_name = $_FILES['organization_card_image']['tmp_name'];
          $error = $_FILES['organization_card_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['organization_title'] . '-organization-card-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/organization-card-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['organization_card_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['organization_cover_image']['name']) and !empty($_FILES['organization_cover_image']['name'])) {


          $img_name = $_FILES['organization_cover_image']['name'];
          $tmp_name = $_FILES['organization_cover_image']['tmp_name'];
          $error = $_FILES['organization_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['organization_title'] . '-organization-cover-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/organization-cover-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['organization_cover_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['organization_cover_image']['name']) and !empty($_FILES['organization_cover_image']['name'])) {


          $img_name = $_FILES['organization_cover_image']['name'];
          $tmp_name = $_FILES['organization_cover_image']['tmp_name'];
          $error = $_FILES['organization_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['organization_title'] . '-organization-cover-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/organization-cover-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['organization_cover_image'] = $new_img_name;
            }
          }
        }

        if ($this->organizationModel->updateOrganization($data)) {
          flash('event_message', "Organization Updated Successfully");
          redirect('organizations');
        }
      } else {

        //load view with error
        $this->view('organizations/organizations-edit', $data);

      }


    } else {
      //get existing post from model
      $organization = $this->organizationModel->getOrganizationById($id);

      // //check for owner
      // if($organization->user_id != $_SESSION['user_id']){
      //   redirect('organizations');
      // }
      // Init data

      $data = [
        'id' => $organization->id,
        'user_id' => $organization->user_id,
        'name' => $organization->name,
        'university' => $organization->university,
        'description' => $organization->description,
        'link' => $organization->link,
        'organization_card_image' => $organization->organization_card_image,
        'organization_cover_image' => $organization->organization_cover_image,
        'user_id_err' => '',
        'name_err' => '',
        'university_err' => '',
        'description_err' => '',
        'link_err' => '',
        'organization_card_image_err' => '',
        'organization_cover_image_err' => '',

      ];

      // Load view
      $this->view('organizations/organizations-edit', $data);
    }
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Get existing post from model
      $organization = $this->organizationModel->getOrganizationById($id);

      //   // Check for owner
      //   if($event->user_id != $_SESSION['user_id']){
      //     redirect('events');
      //   }

      if ($this->organizationModel->deleteOrganization($id)) {
        flash('event_message', 'Organization Removed');
        redirect('organizations');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('organizations');
    }
  }

  public function show($id)
  {
    $organization = $this->organizationModel->getOrganizationById($id);
    $data = [
      'organization' => $organization,
    ];
    $this->view('organizations/organization-show', $data);
  }
}