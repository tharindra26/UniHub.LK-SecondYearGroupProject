<?php
class Pages {
    public function __construct(){
        echo 'Pages loaded successfully';
    }

    public function currentMethod(){
        echo 'Current method is working';
    }

    public function about($id){
        echo '<br>'.$id;
    }
}