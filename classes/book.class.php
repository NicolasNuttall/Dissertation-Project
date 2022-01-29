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
        if($book){
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
        $query = "SELECT timer as amount FROM TimeSpent WHERE username = :username AND book_id = :book_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "book_id"=>$book_id
        ]);
        
        $timer = $stmt->fetch();
         
        $book_data["sec"] = $timer["amount"];
        
        $book_data["timer"]["hours"] = floor($timer["amount"] / 3600);
        $book_data["timer"]["minutes"] = floor(($timer["amount"]/60) % 60);
        $book_data["timer"]["seconds"] = $timer["amount"] % 60;

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
                $query = "INSERT INTO Books (BookID,BookTitle,BookDesc,BookPublishDate,Authors,BookImage) VALUES (:BookID,:BookTitle,:BookDesc,:BookPublishDate,:Authors,:BookImage)" ;
                $stmt = $this->Conn->prepare($query);
                $stmt->execute(array(
                    "BookID"=>$book_id,
                    "BookTitle"=>$book_data["title"],
                    "BookDesc"=>$book_data["description"],
                    "BookPublishDate"=>$book_data["year"],
                    "Authors"=>$book_data["authors"],
                    "BookImage"=>$book_data["usedImage"]
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
            if($book_item_data["BookID"]){
                array_push($book_list,$book_item_data);
            }
        }

        return $book_list;
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
    
}