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
            $attempt["followed"] = $this->isFollowed($username);
            $attempt["following"] = $this->isFollowing($username);
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

        public function isFollowing($username){
            $query = "SELECT * FROM Followers WHERE username = :username AND follower_username = :follower_username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$username,
                "follower_username"=>$_SESSION["user_data"]["username"]
            ]);
            $attempt = $stmt->fetch(PDO::FETCH_ASSOC);
            return $attempt;
        }

        public function isFollowed($username){
            $query = "SELECT * FROM Followers WHERE username = :username AND follower_username = :follower_username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$_SESSION["user_data"]["username"],
                "follower_username"=>$username
            ]);
            $attempt = $stmt->fetch(PDO::FETCH_ASSOC);
            return $attempt;
        }

        public function toggleFollow($username){
            $is_following = $this->isFollowing($username);
            if($is_following){
                $query = "DELETE FROM Followers WHERE username = :username AND follower_username = :follower_username";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute([
                    "username"=>$username,
                    "follower_username"=>$_SESSION["user_data"]["username"]
                ]);
                return false;
            }else{
                $query = "INSERT INTO Followers (username, follower_username, follow_time) VALUES(:username,:follower_username,:follow_time)";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                    "username"=>$username,
                    "follower_username"=>$_SESSION["user_data"]["username"],
                    "follow_time"=>date("Y-m-d H:i:s")
                ));
                return true;
            }
        }

        public function getFollowers($username){
            $query = "SELECT follower_username as username FROM Followers WHERE username=:username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $followers =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = $this->getUserData($followers);

            return $users;
        }
        
        public function getFollowing($username){
            $query = "SELECT username FROM Followers WHERE follower_username=:follower_username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "follower_username"=>$username
            ));
            $following =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = $this->getUserData($following);
            return $users;
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


        public function getTabData($username){
            $tab_data =array();
            $query = "SELECT COUNT(follower_username) AS amount FROM Followers WHERE follower_username = :username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $following = $stmt->fetch();
            
            $query = "SELECT COUNT(username) AS amount FROM Finished WHERE username = :username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $finished = $stmt->fetch();


            $query = "SELECT COUNT(username) AS amount FROM Likes WHERE username = :username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $likes = $stmt->fetch();

            $query = "SELECT COUNT(username) AS amount FROM Followers WHERE username = :username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $followers = $stmt->fetch();


            $query = "SELECT COUNT(username) AS amount FROM Tutorials WHERE username = :username";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $tutorials = $stmt->fetch();

            array_push($tab_data, $following, $finished,$likes,$followers,$tutorials);
            return $tab_data;
        }


        public function editProfile($edit_data, $username){
            $query = "UPDATE Users SET avatar_img = :avatar, banner_img=:banner, biography = :biography, location = :location WHERE username = :username";
            $stmt=$this->Conn->prepare($query);
            return $stmt->execute(array(
                "avatar"=>$edit_data["avatar"],
                "banner"=>$edit_data["banner"],
                "biography"=>$edit_data["Biography"],
                "location"=>$edit_data["Location"],
                "username"=>$username
            ));
        }

        public function searchUsers($search){
            $query = "SELECT * FROM Users WHERE username LIKE :username LIMIT 3";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>"%". $search . "%"
            ));
            $searched_users =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = $this->getUserData($searched_users);

            return $users;

        }

        public function getPopularTags($username){
            $query = "SELECT tutorial_id FROM Tutorials WHERE username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$username
            ));
            $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tags = array();
            foreach($tutorials as &$tutorial){
                $query = "SELECT COUNT(Tag) as amount, Tag, tutorial_id FROM Tags WHERE tutorial_id = :tutorial_id GROUP BY Tag ";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                    "tutorial_id"=>$tutorial["tutorial_id"]
                ));
                $tags_amounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($tags_amounts as &$tag){
                    if(array_key_exists($tag["Tag"], $tags)){
                        $tags[$tag["Tag"]]["amount"]+= 1;
                    }
                    else{
                        $tags[$tag["Tag"]]["amount"]= 1;
                    }

                }
            }
            return(array_slice($tags,0,5,true));
        }


        public function asd(){
            $q = "UPDATE Followers SET username = 'Alexis_B' WHERE username= 'Alexis B.'";
            $s = $this->Conn->prepare($q);
            $s->execute();
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