<?php
class Opportunities extends Controller
{

  public function __construct()
  {
    // if(!isLoggedIn()){
    //     redirect('/users/login');
    // }

    //test comment
    $this->userModel = $this->model('User');

  }


  public function index()
  {
    // $events= $this->eventModel->getEvents();
    $data = [
      // 'events'=> $events
    ];

    $this->view('opportunities/opportunities-index', $data);
  }

  public function show($id) //14
  {
    
    
    // $user = $this->userModel->getUserById($event->user_id);
    $data = [
      
    ];
    $this->view('opportunities/showOpportunity', $data);
  }

}

