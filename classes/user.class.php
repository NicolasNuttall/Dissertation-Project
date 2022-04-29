<?php
    class User{
        protected $Conn;
        public function __construct($Conn){
            $this->Conn=$Conn;
        }
        public function createUser($user_data){
            $sec_password = password_hash($user_data['password'],PASSWORD_DEFAULT);      
            $query = "INSERT INTO Users (username,password,email) VALUES (:username,:user_pass,:user_email)";
            $stmt = $this->Conn->prepare($query);
            return $stmt->execute(array(
                "username"=>$user_data['username'],
                "user_pass"=>$sec_password,
                "user_email"=>$user_data['email'],
            ));
        }
        
        public function loginUser($username,$password){
            $query = "SELECT * FROM Users WHERE username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $attempt = $stmt->fetch();
            
            if($attempt && password_verify($password, $attempt['password'])){
                return $attempt;
            }
            else{
                return false;
            }
        }

        public function getUser($username){
            $query = "SELECT * FROM Users WHERE username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $attempt = $stmt->fetch();

            return $attempt;
        }

        public function userExists($username, $email){
            $query = "SELECT * FROM Users WHERE username = :username";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $username_check = $stmt->fetch();

            $query ="SELECT * FROM Users WHERE email = :email";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute(array(
                "email"=>$email
            ));
            $email_check = $stmt->fetch();

            if($email_check){
                return "Email address already in use.";
            }
            if($username_check){
                return "Username taken";
            }
     
        }

        




 
    }