<?php

$db_config = [
    "db_host" => "localhost",
    "db_name" => "Bookker",
    "db_user" => "NicolasNuttall",
    "db_pass" => "s1E4yvJF2Ce6"
];

$Conn = new PDO("mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],$db_config['db_user'],$db_config['db_pass']);

?> 