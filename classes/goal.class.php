<?php
class Goal{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function setGoal($goalnumber){
        $goalexists = $this->goalExists();
        if($goalexists){
            $query = "UPDATE Goal SET goal_length = :goal_length WHERE username = :username";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "goal_length"=>$goalnumber,
                "username"=>$_SESSION["user_data"]["username"]
            ]);
            return true;
        }else{
            $query = "INSERT INTO Goal (username, goal_length, creation_date) VALUES (:username, :goal_length, :creation_date)";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$_SESSION["user_data"]["username"],
                "goal_length"=>$goalnumber,
                "creation_date"=>date("Y-m-d H:i:s")
            ]);
            return true;
        }
    }

    public function goalExists(){
        $query = "SELECT * FROM Goal WHERE username = :username";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
        ]);
        return $stmt->fetch();
    }
    
    public function getProgress(){
        $query = "SELECT * FROM Goal WHERE username = :username";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
        ]);
        return $stmt->fetch();
    }

    public function resetGoal(){
        $query = "UPDATE Goal SET goal_achieved = 0 WHERE goal_achieved > 0";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute();

    }
}