<?php
/*
*App Core Class
*Creates URL & Loads core cotroller
*.URL FORMAT - /controller/method/param
*/
class Core{
    protected $currentController= 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl()); //array ekk print karanna print_r

        $url = $this->getUrl();

        // Look in controllers for first value
        if(isset($url['0'])){
            if(file_exists('../app/controllers/' .ucwords($url[0]). '.php')){ //uppercase first letter in url
                //if exists, set as controller
                $this->currentController=ucwords($url[0]);
                //Unset 0 index
                unset($url[0]);
            }
        }
        

         // Require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        //check for second part of url
        if(isset($url[1])){
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod=$url[1];
                //echo '<br>'.$this->currentMethod;
                unset($url[1]);
            }
        }

        //get params
        $this->params= $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            //print_r( $url);
            return $url;
            
          }
    }

}

