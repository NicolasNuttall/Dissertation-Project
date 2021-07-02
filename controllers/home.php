<?php

$username = $_SESSION["user_data"]["username"];
$Tutorial = new Tutorial($Conn);
$featured = $Tutorial->getFeatured();
$smarty->assign("featured_tutorials",$featured);
$User = new User($Conn);
$User->asd();
if($_SESSION["logged_in"]){
    if($_GET["id"]){
        if($_GET["id"] == "following"){
            $tutorials = $Tutorial->getFollowingTutorials($username);
            $header = "From Who You Follow";
            $smarty->assign("homeheading",$header);
            $smarty->assign("tutorials",$tutorials);
        }
        elseif($_GET["id"] == "newest"){
            $tutorials = $Tutorial->getNewestTutorials();
            $smarty->assign("tutorials",$tutorials);
            $header = "Newest Tutorials";
            $smarty->assign("homeheading",$header);
        }
        elseif($_GET["id"] == "popular"){
            header("Location: /Promotion/");
            exit();
        }
    }else{
        $tutorials = $Tutorial->getPopularTutorials();
        $smarty->assign("tutorials",$tutorials);
        $header = "Popular Tutorials";
        $smarty->assign("homeheading",$header);
    }
}else{
    $tutorials = $Tutorial->getPopularTutorials();
    $smarty->assign("tutorials",$tutorials);
}