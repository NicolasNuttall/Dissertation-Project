<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $tutorial_id = (int) $_POST["tutorial_id"];
        $comment_data = (string) $_POST["comment_data"];
        if($tutorial_id && $comment_data != ""){
            $Comment = new Comment($Conn);
            $submit = $Comment->submitComment($tutorial_id,$comment_data); 
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