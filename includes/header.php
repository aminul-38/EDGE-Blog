<?php
include "./connect.php";
session_start();
ob_start();
?>

<?php
$page_name = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog</title>
  <!-- Bootstrap cdn -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!-- font awesome cdn -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">EDGE Blog</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarScroll"
          aria-controls="navbarScroll"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul
            class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll fs-5"
            style="--bs-scroll-height: 100px">
            <li class="nav-item">
              <a class="nav-link <?php echo $page_name == "index.php" ? "active" : "" ?>" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo $page_name == "dashboard.php" ? "active" : "" ?>" href="../EDGE Blog/user/dashboard.php">Dashboard</a>
            </li>

            <?php
            if (isset($_SESSION["user_email"])) {
              $active = $page_name == "createPost.php" ? "active" : "";
              echo '<li class="nav-item">
              <a class="nav-link' . $active . '" href="../EDGE Blog/user/createPost.php">Create Post</a>
            </li>';
            }

            if (!isset($_SESSION["user_email"])) {
              echo '<li class="nav-item">
                      <a class="nav-link ' . ($page_name == "login.php" ? "active" : "") . '" href="login.php">Login</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link ' . ($page_name == "registration.php" ? "active" : "") . '" href="registration.php">Registration</a>
                  </li>';
            }
            ?>

            <?php
            if (isset($_SESSION['user_email'])) {
              echo '<li class="nav-item">
              <a class="nav-link" href="./user/logout.php">Logout</a>
            </li>';
            }
            ?>

          </ul>
          <form class="d-flex" role="search" action="../EDGE Blog/search-result.php" method="POST">
            <input
              name="search_key"
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search" />
            <button type="submit" class="btn btn-outline-light">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>
  </div>