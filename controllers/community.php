<?php 
    if($_GET["id"]){
        $book = new Book($Conn);
        $book_id = $_GET["id"];
        $smarty->assign("id",$book_id);
        $book_data = $book->LoadData($book_id);
        if($book_data){
            $smarty->assign("title",$book_data["title"]);
            $smarty->assign("year", $book_data["year"]);
            $smarty->assign("author", $book_data["authors"]);

            $smarty->assign("thumbnail",$book_data["usedImage"]);
            $smarty->assign("booksubtitle",$book_data["description"]);  
        }

    }