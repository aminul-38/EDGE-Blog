<?php
include "includes/header.php";
?>

<div class="container">
  <div class="container my-5">
    <div class="row">
      <div
        class="col-md-8 mx-auto bg-secondary-subtle border border-primary rounded">
        <h1 class="text-center my-3 text-warning-emphasis">Registration</h1>
        <hr />
        <form method="POST" action="registrationSubmit.php" class="form-group col-md-8 col-lg-6 mx-auto">
          <label for="name" class="form-label fs-6">Name</label>
          <input name="name" type="text" class="form-control mb-3" required />
          <label for="email" class="form-label fs-6">Email</label>
          <input name="email" type="email" class="form-control mb-3" required />
          <label for="password" class="form-label fs-6">Password</label>
          <input name="password" type="password" class="form-control" required />
          <div class="d-grid my-4 col-6 mx-auto">
            <button type="submit" class="btn btn-primary fs-6 fw-bold">
              Sign Up
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include "includes/footer.php";
?>