<?php 

    class About extends Controller implements pageInterface{
        public function index() {
            $this->view('about');
        }
    }

?>