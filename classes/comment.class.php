<?php
    class Comment{
        protected $Conn;

        public function __construct($Conn){
            $this->Conn = $Conn;
        }

        public function submitComment($tutorial_id, $comment_data){
            $query = "INSERT INTO Comments (tutorial_id,username,comment_text,comment_date,likes) VALUES(:tutorial_id,:username,:comment_text,:comment_date,0)";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "tutorial_id"=>$tutorial_id,
                "username"=>$_SESSION["user_data"]["username"],
                "comment_text"=>$comment_data,
                "comment_date"=>date("Y-m-d H:i:s"),
            ));
            return true;
        }
        
        public function getComments($tutorial_id){
            $query = "SELECT * FROM Comments WHERE tutorial_id = :tutorial_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "tutorial_id"=>$tutorial_id
            ));
            $comments_data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            date_default_timezone_set("Europe/London");

            foreach($comments_data as &$comment){
                $query = "SELECT avatar_img FROM Users WHERE username = :username";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(["username" => $comment["username"]]);
                $avatar = $stmt->fetch();
                $comment["avatar_img"] = $avatar["avatar_img"];
                $origin = new DateTime();
                $comment_date = new DateTime(date($comment["comment_date"]));
                $age = $comment_date->diff($origin);
                if (!empty($age->format('%a'))){
                    $time_difference=$age->format('%a days ago');
                     } elseif ($comment_date->format('d') != $origin->format('d')){
                          $time_difference="yesterday";
                          }elseif (!empty($age->format('%h'))){
                                  $time_difference=$age->format('%h hr, %i min ago');
                                  } elseif (!empty($age->format('%i'))){
                                           $time_difference=$age->format('%i min ago');
                                           } elseif (!empty($age->format('%s'))){
                                             $time_difference=$age->format('%s sec ago');
                                           }
                $comment["age"] = $time_difference;
            }
            return $comments_data;
        }
    }