<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL & ~E_NOTICE);
 require_once(__DIR__.'/includes/boot.include.php');




 //Check if page is detected
 if($_GET['p']){
     $secure_pages = array("bookshelf","study","notes"); //Add pages here
     if(in_array($_GET['p'],$secure_pages)){
         if(!$_SESSION["logged_in"]){
             header("Location: /Readie/login");
             exit();
         }
     }
     require_once('controllers/'.$_GET['p'].'.php');
     $smarty->display('pages/'.$_GET['p'].'.tpl');
 }else{
     require_once('controllers/bookshelf.php');
     $smarty->display('pages/bookshelf.tpl');
 }

?>