<?php 
    if($_GET["id"]){
        $book = new Book($Conn);
        $book_data = $book->LoadData();
        if($book_data){
            $booktitle = $book_data["volumeInfo"]["title"];
            $bookauthor = $book_data["volumeInfo"]["authors"];
            $bookimage = $book_data["volumeInfo"]["imageLinks"]["large"];
            $bookimagesmall = $book_data["volumeInfo"]["imageLinks"]["small"];
            $bookimagethumb = $book_data["volumeInfo"]["imageLinks"]["thumbnail"];
            $bookimagesmallthumb = $book_data["volumeInfo"]["imageLinks"]["smallThumbnail"];
            
            $booksubtitle = $book_data["volumeInfo"]["subtitle"];
            $smarty->assign("title",$booktitle);
            if($bookauthor){
                $smarty->assign("author", implode(", ", $bookauthor));
            }else{
                $smarty->assign("author","Unknown Author");
            }
            if($bookimage){
                $smarty->assign("thumbnail",$bookimage);
            }
            elseif($bookimagesmall){
                $smarty->assign("thumbnail",$bookimagesmall);
            }
            elseif($bookimagethumb){
                $smarty->assign("thumbnail",$bookimagethumb);
            }
            elseif($bookimagesmallthumb){
                $smarty->assign("thumbnail",$bookimagethumb);
            }
            if($booksubtitle){
                $smarty->assign("booksubtitle",$booksubtitle);
            }

            
        }

    }