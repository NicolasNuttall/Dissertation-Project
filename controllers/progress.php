<?php
    $username = $_SESSION["user_data"]["username"];
   
    if($_SESSION["logged_in"]){
        $goal = new Goal($Conn);
        $progress = $goal->getProgress();
        if($progress){
            if($progress["goal_achieved"] > $progress["goal_length"]){
                $progress["ga"]=$progress["goal_length"]/60;
            }else{
                $progress["ga"]=round($progress["goal_achieved"]/60, 0);
            }
            $progress["gl"]=$progress["goal_length"]/60;
            $progress["per"]=($progress["ga"]/$progress["gl"])*100;
            if($progress){
               $smarty->assign("progress",$progress);  
            }
        }
    }
    
