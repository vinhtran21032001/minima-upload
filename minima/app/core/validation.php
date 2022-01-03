<?php 

    class Validation {
        private $rules = [];
        private $errorMessage;

        function validate($value) {
            $result = true;
            foreach($this->rules as $rule) {
                if(!$rule->validate($value)) {
                    $result = false;
                    $this->errorMessage = $rule->getError();
                }
            }
            return $result;
        }

        public function addRule(ValidationInterface $rule) {
            $this->rules[] = $rule;
            return $this;
        }
        public function getMessage() {
            return $this->errorMessage;
        }

    }
?>