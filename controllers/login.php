<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "https://type.fit/api/quotes");
    $output = curl_exec($ch);
    curl_close($ch);
    $quote = json_decode($output, true);
    $random_num = rand(0, count($quote) - 1);
    $quote_text = $quote[$random_num]["text"];
    $quote_author = $quote[$random_num]["author"];
    if($quote_text){
        $smarty->assign("quote",$quote_text);
        if($quote_author){
            $smarty->assign("author",$quote_author);
        }
    }
    
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
                header('Location: /Promotion/');
                exit();
            }else{
                $smarty->assign('error','Incorrect email/password');
            }
        }
    }