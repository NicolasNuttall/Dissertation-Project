<?php 
    if($_GET["id"]){
        $tutorial_id = $_GET["id"];
        $tutorial = new Tutorial($Conn);
        $tutorial_data = $tutorial->getTutorial($tutorial_id);
        $tutorial_tags = $tutorial->getTags($tutorial_id);
        $tutorial_likes = $tutorial->getLikes($tutorial_id);
        $smarty->assign("tags",$tutorial_tags);
        if(count($tutorial_data) > 1){
            $smarty->assign("tutorial",$tutorial_data);
        }
        $smarty->assign("tutorial_likes",$tutorial_likes);

        $comment = new Comment($Conn);
        $comments = $comment->getComments($tutorial_id);
        $smarty->assign("comments",$comments);

        $oth_tutorials = $tutorial->getRandomTutorials($tutorial_id);
        $smarty->assign("oth_tutorials",$oth_tutorials);
    }
    if($_SESSION['user_data']){
        $Like = new Like($Conn);
        $is_liked = $Like->isLiked($tutorial_id);

        if($is_liked){
            $smarty->assign("is_liked", true);
        }else{
            $smarty->assign("is_liked",false);
        }

        $Mark = new Mark($Conn);
        $is_marked = $Mark->isMarked($tutorial_id);
        if($is_marked){
            $smarty->assign("is_marked",true);
        }else{
            $smarty->assign("is_marked",false);
        }
    }