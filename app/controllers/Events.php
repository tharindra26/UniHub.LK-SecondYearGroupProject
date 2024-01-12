<?php
    class Events extends Controller{
        public function __construct(){
            // if(!isLoggedIn()){
            //     redirect('/users/login');
            // }

            $this->eventModel =$this->model('Event');
            $this->userModel =$this->model('User');
        }
        public function index(){
            //get Posts
            // $events= $this->eventModel->getEvents();
            $data=[
                // 'events'=> $events
            ];

            $this->view('events/events-index', $data);
        }

        public function add(){

            //check the user is a registered user
            if(!isLoggedIn()){
                redirect('/users/login');
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //process form
                $navigation = trim($_POST['map_navigation']);
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                //Init data
                $data =[
                    'title' =>trim($_POST['title']),
                    'university' =>trim($_POST['university']),
                    'organized_by' =>trim($_POST['organized_by']),
                    'venue' =>trim($_POST['venue']),
                    //'map_navigation' =>trim($_POST['map_navigation']),
                    'email' =>trim($_POST['email']),
                    'contact_number' =>trim($_POST['contact_number']),
                    'map_navigation' => $navigation,
                    'start_datetime' =>trim($_POST['start_datetime']),
                    'end_datetime' =>trim($_POST['end_datetime']),
                    'description' =>trim($_POST['description']),
                    'category' =>trim($_POST['category']),
                    'event_profile_image' =>'',
                    'event_cover_image' =>'',

                    'title_err' =>'',
                    'university_err' =>'',
                    'organized_by_err' =>'',
                    'map_navigation_err' =>'',
                    'start_datetime_err' =>'',
                    'end_datetime_err' =>'',
                    'description_err' =>'',
                    'category_err' =>'',
                    'event_profile_image_err' =>'',
                    'event_cover_image_err' =>'',
                    
                ];
                
    
              
              if(empty($data['title'])){
                $data['title_err'] = 'Pleae enter event title';
              }
              if(empty($data['university'])){
                $data['university_err'] = 'Pleae select the university';
              }
              if(empty($data['organized_by'])){
                $data['organized_by_err'] = 'Pleae enter the organization entity';
              }
              if(empty($data['venue'])){
                $data['venue_err'] = 'Pleae enter the venue';
              }
              if(empty($data['map_navigation'])){
                $data['map_navigation_err'] = 'Pleae enter the embed Google map link';
              }
              if(empty($data['start_datetime'])){
                $data['start_datetime_err'] = 'Pleae enter the starting date & time';
              }
              if(empty($data['end_datetime'])){
                $data['end_datetime_err'] = 'Pleae enter the ending date & time';
              }
              if(empty($data['description'])){
                $data['description_err'] = 'Pleae enter the description';
              }
              if(empty($data['category'])){
                $data['category_err'] = 'Pleae enter the event category';
              }
              
              
      
                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['university_err']) && empty($data['organized_by_err']) && empty($data['map_navigation_err'])&& empty($data['start_datetime_err'])&& empty($data['end_datetime_err'])&& empty($data['description_datetime_err'])&& empty($data['category_err'])){
                    //Validated

                    //event-card image adding
                    if (isset($_FILES['event_profile_image']['name']) AND !empty($_FILES['event_profile_image']['name'])) {
         
         
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
                              $new_img_name = $data['title'].'_event_profile_' . time() . '.' . $img_ex_to_lc;
                              $img_upload_path = "../public/img/event-profile-images/" . $new_img_name;
                              move_uploaded_file($tmp_name, $img_upload_path);
                  
                              $data['event_profile_image'] = $new_img_name;
                          }
                      }
                    }


                    //event-cover image adding
                    if (isset($_FILES['event_cover_image']['name']) AND !empty($_FILES['event_cover_image']['name'])) {
         
         
                      $img_name = $_FILES['event_cover_image']['name'];
                      $tmp_name = $_FILES['event_cover_image']['tmp_name'];
                      $error = $_FILES['event_cover_image']['error'];
                      
                      if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            $new_img_name = $data['title'].'_event_cover_' . time() . '.' . $img_ex_to_lc;
                            $img_upload_path = "../public/img/event-cover-images/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['event_cover_image'] = $new_img_name;
                        }
                      }
                    }
                              


                    if($this->eventModel->addEvent($data)){
                        // flash('event_message', "Event Added Successfully");
                        redirect('events');
                    }
                }else{
                    //load view with error
                    $this->view('events/event-add', $data);

                }
                
      
            } else {
              // Init data
              $data =[
                'title' =>'',
                'university' =>'',
                'organized_by' =>'',
                'venue' =>'',
                'map_navigation' =>'',
                'start_datetime' =>'',
                'end_datetime' =>'',
                'description' =>'',
                'category' =>'',
                'event_profile_image' =>'',
                'event_cover_image' =>'',

                'title_err' =>'',
                'university_err' =>'',
                'organized_by_err' =>'',
                'map_navigation_err' =>'',
                'start_datetime_err' =>'',
                'end_datetime_err' =>'',
                'description_err' =>'',
                'category_err' =>'',
                'event_profile_image_err' =>'',
                'event_cover_image_err' =>'',
                
            ];
      
              // Load view
              $this->view('events/event-add', $data);
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
                  'id' =>$id,
                  'event_title' =>trim($_POST['event_title']),
                  'event_type' =>trim($_POST['event_type']),
                  'description' =>trim($_POST['description']),
                  'date' =>trim($_POST['date']),
                  'location' =>trim($_POST['location']),
                  'event_card_image' =>trim($_POST['event_card_image']),
                  'event_cover_image' =>trim($_POST['event_cover_image']),
                  'event_title_err' =>'',
                  'event_type_err' =>'',
                  'description_err' =>'',
                  'date_err' =>'',
                  'location_err' =>'',
                  'event_card_image_err' =>'',
                  'event_cover_image_err' =>'',
                  
              ];
  
            
            if(empty($data['event_title'])){
              $data['event_title_err'] = 'Pleae enter event title';
            }
    
            if(empty($data['event_type'])){
              $data['event_type_err'] = 'Pleae enter event type';
            }
    
            if(empty($data['description'])){
              $data['description_err'] = 'Pleae enter event description';
            }

            if(empty($data['date'])){
              $data['date_err'] = 'Pleae enter date';
            }

            if(empty($data['location'])){
              $data['location_err'] = 'Pleae enter location';
            }
    
            
    
              // Make sure errors are empty
              if(empty($data['event_title_err']) && empty($data['event_type_err']) && empty($data['description_err']) && empty($data['date_err'])&& empty($data['location_err'])){
                  //Validated
                  if (isset($_FILES['event_card_image']['name']) AND !empty($_FILES['event_card_image']['name'])) {
       
       
                      $img_name = $_FILES['event_card_image']['name'];
                      $tmp_name = $_FILES['event_card_image']['tmp_name'];
                      $error = $_FILES['event_card_image']['error'];
                      
                      if($error === 0){
                         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                         $img_ex_to_lc = strtolower($img_ex);
             
                         $allowed_exs = array('jpg', 'jpeg', 'png');
                         if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = $data['event_title'] . '-event-card-image.' . $img_ex_to_lc;
                            $img_upload_path = "../public/img/event-card-images/".$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $data['event_card_image']=$new_img_name;
                         }
                      }
                  }

                  if (isset($_FILES['event_cover_image']['name']) AND !empty($_FILES['event_cover_image']['name'])) {
       
       
                    $img_name = $_FILES['event_cover_image']['name'];
                    $tmp_name = $_FILES['event_cover_image']['tmp_name'];
                    $error = $_FILES['event_cover_image']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['event_title'] . '-event-cover-image.' . $img_ex_to_lc;
                          $img_upload_path = "../public/img/event-cover-images/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['event_cover_image']=$new_img_name;
                       }
                    }
                }
                         
                  if($this->eventModel->updateEvent($data)){
                      flash('event_message', "Event Updated Successfully");
                      redirect('events');
                  }
              }else{
                
                  //load view with error
                  $this->view('events/events-edit', $data);

              }
              
    
          } else {
            //get existing post from model
            $event= $this->eventModel->getEventById($id);

            //check for owner
            if($event->user_id != $_SESSION['user_id']){
              redirect('events');
            }
            // Init data
            $data =[
              'id' => $id,
              'event_title' =>$event->title,
              'event_type' =>$event->type,
              'description' =>$event->description,
              'date' =>$event->date,
              'location' =>$event->location,
              'event_card_image' =>'',
              'event_cover_image' =>$event->event_cover_image,
              'event_title_err' =>'',
              'event_type_err' =>'',
              'description_err' =>'',
              'date_err' =>'',
              'location_err' =>'',
              'event_card_image_err' =>'',
              'event_cover_image_err' =>'',
              
          ];
    
            // Load view
            $this->view('events/events-edit', $data);
          }
      }

      public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Get existing post from model
          $event = $this->eventModel->getEventById($id);
          
          // Check for owner
          if($event->user_id != $_SESSION['user_id']){
            redirect('events');
          }
  
          if($this->eventModel->deleteEvent($id)){
            flash('event_message', 'Event Removed');
            redirect('events');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('events');
        }
      }

        public function show($id){
          $event = $this->eventModel->getEventById($id);
          $user = $this->userModel->getUserById($event->user_id);
          $data =[
            'event' =>$event,
            'user' =>$user,
          ];
          $this->view('events/event-show', $data);
        }

        public function searchEvents(){
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // $keyword = $_POST['keyword'];
            // $date = $_POST['date'];
            $events = $this->eventModel->getEventsBySearch($_POST);
           
            $data =[
              'events' =>$events,
            ];
            $this->view('events/filter-events', $data);
            
          }
        }
    }