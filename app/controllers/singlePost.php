<?php 

    class SinglePost extends Controller implements pageInterface{
        public function index($params) {
            $post = $this->loadModel('Post');
            $data= $post->get_one($params);
            $this->view('single_post', $data);
        }
    

    }

?>