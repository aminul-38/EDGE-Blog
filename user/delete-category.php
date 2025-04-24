<?php
include "../connect.php";
session_start();
ob_start();

if (!isset($_SESSION['user_email']) && $_SESSION['user_type'] != "Admin") {
    header("Location: ../login.php");
}
if (!isset($_GET['category_id'])) {
    header("Location: view-category.php");
}

$category_id = $_GET['category_id'];
ValidateInput($category_id);
$sql = "DELETE FROM category WHERE categoryID = $category_id";
$result = $connection->query($sql);
if ($result) {
    echo "<script>alert('Post Deleted Successfully!');</script>";
    header("Location: view-category.php");
} else {
    echo "<script>alert('Error!');</script>";
}
