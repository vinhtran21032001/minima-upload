<?php 

    class Logout extends Controller implements pageInterface {
        function index() {
            $auth = $this->loadModel('auth');
            $auth->logout();
        }
    }

?>