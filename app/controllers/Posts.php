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
    $popularPosts = $this->postModel->getPopularPosts();
    $data = [
      'popularPosts' => $popularPosts
    ];

    $this->view('posts/post-index', $data);
  }

  public function show($id)
  {
    $addView = $this->postModel->addPostView($id);
    $post = $this->postModel->getPostById($id);
    $data = [
      'post' => $post
    ];
    $this->view('posts/post-show', $data);
  }

  public function add()
  {

    $postCategories = $this->postModel->getPostCategories();


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
        'post_title' => trim($_POST['post_title']),
        'post_description' => trim($_POST['post_description']),
        'material_link' => trim($_POST['material_link']),
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
        'post_profile_image' => '',
        'postCategories' => $postCategories,




        'post_title_err' => '',
        'post_description_err' => '',
        'material_link_err' => '',
        'category_err' => '',
        'tags_err' => '',
        'post_profile_image_err' => '',

      ];


      if (isset($_FILES['post_profile_image']['name']) and !empty($_FILES['post_profile_image']['name'])) {
        $img_name = $_FILES['post_profile_image']['name'];
        $tmp_name = $_FILES['post_profile_image']['tmp_name'];
        $error = $_FILES['post_profile_image']['error'];

        if ($error === 0) {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_to_lc = strtolower($img_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');
          if (in_array($img_ex_to_lc, $allowed_exs)) {
            $new_img_name = $data['post_title'] . '_post_profile_' . time() . '.' . $img_ex_to_lc;
            $img_upload_path = "../public/img/posts/post_profile_images/" . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $data['post_profile_image'] = $new_img_name;
          }
        }
      }



      if (empty($data['post_title'])) {
        $data['post_title_err'] = 'Pleae enter post title';
      }
      if (empty($data['post_description'])) {
        $data['post_description_err'] = 'Pleae enter the description';
      }
      if (empty($data['material_link'])) {
        $data['material_link_err'] = 'Please add your material link';
      }
      if (empty($data['categories'])) {
        $data['category_err'] = 'Please select at least one category';
      }
      if (empty($data['tags'])) {
        $data['tags_err'] = 'Please add at least one tag';
      }
      if (empty($data['post_profile_image'])) {
        $data['post_profile_image_err'] = 'Please add a image for post';
      }

      $postDomainsCheck = false;
      if (!empty($data['material_link'])) {
        $postDomains = $this->postModel->getAllDomains();
        // Check if any part of the email matches any university domain
        foreach ($postDomains as $domainObj) {
          $domain = $domainObj->domain; // Extract domain string from object
          if (strpos($data['material_link'], $domain) !== false) {
            $postDomainsCheck = true;
            break;
          }
        }
      }


      // Make sure errors are empty
      if (empty($data['post_title_err']) && empty($data['post_description_err']) && empty($data['material_link_err']) && empty($data['category_err']) && empty($data['tags_err']) && empty($data['post_profile_image_err'])) {
        //Validated


        //post-profile image adding



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

        if ($postDomainsCheck === false) {
          if ($this->postModel->addPostWithPending($data)) {
            $admins = $this->userModel->getAdminsEmails();

            foreach ($admins as $admin) {

              $to = $admin->secondary_email;
              $sender = 'developer.unihub@gmail.com';
              $mail_subject = 'New Post Added - Review Required:' . $data['post_title'];

              // Initialize $email_body properly and append to it
              $email_body = '<p>Hello,</p>';
              $email_body .= '<p>A new post has been added and requires your attention.<br>Please review the event details and take necessary actions.</p>';
              $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

              $header = "From: {$sender}\r\n";
              $header .= "Content-Type: text/html;";

              $send_mail_result = mail($to, $mail_subject, $email_body, $header);
            }

            $to = $_SESSION['user_secondary_email'];
            $sender = 'developer.unihub@gmail.com';
            $mail_subject = 'Post Under Approval: ' . $data['post_title'];

            // Initialize $email_body properly and append to it
            $email_body = '<p>Hello,</p>';
            $email_body .= '<p>Your post is currently under review. We will notify you once the approval process is completed.</p>';
            $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

            $header = "From: {$sender}\r\n";
            $header .= "Content-Type: text/html;";

            $send_mail_result = mail($to, $mail_subject, $email_body, $header);


            redirect('posts');
          }
        } else {
          if ($this->postModel->addPost($data)) {
            $to = $_SESSION['user_email'];
            $sender = 'developer.unihub@gmail.com';
            $mail_subject = 'Post Published: ' . $data['post_title'];

            // Initialize $email_body properly and append to it
            $email_body = '<p>Hello,</p>';
            $email_body .= '<p>We are pleased to inform you that your post has been successfully published.</p>';
            $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

            $header = "From: {$sender}\r\n";
            $header .= "Content-Type: text/html;";

            $send_mail_result = mail($to, $mail_subject, $email_body, $header);
            redirect('posts');
          }
        }

      } else {
        //load view with error
        $this->view('posts/post-add', $data);

      }


    } else {
      // Init data
      $data = [
        'post_title' => '',
        'post_description' => '',
        'material_link' => '',
        'categories' => '',
        'tags' => '',
        'post_profile_image' => '',
        'post_cover_image' => '',
        'postCategories' => $postCategories,


        'post_title_err' => '',
        'post_description_err' => '',
        'material_link_err' => '',
        'category_err' => '',
        'tags_err' => '',
        'post_profile_image_err' => '',
        'post_cover_image_err' => '',

      ];

      // Load view
      $this->view('posts/post-add', $data);
    }
  }

  public function searchPosts()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $posts = $this->postModel->searchPostsByKeyword($_POST);

      $data = [
        'posts' => $posts,
      ];

      $this->view('posts/filter-posts', $data);

    }
  }

  public function addLike()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $postId = $_POST['postId'];
      if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $data = [
          'postId' => $postId,
          'userId' => $user_id
        ];
        if (!$this->postModel->checkUserPostLike($data)) {
          if ($status = $this->postModel->addUserPostLike($data)) {
            echo $status;
          }
        } else {
          $this->postModel->deleteUserPostLike($data);
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function addBookmark()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $postId = $_POST['postId'];
      if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $data = [
          'postId' => $postId,
          'userId' => $user_id
        ];
        if (!$this->postModel->checkUserPostBookmark($data)) {
          if ($status = $this->postModel->addUserPostBookmark($data)) {
            echo $status;
          }
        } else {
          $this->postModel->deleteUserPostBookmark($data);
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function comments($postId)
  {
    $post = $this->postModel->getPostById($postId);
    $comments = $this->postModel->getCommentsByPostId($postId);
    $data = [
      'post' => $post,
      'comments' => $comments,
    ];
    // var_dump($data);
    // die();
    $this->view('posts/comments', $data);
  }

  public function addComment()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $postId = $_POST['postId'];
      $commentText = $_POST['commentText'];
      if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $data = [
          'post_id' => $postId,
          'user_id' => $user_id,
          'comment_text' => $commentText
        ];
        if ($this->postModel->addComment($data)) {
          echo 1;
        } else {
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function updateComment()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $commentId = $_POST['commentId'];
      $commentText = $_POST['commentText'];
      if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $data = [
          'comment_id' => $commentId,
          'comment_text' => $commentText
        ];
        if ($this->postModel->updateCommentByCommentid($data)) {
          echo 1;
        } else {
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function deleteComment()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $commentId = $_POST['commentId'];
      if (isset($_SESSION['user_id'])) {
        $data = [
          'comment_id' => $commentId,
        ];
        if ($this->postModel->deleteCommentByCommentId($data)) {
          echo 1;
        } else {
          echo 0;
        }
      } else {
        echo 0;
      }
    }
  }

  public function settings($id)
  {
    $data = [
      'id' => $id,
    ];
    $this->view('posts/settings', $data);

  }

  public function deletePost()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $id = $_POST['postId'];

      if ($this->postModel->deletePostById($id)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function updatePost($postId)
  {
    //check the user is a registered user
    if (!isLoggedIn()) {
      redirect('/users/login');
    }

    $post = $this->postModel->getPostById($postId);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //process form


      //Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Init data
      $data = [
        'post_id' => $postId,
        'post_title' => trim($_POST['post_title']),
        'post_description' => trim($_POST['post_description']),
        'material_link' => trim($_POST['material_link']),
        'categories' => isset($_POST['categories']) ? $_POST['categories'] : [],
        'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
        'post_profile_image' => $post->post_profile_image,
        'post_cover_image' => $post->post_cover_image,




        'post_title_err' => '',
        'post_description_err' => '',
        'material_link_err' => '',
        'category_err' => '',
        'tags_err' => '',
        'post_profile_image_err' => '',
        'post_cover_image_err' => '',



      ];



      if (empty($data['post_title'])) {
        $data['post_title_err'] = 'Pleae enter post title';
      }
      if (empty($data['post_description'])) {
        $data['post_description_err'] = 'Pleae enter the description';
      }
      if (empty($data['material_link'])) {
        $data['material_link_err'] = 'Please add your material link';
      }
      if (empty($data['categories'])) {
        $data['category_err'] = 'Please select at least one category';
      }
      if (empty($data['tags'])) {
        $data['tags_err'] = 'Please add at least one tag';
      }



      // Make sure errors are empty
      if (empty($data['post_title_err']) && empty($data['post_description_err']) && empty($data['material_link_err']) && empty($data['category_err']) && empty($data['tags_err'])) {
        //Validated


        //post-profile image adding
        if (isset($_FILES['post_profile_image']['name']) and !empty($_FILES['post_profile_image']['name'])) {


          $img_name = $_FILES['post_profile_image']['name'];
          $tmp_name = $_FILES['post_profile_image']['tmp_name'];
          $error = $_FILES['post_profile_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['post_title'] . '_post_profile_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/posts/post_profile_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['post_profile_image'] = $new_img_name;
            }
          }
        }

        if (isset($_FILES['post_cover_image']['name']) and !empty($_FILES['post_cover_image']['name'])) {


          $img_name = $_FILES['post_cover_image']['name'];
          $tmp_name = $_FILES['post_cover_image']['tmp_name'];
          $error = $_FILES['post_cover_image']['error'];

          if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
              $new_img_name = $data['post_title'] . '_post_cover_' . time() . '.' . $img_ex_to_lc;
              $img_upload_path = "../public/img/posts/post_cover_images/" . $new_img_name;
              move_uploaded_file($tmp_name, $img_upload_path);

              $data['post_cover_image'] = $new_img_name;
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

        if ($this->postModel->updatePost($data)) {
          // flash('event_message', "Event Added Successfully");
          redirect('posts');
        }
      } else {
        //load view with error
        $this->view('posts/post-update', $data);

      }


    } else {
      // Init data
      $data = [
        'post_id' => $postId,
        'post_title' => $post->post_title,
        'post_description' => $post->post_description,
        'material_link' => $post->material_link,
        'categories' => $post->categories,
        'tags' => $post->tags,
        'post_profile_image' => $post->post_profile_image,
        'post_cover_image' => $post->post_cover_image,


        'post_title_err' => '',
        'post_description_err' => '',
        'material_link_err' => '',
        'category_err' => '',
        'tags_err' => '',
        'post_profile_image_err' => '',
        'post_cover_image_err' => '',

      ];

      // Load view
      $this->view('posts/post-update', $data);
    }
  }


  public function filterPostsByApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $posts = $this->postModel->getFilterPosts($_POST);

      $data = [
        'posts' => $posts,
      ];

      $this->view('users/admin/postsApprovalfilter', $data);

    }
  }

  public function filterPosts()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // var_dump($_POST);
      // die();

      // $keyword = $_POST['keyword'];
      // $date = $_POST['date'];
      $posts = $this->postModel->getFilterPosts($_POST);

      $data = [
        'post' => $posts,
      ];

      $this->view('users/admin/postfilter', $data);

    }

  }

  public function changeApproval()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $postId = $_POST['postId'];
      $selectedPostApproval = $_POST['selectedPostApproval'];
      $data = [
        'postId' => $postId,
        'selectedPostApproval' => $selectedPostApproval,
      ];

      if ($this->postModel->changeApproval($data)) {
        $post = $this->postModel->getPostById($postId);
        $user= $this->userModel->getUserById($post->user_id);

        $to = $user->email;
        $sender = 'developer.unihub@gmail.com';
        $mail_subject = 'Post ' . $selectedPostApproval . ': ' . $post->post_title;

        // Initialize $email_body properly and append to it
        $email_body = '<p>Hello,</p>';
        $email_body .= '<p>Your post has been ' . $selectedPostApproval . ' . Thank you for your submission.</p>';
        $email_body .= '<p>For further information or inquiries, please contact us at developer.unihub@gmail.com</p>';
        $email_body .= '<p>Thank You, <br>UniHub.lk </p>';

        $header = "From: {$sender}\r\n";
        $header .= "Content-Type: text/html;";

        $send_mail_result = mail($to, $mail_subject, $email_body, $header);

        echo true;
      } else {
        echo false;
      }

    }
  }

  public function totalPostsFilter()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $type = $_POST['value'];

      if ($type == "all") {
        $post = $this->postModel->getAllPosts();
      } elseif ($type == "published") {
        $post = $this->postModel->getPublishedPosts();
      } elseif ($type == "pending") {
        $post = $this->postModel->getPendingPosts();
      }

      $data = [
        'post' => $post,
      ];

      $this->view('users/admin/postfilter', $data);

    }
  }

  public function addDomainForm()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $data = [
      ];
      $this->view('users/admin/postDomainForm', $data);
    }
  }

  public function addDomain()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $website = $_POST['website'];
      $domain = $_POST['domain'];
      $data = [
        'website' => $website,
        'domain' => $domain,
      ];

      if ($this->postModel->addDomain($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function filterDomains()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $domains = $this->postModel->getFilterDomains($_POST);

      $data = [
        'domains' => $domains,
      ];

      $this->view('users/admin/domainfilter', $data);

    }

  }

  public function deleteDomain()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $domainId = $_POST['domainId'];
      $data = [
        'domainId' => $domainId,
      ];
      if ($this->postModel->deleteDomain($data)) {
        echo true;
      } else {
        echo false;
      }
    }
  }

  public function changeActivation()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $postId = $_POST['postId'];

      if ($this->postModel->checkStatusByPostId($postId) == true) {
        if ($this->postModel->deactivatePostById($postId)) {
          echo 'deactivated';
        }
      } else {
        if ($this->postModel->activatePostById($postId)) {
          echo 'activated';
        }
      }

    }

  }

  public function filterByCategory()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $category = $_POST['category'];
      $posts = $this->postModel->filterByCategory($category);

      $data = [
        'posts' => $posts,
      ];

      $this->view('posts/filter-posts', $data);

    }
  }

  public function filterByUserId()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $userId = $_POST['userId'];
      $posts = $this->postModel->filterByUserId($userId);

      $data = [
        'posts' => $posts,
      ];

      $this->view('posts/filter-posts', $data);

    }
  }

  public function suggestedPosts()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // echo $_POST['value'];
      $userId = $_POST['userId'];
      $posts = $this->postModel->getUserSuggestedPosts($userId);

      $data = [
        'posts' => $posts,
      ];

      $this->view('events/filter-events', $data);

    }
  }

}