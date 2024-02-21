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
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'post_profile_image' => "",

        


        'title_err' => '',
        'description_err' => '',
        'material_link_err' => '',
        'category_err' => '',
        'post_profile_image' => '',



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
      if (empty($data['categories'])) {
        $data['category_err'] = 'Please select at least one category';
      }



      // Make sure errors are empty
      if (empty($data['title_err']) && empty($data['description_err']) && empty($data['material_link_err']) && empty($data['category_err'])) {
        //Validated


        //event-card image adding
        if (isset($_FILES['post_profile_image']['name']) and !empty($_FILES['post_profile_image']['name'])) {


          $img_name = $_FILES['post_profile_image']['name'];
          $tmp_name = $_FILES['post_profile_image']['tmp_name'];
          $error = $_FILES['post_profile_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['title'] . '_post_profile_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/posts/posts_profile_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['post_profile_image'] = $new_img_name;
            }
          }
        }


        if (!empty($data['categories'])) {
          // Convert array of category names to category IDs
          $category_ids = [];
          foreach ($data['categories'] as $category_name) {
            $category_id = $this->postModel->getCategoryIdByName($category_name);
            if ($category_id !== false) {
              $category_ids[] = $category_id;
            }
          }
          $data['category_ids'] = $category_ids;
        }

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
        'categories' => '',
        

        'title_err' => '',
        'description_err' => '',
        'material_link_err' => '',
        'category_err' => '',

      ];

      // Load view
      $this->view('posts/post-add', $data);
    }
  }

}

