<?php 
    if($_SESSION["logged_in"]){
        $journal = new Journal($Conn);
        $archive = $journal->getArchive();
        if($archive){
            $smarty->assign("archive",$archive);
        }
    }
    