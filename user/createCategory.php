<?php
include "header.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
}
?>

<?php
$page_name = basename($_SERVER['PHP_SELF']);
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action 
                <?php echo $page_name == "dashboard.php" ? "active" : "" ?>"> Dashboard</a>
                <a href="view-category.php" class="list-group-item list-group-item-action
                <?php echo $page_name == "viewCategory.php" ? "active" : "" ?>">View Category</a>
                <a href="createCategory.php" class="list-group-item list-group-item-action
                <?php echo $page_name == "createCategory.php" ? "active" : "" ?>">Create Category</a>
            </ul>
        </div>

        <div class="col border-start" style="min-height: 60vh">
            <h1 class="text-center my-3 text-warning-emphasis">Create Category</h1>
            <hr />
            <form method="POST" action="" class="form-group">
                <label for="category" class="form-label fs-5 fw-bold">Category</label>
                <input type="text" name="category" class="form-control mb-4" required />

                <div class="d-grid my-4 col-6 mx-auto">
                    <input type="submit" name="createCategorySubmit" class="btn btn-primary fs-6 fw-bold">
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
if (isset($_POST['createCategorySubmit'])) {
    $categoryName = $_POST['category'];

    $sql = "INSERT INTO category (categoryName) VALUES ('$categoryName')";
    $result = $connection->query($sql);
    if ($result) {
        echo "<script>alert('Category Created Successfully!');</script>";
        /*         header("Location: dashboard.php"); */
    } else {
        echo "<script>alert('Error!');</script>";
    }
}
