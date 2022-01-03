<?php 

    class Template{
        private $template;
        private $data;
        public function __construct($template,$data) {
           $this->template = $template;
           $this->data = $data;
        }
        public function getStaticPage() {
            if(file_exists('../app/views/minima/' . $this->template . '.php')) {
                include '../app/views/layouts/static-page.php';
            } else {
                include '../app/views/notfound.php';
            }
        }

    }

?>