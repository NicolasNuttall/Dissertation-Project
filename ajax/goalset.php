<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    if($_SESSION["user_data"]){
        $goalNumber = (float) $_POST["goalNumber"];

        if($goalNumber){
            $goal = new Goal($Conn);
            $setgoal = $goal->setGoal($goalNumber);
            if($setgoal){
                echo json_encode(array(
                    "success"=>true,
                    
                ));
                
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"Unsuccessfully deleted",
                 
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