<?php
class Book{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function LoadData($book_id){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/books/v1/volumes/".$book_id);
        $output = curl_exec($ch);
        curl_close($ch);
        $book = json_decode($output, true);
        $book_data = array();
        if($book && $book["volumeInfo"]["authors"]){
            if($book["volumeInfo"]["imageLinks"]["thumbnail"]){
                $book_data["usedImage"] = $book["volumeInfo"]["imageLinks"]["thumbnail"];
            }elseif($book["volumeInfo"]["imageLinks"]["smallThumbnail"]){
                $book_data["usedImage"] = $book["volumeInfo"]["imageLinks"]["smallThumbnail"];
            }elseif($book["volumeInfo"]["imageLinks"]["small"]){
                $book_data["usedImage"] = $book["volumeInfo"]["imageLinks"]["small"];
            }elseif($book["volumeInfo"]["imageLinks"]["large"]){
                $book_data["usedImage"] = $book["volumeInfo"]["imageLinks"]["large"];
            }else{
                $book_data["usedImage"] = "No Image";
            }
            if($book["volumeInfo"]["title"]){
                $book_data["title"] = $book["volumeInfo"]["title"];
            }
            else{
                $book_data["title"] = "Unknown";
            }
            if($book["volumeInfo"]["categories"]){
                $book_data["genre"] = $book["volumeInfo"]["categories"][0];
            }
            if($book["saleInfo"]["buyLink"]){
                $book_data["buyLink"]=$book["saleInfo"]["buyLink"];
            }

            if($book["volumeInfo"]["authors"]){
                $book_data["authors"] = implode(", ", $book["volumeInfo"]["authors"]);
            }else{
                $book_data["authors"] = "Unknown Author";
            }

            $year = $book["volumeInfo"]["publishedDate"];
            if($year){
                $book_data["year"] = substr($year, 0, 4 ); 
            }else{
                $book_data["year"] = "Year Unknown";
            }
            
            if($book["volumeInfo"]["description"]){
                $book_data["description"] = $book["volumeInfo"]["description"];
            }else{
                $book_data["description"] = "No Description";
            }
        }

        $timer = $this->getTimeAmount($book_id);

        $book_data["timer"]["hours"] = floor($timer["amount"] / 3600);
        $book_data["timer"]["minutes"] = floor(($timer["amount"]/60) % 60);
        $book_data["timer"]["seconds"] = $timer["amount"] % 60;
        if($timer["amount"] > 0){
            $book_data["sec"] = $timer["amount"];  
        }else{
            $book_data["sec"] = 0;
        }
        $book_data["id"] = $book_id;
        $book_data["notes"] = $this->getNotesAmount($book_id);
        return $book_data;
    }

