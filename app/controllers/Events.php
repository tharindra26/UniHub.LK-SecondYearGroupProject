<?php
class Events extends Controller
{
  public $eventModel;
  public $userModel;
  public $categoryModel;
  public $universityModel;
  public function __construct()
  {
    // if(!isLoggedIn()){
    //     redirect('/users/login');
    // }

    //test comment

    $this->eventModel = $this->model('Event');
    $this->userModel = $this->model('User');
    $this->categoryModel = $this->model('Category');
    $this->universityModel = $this->model('University');
  }
  public function index()
  {
    // $events= $this->eventModel->getEvents();
    $data = [
      // 'events'=> $events
    ];

    $this->view('events/events-index', $data);
  }

  public function add()
  {

    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      $navigation = trim($_POST['map_navigation']);
      $web = trim($_POST['web']);
      $linkedin = trim($_POST['linkedin']);
      $facebook = trim($_POST['facebook']);
      $instagram = trim($_POST['instagram']);

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
        'web' => $web,
        'linkedin' => $linkedin,
        'facebook' => $facebook,
        'instagram' => $instagram,
        'map_navigation' => $navigation,
        'start_datetime' => trim($_POST['start_datetime']),
        'end_datetime' => trim($_POST['end_datetime']),
        'description' => trim($_POST['description']),
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'event_profile_image' => '',
        'event_cover_image' => '',

        'title_err' => '',
        'university_err' => '',
        'organized_by_err' => '',
        'venue_err' => '',
        'email_err' => '',
        'contact_number_err' => '',
        'web_err' => '',
        'linkedin_err' => '',
        'facebook_err' => '',
        'instagram_err' => '',
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
      // Check if categories are empty
      if (empty($data['categories'])) {
        $data['category_err'] = 'Please select at least one category';
      }



      // Make sure errors are empty
      if (empty($data['title_err']) && empty($data['university_err']) && empty($data['organized_by_err']) && empty($data['map_navigation_err']) && empty($data['start_datetime_err']) && empty($data['end_datetime_err']) && empty($data['description_datetime_err']) && empty($data['category_err'])) {
        //Validated

        //event-profile image adding
        if (isset($_FILES['event_profile_image']['name']) and !empty($_FILES['event_profile_image']['name'])) {


          $img_name = $_FILES['event_profile_image']['name'];
          $tmp_name = $_FILES['event_profile_image']['tmp_name'];
          $error = $_FILES['event_profile_image']['error'];
          
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


        // $data['category_id'] = $this->categoryModel->getCategoryIdByName($data['category']);
        if (!empty($data['categories'])) {
          // Convert array of category names to category IDs
          $category_ids = [];
          foreach ($data['categories'] as $category_name) {
            $category_id = $this->categoryModel->getCategoryIdByName($category_name);
            if ($category_id !== false) {
              $category_ids[] = $category_id;
            }
          }
          $data['category_ids'] = $category_ids;
        }
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
        'web' => '',
        'linkedin' => '',
        'facebook' => '',
        'instagram' => '',
        'map_navigation' => '',
        'start_datetime' => '',
        'end_datetime' => '',
        'description' => '',
        'categories' => [],
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
        'event_title' => trim($_POST['event_title']),
        'event_type' => trim($_POST['event_type']),
        'description' => trim($_POST['description']),
        'date' => trim($_POST['date']),
        'location' => trim($_POST['location']),
        'event_profile_image' => trim($_POST['event_profile_image']),
        'event_cover_image' => trim($_POST['event_cover_image']),
        'event_title_err' => '',
        'event_type_err' => '',
        'description_err' => '',
        'date_err' => '',
        'location_err' => '',
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',

      ];


      if (empty($data['event_title'])) {
        $data['event_title_err'] = 'Pleae enter event title';
      }

      if (empty($data['event_type'])) {
        $data['event_type_err'] = 'Pleae enter event type';
      }

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter event description';
      }

      if (empty($data['date'])) {
        $data['date_err'] = 'Pleae enter date';
      }

      if (empty($data['location'])) {
        $data['location_err'] = 'Pleae enter location';
      }



      // Make sure errors are empty
      if (empty($data['event_title_err']) && empty($data['event_type_err']) && empty($data['description_err']) && empty($data['date_err']) && empty($data['location_err'])) {
        //Validated
        if (isset($_FILES['event_profile_image']['name']) and !empty($_FILES['event_profile_image']['name'])) {


          $img_name = $_FILES['event_profile_image']['name'];
          $tmp_name = $_FILES['event_profile_image']['tmp_name'];
          $error = $_FILES['event_profile_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['event_title'] . '-event-profile-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/event-profile-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['event_profile_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['event_cover_image']['name']) and !empty($_FILES['event_cover_image']['name'])) {


          $img_name = $_FILES['event_cover_image']['name'];
          $tmp_name = $_FILES['event_cover_image']['tmp_name'];
          $error = $_FILES['event_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['event_title'] . '-event-cover-image.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/event-cover-images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['event_cover_image'] = $new_img_name;
            }
          }
        }

        if ($this->eventModel->updateEvent($data)) {
          flash('event_message', "Event Updated Successfully");
          redirect('events');
        }
      } else {

        //load view with error
        $this->view('events/events-edit', $data);

      }


    } else {
      //get existing post from model
      $event = $this->eventModel->getEventById($id);

      //check for owner
      if ($event->user_id != $_SESSION['user_id']) {
        redirect('events');
      }
      // Init data
      $data = [
        'id' => $id,
        'event_title' => $event->title,
        'event_type' => $event->type,
        'description' => $event->description,
        'date' => $event->date,
        'location' => $event->location,
        'event_profile_image' => '',
        'event_cover_image' => $event->event_cover_image,
        'event_title_err' => '',
        'event_type_err' => '',
        'description_err' => '',
        'date_err' => '',
        'location_err' => '',
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',

      ];

      // Load view
      $this->view('events/events-edit', $data);
    }
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Get existing post from model
      $event = $this->eventModel->getEventById($id);

      // Check for owner
      if ($event->user_id != $_SESSION['user_id']) {
        redirect('events');
      }

      if ($this->eventModel->deleteEvent($id)) {
        flash('event_message', 'Event Removed');
        redirect('events');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('events');
    }
  }

