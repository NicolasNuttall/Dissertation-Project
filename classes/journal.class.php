<?php

    class Journal{
        protected $Conn;

        public function __construct($Conn){
            $this->Conn = $Conn;
        }

        public function submitEntry($q1,$q2){
            $query = "INSERT INTO JournalEntries (username, q1, q2, creation_date) VALUES (:username, :q1,:q2,:creation_date)";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$_SESSION["user_data"]["username"],
                "q1"=>$q1,
                "q2"=>$q2,
                "creation_date"=>date("Y-m-d H:i:s")
            ]);
            return true;
        }

        public function getArchive(){
            $query = "SELECT * FROM JournalEntries WHERE username = :username";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$_SESSION["user_data"]["username"],

            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function EditJournal($journ_text,$journ_text2,$journ_id){
            $query = "UPDATE JournalEntries SET q1 = :journ_text, q2 = :journ_text2 WHERE journal_entry_id = :journ_id";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "journ_text"=>$journ_text,
                "journ_text2"=>$journ_text2,
                "journ_id"=>$journ_id
            ]);
            
            return $journ_text;
        }

            
        public function DeleteJournal($journ_id){
            $query = "DELETE FROM JournalEntries WHERE journal_entry_id = :journ_id";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "journ_id"=>$journ_id
            ]);
            return true;
        }
    }