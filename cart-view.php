<?php
include_once 'navbar.php';
include_once 'notifications.php';

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sqlSelect = $qb->select("products", "product_id", " = $productId");

    $row = $sqlSelect->fetch();

    $cartArray = [
        'id' => $productId,
        'name' => $row['product_name'],
        'image' => $row['product_image'],
        'price' => $row['product_price'],
        'quantity' => $quantity
    ];

    $_SESSION['cart'][] = $cartArray;

    redirect("index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <?php if (empty($_SESSION['cart'])) { ?>
        <div id="cart-warning">
            <p style="font-weight: bold">Your cart is empty...</p>
            <a href="index.php" style="color:lightseagreen">Continue with your shopping</a>
        </div>
    <?php } else { ?>
        <div class="outer-wrapper-cart">
            <?php notification('cart-notification') ?>
            <div class="table-wrapper">
                <table class="cart-table">
                    <thead>
                        <th></th>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </thead>
                        <?php
                        $totalPrice = 0;
                        foreach ($_SESSION['cart'] as $key => $value) {
                            $totalProductPrice = $value['quantity'] * $value['price'];
                            $totalPrice += $totalProductPrice;
                        ?>
                    <tbody>
                        <tr>
                            <td class="cart-td"><img class="cart-img" src="images/<?= $value['image'] ?>"></td>
                            <td class="cart-td"><?= $value['name'] ?></td>
                            <td class="cart-td"><?= $value['quantity'] ?></td>
                            <td><?= sprintf('%.2f', $totalProductPrice) ?>&euro;</td>
                            <td><a href="delete.php?remove_cart_item=<?= $key ?>" style="background-color:#D2122E" class="btn"><i class="fas fa-trash" style="color: white;"></i><?php } ?></a></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <p style="margin-right: 8%; font-weight: bold; color:lightseagreen">Total: <?= sprintf('%.2f', $totalPrice) ?>&euro;</p>
            <form method="post" action="checkout.php">
                <button type="submit" class="btn checkout-btn" name="checkout">Checkout</button>
            </form>
        </div>

    <?php } ?>
</body>

</html>