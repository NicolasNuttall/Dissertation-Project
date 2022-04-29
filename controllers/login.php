<?php
    
    if($active_user_data){
        session_destroy();
    }
    if($_POST['login']){
        
        if(!$_POST['username']){
            $error ="username not set.";
        }
        else if(!$_POST['password']){
            $error = "Password not set.";
        }



        if($error){
            $smarty->assign('error',$error);
        }else{
            $User = new User($Conn);
            $user_data = $User->loginUser($_POST['username'],$_POST['password']);
            if($user_data){
                $_SESSION["logged_in"] = true;
                $_SESSION["user_data"] = $user_data;
                header('Location: index.php');
                exit();
            }else{
                $smarty->assign('error','Incorrect username/password');
            }
        }
    }