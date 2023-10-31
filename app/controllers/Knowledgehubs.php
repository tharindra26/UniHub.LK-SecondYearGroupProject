<?php
    class Knowledgehubs extends Controller{
        public function __construct(){
            // if(!isLoggedIn()){
            //     redirect('/users/login');
            // }

            $this->knowledgehubModel =$this->model('Knowledgehub');
            $this->userModel =$this->model('User');
        }
        public function index(){
            //get Posts
            $knowledgehubs= $this->knowledgehubModel->getKnowledgehubs();
            $data=[
                'knowledgehubs'=> $knowledgehubs
            ];

            $this->view('knowledgehubs/knowledgehubs-main', $data);
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
                    'title' =>trim($_POST['title']),
                    'type' =>trim($_POST['type']),
                    'description' =>trim($_POST['description']),
                    'link' =>trim($_POST['link']),
                    'knowledgehub_card_image' =>'',
                    'knowledgehub_cover_image' =>'',
                    'title_err' =>'',
                    'type_err' =>'',
                    'description_err' =>'',
                    'link_err' =>'',
                    'knowledgehub_card_image_err' =>'',
                    'knowledgehub_cover_image_err' =>'',
                    
                ];
    
              
              if(empty($data['title'])){
                $data['title_err'] = 'Pleae enter event title';
              }
      
              if(empty($data['type'])){
                $data['type_err'] = 'Pleae enter event type';
              }
      
              if(empty($data['description'])){
                $data['description_err'] = 'Pleae enter event description';
              }

              if(empty($data['link'])){
                $data['link_err'] = 'Pleae enter date';
              }
      
              
      
                // Make sure errors are empty
                if(empty($data['title_err']) && empty($data['type_err']) && empty($data['description_err']) && empty($data['link_err'])){
                    //Validated
                    if (isset($_FILES['knowledgehub_card_image']['name']) AND !empty($_FILES['knowledgehub_card_image']['name'])) {
         
         
                        $img_name = $_FILES['knowledgehub_card_image']['name'];
                        $tmp_name = $_FILES['knowledgehub_card_image']['tmp_name'];
                        $error = $_FILES['knowledgehub_card_image']['error'];
                        
                        if($error === 0){
                           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                           $img_ex_to_lc = strtolower($img_ex);
               
                           $allowed_exs = array('jpg', 'jpeg', 'png');
                           if(in_array($img_ex_to_lc, $allowed_exs)){
                              $new_img_name = $data['title'] . '-knowledgehub-card-image.' . $img_ex_to_lc;
                              $img_upload_path = "../public/img/knowledgehub-card-images/".$new_img_name;
                              move_uploaded_file($tmp_name, $img_upload_path);

                              $data['knowledgehub_card_image']=$new_img_name;
                           }
                        }
                    }

                    if (isset($_FILES['knowledgehub_cover_image']['name']) AND !empty($_FILES['knowledgehub_cover_image']['name'])) {
         
         
                      $img_name = $_FILES['knowledgehub_cover_image']['name'];
                      $tmp_name = $_FILES['knowledgehub_cover_image']['tmp_name'];
                      $error = $_FILES['knowledgehub_cover_image']['error'];
                      
                      if($error === 0){
                         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                         $img_ex_to_lc = strtolower($img_ex);
             
                         $allowed_exs = array('jpg', 'jpeg', 'png');
                         if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = $data['title'] . '-knowledgehub-cover-image.' . $img_ex_to_lc;
                            $img_upload_path = "../public/img/knowledgehub-cover-images/".$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $data['knowledgehub_cover_image']=$new_img_name;
                         }
                      }
                  }
                              


                    if($this->knowledgehubModel->addknowledgehub($data)){
                        flash('event_message', "knowledgehub Post Added Successfully");
                        redirect('knowledgehubs');
                    }
                }else{
                    //load view with error
                    $this->view('knowledgehubs/knowledgehubs-add', $data);

                }
                
      
            } else {
              // Init data
              $data =[
                'title' =>'',
                'type' =>'',
                'description' =>'',
                'link' =>'',
                'knowledgehub_card_image' =>'',
                'knowledgehub_cover_image' =>'',
                'title_err' =>'',
                'type_err' =>'',
                'description_err' =>'',
                'link_err' =>'',
                'knowledgehub_card_image_err' =>'',
                'knowledgehub_cover_image_err' =>'',
                
            ];
      
              // Load view
              $this->view('knowledgehubs/knowledgehubs-add', $data);
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
                    'title' =>trim($_POST['title']),
                    'type' =>trim($_POST['type']),
                    'description' =>trim($_POST['description']),
                    'link' =>trim($_POST['link']),
                    'knowledgehub_card_image' =>trim($_POST['knowledgehub_card_image']),
                    'knowledgehub_cover_image' =>trim($_POST['knowledgehub_cover_image']),
                    'title_err' =>'',
                    'type_err' =>'',
                    'description_err' =>'',
                    'link_err' =>'',
                    'knowledgehub_card_image_err' =>'',
                    'knowledgehub_cover_image_err' =>'',
                  
              ];
  
            
              if(empty($data['title'])){
                $data['title_err'] = 'Pleae enter event title';
              }
      
              if(empty($data['type'])){
                $data['type_err'] = 'Pleae enter event type';
              }
      
              if(empty($data['description'])){
                $data['description_err'] = 'Pleae enter event description';
              }

              if(empty($data['link'])){
                $data['link_err'] = 'Pleae enter date';
              }
    
            
    
              // Make sure errors are empty
              if(empty($data['title_err']) && empty($data['type_err']) && empty($data['description_err']) && empty($data['link_err'])){
                //Validated
                if (isset($_FILES['knowledgehub_card_image']['name']) AND !empty($_FILES['knowledgehub_card_image']['name'])) {
     
     
                    $img_name = $_FILES['knowledgehub_card_image']['name'];
                    $tmp_name = $_FILES['knowledgehub_card_image']['tmp_name'];
                    $error = $_FILES['knowledgehub_card_image']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['title'] . '-knowledgehub-card-image.' . $img_ex_to_lc;
                          $img_upload_path = "../public/img/knowledgehub-card-images/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['knowledgehub_card_image']=$new_img_name;
                       }
                    }
                }

                if (isset($_FILES['knowledgehub_cover_image']['name']) AND !empty($_FILES['knowledgehub_cover_image']['name'])) {
     
     
                  $img_name = $_FILES['knowledgehub_cover_image']['name'];
                  $tmp_name = $_FILES['knowledgehub_cover_image']['tmp_name'];
                  $error = $_FILES['knowledgehub_cover_image']['error'];
                  
                  if($error === 0){
                     $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                     $img_ex_to_lc = strtolower($img_ex);
         
                     $allowed_exs = array('jpg', 'jpeg', 'png');
                     if(in_array($img_ex_to_lc, $allowed_exs)){
                        $new_img_name = $data['title'] . '-knowledgehub-cover-image.' . $img_ex_to_lc;
                        $img_upload_path = "../public/img/knowledgehub-cover-images/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $data['knowledgehub_cover_image']=$new_img_name;
                     }
                  }
              }
                         
                    if($this->knowledgehubModel->updateKnowledgehub($data)){
                        flash('event_message', "Post Updated Successfully");
                        redirect('knowledgehubs');
                    }
              }else{
                
                  //load view with error
                  $this->view('knowledgehubs/knowledgehubs-edit', $data);

              }
              
    
          } else {
            //get existing post from model
            $knowledgehub= $this->knowledgehubModel->getKnowledgehubById($id);
            $user = $this->userModel->getUserById($knowledgehub->user_id);

            // //check for owner
            // if($knowledgehub->user_id != $_SESSION['user_id']){
            //   redirect('events');
            // }
            // Init data
            $data =[
                'id' =>$id,
                'user_name'=>$user->name,
                'user_id'=>$user->id,
                'title' =>$knowledgehub->title,
                'type' =>$knowledgehub->type,
                'created_at'=>$knowledgehub->created_at,
                'description' =>$knowledgehub->description,
                'link' =>$knowledgehub->link,
                'knowledgehub_card_image' =>$knowledgehub->knowledgehub_card_image,
                'knowledgehub_cover_image' =>$knowledgehub->knowledgehub_cover_image,
                'title_err' =>'',
                'type_err' =>'',
                'description_err' =>'',
                'link_err' =>'',
                'knowledgehub_card_image_err' =>'',
                'knowledgehub_cover_image_err' =>'',
              
          ];
    
            // Load view
            $this->view('knowledgehubs/knowledgehubs-edit', $data);
          }
      }

      public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Get existing post from model
          $knowledgehub = $this->knowledgehubModel->getKnowledgehubById($id);
          
          // Check for owner
          if($knowledgehub->user_id != $_SESSION['user_id']){
            redirect('knowledgehubs');
          }
  
          if($this->knowledgehubModel->deleteKnowledgehub($id)){
            flash('event_message', 'Post Removed');
            redirect('knowledgehubs');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('knowledgehubs');
        }
      }

        public function show($id){
            $knowledgehub = $this->knowledgehubModel->getKnowledgehubById($id);
            $user = $this->userModel->getUserById($knowledgehub->user_id);
            $data =[
            'knowledgehub' =>$knowledgehub,
            'user' =>$user,
            ];
            $this->view('knowledgehubs/knowledgehubs-show', $data);
        }
    }