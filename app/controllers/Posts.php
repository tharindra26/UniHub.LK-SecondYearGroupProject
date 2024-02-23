<?php
class Posts extends Controller
{

  public function __construct()
  {
    // if(!isLoggedIn()){
    //     redirect('/users/login');
    // }

    //test comment
    $this->userModel = $this->model('User');
    $this->postModel = $this->model('Post');

  }


  public function index()
  {
    // $events= $this->eventModel->getEvents();
    $data = [
      // 'events'=> $events
    ];

    $this->view('posts/post-index', $data);
  }

  public function show($id) //14
  {
    
    
    // $user = $this->userModel->getUserById($event->user_id);
    $data = [
      
    ];
    $this->view('post/showPost', $data);
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
        'title' => trim($_POST['title']),
        'description' => trim($_POST['description']),
        'material_link' => trim($_POST['material_link']),

        'title_err' => '',
        'description_err' => '',
        'material_link_err' => '',

      ];



      if (empty($data['title'])) {
        $data['title_err'] = 'Pleae enter post title';
      }
      if (empty($data['description'])) {
        $data['description_err'] = 'Pleae enter the description';
      }
      if (empty($data['material_link'])) {
        $data['material_link_err'] = 'Please add your material link';
      }



      // Make sure errors are empty
      if (empty($data['title_err']) && empty($data['description_err']) && empty($data['material_link_err'])) {
        //Validated

        

        if ($this->postModel->addPost($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('posts');
        }
      } else {
        //load view with error
        $this->view('posts/post-add', $data);

      }


    } else {
      // Init data
      $data = [
        'title' => '',
        'description' => '',
        'material_link' => '',
        

        'title_err' => '',
        'description_err' => '',
        'material_link_err' => '',

      ];

      // Load view
      $this->view('posts/post-add', $data);
    }
  }

}

