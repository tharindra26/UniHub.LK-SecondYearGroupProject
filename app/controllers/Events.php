<?php
    class Events extends Controller{
        public function __construct(){
            if(!isLoggedIn()){
                redirect('/users/login');
            }

            $this->postModel =$this->model('Event');
        }
        public function index(){
            //get Posts
            $events= $this->postModel->getEvents();
            $data=[
                'events'=> $events
            ];

            $this->view('events/events-main', $data);
        }

        public function add(){
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
                    'event_title_err' =>'',
                    'event_type_err' =>'',
                    'description_err' =>'',
                    'date_err' =>'',
                    'location_err' =>'',
                    
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
                'event_title_err' =>'',
                'event_type_err' =>'',
                'description_err' =>'',
                'date_err' =>'',
                'location_err' =>'',
                
            ];
      
              // Load view
              $this->view('events/events-add', $data);
            }
        }
    }