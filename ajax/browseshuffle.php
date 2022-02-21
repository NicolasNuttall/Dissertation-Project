<?php
    session_start();
    require_once(__DIR__.'/../includes/config.include.php');
    require_once(__DIR__.'/../includes/db.include.php');
    require_once(__DIR__.'/../includes/autoloader.include.php');

    
    if($_SESSION["user_data"]){
        $shuffle = (bool) $_POST["shuffle"];

        if($shuffle){
            $book = new Book($Conn);
            $genre = $book->recomended();
            $authors = $book->byAuthors();
            if($authors){
                echo json_encode($authors);
                $smarty->assign("recomended",$genre);
                $smarty->assign("authors",$authors);
            }else{
                echo json_encode(array(
                    "success"=>true,
                    "reason"=>"no data"
                ));
            }
        }else{
            echo json_encode(array(
                "success"=>false,
                "reason"=>"k"
            ));
        }
    }else{
        echo json_encode(array(
            "success"=>false,
            "reason"=>"k"
        ));
    }