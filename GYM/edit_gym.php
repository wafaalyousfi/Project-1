<?php require 'header.php'; ?>

<?php
require 'conn.php';

$gym_id = $_GET['id']; // Getting the gym id from URL parameter
$sql = "SELECT * FROM gym WHERE id = '$gym_id'"; // Use the actual table name
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {
    $gym['branch_name'] = $row['branch_name'];
    $gym['description'] = $row['description'];
    $gym['email'] = $row['email'];
}
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
        <h3 style="color:blue; background-color: honeydew;" class="text-center mt-5"> Edit GYM</h3>
        <form method="POST" enctype="multipart/form-data" style="background-color: aliceblue;">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="caravan_name">NAME</label>
                    <input type="text" class="form-control" name="branch_name" id="branch_name" value="<?php echo $gym['branch_name']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="<?php echo $gym['description']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="menu">Menu list</label>
                    <input type="file" class="form-control" name="menu" id="menu">
                    <small class="text-muted">Leave blank if you don't want to change the menu file.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $gym['email']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="file" class="form-control" name="phone" id="phone">
                    <small class="text-muted">Leave blank if you don't want to change the phone file.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image">
                    <small class="text-muted">Leave blank if you don't want to change the image file.</small>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="update">UPDATE</button>
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
if (isset($_POST['update'])) {
    $branch_name = $_POST['branch_name'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];

    $menu_name = $_FILES['menu']['name'];
    $menu_tmp = $_FILES['menu']['tmp_name'];
    $phone_name = $_FILES['phone']['name'];
    $phone_tmp = $_FILES['phone']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Upload menu file
    $menu_folder = "menu/";
    if (!empty($menu_name)) {
        if (!move_uploaded_file($menu_tmp, $menu_folder . $menu_name)) {
            echo "<script>
                alert('Menu File Not Uploaded');
            </script>";
            exit;
        }
    }

    // Upload image file
    $image_folder = "GYM/";
    if (!empty($image_name)) {
        if (!move_uploaded_file($image_tmp, $image_folder . $image_name)) {
            echo "<script>
                alert('Image File Not Uploaded');
            </script>";
            exit;
        }
    }

    require 'conn.php';
    $stmt = $conn->prepare("UPDATE gym SET branch_name = ?, description = ?, menu = ?, email = ?, phone = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $branch_name, $description, $menu_name, $email, $phone_name, $image_name, $caravan_id);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>
            alert('GYM info Updated');
            window.location = 'admin.php';
        </script>";
    }
}
?>