  public function deactivateEvent()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $event_id = $_POST['event_id'];
      $data = [
        'event_id' => $event_id
      ];
      if ($this->userModel->DeactivateEvent($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function activateEvent()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $event_id = $_POST['event_id'];
      $data = [
        'event_id' => $event_id
      ];
      if ($this->userModel->activateEvent($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function show($id) 
  {
    $event = $this->eventModel->getEventById($id);
    $announcements = $this->eventModel->getAnnouncementsByEventId($id);
    $user = $this->userModel->getUserById($event->user_id);
    $reviews = $this->eventModel->getReviewsByEventId($id);
    $data = [
      'event' => $event,
      'user' => $user,
      'announcements' => $announcements,
      'reviews' => $reviews
    ];
    $this->view('events/event-show', $data);
  }

  public function searchEvents()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $events = $this->eventModel->getEventsBySearch($_POST);

      $data = [
        'events' => $events,
      ];

      $this->view('events/filter-events', $data);

    }
  }

  public function filterEvents()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $events = $this->eventModel->getFilterEvents($_POST);

      $data = [
        'events' => $events,
      ];

      $this->view('users/admin/eventfilter', $data);

    }
  }

  public function approvalFilter(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      $approvalType = $_POST['type'];

      if($approvalType == ""){
        $events = $this->eventModel->getAllEvents();
      }else{
        $events = $this->eventModel->getEventsByApprovalType($approvalType);
      }

      $data = [
        'events' => $events,
      ];

      $this->view('users/admin/eventfilter', $data);

    }
  }

  public function statusFilter(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();
      $events = [];
      $status = $_POST['status'];

      if($status == ""){
        $events = $this->eventModel->getAllEvents();
      }elseif($status == "active"){
        $events = $this->eventModel->getActiveEvents();
      }elseif($status == "deactived"){
        $events = $this->eventModel->getDeactivedEvents();
      }

      $data = [
        'events' => $events,
      ];

      $this->view('users/admin/eventfilter', $data);

    }
  }

  public function dueEventsFilterilter(){
    // Sanitize post data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // var_dump($_POST);
    // die();

    $type = $_POST['value'];

    if($type == "all"){
      $events = $this->eventModel->getAllEvents();
    }
    elseif($type == "ongoing"){
      $events = $this->eventModel->getOngoingEvents($type);
    }
    elseif($type == "due"){
      $events = $this->eventModel->getDueEvents($type);
    }

    $data = [
      'events' => $events,
    ];

    $this->view('users/admin/eventfilter', $data);

  }
  

  public function checkEventParticipation()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $event_id = $_POST['event_id'];
      $user_id = $_POST['user_id'];
      $data = [
        'event_id' => $event_id,
        'user_id' => $user_id
      ];
      if ($this->eventModel->checkUserInterest($data)) {
        echo 1;
      } else {
        echo 0;
      }

    }
  }

  public function changeEventInterest()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $event_id = $_POST['event_id'];
      $user_id = $_POST['user_id'];
      $data = [
        'event_id' => $event_id,
        'user_id' => $user_id
      ];
      if (!$this->eventModel->checkUserInterest($data)) {
        if ($status = $this->eventModel->addUserInterest($data)) {
          echo $status;
        }
      } else {
        $this->eventModel->deleteUserInterest($data);
        echo 0;
      }

    }
  }

  public function settings($id)
  {
    $data = [
      'id' => $id,
    ];
    $this->view('events/settings', $data);

  }

  public function addAnnouncement($id)
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
        'announcement' => trim($_POST['announcement']),
        'sharingOption' => trim($_POST['sharingOption']),
        'announcement_err' => '',
        'sharingOption_err' => '',
        'user_id' => $_SESSION['user_id'],
        'event_id' => $id,

      ];




      if (empty($data['announcement'])) {
        $data['announcement_err'] = 'Pleae enter the announcement';
      }
      if (empty($data['sharingOption'])) {
        $data['sharingOption_err'] = 'Pleae select a option';
      }



      // Make sure errors are empty
      if (empty($data['announcement_err']) && empty($data['sharingOption_err'])) {

        //Validated


        if ($this->eventModel->addAnnouncement($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('events/settings/' . $id);
        }
      } else {
        //load view with error
        $this->view('events/add-announcement', $data);

      }



    } else {
      // Init data
      $data = [
        'announcement' => '',
        'sharingOption' => '',
        'announcement_err' => '',
        'sharingOption_err' => '',
        'event_id' => $id,
      ];

      // Load view
      $this->view('events/add-announcement', $data);
    }

  }


  public function editContactDetails($id)
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $web = trim($_POST['web']);
      $email = trim($_POST['email']);
      $linkedin = trim($_POST['linkedin']);
      $facebook = trim($_POST['facebook']);
      $instagram = trim($_POST['instagram']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'organized_by' => trim($_POST['organized_by']),
        'contact_number' => trim($_POST['contact_number']),
        'web' => $web,
        'email' => $email,
        'linkedin' => $linkedin,
        'facebook' => $facebook,
        'instagram' => $instagram,

        'organized_by_err' => '',
        'web_err' => '',
        'email_err' => '',
        'linkedin_err' => '',
        'facebook_err' => '',
        'instagram_err' => '',

      ];




      if (empty($data['organized_by'])) {
        $data['organized_by_err'] = 'Pleae enter the organization entity';
      }

      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter the email';
      }
      if (empty($data['contact_number'])) {
        $data['contact_number_err'] = 'Pleae enter the contact number';
      }



      // Make sure errors are empty
      if (empty($data['organized_by_err']) && empty($data['contact_number_err']) && empty($data['email_err'])) {
        //Validated
        if ($this->eventModel->updateContactDetails($data)) {
          redirect('events/show/' . $id);
        }


      } else {

        //load view with errors
        $this->view('events/editContactDetails', $data);

      }


    } else {
      //get existing post from model
      $event = $this->eventModel->getEventById($id);

      // Init data
      $data = [
        'id' => $id,
        'organized_by' => $event->organized_by,
        'email' => $event->email,
        'contact_number' => $event->contact_number,
        'web' => $event->web,
        'linkedin' => $event->linkedin,
        'facebook' => $event->facebook,
        'instagram' => $event->instagram,

        'organized_by_err' => '',
        'email_err' => '',
        'contact_number_err' => '',
        'web_err' => '',
        'linkedin_err' => '',
        'facebook_err' => '',
        'instagram_err' => '',

      ];

      // Load view
      $this->view('events/editContactDetails', $data);
    }
  }

  public function editPlacement($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $map_navigation = trim($_POST['map_navigation']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'venue' => trim($_POST['venue']),
        'start_datetime' => trim($_POST['start_datetime']),
        'end_datetime' => trim($_POST['end_datetime']),
        'map_navigation' => $map_navigation,


        'venue_err' => '',
        'start_datetime_err' => '',
        'end_datetime_err' => '',
        'map_navigation_err' => '',


      ];




      if (empty($data['venue'])) {
        $data['venue_err'] = 'Pleae enter the venue';
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



      // Make sure errors are empty
      if (empty($data['venue_err']) && empty($data['map_navigation_err']) && empty($data['start_datetime_err']) && empty($data['end_datetime_err'])) {
        //Validated
        if ($this->eventModel->updatePlacementDetails($data)) {

          redirect('events/show/' . $id);
        }


      } else {

        //load view with errors
        $this->view('events/editPlacement', $data);

      }


    } else {
      //get existing post from model
      $event = $this->eventModel->getEventById($id);

      // Init data
      $data = [
        'id' => $id,
        'venue' => $event->venue,
        'start_datetime' => $event->start_datetime,
        'end_datetime' => $event->end_datetime,
        'map_navigation' => $event->map_navigation,


        'venue_err' => '',
        'start_datetime_err' => '',
        'end_datetime_err' => '',
        'map_navigation_err' => '',

      ];

      // Load view
      $this->view('events/editPlacement', $data);
    }
  }

  public function editDescription($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'description' => trim($_POST['description']),

        'description_err' => '',
      ];

      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }

      // Make sure errors are empty
      if (empty($data['description_err'])) {
        //Validated
        if ($this->eventModel->updateDescription($data)) {
          redirect('events/show/' . $id);
        }
      } else {
        //load view with errors
        $this->view('events/editDescription', $data);
      }
    } else {
      //get existing post from model
      $event = $this->eventModel->getEventById($id);
      // Init data
      $data = [
        'id' => $id,
        'description' => $event->description,

        'description_err' => '',
      ];
      // Load view
      $this->view('events/editDescription', $data);
    }
  }

  public function editCategories($id){
    $eventCategories = $this->eventModel->getEventCategoriesByEventId($id);
    $data= [
      'id' => $id,
      'eventCategories' => $eventCategories
    ];
    $this->view('events/editCategories', $data);
  }

  public function quickShortcut()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo $_POST['value'];

      $events = $this->eventModel->getEventsByShortcut($_POST);

      $data = [
        'events' => $events,
      ];

      $this->view('events/filter-events', $data);

    }
  }

  public function getEventCategories()
  {
    $eventCategories = $this->eventModel->getEventCategories();
    echo json_encode($eventCategories);
  }



  //change profile images

  public function editProfileImage($id)
  {

    $event = $this->eventModel->getEventById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'id' => $id,
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',

      ];

      if (isset($_POST['event_profile_image']) && !empty($_POST['event_profile_image'])) {
        // If it's set and not empty, trim any whitespace and assign it
        $data['$event_profile_image'] = trim($_POST['event_profile_image']);
      } else {
        // If it's not set or empty, assign a default value or handle the scenario accordingly
        $data['event_profile_image'] = $event->event_profile_image; // You can set a default value here if needed
      }

      if (isset($_POST['event_cover_image']) && !empty($_POST['event_cover_image'])) {
        // If it's set and not empty, trim any whitespace and assign it
        $data['$event_cover_image'] = trim($_POST['event_cover_image']);
      } else {
        // If it's not set or empty, assign a default value or handle the scenario accordingly
        $data['event_cover_image'] = $event->event_cover_image; // You can set a default value here if needed
      }




      if (empty($data['event_profile_image'])) {
        $data['event_profile_image_err'] = 'Pleae add a event profile image';
      }

      if (empty($data['event_cover_image'])) {
        $data['event_cover_image_err'] = 'Pleae add a event cover image';
      }

    
      // Make sure errors are empty
      if (empty($data['event_profile_image_err']) && empty($data['event_cover_image_err'])) {
        //Validated
        if (isset($_FILES['event_profile_image']['name']) and !empty($_FILES['event_profile_image']['name'])) {


          $img_name = $_FILES['event_profile_image']['name'];
          $tmp_name = $_FILES['event_profile_image']['tmp_name'];
          $error = $_FILES['event_profile_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $event->title . '_event_profile_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/events/events_profile_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['event_profile_image'] = $new_img_name;
            }
          }
        }

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


        $data['event_id'] = $event->id;
        if ($this->eventModel->updateEventProfileImage($data)) {
          // flash('event_message', "Event Updated Successfully");
          redirect('events/show/' . $event->id);
        }
      } else {

        //load view with error
        $data['id'] = $event->id;
        $this->view('events/events-edit', $data);

      }


    } else {
      //check for owner
      // if ($event->user_id != $_SESSION['user_id']) {
      //   redirect('events');
      // }
      // Init data
      $data = [
        'id' => $id,
        'event_profile_image' => $event->event_profile_image,
        'event_cover_image' => $event->event_cover_image,
        'event_profile_image_err' => '',
        'event_cover_image_err' => '',
      ];

      // Load view
      $this->view('events/editProfileImage', $data);
    }
  }

  public function addReview()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'event_id' => $_POST['event_id'],
        'user_id' => $_POST['user_id'],
        'comment' => $_POST['comment'],
        'rating' => $_POST['rating']
      ];

      if ($this->eventModel->addReview($data)) {
        echo true;
      } else {
        echo false;
      }

    }
  }

  public function deleteEventCategory(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $eventId = $_POST['eventId'];
      $categoryId = $_POST['categoryId'];

      $data=[
        'event_id' => $eventId,
        'category_id' => $categoryId
      ];

      if ($this->eventModel->deleteCategoryByEventIdCategoryId($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function addEventCategory(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $eventId = $_POST['eventId'];
      $category = $_POST['category'];

      $categoryId = $this->categoryModel->getCategoryIdByName($category);



      $data=[
        'eventId' => $eventId,
        'categoryId' => $categoryId
      ];

      if ($this->eventModel->addEventCategory($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function editCountdown($id){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form
      $main_button_link = trim($_POST['main_button_link']);

      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [

        'id' => $id,
        'main_button_action' => $_POST['main_button_action'],
        'main_button_link' => $main_button_link,
        'countdown_text' => $_POST['countdown_text'],
        'countdown_datetime' => $_POST['countdown_datetime'],


        'main_button_action_err' => '',
        'main_button_link_err' => '',
        'countdown_text_err' => '',
        'countdown_datetime_err' => '',


      ];




      if (empty($data['main_button_action'])) {
        $data['main_button_action_err'] = 'Pleae enter the main button action';
      }

      if (empty($data['countdown_text'])) {
        $data['countdown_text_err'] = 'Pleae enter the countdown text';
      }
      if (empty($data['countdown_datetime'])) {
        $data['countdown_datetime_err'] = 'Pleae enter the countdown date and time';
      }


      // Make sure errors are empty
      if (empty($data['main_button_action_err']) && empty($data['countdown_text_err']) && empty($data['start_datetime_err']) && empty($data['countdown_datetime_err'])) {
        //Validated
        if ($this->eventModel->updateCountdown($data)) {

          redirect('events/show/' . $id);
        }


      } else {

        //load view with errors
        $this->view('events/editCountdown', $data);

      }


    } else {
      //get existing post from model
      $event = $this->eventModel->getEventById($id);

      // Init data
      $data = [
        'id' => $id,
        'main_button_action' => $event->main_button_action,
        'main_button_link' => $event->main_button_link,
        'countdown_text' => $event->countdown_text,
        'countdown_datetime' => $event->countdown_datetime,


        'main_button_action_err' => '',
        'main_button_link_err' => '',
        'countdown_text_err' => '',
        'countdown_datetime_err' => '',

      ];

      // Load view
      $this->view('events/editCountdown', $data);
    }
  }

  public function editAnnouncements($id){
    $announcements = $this->eventModel->getAnnouncementsByEventId($id);
    $data=[
      'announcements'=> $announcements,
    ];
    $this->view('events/editAnnouncements', $data);
  }

  public function deleteAnnouncement(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $id = $_POST['announcementId'];

      if ($this->eventModel->deleteAnnouncementById($id)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function updateAnnouncement(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $id = $_POST['announcementId'];
      $announcementText = $_POST['announcementText'];

      $data =[
        'announcementId'=> $id,
        'announcementText' => $announcementText
      ];

      if ($this->eventModel->updateAnnouncementById($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }


}

