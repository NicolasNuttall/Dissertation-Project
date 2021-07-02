<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');
    if($_SESSION["user_data"]){
        $tutorial_id = (int) $_POST["tutorial_id"];
        if($tutorial_id != ""){
            $Tutorial = new Tutorial($Conn);
            $delete = $Tutorial->DeleteTutorial($tutorial_id); 
            if($delete){
                echo json_encode(array(
                    "success"=>true,
                    "link"=>"/Promotion/profile/".$_SESSION["user_data"]["username"]
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
                "reason"=>"No tutorial ID"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }