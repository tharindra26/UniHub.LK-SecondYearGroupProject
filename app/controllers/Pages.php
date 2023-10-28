<?php
class Pages  extends Controller {
    public function __construct(){
  
    }

    public function index(){

        $data= [
            'title' => 'Home',
        ];
        $this->view('pages/index', $data);
    }

    public function events(){

        $data= [
            'title' => 'Events',
        ];
        $this->view('events/events-main', $data);
    }

    public function about(){
        $data= [
            'title' => 'About Us',
        ];
        $this->view('pages/about', $data);
    }
}