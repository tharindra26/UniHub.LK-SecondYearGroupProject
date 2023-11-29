<?php
class Pages  extends Controller {
    public function __construct(){
  
    }

    public function index(){

        $data= [
            'title' => 'Home',
        ];
        $this->view('home-page', $data);
    }

    public function events(){

        $data= [
            'title' => 'Events',
        ];
        $this->view('events/events-main', $data);
    }

    public function knowledgehubs(){

        $data= [
            'title' => 'Knowledge Hub',
        ];
        $this->view('knowledgehubs/knowledgehubs-main', $data);
    }

    public function organizations(){

        $data= [
            'title' => 'Organizations',
        ];
        $this->view('organizations/organizations-main', $data);
    }

    public function about(){
        $data= [
            'title' => 'About Us',
        ];
        $this->view('pages/about', $data);
    }
}