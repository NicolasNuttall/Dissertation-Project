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
        
        public function loginUser($email,$password){
            $query = "SELECT * FROM Users WHERE email = :user_email";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "user_email"=>$email
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

        public function getUserData($users_list){
            $users = array();
            foreach($users_list as &$user){
                $query="SELECT username,avatar_img,banner_img,biography FROM Users WHERE username=:username";
                $stmt=$this->Conn->prepare($query);
                $stmt->execute(array(
                    "username"=>$user["username"]
                ));
                $userData=$stmt->fetch();
                $userData["followed"] = $this->isFollowed($user["username"]);
                $userData["following"] = $this->isFollowing($user["username"]);
                
                $query = "SELECT COUNT(username) AS amount FROM Followers WHERE username = :username";
                $stmt=$this->Conn->prepare($query);
                $stmt->execute(array(
                    "username"=>$user["username"]
                ));
                $followers = $stmt->fetch();
                $userData["followers"] = $followers["amount"];
                
                array_push($users,$userData);
            }

            return $users;
        }




        // public function changeUserPassword($current_pass, $new_pass){
        //     if(!password_verify($current_pass, $_SESSION['user_data']['user_pass'])){
        //         return false;
        //     }
            
        //     $new_sec_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        //     $query = "UPDATE users SET user_pass = :user_pass WHERE user_id = :user_id";
        //     $stmt = $this->Conn->prepare($query);
        //     $stmt->execute(array(
        //         "user_pass" =>$new_sec_pass,
        //         "user_id"=>$_SESSION["user_data"]["user_id"]
        //     ));
        //     return true;
        // }
    }