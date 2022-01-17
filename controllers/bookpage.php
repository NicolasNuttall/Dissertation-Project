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
            $bookdate = $book_data["volumeInfo"]["publishedDate"];
            $bookyear = substr($bookdate, 0, 4 ); 
            $bookdescription = $book_data["volumeInfo"]["description"];
            $smarty->assign("title",$booktitle);
            if($bookyear){
                $smarty->assign("year", $bookyear);
            }else{
                $smarty->assign("year", "Unknown");
            }
            if($bookauthor){
                $smarty->assign("author", implode(", ", $bookauthor));
            }else{
                $smarty->assign("author","Unknown Author");
            }
            if($bookimagethumb){
                $smarty->assign("thumbnail",$bookimagethumb);
            }
            elseif($bookimagesmallthumb){
                $smarty->assign("thumbnail",$bookimagethumb);
            }
            elseif($bookimage){
                $smarty->assign("thumbnail",$bookimage);
            }
            elseif($bookimagesmall){
                $smarty->assign("thumbnail",$bookimagesmall);
            }

            if($bookdescription){
                $smarty->assign("booksubtitle",$bookdescription);
            }

            
        }

    }