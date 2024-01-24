<?php require 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
</head>

<body>
  <main>
    <form method="POST">
      <h1>login</h1>

      <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
      </div>

      <button type="submit" name="login">Login</button>

    </form>
  </main>
  <footer class="footer mt-5">
    <p>&copy; 2024 Flex GYM Web App. All rights reserved.</p>
  </footer>
</body>

</html>

<?php



if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $pass = $_POST['password'];


  require 'conn.php';
  $stmt = $conn->prepare("select * from users where email = ? and password = ?");
  $stmt->bind_param("ss", $email, $pass);
  $stmt->execute();
  $stmt->store_result();
  $stmt->num_rows();

  if ($stmt->num_rows() > 0) {

    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
      $user_type = $row['user_type'];

      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_type'] = $user_type;

      if ($user_type == 1) {

        header('Location:admin.php');
      } else {
        header('Location:user.php');
      }
    }
  } else {
    echo "<script> alert('Wrong Email Or Password');</script>";
  }
}


?>