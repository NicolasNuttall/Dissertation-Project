<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');
    if($_SESSION["user_data"]){
        $note_id = (int) $_POST["note_id"];
        $note_title = (string) $_POST["note_title"];
        if($note_id != ""){
            $note = new Note($Conn);
            $publish = $note->Publishnote($note_title, $note_id); 
            if($publish == True){
                echo json_encode(array(
                    "success"=>true,
                ));
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"Unsuccessfully deleted"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"No note ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }