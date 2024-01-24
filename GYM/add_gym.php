<?php require 'header.php'; ?>

<?php
require 'conn.php';
?>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .wrapper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .content {
        flex: 1;
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
    }
</style>
<div class="wrapper">
    <div class="container">
        <h3 style="color:blue; background-color: honeydew;" class="text-center mt-5"> ADD Branch</h3>
        <form method="POST" enctype="multipart/form-data" style="background-color: aliceblue;">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="branch_name">NAME</label>
                    <input type="text" class="form-control" name="branch_name" id="branch_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="menu">Menu Price</label>
                    <input type="file" class="form-control" name="menu" id="menu" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="add">ADD</button>
            </div>
        </form>
    </div>
</div>
<footer class="footer">
    <p>&copy; 2024 Flex GYM Web App. All rights reserved.</p>
</footer>
</body>

</html>
<?php
if (isset($_POST['add'])) {
    $branch_name = $_POST['branch_name'];
    $description = $_POST['description'];
    $menu_name = $_FILES['menu']['name'];
    $menu_tmp = $_FILES['menu']['tmp_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Upload menu file
    $menu_folder = "menu/";
    if (!move_uploaded_file($menu_tmp, $menu_folder . $menu_name)) {
        echo "<script>
            alert('Menu File Not Uploaded');
        </script>";
        exit;
    }

    // Upload image file
    $image_folder = "GYM/";
    if (!move_uploaded_file($image_tmp, $image_folder . $image_name)) {
        echo "<script>
            alert('Image File Not Uploaded');
        </script>";
        exit;
    }

    require 'conn.php';
    $stmt = $conn->prepare("INSERT INTO gym (branch_name, description, menu, email, phone, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $branch_name, $description, $menu_name, $email, $phone, $image_name);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>
            alert('Branch Added');
            window.location = 'admin.php';
        </script>";
    }
}
?>