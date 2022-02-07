<?php
class Note{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function CreateNote($notecontent, $bookid){
        $query = "INSERT INTO Notes (NoteContent,Username,BookID,Creation_Date,Note_Title,private_status) VALUES (:NoteContent,:Username,:BookID,:Creation_Date, :Note_Title,:private_status)";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "NoteContent"=>$notecontent,
            "Username"=>$_SESSION["user_data"]["username"],
            "BookID"=>$bookid,
            "Creation_Date"=>date("Y-m-d H:i:s"),
            "Note_Title"=>"Untitled Note",
            "private_status"=>"True"
        ]);
        $a = $this->getNoteID($bookid);
        return $a;
    }
    public function getNoteID($bookid){
        $query ="SELECT NoteID, Creation_Date FROM Notes WHERE Username = :username AND BookID = :bookid ORDER BY Creation_Date DESC LIMIT 1";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "bookid"=>$bookid
        ]);
        $a = $stmt->fetch();
        return $a;
    }

    public function GetUserNotes($book_id){
        $query = "SELECT * FROM Notes WHERE Username = :username AND BookID = :book_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "book_id"=>$book_id
        ]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notes_data = $this->getNoteAge($notes);

        return $notes_data;
    }

    public function getNoteAge($notes_data){
        foreach($notes_data as &$note){
            $origin = new DateTime();
            $note_date = new DateTime(date($note["Creation_Date"]));
            $age = $note_date->diff($origin);
            if (!empty($age->format('%a'))){
            $time_difference=$age->format('%a days ago');
            } elseif ($note_date->format('d') != $origin->format('d')){
                $time_difference="yesterday";
            }elseif (!empty($age->format('%h'))){
                    $time_difference=$age->format('%h hr, %i min ago');
            } elseif (!empty($age->format('%i'))){
                    $time_difference=$age->format('%i min ago');
            } elseif (!empty($age->format('%s'))){
                $time_difference=$age->format('%s sec ago');
            }
            $note["age"] = $time_difference;
        }
        return $notes_data;
    }

    public function GetCommunityNotes($book_id){
        $query = "SELECT * FROM Notes WHERE BookID = :book_id AND private_status = 'False' ORDER BY Creation_Date DESC" ;
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "book_id"=>$book_id
        ]);
        $notes_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($notes_data as &$note){
            $note["liked"] = $this->isadded($note["NoteID"]);

            $origin = new DateTime();
            $note_date = new DateTime(date($note["Creation_Date"]));
            $age = $note_date->diff($origin);
            if (!empty($age->format('%a'))){
            $time_difference=$age->format('%a days ago');
            } elseif ($note_date->format('d') != $origin->format('d')){
                $time_difference="yesterday";
            }elseif (!empty($age->format('%h'))){
                    $time_difference=$age->format('%h hr, %i min ago');
            } elseif (!empty($age->format('%i'))){
                    $time_difference=$age->format('%i min ago');
            } elseif (!empty($age->format('%s'))){
                $time_difference=$age->format('%s sec ago');
            }
            $note["age"] = $time_difference;
        }

        return $notes_data;
    }

    public function Deletenote($note_id){
        $query = "DELETE FROM Notes WHERE NoteID = :note_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "note_id"=>$note_id
        ]);
        return true;
    }

    public function Publishnote($note_title, $note_id){
        $query = "UPDATE Notes SET private_status = 'False', Note_Title = :note_title WHERE NoteID = :note_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "note_title"=>$note_title,
            "note_id"=>$note_id
        ]);
        return true;
    }

    public function EditNote($note_text, $note_id, $note_title){
        $query = "UPDATE Notes SET NoteContent = :note_text, Note_Title = :note_title WHERE NoteID = :note_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "note_text"=>$note_text,
            "note_title"=>$note_title,
            "note_id"=>$note_id
        ]);
        
        return $note_text;
    }

    public function UpdateTime($book_id, $count){

        $query = "SELECT * FROM TimeSpent WHERE username = :username AND book_id = :book_id ";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "book_id"=>$book_id
        ]);
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($book) > 0){
            $query = "UPDATE TimeSpent SET timer = timer + :count_ WHERE username = :username AND book_id = :book_id" ;
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "count_"=>$count,
                "username"=>$_SESSION["user_data"]["username"],
                "book_id"=>$book_id
            ]);
            $query = "UPDATE Goal SET goal_achieved = goal_achieved + :count_ WHERE username= :username";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "count_"=>$count,
                "username"=>$_SESSION["user_data"]["username"],
            ]);
            return $count; 

        }else{
            $query = "INSERT INTO TimeSpent (username, book_id, timer) VALUES (:username,:book_id, :count_)";
            $stmt= $this->Conn->prepare($query);
            $stmt->execute([
                "username"=>$_SESSION["user_data"]["username"],
                "book_id"=>$book_id,
                "count_"=>$count
            ]);
            return $count;
        }
    }

    public function ToggleSave($note_id){
        $added = $this->isadded($note_id);
        if($added){
            $query = "DELETE FROM SavedNotes WHERE NoteID = :NoteID AND Username = :username";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "NoteID"=>$note_id,
                "username"=>$_SESSION["user_data"]["username"]
            ]);
            return false;
        }else{
            $query = "INSERT INTO SavedNotes (NoteID, Username) VALUES (:NoteID,:username)";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute(array(
                "NoteID"=>$note_id,
                "username"=>$_SESSION["user_data"]["username"]
            ));           
            return true;
        }
    }

    public function isadded($note_id){
        $query = "SELECT * FROM SavedNotes WHERE NoteID = :NoteID AND Username = :username";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "NoteID"=>$note_id,
            "username"=>$_SESSION["user_data"]["username"]
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function likedNotes(){
        $query = "SELECT * FROM SavedNotes WHERE Username = :username ORDER BY SavedNoteID DESC ";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"]
        ]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notes_list = array();
        foreach($notes as &$note){
            $query = "SELECT * FROM Notes WHERE NoteID = :note_id";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([
                "note_id"=>$note["NoteID"]
            ]);
            $note_data =$stmt->fetch(PDO::FETCH_ASSOC);
            $note_data["liked"] = $this->isadded($note["NoteID"]);
            array_push($notes_list, $note_data);
        }
        $this->getNoteAge($notes_list);
        return $notes_list;
    }

    public function getAllNotes(){
        $query = "SELECT * FROM Notes WHERE Username = :username ORDER BY Creation_Date DESC";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
        ]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notes_data = $this->getNoteAge($notes);
        foreach($notes_data as &$note){
            $note["liked"] = $this->isadded($note["NoteID"]);
            $note["bookinfo"]=$this->getBookInfo($note["BookID"]);
        }

        return $notes_data;
    }

    public function getBookInfo($book_id){
        $query = "SELECT * FROM Books WHERE BookID = :book_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "book_id"=>$book_id
        ]);
        return $stmt->fetch();
    }
}