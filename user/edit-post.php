<?php
include "header.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
}
if (!isset($_GET['post_id'])) {
    header("Location: dashboard.php");
}

$post_id = $_GET['post_id'];
ValidateInput($post_id);
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM posts WHERE postID = $post_id AND userID = $user_id";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $post_data = $result->fetch_assoc();
}
?>


<div class="container mt-3">
    <div class="row">
        <h1 class="text-center my-3 text-warning-emphasis">Edit Your Post</h1>
        <hr />
        <form method="POST" action="" class="form-group">
            <label for="title" class="form-label fs-5 fw-bold">Title</label>
            <input type="text" name="title" class="form-control mb-4" required value="<?php echo $post_data['tittle'] ?>" />
            <label for="content" class="form-label fs-5 fw-bold">Content</label>
            <textarea name="content" class="form-control mb-4" rows="7" required><?php echo $post_data['description'] ?></textarea>
            <label for="coverPhoto" class="form-label fs-5 fw-bold">Cover Photo</label>
            <input type="file" accept="image/*" name="coverPhoto" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <label for="category" class="form-label fs-5 fw-bold mt-4">Category</label>
            <select name="category" class="form-select" required>
                <?php
                $sql = "SELECT * FROM category";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $is_selected = $row['categoryID'] == $post_data['categoryID'] ? "selected" : "";
                        echo '<option value="' . $row['categoryID'] . '"' . $is_selected . '  >' . $row['categoryName'] . '</option>';
                    }
                }
                ?>
            </select>
            <div class="d-grid my-4 col-6 mx-auto">
                <input type="submit" name="updatePostSubmit" class="btn btn-primary fs-6 fw-bold " value="Update Post">
            </div>
        </form>
    </div>
</div>
</div>

<?php
if (isset($_POST['updatePostSubmit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    /*
    Safest version of writing sql to prevent sql injection.
    $stmt = $connection->prepare("UPDATE posts SET tittle = ?, description = ? WHERE postID = ? AND userID = ?");
    $stmt->bind_param("ssii", $title, $content, $post_id, $user_id);
    $stmt->execute();
    */

    $sql = "UPDATE posts SET tittle = '$title', description = '$content' WHERE postID = $post_id AND userID = $user_id";
    $result = $connection->query($sql);
    if ($result) {
        header("Location: dashboard.php");
    }
}
?>