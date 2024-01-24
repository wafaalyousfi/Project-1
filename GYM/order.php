<?php require 'header.php'; ?>


<?php
require 'conn.php';

$sql = "select *  from gym";
$stmt = $conn->query($sql);
while ($row = $stmt->fetch_assoc()) {
    $gyms[] = $row;
}

?>

<style>
    .table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: comic;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

    }

    .table thead tr {
        background-color: blue;
        color: #ffffff;
        text-align: left;
    }


    .table td {
        padding: 12px 15px;
        background-color: whitesmoke;
        color: black;
        text-align: left;
    }

    .table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .table tbody tr:last-of-type {
        border-bottom: 2px solid blue;
    }

    .table tbody tr.active-row {
        font-weight: bold;
        color: blue;
    }
</style>
<div class="container">

    <h3 style="color:blue;background-color:aliceblue;" class="text-center mt-5"> Request For Membership </h3>
    <form method="POST" enctype="multipart/form-data">
        <table class="table">
            <div class="row justify-content-center">
                <thead style="background-color:blue">
                    <tr>

                        <th>NAME</th>
                        <th>LOCATION</th>
                        <th>PHONE</th>
                        <th>BRANCH NAME</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody style="background-color:darkgrey">
                    <tr>
                        <td> <input type="text" id="name" name="name"> </td>
                        <td> <input type="text" id="location" name="location"> </td>
                        <td> <input type="phone" id="phone" name="phone"> </td>
                        <td>
                            <select name="branch_name" id="branch_name" required>
                                <option>BRANCH NAME</option>
                                <?php foreach ($gyms as $gym) : ?>
                                    <option value="<?php echo $gym['id'] ?>"><?php echo $gym['branch_name']; ?></option>
                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <button type="submit" name="add" class="btn btn-success">ORDER</button>
                        </td>

                    </tr>


                </tbody>
        </table>
    </form>


</div>
</body>

</html>
<?php
if (isset($_POST['add'])) {
    $gym_id = $_POST['branch_name'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];

    require 'conn.php';
    $stmt = $conn->prepare("INSERT INTO orders (name, gym_id, location, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $gym_id, $location, $phone);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>
            alert('Your order has been added. We will contact you soon.');
            window.location = 'user.php';
        </script>";
    }
}
?>