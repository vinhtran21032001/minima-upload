<?php 

    class ValidationEmail implements validationInterface{
        function validate($value) {
            if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }
        function getError() {
            return 'Your email is invalid';
        }

    }

?>