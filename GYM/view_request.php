<?php require 'header.php'; ?>

<?php
require 'conn.php';

// Fetch ordered gyms
$sql = "SELECT o.*, c.branch_name FROM orders o INNER JOIN gym c ON o.gym_id = c.id";
$result = $conn->query($sql);
$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
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
    <h3 style="color: blue; background-color: aliceblue;" class="text-center mt-5">Membership Ordered</h3>
    <table class="table">
        <thead style="background-color: blue;">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Branch Name</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody style="background-color: darkgrey;">
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['name']; ?></td>
                    <td>
                        <a href="<?php echo $order['location']; ?>" target="_blank" class="btn btn-primary">Open Location</a>
                    </td>
                    <td><?php echo $order['phone']; ?></td>
                    <td><?php echo $order['branch_name']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>

</html>