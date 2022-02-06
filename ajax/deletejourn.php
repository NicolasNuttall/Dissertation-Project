<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');
    if($_SESSION["user_data"]){
        $journ_id = (int) $_POST["journ_id"];
        if($journ_id != ""){
            $journ = new Journal($Conn);
            $delete = $journ->DeleteJournal($journ_id); 
            if($delete == True){
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
                "reason"=>"No journ ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }