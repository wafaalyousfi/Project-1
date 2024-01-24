<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CARAVAN</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>


<body>
  <style>
    body {
      background-image: url(gym/flex1.jpg);
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a style="color:blue" class="navbar-brand" href="#">FLEX GYM</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
        </li>

        <?php if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 1) {  // seller 
        ?>

            <li class="nav-item active">
              <a class="nav-link" href="admin.php">FLEX GYM <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="javascript:void(0);" onclick="openInFront();">GOOGLE MAP<span class="sr-only">(current)</span></a>
            </li>

            <script>
              function openInFront() {
                var left = window.screenX + 10;
                var top = window.screenY + 10;
                window.open('https://www.google.com/maps', '_blank', 'left=' + left + ',top=' + top);
              }
            </script>

          <?php } else {  ?>

            <li class="nav-item active">
              <a class="nav-link" href="user.php">FLEX GYM <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="javascript:void(0);" onclick="openInFront();">GOOGLE MAP<span class="sr-only">(current)</span></a>
            </li>

            <script>
              function openInFront() {
                var left = window.screenX + 10;
                var top = window.screenY + 10;
                window.open('https://www.google.com/maps', '_blank', 'left=' + left + ',top=' + top);
              }
            </script>

        <?php  }
        }
        ?>

      </ul>


      <?php if (isset($_SESSION['user_type'])) {  ?>
        <div class="float-right">
          <ul class="nav justify-content-end">

            <li class="nav-item active">
              <a class="nav-link text-danger" href="logout.php">Logout <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>

      <?php } else { ?>
        <div class="float-right">
          <ul class="navbar-nav float-right">
            <li class="nav-item active">
              <a class="nav-link f" href="login.php">Login</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      <?php } ?>
    </div>
  </nav>