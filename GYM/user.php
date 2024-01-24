<?php require 'header.php'; ?>
<?php
require 'conn.php';
$sql = "select *  from gym";
$stmt = $conn->query($sql);
$gyms = [];
while ($row = $stmt->fetch_assoc()) {
    $gyms[] = $row;
}

?>

<div class="container">
    <h3 style="color:blue;background-color:aliceblue;" class="text-center mt-5">GYMS List</h3>
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
    <table class="table">
        <thead>
            <tr>
                <th>BRANCH NAME</th>
                <th>DESCRIPTION</th>
                <th>MENU</th>
                <th>PHONE</th>
                <th>EMAIL</th>
                <th>LOGO</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>



            <?php foreach ($gyms as $gym) : ?>
                <tr>
                    <td> <?php echo $gym['branch_name'] ?> </td>
                    <td> <?php echo $gym['description'] ?> </td>
                    <td>
                        <a href="GYM/<?php echo $gym['menu']; ?>" download>Download Menu</a>
                    </td>

                    <td> <?php echo $gym['phone'] ?> </td>
                    <td> <?php echo $gym['email'] ?> </td>

                    <td>
                        <img width="150" height="100" src="GYM/<?php echo $gym['image'] ?>" class="rounded-circle" alt="Cinque Terre"> </img>
                    </td>
                    <td>
                        <a class="btn btn-warning text-white" href="order.php?id=<?php echo $gym['id'] ?>" role="button">Order</a>
                    </td>
                </tr>
            <?php endforeach ?>


        </tbody>
    </table>


</div>
</body>

</html>