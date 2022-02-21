<?php
     if($_SESSION["logged_in"]){
        $book = new Book($Conn);
        $recomended = $book->recomended();
        $byAuthors = $book->byAuthor();
        if($recomended){
            $smarty->assign("recomended",$recomended);
        }
        if($byAuthors){
            $smarty->assign("authors",$byAuthors);
        }

    }