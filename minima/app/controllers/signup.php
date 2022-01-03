<?php 

    class Signup extends Controller implements pageInterface{
        function index() {
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
                $auth = $this->loadModel('auth');
                $auth->signup(($_POST['username']) , ($_POST['password']) , ($_POST['email']));
            }
            $this->view('signup');
            unset($_SESSION['signup_error']);
        }
    }

?>