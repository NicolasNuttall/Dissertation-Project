<?php
    
    if($active_user_data){
        session_destroy();
    }
    if($_POST['login']){
        
        if(!$_POST['email']){
            $error ="Email not set.";
        }
        else if(!$_POST['password']){
            $error = "Password not set.";
        }
        else if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $error = "Email is not valid";
        }


        if($error){
            $smarty->assign('error',$error);
        }else{
            $User = new User($Conn);
            $user_data = $User->loginUser($_POST['email'],$_POST['password']);
            if($user_data){
                $_SESSION["logged_in"] = true;
                $_SESSION["user_data"] = $user_data;
                header('Location: index.php');
                exit();
            }else{
                $smarty->assign('error','Incorrect email/password');
            }
        }
    }