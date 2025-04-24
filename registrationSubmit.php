<?php
include "connect.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
ValidateInput($name);
ValidateInput($email);
ValidateInput($password);

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if ($connection->query($sql) === TRUE) {
    //print_r($connection->query($sql)); to print array
    echo "<script>alert('Registration Successful');</script>";
    header("Location: login.php");
} else {
    echo "<script>alert('Error!');</script>";
    header("Location: registration.php");
}

exit();
