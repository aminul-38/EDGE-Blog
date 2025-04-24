<?php
include "header.php";

if (!isset($_SESSION['user_email']) && $_SESSION['user_type'] != "Admin") {
    header("Location: ../login.php");
}
if (!isset($_GET['category_id'])) {
    header("Location: view-category.php");
}

$category_id = $_GET['category_id'];
ValidateInput($category_id);
$sql = "SELECT * FROM category WHERE categoryID = $category_id";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $category_data = $result->fetch_assoc();
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-3">
            <ul class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action 
                <?php echo $page_name == "dashboard.php" ? "active" : "" ?>"> Dashboard</a>
                <a href="view-category.php" class="list-group-item list-group-item-action
                <?php echo $page_name == "view-category.php" ? "active" : "" ?>">View Category</a>
                <a href="createCategory.php" class="list-group-item list-group-item-action
                <?php echo $page_name == "createCategory.php" ? "active" : "" ?>">Create Category</a>
            </ul>
        </div>
        <div class="col border-start" style="min-height: 60vh">
            <h1 class="text-center my-3 text-warning-emphasis">Edit Category</h1>
            <hr />
            <form method="POST" action="" class="form-group">
                <label for="categoryID" class="form-label fs-5 fw-bold">CategoryID</label>
                <input type="number" name="categoryID" class="form-control mb-4" disabled value="<?php echo $category_data['categoryID'] ?>" />
                <label for="categoryName" class="form-label fs-5 fw-bold">Name</label>
                <input type="text" name="categoryName" class="form-control mb-4" required value="<?php echo $category_data['categoryName'] ?>" />
                <div class="d-grid my-4 col-6 mx-auto">
                    <input type="submit" name="updateCategorySubmit" class="btn btn-primary fs-6 fw-bold " value="Update Category">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['updateCategorySubmit'])) {
    $categoryName = $_POST['categoryName'];

    $sql = "UPDATE category SET categoryName = '$categoryName' WHERE categoryID = $category_id";
    $result = $connection->query($sql);
    if ($result) {
        header("Location: view-category.php");
    }
}
?>