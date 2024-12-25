<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "game_player";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
    echo "database connection error";
    die("error!");
}
?>