    public function ToggleAdd($book_id){
        $added = $this->isadded($book_id);
        $saved =$this->issaved($book_id);
        $book_data=$this->LoadData($book_id);
        if($added){
            $query = "DELETE FROM DashboardItems WHERE BookID = :BookID AND username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "BookID"=>$book_id,
                "username"=>$_SESSION["user_data"]["username"]
            ]);
            return false;
        }else{
            $query = "INSERT INTO DashboardItems (BookID, username, add_time) VALUES (:book_id,:username,:add_time)";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "book_id"=>$book_id,
                "username"=>$_SESSION["user_data"]["username"],
                "add_time"=>date("Y-m-d H:i:s")
            ));
            if($saved == False){
                $query = "INSERT INTO Books (BookID,BookTitle,BookDesc,BookPublishDate,Authors,BookImage, genre) VALUES (:BookID,:BookTitle,:BookDesc,:BookPublishDate,:Authors,:BookImage, :genre)" ;
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                    "BookID"=>$book_id,
                    "BookTitle"=>$book_data["title"],
                    "BookDesc"=>$book_data["description"],
                    "BookPublishDate"=>$book_data["year"],
                    "Authors"=>$book_data["authors"],
                    "BookImage"=>$book_data["usedImage"],
                    "genre"=>$book_data["genre"]
                ));
                
            }
            return true;
        }
    

    }

    public function isadded($book_id){
        $query = "SELECT * FROM DashboardItems WHERE BookID = :book_id AND username = :username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "book_id"=>$book_id,
            "username"=>$_SESSION["user_data"]["username"]
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function issaved($book_id){
        $query = "SELECT * FROM Books WHERE BookID = :book_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "book_id"=>$book_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function GetBookshelf($username){
        $query = "SELECT * FROM DashboardItems WHERE username=:username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$username
        ]);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bookshelf_data = $this->getBooksData($books);
        return $bookshelf_data;
    }

    public function getBooksData($books){
        $book_list = array();
        foreach($books as &$book){
            $query="SELECT * FROM Books WHERE BookID = :book_id";
            $stmt=$this->Conn->prepare($query);
            $stmt->execute([
                "book_id"=>$book["BookID"]
            ]);
            $book_item_data = $stmt->fetch();
            $book_item_data["notes"] = $this->getNotesAmount($book["BookID"]);
            
            $timer = $this->getTimeAmount($book["BookID"]);

            $book_item_data["timer"]["hours"] = floor($timer["amount"] / 3600);
            $book_item_data["timer"]["minutes"] = floor(($timer["amount"]/60) % 60);
            $book_item_data["timer"]["seconds"] = $timer["amount"] % 60;

            if($book_item_data["BookID"]){
                array_push($book_list,$book_item_data);
            }
        }

        return $book_list;
    }

    public function getTimeAmount($book_id){
        $query = "SELECT timer as amount FROM TimeSpent WHERE username = :username AND book_id = :book_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "book_id"=>$book_id
        ]);
        
        $timer = $stmt->fetch();
        return $timer;
    }

    public function getNotesAmount($book_id){
        $query = "SELECT COUNT(NoteID) as amount FROM Notes WHERE BookID = :BookID AND Username = :Username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "BookID"=>$book_id,
            "Username"=>$_SESSION["user_data"]["username"]
        ));
        return $attempt = $stmt->fetch();
    
    }
    
    public function recentlyRead(){
        $query ="SELECT * FROM Notes WHERE username = :username GROUP BY BookID ORDER BY Creation_Date DESC LIMIT 5";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$_SESSION["user_data"]["username"]
        ));
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $book_list = array();
        foreach($books as &$book){
            $query ="SELECT * FROM Books WHERE BookID = :book_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "book_id"=>$book["BookID"]
            ));
            $item = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $book_item["BookID"] = $item[0]["BookID"];
            $book_item["Title"] = $item[0]["BookTitle"];
            array_push($book_list, $book_item);
        }
        return $book_list;
    }

    public function getByQuery($q){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/books/v1/volumes?".$q);
        $output = curl_exec($ch);
        curl_close($ch);
        $books = json_decode($output, true);
        $data = array();
        for($x = 0; $x <= 10; $x++){
            $book_data = array();
            if($books["items"][$x] && $books["items"][$x]["volumeInfo"]["authors"]){
                $book_data["id"]=$books["items"][$x]["id"];
                if($books["items"][$x]["volumeInfo"]["imageLinks"]["thumbnail"]){
                    $book_data["usedImage"] = $books["items"][$x]["volumeInfo"]["imageLinks"]["thumbnail"];
                }elseif($books["items"][$x]["volumeInfo"]["imageLinks"]["smallThumbnail"]){
                    $book_data["usedImage"] = $books["items"][$x]["volumeInfo"]["imageLinks"]["smallThumbnail"];
                }elseif($books["items"][$x]["volumeInfo"]["imageLinks"]["small"]){
                    $book_data["usedImage"] = $books["items"][$x]["volumeInfo"]["imageLinks"]["small"];
                }elseif($books["items"][$x]["volumeInfo"]["imageLinks"]["large"]){
                    $book_data["usedImage"] = $books["items"][$x]["volumeInfo"]["imageLinks"]["large"];
                }
                if($books["items"][$x]["volumeInfo"]["title"]){
                    $book_data["title"] = $books["items"][$x]["volumeInfo"]["title"];
                }
                else{
                    $book_data["title"] = "Unknown";
                }
                if($books["items"][$x]["volumeInfo"]["categories"]){
                    $book_data["genre"] = $books["items"][$x]["volumeInfo"]["categories"][0];
                }

                if($books["items"][$x]["volumeInfo"]["authors"]){
                    $book_data["authors"] = implode(", ", $books["items"][$x]["volumeInfo"]["authors"]);
                }else{
                    $book_data["authors"] = "Unknown Author";
                }

                $year = $books["items"][$x]["volumeInfo"]["publishedDate"];
                if($year){
                    $book_data["year"] = substr($year, 0, 4 ); 
                }else{
                    $book_data["year"] = "Year Unknown";
                }
                
                if($books["items"][$x]["volumeInfo"]["description"]){
                    $book_data["description"] = $books["items"][$x]["volumeInfo"]["description"];
                }else{
                    $book_data["description"] = "No Description";
                }
            }
            if($book_data["usedImage"]){
                
                array_push($data, $book_data);
            }
        }

        return $data;
    }

    public function recomended(){
        $query = "SELECT BookID FROM DashboardItems WHERE username=:username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$_SESSION["user_data"]["username"]
        ));
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $genre_list = array();
        foreach($books as &$book){
            $query ="SELECT genre FROM Books WHERE BookID = :book_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "book_id"=>$book["BookID"]
            ));
            $item = $stmt->fetch();
            $x = explode("/", $item[0]);
            foreach($x as $t){
                if($t != ""){
                    array_push($genre_list, $t);
                }
            }
        }
        $sorted_genres = array_count_values($genre_list);
        $genre_item = array_keys($sorted_genres);

        $book_set = array();

        $random = rand(0, count($genre_item) - 1);

        if($genre_item[$random]){
            $q = "q=subject:".$genre_item[$random];
            $book_data = $this->getByQuery(str_replace(' ', "%20",$q));
            foreach($book_data as &$book){
                array_push($book_set, $book);
            }
        }
    
        return $book_set;

    }

    public function byAuthor(){
        $query = "SELECT BookID FROM DashboardItems WHERE username=:username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            "username"=>$_SESSION["user_data"]["username"]
        ));
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $author_list = array();
        foreach($books as &$book){
            $query ="SELECT Authors FROM Books WHERE BookID = :book_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "book_id"=>$book["BookID"]
            ));
            $item = $stmt->fetch();

            $x = explode(",", $item[0]);
            foreach($x as $t){
                if($t != ""){
                    array_push($author_list, $t);
                }
            }
        }

        $sorted_authors = array_count_values($author_list);
        $author_item = array_keys($sorted_authors);
        $book_set = array();

        $random = rand(0, count($author_item) - 1);
        if($author_item[$random]){
            $q = "q=inauthor:".$author_item[$random];
            $book_data = $this->getByQuery(str_replace(' ', "-",$q));
            foreach($book_data as &$book){
                array_push($book_set, $book);
            }
        }
        
        return $book_set;
    } 

    
}