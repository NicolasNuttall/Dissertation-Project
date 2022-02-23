<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $shuffle = (int) $_POST["shuffle"];

        if($shuffle){
            $book = new Book($Conn);
            
            $authors = $book->byAuthor();
            $recomended = $book->recomended();
            if($authors){
         
                echo json_encode(array($recomended,$authors));

            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"no data"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"b"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"k"
        ));
    }