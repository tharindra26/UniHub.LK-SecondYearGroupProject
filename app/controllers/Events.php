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
            $events= $this->eventModel->getEvents();
            $data=[
                'events'=> $events
            ];

            $this->view('events/events-main', $data);
        }

        public function add(){

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
                              


                    if($this->eventModel->addEvent($data)){
                        flash('event_message', "Event Added Successfully");
                        redirect('events');
                    }
                }else{
                    //load view with error
                    $this->view('events/events-add', $data);

                }
                
      
            } else {
              // Init data
              $data =[
                'event_title' =>'',
                'event_type' =>'',
                'description' =>'',
                'date' =>'',
                'location' =>'',
                'event_card_image' =>'',
                'event_cover_image' =>'',
                'event_title_err' =>'',
                'event_type_err' =>'',
                'description_err' =>'',
                'date_err' =>'',
                'location_err' =>'',
                'event_card_image_err' =>'',
                'event_cover_image_err' =>'',
                
            ];
      
              // Load view
              $this->view('events/events-add', $data);
            }
        }

        public function show($id){
          $event = $this->eventModel->getEventById($id);
          $user = $this->userModel->getUserById($event->user_id);
          $data =[
            'event' =>$event,
            'user' =>$user,
          ];
          $this->view('events/events-show', $data);
        }
    }