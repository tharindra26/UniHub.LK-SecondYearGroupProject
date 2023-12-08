<?php
class Pages  extends Controller {
    public function __construct(){
  
    }

    public function index(){

        $data= [
            'title' => 'Home',
        ];
        $this->view('home/home-page', $data);
    }

    public function about(){
        $data= [
            'title' => 'About Us',
        ];
        $this->view('pages/about', $data);
    }
}