<?php

include "../connect.php";
ob_start();

echo $email = $_POST['email'];
echo $password = $_POST['password'];

ValidateInput($email);
ValidateInput($password);

$sql = "DELETE FROM users WHERE email = '$email' AND password = '$password' ";
$result = $connection->query($sql);

if ($result === true) {
    echo "<script>
            alert('Account Deletiton Success.');
        </script>";
    header("Location: logout.php");
} else {
    echo "<script>
            alert('Error!');
        </script>";
    header("Location: dashboard.php");
}

exit();
