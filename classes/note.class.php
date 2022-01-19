<?php
class Note{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function CreateNote($notecontent, $bookid){
        $query = "INSERT INTO Notes (NoteContent,Username,BookID,Creation_Date,Note_Title,Private) VALUES (:NoteContent,:Username,:BookID,:Creation_Date, :Note_Title,:Private)";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "NoteContent"=>$notecontent,
            "Username"=>$_SESSION["user_data"]["username"],
            "BookID"=>$bookid,
            "Creation_Date"=>date("Y-m-d H:i:s"),
            "Note_Title"=>"Untitled Note",
            "Private"=>"True"
        ]);
        return true;
    }

    public function GetUserNotes($book_id){
        $query = "SELECT * FROM Notes WHERE Username = :username AND BookID = :book_id";
        $stmt= $this->Conn->prepare($query);
        $stmt->execute([
            "username"=>$_SESSION["user_data"]["username"],
            "book_id"=>$book_id
        ]);
        $notes_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}