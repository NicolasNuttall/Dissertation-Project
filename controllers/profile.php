<?php
    $User = new User($Conn);
    $Tutorial = new Tutorial($Conn);
    if($_GET['id']){
        $username = $_GET['id'];
        $profile_data = $User->getUser($username);
        $tab_data = $User->getTabData($username);
        $popular_tags = $User->getPopularTags($username);
        
        $smarty->assign("tab_data",$tab_data);
        if($popular_tags){
            $smarty->assign("popular_tags",$popular_tags);
        }
        if(count($profile_data) > 5){
            $smarty->assign("profile_data",$profile_data);
        }
        if($_SESSION["logged_in"]){
            $smarty->assign("logged_user",$_SESSION["user_data"]["username"]);
        }
        if(!$_GET["tab"]){
            $smarty->assign("pagehead","Tutorials");
            $tutorials = $Tutorial->getTutorials($username);
            $smarty->assign("tutorials",$tutorials);
            if(count($tutorials) == 0){
                $smarty->assign('notutorialresults',"y");       
            }
        }
        
        if($_GET["tab"] == "followers"){
            $followers = $User->getFollowers($username);
            $smarty->assign("users", $followers);
            $smarty->assign("pagehead","Followers");
            if(count($followers) == 0){
                $smarty->assign('nouserresults',"y");
            }
        }
        if($_GET["tab"] == "following"){
            $following = $User->getFollowing($username);
            $smarty->assign("users", $following);
            $smarty->assign("pagehead","Following");
            if(count($following) == 0){
                $smarty->assign('nouserresults',"y");
            }
        }
        if($_GET["tab"] == "likes"){
            $likes = $Tutorial->getUserLikes($username);
            $smarty->assign("tutorials", $likes);
            $smarty->assign("pagehead","Liked Tutorials");
            if(count($likes) == 0){
                $smarty->assign('notutorialresults',"y");       
            }
        }
        if($_GET["tab"] == "finished"){
            $finished = $Tutorial->getFinished($username);
            $smarty->assign("tutorials", $finished);
            $smarty->assign("pagehead","Finished Tutorials");
            if(count($finished) == 0){
                $smarty->assign('notutorialresults',"y");       
            }
        }
    }