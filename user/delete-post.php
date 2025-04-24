<?php
include "../connect.php";
session_start();
ob_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
}
if (!isset($_GET['post_id'])) {
    header("Location: dashboard.php");
}

$post_id = $_GET['post_id'];
$user_id = $_SESSION['user_id'];
ValidateInput($post_id);
$sql = "DELETE FROM posts WHERE postID = $post_id AND userID = $user_id";
$result = $connection->query($sql);
if ($result) {
    echo "<script>alert('Post Deleted Successfully!');</script>";
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Error!');</script>";
}
