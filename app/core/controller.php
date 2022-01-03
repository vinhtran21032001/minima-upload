<?php 

    class Controller {
        public function view($view, $data = []) {
            $template = new Template($view,$data);
         
            $template->getStaticPage();
        }
        protected function loadModel($model) {
            if(file_exists('../app/models/' . $model .'.php') ) {
                include '../app/models/' . $model .'.php';
                return $model = new $model();
            } 
            return false;
        }

        public function notfound() {
            include '../app/views/notfound.php';
        }
    }

?>