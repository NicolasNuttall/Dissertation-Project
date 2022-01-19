<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $book_id = (string) $_POST["book_id"];
        $note_data = (string) $_POST["note_data"];
        if($book_id && $note_data != ""){
            $Note = new Note($Conn);
            $submit = $Note->CreateNote($note_data,$book_id); 
            if($submit){
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"Comment Was submitted",

                ));
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"comment wasn't submitted"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"No tutorial ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }