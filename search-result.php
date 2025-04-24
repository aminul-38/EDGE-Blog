<?php
include "includes/header.php";
?>

<?php
if (isset($_POST['search_key'])) {
    $search_key = $_POST['search_key'];
    $search_term = "%" . $search_key . "%";
} else {
    header('index.php');
}
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-8">
            <?php
            $sql = "SELECT posts.*, category.categoryName, users.name 
                    FROM posts 
                    JOIN category ON posts.categoryID = category.categoryID 
                    JOIN users ON posts.userID = users.userID 
                    WHERE posts.tittle LIKE ? OR posts.description LIKE ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ss", $search_term, $search_term);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card mb-5">
                <img src="' . $row['imagePath'] . '" class="card-img-top" alt="image" />
                <div class="card-body">
                  <h5 class="card-title">' . $row['tittle'] . '</h5>
                  <p class="card-text" style="text-align: justify">' . $row['description'] . '</p>
                  <p><i class="fa-regular fa-clock"></i> Time: ' . date_format(new DateTime($row['dateTime']), "d M,Y h:i A") . '</p>
                  <p><i class="fa-solid fa-user"></i> Posted By: ' . $row['name'] . ' </p>
                  <p><i class="fa-solid fa-layer-group"></i> Category: ' . $row['categoryName'] . '</p>
                </div>
                </div>';
                }
            } else {
                echo '
              <div class="text-center">
                <h3>No posts available!</h3>
              </div>';
            }
            ?>
        </div>

        <div class="col-md-4 mb-5">
            <div class="card">
                <div
                    class="card-header bg-primary text-white text-center fw-bolder fs-5">
                    Category
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    $sql = "SELECT * FROM category";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="customFeed.php?categoryID=' . $row['categoryID'] . '"
                                class="list-group-item list-group-item-action list-group-item-primary">'
                                . $row['categoryName'] . '</a>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>

<?php
include "includes/footer.php";
?>