<?php 

    class ValidationMaximum implements validationInterface{
        private $maxium;
        function __construct($maxium) {
            $this->maxium = $maxium;
        }
        function validate($value) {
            if(strlen($value) < $this->maxium) {
                return true;
            } else {
                return false;
            }
        }
        function getError() {
            return 'is not over' . $this->maxium; 
        }

    }

?>