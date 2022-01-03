<?php 

    class Auth {
        function login($usernanme, $password) {
            $dbh = Database::getInstance();
            $dbc = $dbh->getConnect();
           
            // validation username

            $validate = new Validation();
            if(!$validate
                ->addRule(new ValidationEmpty())
                ->validate($usernanme)
            ) {
                $_SESSION['login_error']  = 'username ' . $validate->getMessage();
            }
            $validate = new Validation();
            if(!$validate
                ->addRule(new ValidationEmpty())
                ->validate($password)
            ) {
                $_SESSION['login_error']  = 'password ' . $validate->getMessage();
            }

            ///
           if( ($_SESSION['login_error']  ?? "") == "") {
                $arr['username'] = $usernanme;
      
                $query = 'select * from user where username = :username';
                $dataObj = $dbh->select($query , $arr);
                if(is_array($dataObj) && count($dataObj) > 0) {
                    var_dump(password_verify($password , $dataObj[0]->password));
                    if(password_verify($password , $dataObj[0]->password)) {
                        $_SESSION['user_name'] = $dataObj[0]->username;
                        $_SESSION['user_id'] = $dataObj[0]->id;
                        header("Location:". ROOT . "home");
                        die;
                    } else {
                        $_SESSION['login_error'] = 'Username or Password is wrong';
                    }
                } else {
                    $_SESSION['login_error'] = 'Username or Password is wrong';
                }

            }
        }

        function logout() {
            unset($_SESSION['user_name']);
            header("Location:". ROOT . "login");
		    die;
        }


        function signup($username, $password, $email){ 
            $dbh = Database::getInstance();
            $dbc = $dbh->getConnect();

            $validate = new Validation();
            if(!$validate
                ->addRule(new ValidationMaximum(20))
                ->addRule(new ValidationMinimum(6))
                ->addRule(new ValidationEmpty())
                ->validate($username)      
            ) {
                $_SESSION['signup_error'] = 'username '. $validate->getMessage();
            }


            $validate = new Validation();
            if(!$validate
                ->addRule(new ValidationMaximum(20))
                ->addRule(new ValidationMinimum(6))
                ->addRule(new ValidationEmpty())
                ->validate($password)      
            ) {
                $_SESSION['signup_error'] = 'password '. $validate->getMessage();
            }


            $validate = new Validation();
            if(!$validate
               
                ->addRule(new ValidationEmpty())
                ->validate($email)      
            ) {
                $_SESSION['signup_error'] = $validate->getMessage();
            }

            if(($_SESSION['signup_error'] ?? "") =="") {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $arr['username'] = $username;
                $arr['password'] = $password;
                $arr['email'] = $email;

                $query = "insert into user (username, password , email) values (:username , :password, :email)";
                $result = $dbh->insert($query , $arr);
                if($result) {
                    header("Location:". ROOT . "login");
                    die;
                }

            }

        }

       

    }

?>