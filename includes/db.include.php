<?php

$db_config = [
    "db_host" => "localhost",
    "db_name" => "phptesting",
    "db_user" => "s204369uoswebcou",
    "db_pass" => "kRFv0JwRqCv4"
];

$Conn = new PDO("mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],$db_config['db_user'],$db_config['db_pass']);

?> 