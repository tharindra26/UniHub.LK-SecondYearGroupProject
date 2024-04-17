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

      $navigation = trim($_POST['map_navigation']);
      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'title' => trim($_POST['title']),
        'university' => (trim($_POST['university']) == 'Select University' ? '' : trim($_POST['university'])),
        'organized_by' => trim($_POST['organized_by']),
        'venue' => trim($_POST['venue']),
        'email' => trim($_POST['email']),
        'contact_number' => trim($_POST['contact_number']),
        'map_navigation' => $navigation,
        'start_datetime' => trim($_POST['start_datetime']),
        'end_datetime' => trim($_POST['end_datetime']),
        'description' => trim($_POST['description']),
        'category' => trim($_POST['category']),
        'event_profile_image' => '',
        'event_cover_image' => '',

        'title_err' => '',
        'university_err' => '',
        'organized_by_err' => '',
        'venue_err' => '',
        'email_err' => '',
        'contact_number_err' => '',
        'map_navigation_err' => '',
        'start_datetime_err' => '',
        'end_datetime_err' => '',
        'description_err' => '',
        'category_err' => '',
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',

      ];



      if (empty($data['title'])) {
        $data['title_err'] = 'Pleae enter event title';
      }
      if (empty($data['university'])) {
        $data['university_err'] = 'Pleae select the university';
      }
      if (empty($data['organized_by'])) {
        $data['organized_by_err'] = 'Pleae enter the organization entity';
      }
      if (empty($data['venue'])) {
        $data['venue_err'] = 'Pleae enter the venue';
      }
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter the email';
      }
      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Pleae enter the contact number';
      }
      if (empty($data['map_navigation'])) {
        $data['map_navigation_err'] = 'Pleae enter the embed Google map link';
      }
      if (empty($data['start_datetime'])) {
        $data['start_datetime_err'] = 'Pleae enter the starting date & time';
      }
      if (empty($data['end_datetime'])) {
        $data['end_datetime_err'] = 'Pleae enter the ending date & time';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }
      if (empty($data['category'])) {
        $data['category_err'] = 'Pleae enter the event category';
      }



      // Make sure errors are empty
      if (empty($data['title_err']) && empty($data['university_err']) && empty($data['organized_by_err']) && empty($data['map_navigation_err']) && empty($data['start_datetime_err']) && empty($data['end_datetime_err']) && empty($data['description_datetime_err']) && empty($data['category_err'])) {
        //Validated

        //event-card image adding
        if (isset($_FILES['event_profile_image']['name']) and !empty($_FILES['event_profile_image']['name'])) {


          $img_name = $_FILES['event_profile_image']['name'];
          $tmp_name = $_FILES['event_profile_image']['tmp_name'];
          $error = $_FILES['event_profile_image']['error'];

          // if($error === 0){
          //    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          //    $img_ex_to_lc = strtolower($img_ex);

          //    $allowed_exs = array('jpg', 'jpeg', 'png');
          //    if(in_array($img_ex_to_lc, $allowed_exs)){
          //       $new_img_name = $data['event_title'] . '-event-card-image.' . $img_ex_to_lc;
          //       $img_upload_path = "../public/img/event-card-images/".$new_img_name;
          //       move_uploaded_file($tmp_name, $img_upload_path);

          //       $data['event_card_image']=$new_img_name;
          //    }
          // }
          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['title'] . '_event_profile_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/events/events_profile_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['event_profile_image'] = $new_img_name;
            }
          }
        }


        //event-cover image adding
        if (isset($_FILES['event_cover_image']['name']) and !empty($_FILES['event_cover_image']['name'])) {


          $img_name = $_FILES['event_cover_image']['name'];
          $tmp_name = $_FILES['event_cover_image']['tmp_name'];
          $error = $_FILES['event_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['title'] . '_event_cover_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/events/events_cover_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['event_cover_image'] = $new_img_name;
            }
          }
        }


        $data['category_id'] = $this->categoryModel->getCategoryIdByName($data['category']);
        $data['university_id'] = $this->universityModel->getUniIdByName($data['university']);

        if ($this->eventModel->addEvent($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('events');
        }
      } else {
        //load view with error
        $this->view('events/event-add', $data);

      }


    } else {
      // Init data
      $data = [
        'title' => '',
        'university' => '',
        'organized_by' => '',
        'venue' => '',
        'email' => '',
        'contact_number' => '',
        'map_navigation' => '',
        'start_datetime' => '',
        'end_datetime' => '',
        'description' => '',
        'category' => '',
        'event_profile_image' => '',
        'event_cover_image' => '',

        'title_err' => '',
        'university_err' => '',
        'organized_by_err' => '',
        'venue_err' => '',
        'email_err' => '',
        'contact_number_err' => '',
        'map_navigation_err' => '',
        'start_datetime_err' => '',
        'end_datetime_err' => '',
        'description_err' => '',
        'category_err' => '',
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',

      ];

      // Load view
      $this->view('events/event-add', $data);
    }
  }
}
  


