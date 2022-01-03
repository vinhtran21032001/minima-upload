<?php 

    class Login extends Controller implements pageInterface{
        public function index() {

            if(isset($_POST['username']) && isset($_POST['password'])) {
                $auth = $this->loadModel('Auth');
                $auth->login($_POST['username'], $_POST['password']);
            }



      
            if(isset($_SESSION['user_name'])) {
                header("Location:". ROOT . "home");
            } else {
                $this->view('login');
            }
          
           
            $_SESSION['login_error'] = "";
        }
    }

?>