<?php 

    class Contact extends Controller implements pageInterface{
        public function index() {
            $this->view('contact');
        }
    }

?>