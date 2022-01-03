<?php 

    class ValidationEmpty implements validationInterface{
        function validate($value) {
            if(strlen($value) > 0) {
                return true;
            } else {
                return false;
            }
        }
        function getError() {
            return 'is not empty'; 
        }

    }

?>