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
                <?php echo $page_name == "view-category.php" ? "active" : "" ?>">View Category</a>
                <a href="createCategory.php" class="list-group-item list-group-item-action
                <?php echo $page_name == "createCategory.php" ? "active" : "" ?>">Create Category</a>
            </ul>
        </div>
        <div class="col border-start" style="min-height: 60vh">
            <h1 class="text-center my-3 text-warning-emphasis">Categories</h1>
            <hr />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sql = "SELECT * FROM category";
                    $result = $connection->query($sql);
                    $i = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                            <td>' . $i++ . '</td>
                            <td>' . $row['categoryID'] . '</td>
                            <td>' . $row['categoryName'] . '</td>
                            <td>
                                <a class="btn btn-warning" href="edit-category.php?category_id=' . $row['categoryID'] . '">Edit</a>
                                <a class="btn btn-danger" href="delete-category.php?category_id=' . $row['categoryID'] . '">Delete</a>
                            </td>
                            </tr>';
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>