<?php 

    if($_GET["id"]){
        $book = new Book($Conn);
        $book_id = $_GET["id"];
        $smarty->assign("id",$book_id);
        $book_data = $book->LoadData($book_id);
        if($book_data){
            $smarty->assign("book_data",$book_data);  
        }

    }