<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $username = (string) $_POST["username"];
        if($username){
            $User = new User($Conn);
            $toggle = $User->toggleFollow($_POST['username']);
            if($toggle){
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"User was followed"
                ));
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"User was unfollowed"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"No username"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"user not logged in"
        ));
    }