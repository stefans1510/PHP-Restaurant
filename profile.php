<?php
include_once 'navbar.php';
?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<header>
    <div class="wrapper d-flex">
        <div class="sidebar profile-sidebar">
            <ul>
                <li><a href="profile.php">Overview</a></li>
                <li><a href="profile.php?user_orders">My Orders</a></li>
                <li><a href="profile.php?change_email">Change Email</a></li>
                <li><a href="profile.php?change_address">Change Address</a></li>
                <li><a href="profile.php?change_password">Change Password</a></li>
            </ul>
        </div>
    </div>
</header>

<body>
    <form class="profile-details" id="profile-details" method="POST" action="UserController.php">
        <?php notification('profile') ?><br>
        <?php if (isset($_REQUEST['change_email'])) { ?>

            <legend class="profile-legend">Change email address</legend>
            <input type="hidden" name="action" value="update_email">
            <label for="email" class="profile-label">Enter New Email:</label>
            <input type="text" class="profile-detail" id="email" name="email" required autofocus>
            <button class="btn update-btn btn-sm" type="submit" name="update_email">Update</button>

        <?php } elseif (isset($_REQUEST['change_address'])) {  ?>

            <legend class="profile-legend">Change home address</legend>
            <input type="hidden" name="action" value="update_address">
            <label for="address" class="profile-label">Enter New Address:</label>
            <input type="text" class="profile-detail" id="address" name="address" required autofocus autofocus>
            <button class="btn update-btn btn-sm" type="submit">Update</button>

        <?php } elseif (isset($_REQUEST['change_password'])) {  ?>

            <legend class="profile-legend">Change password</legend>
            <input type="hidden" name="action" value="update_password">
            <label for="password" class="profile-label">Enter New Password:</label>
            <input type="password" class="profile-detail" id="password" name="password" pattern="[A-Za-z0-9]{6,}" title="Must contain atleast 6 characters. Letters and numbers only" required autofocus>
            <label for="repeat-password" class="profile-label">Repeat password:</label>
            <input type="password" class="profile-detail" id="repeat-password" name="repeat_password" required>
            <button class="btn update-btn btn-sm" type="submit">Update</button>

            <?php
        } else {
            $selectCustomer = $qb->select("customers", "customer_id", " =  {$_SESSION['id']}");
            while ($row = $selectCustomer->fetch()) :
            ?>
                <label for="name" class="profile-label">Name:</label>
                <input type="text" class="profile-detail" id="name" value="<?= $row['customer_name'] ?>" disabled>
                <label for="username" class="profile-label">Username:</label>
                <input type="text" class="profile-detail" id="username" value="<?= $row['customer_username'] ?>" disabled>
                <label for="email" class="profile-label">Email:</label>
                <input type="text" class="profile-detail" id="email" value="<?= $row['customer_email'] ?>" disabled>
                <label for="address" class="profile-label">Address:</label>
                <input type="text" class="profile-detail" id="address" value="<?= $row['customer_address'] ?>" disabled>

        <?php endwhile;
        } ?>
    </form>

    <?php if (isset($_REQUEST['user_orders'])) {
        $userID = $_SESSION['id'];
        $selectOrders = $qb->select("orders", "customer_id", " = $userID ORDER BY created DESC")
    ?>

        <script>
            document.getElementById("profile-details").style.display = "none";
        </script>

        <div class="outer-wrapper-cart profile-wrapper">
            <?php notification('cart-notification') ?>
            <div class="table-wrapper">
                <table class="cart-table" id="profile-table">
                    <thead>
                        <th>Address</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Info</th>
                    </thead>
                    <tbody>
                        <?php while ($row = $selectOrders->fetch()) : ?>
                            <tr>
                                <td class="cart-td"><?= $row['address'] ?></td>
                                <td class="cart-td"><?= $row['created'] ?></td>
                                <td class="cart-td"><?= $row['grand_total'] ?>&euro;</td>
                                <td class="cart-td"><?= $row['status'] ?></td>
                                <td>
                                    <a href="profile.php?user_order=<?= $row['order_id'] ?>" style="background-color: lightseagreen;" class="btn" id="info" onclick="show_details(); return false;"><i class="fas fa-info-circle" style="color: white; font-size: larger"></i></a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php }
    if (isset($_REQUEST['user_order'])) {
        $id = $_REQUEST['user_order'];
        $sqlSelect = "SELECT products.product_name, order_details.quantity, orders.order_id
                FROM orders 
                JOIN order_details ON order_details.order_id = orders.order_id
                JOIN products ON products.product_id = order_details.product_id 
                WHERE orders.order_id = '$id'";
        $result = $db->conn->query($sqlSelect);
    ?>

        <script>
            document.getElementById("profile-details").style.display = "none";
        </script>

        <div id="order-details">
            <?php while ($row = $result->fetch()) : ?>
                <p><b class="ord-det-product"><?= $row['product_name'] ?></b> &nbsp;&nbsp; X <span class="badge badge-pill"><?= $row['quantity'] ?></span></p>
                <hr>
            <?php endwhile ?>
        </div>

    <?php } ?>

</body>