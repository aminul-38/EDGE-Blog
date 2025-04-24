<?php
include "includes/header.php";
?>

<div class="container">
  <div class="container my-5">
    <div class="row">
      <div
        class="col-md-6 text-center"
        style="
          display: flex;
          flex-direction: column;
          justify-content: center;
        ">
        <h1 class="display-2 fw-bold">EDGE Blog</h1>
        <p class="display-4">Share Your Thoughts!</p>
      </div>
      <div
        class="col-md-5 mx-auto bg-secondary-subtle border border-primary rounded">
        <h1 class="text-center my-3 text-warning-emphasis">Login</h1>
        <hr />
        <form method="POST" action="" class="form-group col-md-8 col-lg-6 mx-auto">
          <label for="email" class="form-label fs-6">Email</label>
          <input type="email" name="email" class="form-control mb-3" />
          <label for="password" class="form-label fs-6">Password</label>
          <input type="password" name="password" class="form-control" />
          <div class="d-grid my-4 col-6 mx-auto">
            <input type="submit" name="loginSubmit" class="btn btn-primary fs-6 fw-bold">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include "includes/footer.php";
?>

<?php
if (isset($_POST['loginSubmit'])) {

  $email = $_POST['email'];
  $password =  $_POST['password'];
  ValidateInput($email);
  ValidateInput($password);

  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
  $result = $connection->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $_SESSION['user_id'] = $row['userID'];
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_email'] = $row['email'];
      $_SESSION['user_type'] = $row['user_type'];
    }
    echo "<script>alert('Login Successful!');</script>";
    header("Location: user/dashboard.php");
  } else {
    echo "<script>alert('user not found');</script>";
  }
}
?>