<?php require 'header.php'; ?>

<?php
require 'conn.php';

$sql = "select *  from roles";
$stmt = $conn->query($sql);
while ($row = $stmt->fetch_assoc()) {
    $roles[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>sign up</title>
</head>

<body>
    <main>

        <form action="register.php" method="post">
            <h1>Sign Up</h1>
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <div>
                    <label for="phone">Phone:</label>
                    <input type="phone" name="phone" id="phone">
                </div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit" name="register">Register</button>
            <footer>Already a member? <a href="login.php">Login here</a></footer>
        </form>
    </main>
    <footer class="footer mt-5">
        <p>&copy; 2024 Flex GYM Web App. All rights reserved.</p>
    </footer>
</body>

</html>

<?php



if (isset($_POST['register'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];

    require 'conn.php';
    $stmt =   $conn->prepare("insert into users (name , email , password , phone ) values(? , ? , ? , ? ); ");

    $stmt->bind_param("ssss", $name, $email, $pass, $phone);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>
            alert('User Added');
            window.location = 'login.php';
        </script>";
    }
}


?>