<?php

session_start();
require_once(__DIR__.'/../includes/config.include.php');
require_once(__DIR__.'/../includes/db.include.php');
require_once(__DIR__.'/../includes/autoloader.include.php');

 $ch = curl_init();

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_URL, " https://www.googleapis.com/books/v1/volumes?q=javascript");
 $output = curl_exec($ch);
 curl_close($ch);

 $book = json_decode($output, true);
 $book_text = $book[0];
 echo $book_text;

 if($book_text){
     $smarty->assign("book",$book_text);
     if($book_author){
         $smarty->assign("author",$book_author);
     }
 }

