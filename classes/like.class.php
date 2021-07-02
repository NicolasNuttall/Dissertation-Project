<?php
    class Like{
        protected $Conn;

        public function __construct($Conn){
            $this->Conn = $Conn;
        }

        public function isLiked($tutorial_id){
            $query = "SELECT * FROM Likes WHERE tutorial_id = :tutorial_id AND username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "tutorial_id"=>$tutorial_id,
                "username"=>$_SESSION["user_data"]["username"]
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function toggleLike($tutorial_id){
            $is_liked = $this->isLiked($tutorial_id);

            if($is_liked){
                $query = "DELETE FROM Likes WHERE like_id = :like_id";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute([
                    "like_id"=>$is_liked['like_id']
                ]);
                return false;
            }else{
                $query = "INSERT INTO Likes (username,tutorial_id,seen,like_time) VALUES (:username,:tutorial_id,0,:like_time)";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute([
                    "username"=>$_SESSION["user_data"]["username"],
                    "tutorial_id"=>$tutorial_id,
                    "like_time"=>date("Y-m-d h:i:sa")
                ]);
                return true;
            }
        }
    }