<?php 
    if($_GET["id"]){
        $book = new Book($Conn);
        $book_id = $_GET["id"];
        $smarty->assign("id",$book_id);
        $book_data = $book->LoadData($book_id);
        
        if($book_data){
            $smarty->assign("book_data",$book_data);  
        }

        $note = new Note($Conn);
        $note_data = $note->GetUserNotes($book_id);
        if($note_data){
            $smarty->assign("notes", $note_data);
        }

    }

    if($_SESSION['user_data']){
        $book = new Book($Conn);
        $is_added = $book->isadded($book_id);
        if($is_added){
            $smarty->assign("is_added", true);
        }else{
            $smarty->assign("is_added",false);
        }


    }