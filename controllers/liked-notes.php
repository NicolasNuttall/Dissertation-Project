<?php 
    if($_GET["p"]){
        $note = new Note($Conn);
        $liked_notes = $note->likedNotes();

        if($liked_notes){
           $smarty->assign("note_data",$liked_notes);  
        }
    }
