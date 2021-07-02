<?php
    class Mark{
        protected $Conn;
        public function __construct($Conn){
            $this->Conn = $Conn;
        }
        public function isMarked($tutorial_id){
            $query = "SELECT * FROM Finished WHERE tutorial_id = :tutorial_id AND username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "tutorial_id"=>$tutorial_id,
                "username"=>$_SESSION["user_data"]["username"]
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function ToggleMark($tutorial_id){
            $marked = $this->isMarked($tutorial_id);
            if($marked){
                $query = "DELETE FROM Finished WHERE finish_id = :finish_id";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute([
                    "finish_id"=>$marked['finish_id']
                ]);
                return false;
            }else{
                $query = "INSERT INTO Finished (username,tutorial_id,finish_time) VALUES (:username,:tutorial_id,:finish_time)";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                   "username"=>$_SESSION["user_data"]["username"],
                   "tutorial_id"=>$tutorial_id,
                   "finish_time"=>date("Y-m-d H:i:s")
                ));
                return true;
            }

            
        }
        
    }