<?php
    $search_query = $_GET["id"];
    $smarty->assign('query',$search_query);
    $Tutorial = new Tutorial($Conn);
    $User = new User($Conn);
    $tutorials = $Tutorial->searchTutorials($search_query);
    $users = $User->searchUsers($q);
    $smarty->assign("tutorials", $tutorials);
    $smarty->assign("users",$users);