<?php

session_start();
require_once(__DIR__.'/../includes/config.include.php');
require_once(__DIR__.'/../includes/db.include.php');
require_once(__DIR__.'/../includes/autoloader.include.php');

if($_POST["query"]){
    $query = $_POST["query"];
    $note = new Note($Conn);
    $notes = $note->noteSearch($query);
    if($notes){
        echo json_encode($notes);
    }else{
        echo json_encode(array(
            "failed"=>"Couldn't find notes"
        ));
    }
}
