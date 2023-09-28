<?php
/*
* Base Controller
*Loads the model and views
*/
class Controller {
    //Load model
    public function model($model){
        //Require the model class
        require_once '../app/models/'.$model.'.php';

        //Instantiate model
        return new $model;
    }

    //Load view
    public function view($view, $data= [] ){
        //check for view file
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
            //View does not exist
            echo '<br>View does not exist';
        }
    }

}