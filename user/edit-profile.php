<?php
include "header.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
}


$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE userID = $userID";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}
?>

<div class="modal fade"
    id="deleteAccountModal" tabindex="-1"
    data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 text-danger"><strong>Account Deletion!</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger fw-bold">Are you sure delete your account? Deleting account will romove all of your data.
                    Enter your email and passowrd to continue.</p>
                <form action="delete-account.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input name="email" type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Password:</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <div class="modal-footer mt-5">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-3">

            <ul class="list-group">
                <a href="edit-profile.php" class="list-group-item list-group-item-action active"> Edit Profile</a>
                <a href="reset-password.php" class="list-group-item list-group-item-action">Reset Password</a>
                <?php
                if ($_SESSION['user_type'] == "Admin") {
                    echo '<a href="view-category.php" class="list-group-item list-group-item-action">View Category</a>';
                    echo '<a href="createCategory.php" class="list-group-item list-group-item-action">Create Category</a>';
                }
                ?>
                <a href="" type="button" class="list-group-item list-group-item-action bg-danger text-light"
                    data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</a>
            </ul>

        </div>
        <div class="col border-start" style="min-height: 60vh">
            <h1 class="text-center my-3 text-warning-emphasis">Edit Profile</h1>
            <hr />
            <form method="POST" action="" class="form-group col-md-6 col-lg-8 mx-auto">
                <label for="name" class="form-label fs-6">Name</label>
                <input name="name" type="text" class="form-control mb-3" required value="<?php echo $user_data['name'] ?>" />
                <label for="email" class="form-label fs-6">Email</label>
                <input name="email" type="email" class="form-control mb-3" required value="<?php echo $user_data['email'] ?>" />
                <div class="d-grid my-4 col-5 mx-auto">
                    <input type="submit" name="updateProfileSubmit" class="btn btn-primary fs-6 fw-bold " value="Update Profile">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['updateProfileSubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE userID = $userID";
    $result = $connection->query($sql);
    if ($result) {
        header("Location: dashboard.php");
    }
}
?>

<!-- Bootstrap script -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>