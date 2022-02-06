<?php
session_start();
require_once(__DIR__.'/../includes/config.include.php');
require_once(__DIR__.'/../includes/db.include.php');
require_once(__DIR__.'/../includes/autoloader.include.php');


if($_SESSION["user_data"]){
    $q1 = (string) $_POST["q1"];
    $q2 = (string) $_POST["q2"];
    if($q1 != ""){
        $journal = new Journal($Conn);
        $submit = $journal->submitEntry($q1, $q2); 
        if($submit){
            echo json_encode($submit);
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