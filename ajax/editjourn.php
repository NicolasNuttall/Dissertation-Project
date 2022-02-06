<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');
    if($_SESSION["user_data"]){
        $journ_id = (int) $_POST["journ_id"];
        $journ_text = (string) $_POST["journ_text"];
        $journ_text2 = (string) $_POST["journ_text2"];

        if($journ_id != ""){
            $journ = new Journal($Conn);
            $save = $journ->EditJournal($journ_text, $journ_text2, $journ_id); 
            if($save == True){
                echo json_encode($publish);
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"Unsuccessfully deleted"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"No journ ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }