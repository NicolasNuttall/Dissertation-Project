<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');
    if($_SESSION["user_data"]){
        $book_id = (string) $_POST["book_id"];
        $count = (int) $_POST["count"];
        if($book_id){
            $note = new Note($Conn);
            $updatetime = $note->UpdateTime($book_id, $count);
            if($updatetime){
                echo json_encode(array(
                    "success"=>true,
                    "some"=>$updatetime
                ));
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"Unsuccessfully deleted",
                    "some"=>$updatetime
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"No book ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }