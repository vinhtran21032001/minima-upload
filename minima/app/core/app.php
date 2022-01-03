<?php 

    class App {
    
        private $method;
        private $params;


        public function __construct() {
            $url = $this->splitURL();
            $class = isset($url[0]) ? $url[0] : "home";
            $class = $class == "" ?  "home" : $class;
            $this->method = isset($url[1]) ? $url[1] : "index";
            unset($url[0]);
            unset($url[1]);
         

            // include '../app/controllers/pageController.php';
            // $pageController = new PageController($class);
            // $actionName = $this->method . 'Action';
            // if(!method_exists($pageController , $actionName)) {
            //    $actionName = 'notFoundAction';
            // } 
            // $pageController->$actionName($this->params);
           
            if(file_exists('../app/controllers/' . $class . '.php')){
             
                include '../app/controllers/' . $class . '.php';
                $this->controller = new $class();
                
                
            } else {
                include '../app/controllers/home.php';
                $this->controller = new Home();
            }

            if(!method_exists($this->controller , $this->method)) {
                $this->method = 'notfound';
            } 

            $this->params = array_values($url);

            call_user_func_array([$this->controller , $this->method], $this->params);      
        }

        private function splitURL() {
            $url = isset($_GET['url']) ? $_GET['url'] : '';

            return explode('/' ,filter_var( trim($url , '/'), FILTER_SANITIZE_URL));
        }
    }

?>