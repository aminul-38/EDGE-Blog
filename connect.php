<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "edge_blog";

// create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// check connection
if ($connection->connect_error) {
    die("Conneciton failed: " . $connection->connect_error);
}

function ValidateInput($data)
{
    global $connection;

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connection, $data);
    return $data;
}
