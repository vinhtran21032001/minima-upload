<?php 

    class Home extends Controller implements pageInterface{
        public function index() {
            $post = $this->loadModel('Post');
            $data = $post->get_all();
          
            $this->view('home', $data);
        }
    }

?>