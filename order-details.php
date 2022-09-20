<?php
ob_start();
include_once 'sidebar.php';
include_once 'notifications.php';

?>

    <!DOCTYPE html>
    <html lang="en">
    <?php
    if (isset($_SESSION['admin'])) {
        if (isset($_REQUEST['info'])) {
            $id = $_REQUEST['info'];
            $sqlSelect = "SELECT products.product_name, order_details.quantity, orders.status
            FROM orders 
            JOIN order_details on order_details.order_id = orders.order_id
            JOIN products on products.product_id = order_details.product_id
            WHERE orders.order_id = $id";
            $result = $db->conn->query($sqlSelect);
    ?>

        <head>
            <title>Admin panel | Order info</title>
        </head>

        <body>
            <form class="create-form" method="POST" style="margin-left: 40% !important;">
                <legend>Order details</legend><br>
                <h5 style="color:rgb(5, 94, 91);">Order number: <?= $id ?></h5><br>

                <div class="form-row">
                    <div class="form-group">
                    <label for="inputCategory"><b style="color:rgb(5, 94, 91);">Products:</b></label>
                        <ul class="list-group" style="width: 300px;">
                            <?php while ($row = $result->fetch()) : ?>
                            <li class="list-group-item"><b style="color:rgb(5, 94, 91);"><?= $row['product_name'] ?></b> &nbsp;&nbsp; X <span class="badge badge-pill" id="ord-det-qty"><?= $row['quantity'] ?></span></li>
                            <?php endwhile; }?>
                        </ul>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCategory"><b style="color:rgb(5, 94, 91);">Status:</b></label>
                        <select id="inputCategory" class="form-control" name="status" style="width: 300px;" required>
                                <option selected disabled>Select status</option>
                                <option value="Pending">Pending</option>
                                <option value="On the way">On the way</option>
                                <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="update_status" style="background-color:rgb(5, 94, 91); border-color:rgb(5, 94, 91);">Submit</button>
            </form>
        <?php
        if (isset($_POST['update_status'])) {
            $status = $_POST['status'];
            $sqlUpdate = $qb->update_order_status($status, $id);

            if ($sqlUpdate) {
                redirect("orders.php");
            }
        }
    } else {
        redirect("index.php");
    }
        ?>

    </html>