<?php 

    final class Database {
        private static $instance = null;
        private static $connection;


        static function getInstance() {
            if(is_null(self::$instance)) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
        static function connectDB($host, $dbName, $user, $password) {
            self::$connection = new PDO("mysql:host=$host;dbname=$dbName" , "$user", "$password");
        }
        public function getConnect() {
            return self::$connection;
        }


        public function select($query , $data = []) {
            $stmt = self::$connection->prepare($query);
            if(count($data)== 0) {
                $stmt = self::$connection->query($query);
                $check = 0;
                if($stmt) {
                    $check = 1;
                }
            } else {
                $check = $stmt->execute($data);               
            }
            if($check) {
                $dataObj = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(is_array($dataObj) && count($dataObj) > 0) {
                    return $dataObj;
                } 
                else {
                    return false;
                }
                return false;
            }
        }


        public function insert($query , $data = []) {

            $sql = "select * from user where username = :username";
            $arr['username'] = $data['username'];
            $arr['password'] = $data['password'];
            $checkData = $this->select($sql, $arr);

            if(!$checkData) {
                $stmt = self::$connection->prepare($query);
                if(count($data)== 0) {
                    $stmt = self::$connection->query($query);
                    $check = 0;
                    if($stmt) {
                        $check = 1;
                    }
                } else {
                    $check = $stmt->execute($data);
                }
                if($check) {
                   return true;
                }
                return false;
            } 
            else {
                $_SESSION['signup_error'] = "username is already, try nother username, please!";
                return false;
            }

        }

        public function insert_post($query , $data = []) {
          
                $stmt = self::$connection->prepare($query);
                if(count($data)== 0) {
                    $stmt = self::$connection->query($query);
                    $check = 0;
               
                    if($stmt) {
                        $check = 1;
                    }
                } else {
                    $check = $stmt->execute($data);
                    var_dump($data);
                    var_dump($stmt->debugDumpParams());
                }
                if($check) {
                   return true;
                }
                return false;
          

        }



    }

?>