<?php

$username = $_SESSION["user_data"]["username"];
$Book = new Book($Conn);

if($_SESSION["logged_in"]){
    
    $bookshelf = $Book->GetBookshelf($username);
    
    if($bookshelf){
        $smarty->assign("bookshelf",$bookshelf);
    }else{
        $smarty->assign("no_books",true);
    } 
}else{

}