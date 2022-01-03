<?php 

    class ValidationMinimum implements validationInterface{
        private $minium;
        function __construct($minium) {
            $this->minium = $minium;
        }
        function validate($value) {
          
            if(strlen($value) > $this->minium) {
                return true;
            } else {
                return false;
            }
        }
        function getError() {
            return 'is not under ' . $this->minium . ' characters'; 
        }

    }

?>