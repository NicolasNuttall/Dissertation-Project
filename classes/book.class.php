<?php
class Book{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function LoadData(){
        $book_id = $_GET["id"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/books/v1/volumes/".$book_id);
        $output = curl_exec($ch);
        curl_close($ch);
        $book = json_decode($output, true);
        return $book;
    }

    public function ToggleAdd($book_id){
        $added = $this->isadded($book_id);
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
}