<?php 



    if($_SESSION["logged_in"]){
        $note = new Note($Conn);
        $note_data = $note->GetAllNotes();

        if($note_data){
            $smarty->assign("notes", $note_data);
        }
    }
    