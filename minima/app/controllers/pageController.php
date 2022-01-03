<?php 

    class PageController extends Controller implements pageInterface{
        private $template;
        function __construct($template) {
            $this->template = $template;
        }
        function indexAction() {
           $this->view($this->template);
        } 
        function notFoundAction() {
            include '../app/views/notfound.php';
        }
    }

?>