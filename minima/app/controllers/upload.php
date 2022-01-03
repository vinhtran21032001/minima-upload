<?php 

    class Upload extends Controller implements pageInterface{
        public function index() {
            // if(isset($_SESSION['user_name'])) {
            //     var_dump(checkLogin());
            //     $this->view('upload');
            // } else {
            //     header("Location:" . ROOT . 'login');
            // }

          
           // check login for upload file
           if($checkUser = checkLogin()){
                $post = $this->loadModel('Post');
                if(isset($_FILES['file'])){
                    $post->uploadPost($_POST, $_FILES['file']);
                }
                $this->view('upload');
                unset( $_SESSION['error_uploadfile']);
           } else {
                header("Location:" . ROOT . 'login');
           }




        }
    }
?>