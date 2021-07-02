<?php
    class Category{
        protected  $Conn;
        public function __construct($Conn){
            $this->Conn = $Conn;
        }

        public function getCategories(){
            $query = "SELECT * FROM Categories";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }