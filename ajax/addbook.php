<?php
 session_start();
 require_once(__DIR__.'/../includes/config.include.php');
 require_once(__DIR__.'/../includes/db.include.php');
 require_once(__DIR__.'/../includes/autoloader.include.php');

 
 if($_SESSION["user_data"]){
     $book_id = (string) $_POST["book_id"];
     if($book_id){
         $add = new Book($Conn); 
         $toggle = $add->ToggleAdd($book_id);
         if($toggle){
             echo json_encode(array(
                 "success"=>true,
                 "reason"=>"Add Was submitted",

             ));
         }else{
             echo json_encode(array(
                 "success"=>true,
                 "reason"=>"Add wasn't submitted"
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