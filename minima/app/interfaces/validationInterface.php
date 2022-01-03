<?php 

    interface ValidationInterface {
        function validate($value);
        function getError();
    }

?>