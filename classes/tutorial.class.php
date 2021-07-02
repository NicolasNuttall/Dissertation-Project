<?php
 class Tutorial{
    protected  $Conn;
    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function AddTutorial($tutorial_data, $username){
        $query = "INSERT INTO Tutorials (Title, thumbnail_img,tutorial_content,description,username,publish_date,category_name) VALUES (:Title, :thumbnail_img,:tutorial_content,:description,:username,:publish_date,:category)";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "Title"=>$tutorial_data["Title"],
            "thumbnail_img"=>$tutorial_data["thumbnail"],
            "tutorial_content"=>$tutorial_data["tutorial_content"],
            "description"=>$tutorial_data["description"],
            "username"=>$username,
            "publish_date"=>date("Y-m-d H:i:s"),
            "category"=>$tutorial_data["Category"],
        ));

        $query="SELECT tutorial_id FROM Tutorials WHERE username=:username  ORDER BY publish_date DESC LIMIT 1";
        $stmt=$this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$username
        ));
        $last_id = $stmt->fetch();
        $tags_input = explode("?", $tutorial_data["tagArray"]);
        $tags = array_unique($tags_input);
        foreach($tags as &$tag){
            if($tag != ""){
                $query = "INSERT INTO Tags VALUES(:tag, :tut_id);";
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                    "tag"=>$tag,
                    "tut_id"=>$last_id["tutorial_id"]
                ));
            }
        }
        
        return true;
    }
    public function getLikes($tutorial_id){
        $query="SELECT COUNT(tutorial_id) AS amount FROM Likes WHERE tutorial_id=:tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "tutorial_id"=>$tutorial_id,
        ));
        return $attempt = $stmt->fetch();
    }

    public function getTutorial($tutorial_id){
        $query ="SELECT * FROM Tutorials WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "tutorial_id"=>$tutorial_id,
        ));
        $tutorial_data = $stmt->fetch();
        date_default_timezone_set("Europe/London");
        $origin = new DateTime();
        $tutorial_date = new DateTime(date($tutorial_data["publish_date"]));
        $age = $tutorial_date->diff($origin);
        if (!empty($age->format('%a'))){
            $time_difference=$age->format('%a days ago');
                } elseif ($tutorial_date->format('d') != $origin->format('d')){
                    $time_difference="yesterday";
                    }elseif (!empty($age->format('%h'))){
                            $time_difference=$age->format('%h hr, %i min ago');
                            } elseif (!empty($age->format('%i'))){
                                    $time_difference=$age->format('%i min ago');
                                    } elseif (!empty($age->format('%s'))){
                                        $time_difference=$age->format('%s sec ago');
                                    }
        $tutorial_data["age"] = $time_difference;
        return $tutorial_data;
    }

    public function getTags($tutorial_id){
        $query = "SELECT * FROM Tags WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(["tutorial_id" =>$tutorial_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserLikes($username){
        $query = "SELECT tutorial_id FROM Likes WHERE username =:username";
        $stmt=$this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$username
        ));
        $likes =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tutorials_data =  $this->getTutorialsData($likes);

        return $tutorials_data;
    }

    public function getFinishedNumber($tutorial_id){
        $query = "SELECT * FROM COUNT(finish_id) WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "tutorial_id"=>$tutorial_id,
        ));
        return $attempt = $stmt->fetch();
    }

    public function getCommentsNumber($tutorial_id){
        $query = "SELECT COUNT(comment_id) as amount FROM Comments WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "tutorial_id"=>$tutorial_id,
        ));
        return $attempt = $stmt->fetch();
    }

    public function getTutorialsData($tutorials){
        $tutorials_list = array();
        foreach($tutorials as &$tutorial){
            $query="SELECT * FROM Tutorials WHERE tutorial_id = :tutorial_id";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute(array(
                "tutorial_id"=>$tutorial["tutorial_id"]
            ));
            $tutorial_data = $stmt->fetch();

            $tutorial_data["likes_amount"] = $this->getLikes($tutorial["tutorial_id"]);
            $tutorial_data["comments_amount"] = $this->getCommentsNumber($tutorial["tutorial_id"]);
            $tutorial_data["is_liked"] = $this->isLiked($tutorial["tutorial_id"]);
            $tutorial_data["is_marked"] = $this->isMarked($tutorial["tutorial_id"]);
            if($tutorial_data["tutorial_id"]){
                array_push($tutorials_list,$tutorial_data);
            }
        }

        return $tutorials_list;
    }
    
    public function getTutorials($username){
        $query = "SELECT * FROM Tutorials WHERE username = :username";
        $stmt=$this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$username
        ));
        $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tutorials_data = $this->getTutorialsData($tutorials);
        return $tutorials_data;
    }

    public function isLiked($tutorial_id){
        $query = "SELECT * FROM Likes WHERE tutorial_id = :tutorial_id AND username = :username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "tutorial_id"=>$tutorial_id,
            "username"=>$_SESSION["user_data"]["username"]
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) == 0 ){
            return false;
        }else{
            return true;
        }
    }
    
    public function isMarked($tutorial_id){
        $query = "SELECT * FROM Finished WHERE tutorial_id = :tutorial_id AND username = :username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "tutorial_id"=>$tutorial_id,
            "username"=>$_SESSION["user_data"]["username"]
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) == 0 ){
            return false;
        }else{
            return true;
        }
    }

    public function getFinished($username){
        $query = "SELECT tutorial_id FROM Finished WHERE username =:username";
        $stmt=$this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$username
        ));
        $finished =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tutorials_data = $this->getTutorialsData($finished);

        return $tutorials_data;
    }

    public function searchTutorials($search){
        $tutorials = array();
        $query = "SELECT * FROM Tutorials WHERE Title LIKE :search OR username LIKE :search OR description LIKE :search";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "search"=>"%" . $search . "%",
        ));
        $t1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $query="SELECT * FROM Tags WHERE Tag = :search";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "search"=> $search,
        ));
        $t2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($t1 as &$t){
            array_push($tutorials, $t);
        }
        foreach($t2 as &$t){
            $count = 0;
            foreach($tutorials as $tut){
                if($tut["tutorial_id"] == $t["tutorial_id"]){
                    $count = 1;
                }
            }
            if($count == 0 ){
                $query = "SELECT * FROM Tutorials WHERE tutorial_id = :tutorial_id";
                $stmt=$this->Conn->prepare($query);
                $stmt->execute(array(
                   "tutorial_id"=>$t["tutorial_id"]
                ));
                $tutorial = $stmt->fetch();
                array_push($tutorials, $tutorial);    
                 
            }
        }
        $tutorials_data = $this->getTutorialsData($tutorials);
        return $tutorials_data;
    }

    public function getFeatured(){
        $query= "SELECT * FROM Tutorials WHERE tutorial_featured = 1 ";
        $stmt=$this->Conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setFeaturedTutorials(){
        $query = "UPDATE Tutorials SET tutorial_featured = 0 WHERE tutorial_featured = 1";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute();

        $query = "SELECT tutorial_id, count(tutorial_id) as likes FROM Likes GROUP BY tutorial_id ORDER BY likes DESC LIMIT 6"; 
        $stmt = $this->Conn->prepare($query);
        $stmt->execute();
        $featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $featured_ids = array();
        $random_nums = range(0, 6);
        shuffle($random_nums);
        for($x = 0; $x <= 3; $x++){
            array_push($featured_ids, $featured[$random_nums[$x]]);
        }
        foreach($featured_ids as &$id){
            $query = "UPDATE Tutorials SET tutorial_featured = 1 WHERE tutorial_id = :tutorial_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "tutorial_id"=>$id["tutorial_id"]
            ));
        }
    }
    public function getRandomTutorials($tutorial_id){
        $query = "SELECT * FROM Tutorials WHERE tutorial_id != :tutorial_id ORDER BY RAND() LIMIT 6";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "tutorial_id"=>$tutorial_id
        ));
        $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tutorials_data = $this->getTutorialsData($tutorials);
        return $tutorials_data;
    }


    // public function delt(){
    //     $query = "SELECT * FROM Tags";
    //     $stmt=$this->Conn->prepare($query);
    //     $stmt->execute();
    //     $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $query = "SELECT * FROM Tutorials";
    //     $stmt=$this->Conn->prepare($query);
    //     $stmt->execute();
    //     $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($tags as &$tag){
    //         $count = 0;
    //         foreach($tutorials as &$tut){
    //             if($tag["tutorial_id"] == $tut["tutorial_id"]){
    //                 $count = 1;
    //             }
    //         }
    //         if($count == 0){
    //             $q = "DELETE FROM Tags WHERE tutorial_id = :tutorial_id";
    //             $stmt=$this->Conn->prepare($q);
    //             $stmt->execute(array(
    //                 "tutorial_id"=>$tag["tutorial_id"]
    //             ));
                
    //         }
    //     }
    // }

    public function getFollowingTutorials($username){
        $query = "SELECT username FROM Followers WHERE follower_username = :follower_username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "follower_username"=>$username
        ));
        $following =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tutorials = array();
        foreach($following as &$following_user){
            $query = 'SELECT * FROM Tutorials WHERE username = :username';
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "username"=>$following_user["username"]
            ));
            $following_user_tutorials =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($following_user_tutorials as &$ft){
                array_push($tutorials, $ft);
            }
        }
        $tutorials_data = $this->getTutorialsData($tutorials);
        usort($tutorials_data, "orderDate");
        return $tutorials_data;
    }

    public function getNewestTutorials(){
        $query = "SELECT * FROM Tutorials ORDER BY tutorial_id DESC LIMIT 20";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute();
        $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->getTutorialsData($tutorials);
    }

    public function getPopularTutorials(){
        $query = "SELECT tutorial_id, COUNT(tutorial_id) FROM Likes GROUP BY tutorial_id ORDER BY COUNT(tutorial_id) DESC LIMIT 20";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute();
        $tutorials = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->getTutorialsData($tutorials);
    }

    public function DeleteTutorial($tutorial_id){
        $tut_id = array(
            "tutorial_id"=>$tutorial_id
        );
        $query = "DELETE FROM Tutorials WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute($tut_id);
        $query = "DELETE FROM Likes WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute($tut_id);
        $query = "DELETE FROM Finished WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute($tut_id);
        $query = "DELETE FROM Tags WHERE tutorial_id = :tutorial_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute($tut_id);
        return true;
    }
} 

function orderDate($a, $b){
    return strcmp($a->tutorial_id, $b->tutorial_id);
}