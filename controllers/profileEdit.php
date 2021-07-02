<?php
    if($_SESSION["user_data"]){
        $user = new User($Conn);
        $user_data = $user->getUser($_SESSION["user_data"]["username"]);
        $smarty->assign("user_data",$user_data);
    }
    
    if($_POST){
        if($error){
            $smarty->assign('error',$error);
        }else{ 
            
            $random = substr(str_shuffle(MD5(microtime())),0,10);
            if($_FILES["avatar"]["name"]){
                $avatar_file = $random . $_FILES['avatar']['name'];
            }else{
                $avatar_file = $active_user_data["avatar_img"];
            };
            if($_FILES["banner"]["name"]){
                $banner_file = $random . $_FILES['banner']['name'];
            }else{
                $banner_file = $active_user_data["banner_img"];
            };
            $User = new User($Conn);
            $_POST["avatar"] = $avatar_file;
            $_POST["banner"] = $banner_file;
            $attempt = $User->editProfile($_POST, $_SESSION["user_data"]["username"]);
            if($attempt){
                if(move_uploaded_file($_FILES['banner']['tmp_name'],__DIR__ . "/../images/banners/" . $banner_file)){
                    $smarty->assign("saved","Changes were saved");
                };
                
                if(move_uploaded_file($_FILES['avatar']['tmp_name'],__DIR__ . "/../images/avatars/" . $avatar_file)){
                    $smarty->assign("saved","Changes were saved");
                }
                header("Location: /Promotion/profile/" . $_SESSION["user_data"]["username"]);
            }
        }
    } 
        
