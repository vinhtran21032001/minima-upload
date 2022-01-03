<?php 

    class Post {

        function uploadPost($POST, $FILES) {
            $dbh = Database::getInstance();
            $dbc = $dbh->getConnect();


            show($POST);
            show($FILES);
            
           
            $allowType[] = "image/jpeg";
            $allowType[] = "image/png";

          

            if(isset($POST['title']) && isset($FILES)) {

                if($FILES['name'] != "" && $FILES['error'] == 0 && in_array($FILES['type'], $allowType)) {
                  
                    $folder = 'uploads/images/';
                    if(!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    
                    $destination =$folder . date("YmdHis") . $FILES['name'];

                    move_uploaded_file($FILES['tmp_name'], $destination);

                    $arr['title'] = $POST['title'];
                    $arr['description'] = $POST['description'];
                    $arr['date'] =  date("Y-m-d H:i:s");
                    $arr['orther_id'] = $_SESSION['user_id'];
                    $arr['image_url'] = get_random_string_max(20);
                    $arr['image_address'] = $destination;

                    $query = "insert into posts (title, description, date, orther_id, image_url, image_address) values (:title, :description, :date, :orther_id, :image_url, :image_address)";
                    $result = $dbh->insert_post($query, $arr) ;
                    if($result) {
                        header( "Location: " . ROOT. 'home' );
                    } else {
                        $_SESSION['error_uploadfile'] = "This file could not be uploaded";
                    }
                } else {
                    $_SESSION['error_uploadfile'] = "This file could not be uploaded";
                    
                }
       
            }

            
        }

        function get_all() {
            $dbh = Database::getInstance();
            $dbc = $dbh->getConnect();

            $query = "select * from posts";
            $data = $dbh->select($query);
            return $data;
        }
        function get_one($image_url) {
            $dbh = Database::getInstance();
            $dbc = $dbh->getConnect();
            $arr['image_url'] = $image_url;
            $query = "select * from posts where image_url = :image_url";
            $data = $dbh->select($query, $arr);
            return $data;
        }


    }

?>