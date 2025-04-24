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
        <h1 class="text-center my-3 text-warning-emphasis">Create Post</h1>
        <hr />
        <form method="POST" action="" class="form-group" enctype="multipart/form-data">
            <label for="title" class="form-label fs-5 fw-bold">Title</label>
            <input type="text" name="title" class="form-control mb-4" required />
            <label for="content" class="form-label fs-5 fw-bold">Content</label>
            <textarea name="content" class="form-control mb-4" rows="7" required></textarea>
            <label for="coverPhoto" class="form-label fs-5 fw-bold">Cover Photo</label>
            <input type="file" accept="image/*" name="coverPhoto" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <label for="category" class="form-label fs-5 fw-bold mt-4">Category</label>
            <select name="category" class="form-select" required>
                <option selected>Select Category</option>
                <?php
                $sql = "SELECT * FROM category";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['categoryID'] . '">' . $row['categoryName'] . '</option>';
                    }
                }
                ?>
            </select>
            <div class="d-grid my-4 col-6 mx-auto">
                <input type="submit" name="createPostSubmit" class="btn btn-primary fs-6 fw-bold">
            </div>
        </form>
    </div>
</div>
</div>

<?php
if (isset($_POST['createPostSubmit'])) {
    echo $title = ValidateInput($_POST['title']);

    echo $content = ValidateInput($_POST['content']);
    echo $categoryID = ValidateInput($_POST['category']);
    echo "<br>";
    print_r($file = $_FILES['coverPhoto']);
    echo "<br>";
    echo $fileName = basename(ValidateInput($file['name']));
    echo "<br>";
    echo $uploadDir = __DIR__ . "/../images/";
    echo "<br>";
    echo $destination = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "File uploaded to $destination";
    }
    $image_path = 'images/' . $fileName;

    $sql = "INSERT INTO posts (userID, tittle, description, imagePath, categoryID) VALUES ('$_SESSION[user_id]', '$title', '$content','$image_path', '$categoryID')";
    $result = $connection->query($sql);
    if ($result) {
        echo "<script>alert('Post Created Successfully!');</script>";
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Error!');</script>";
    }
}

?>