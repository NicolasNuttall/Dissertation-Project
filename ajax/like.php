<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $tutorial_id = (int) $_POST["tutorial_id"];
        if($tutorial_id){
            $Like = new Like($Conn);
            $toggle = $Like->toggleLike($_POST['tutorial_id']);
            if($toggle){
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"tutorial was added to favourites"
                ));
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"tutorial was removed from favourites"
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