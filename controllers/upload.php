<?php
  
    $categories = new Category($Conn);
    $category_data = $categories->getCategories();
    $smarty->assign("categories",$category_data);

    if($_POST){
        if(!$_POST["Title"]){
            $error = "You need to add a Title";
        }
        if(!$_POST["description"]){
            $error = "You need to add a description";
        }

        if($error){
            $smarty->assign("error",$error);
        }else{
            $tutorial = new Tutorial($Conn);

            $random = substr(str_shuffle(MD5(microtime())),0,10);
            $thumbnail_file = $random . $_FILES['thumbnail']['name'];
            $_POST["thumbnail"] = $thumbnail_file;
            $username = $_SESSION["user_data"]["username"];
            $attempt = $tutorial->AddTutorial($_POST, $username);
            if($attempt){
                if(move_uploaded_file($_FILES['thumbnail']['tmp_name'],__DIR__ . "/../images/tutorial_images/" . $thumbnail_file)){
                    header("Location:index.php");
                };
            }
        }
    }