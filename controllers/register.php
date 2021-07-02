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
    if($_POST){
        $User = new User($Conn);
        $account_exist_check = $User->userExists($_POST["username"],$_POST["email"]);
        if($_POST['register']){
            if(!$_POST['email']){
                $error ="Email not set.";
            }
            else if(!$_POST['username']){
                $error ="Username not set";
            }
            else if(preg_match("/[^A-Za-z0-9_-]/", $_POST['username'])  ){
                $error ="Invalid username - must only contain letters, numbers, dashes and/or underscores";
            }
            else if(!$_POST['password']){
                $error = "Password not set.";
            }
            else if($_POST['conf-password'] != $_POST['password']){
                $error = "Passwords do not match.";
            }
            else if(strlen($_POST['password']) < 8){
                $error = "Password must be 8 characters or more";
            }
            else if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                $error = "Email is not valid";
            }
            else if($account_exist_check){
                $error = "".$account_exist_check."";
            }

            if($error){
                $smarty->assign('error',$error);
            }else{
                $User = new User($Conn);
                $attempt = $User->createUser($_POST);

                if($attempt){
                    
                    $email = new \SendGrid\Mail\Mail();
                    $email->setFrom("s204369@uos.ac.uk","Promotion");
                    $email->setSubject("Welcome to Promotion");
                    $email->addTo($_POST['email'],"User");
                    $email->addContent(
                        "text/html","
                        <h1 style='font-weight:bold;'>Hey ".$_POST["username"] .",</h1>
                        <p>Welcome to Promotion, your account has successfully been registered!</p>
                        <p>Once you're logged in, you can edit your profile page, interact with posts and share some of your own.
                        Have fun! </p>
                        "
                    );
                    $sendgrid=new \SendGrid('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');
                    $respone = $sendgrid->send($email);

                    
                    $user_data = $User->loginUser($_POST['email'],$_POST['password']);
                    $_SESSION["logged_in"] = true;
                    $_SESSION["user_data"] = $user_data;
                    header('Location: index.php');
                    exit();    

                }else{
                    $smarty->assign('error',"An error occured, please try again.");
                }
            }
        } 
        
    }