<?php
include_once 'sidebar.php';
include_once 'notifications.php';

$db = new Server;

$sqlSelect = "SELECT orders.order_id, customers.customer_email, orders.address, orders.apartment, orders.phone, orders.grand_total, orders.payment, orders.created, orders.status
     FROM orders JOIN customers ON customers.customer_id = orders.customer_id ORDER BY created DESC";
$result = $db->conn->query($sqlSelect);
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['admin'])) {
?>

    <head>
        <title>Admin panel | Orders</title>
    </head>
    
    <body>
        <div class="outer-wrapper-orders">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Home adress</th>
                        <th>Apartment</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Details</th>
                    </thead>
                    <?php
                    while ($row = $result->fetch()) :
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $row['order_id'] ?></td>
                                <td><?= $row['customer_email'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['apartment'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['grand_total'] ?>&euro;</td>
                                <td><?= $row['payment'] ?></td>
                                <td><?= $row['created'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td>
                                    <a href="order-details.php?info=<?= $row['order_id'] ?>" style="background-color: rgb(5, 94, 91);" class="btn"><i class="fas fa-info-circle" style="color: white; font-size: larger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </body>
<?php
} else {
    redirect("index.php");
}
?>

</html>