<?php
    class Search extends Controller{
        public function __construct(){
            // if(!isLoggedIn()){
            //     redirect('/users/login');
            // }

            $this->eventModel =$this->model('Event');
            $this->userModel =$this->model('User');
        }


        public function eventSearchByKey()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $searchKey = $_POST['input'];

               $data=[
                'searchKey' => $searchKey,
               ];
               $this->view('events/search-test', $data);
            }
        }

        public function eventSearchDefault(){
            echo "default";
        }

        public function updateContent(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

               $data=[
                // 'university' => $_POST['university'],
                // 'date' => $_POST['date'],
                'keyword' =>$_POST['keyword'],
                'university' =>$_POST['university'],
                'date' =>$_POST['date'],
                // 'categories' =>$_POST['categories'],
               ];

               $this->view('events/search-test', $data);
            }
        }
    }
