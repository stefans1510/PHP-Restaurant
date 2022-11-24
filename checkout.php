<?php
ob_start();
include_once 'navbar.php';
include_once 'notifications.php';

if (isset($_POST['checkout'])) {
    if (!isset($_SESSION['id'])) {
        notification("cart-notification", "Please&nbsp;<a href='login.php' style='color:lightseagreen'>log in</a>&nbsp;to proceed to checkout");
        redirect("cart-view.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['id']) && !empty($_SESSION['cart'])) {
?>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="row mt-3 " id="checkout-form">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $totalPrice = 0;
                    foreach ($_SESSION['cart'] as $key => $value) :
                        $totalProductPrice = $value['quantity'] * $value['price'];
                        $totalPrice += $totalProductPrice;
                        $_SESSION['total_price'] = $totalPrice;
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $value['name'] ?></h6>
                                <small class="text-muted">Quantity: <?= $value['quantity'] ?></small>
                            </div>
                            <span class="text-muted"><?= sprintf('%.2f', $totalPrice) ?>&euro;</span>
                        </li>
                    <?php
                    endforeach;
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong><?= sprintf('%.2f', $_SESSION['total_price']) ?>&euro;</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Delivery details</h4>

                <form class="needs-validation" method="POST">
                    <?php
                    $selectCustomer =  $qb->select("customers", "customer_id", " = {$_SESSION['id']}");
                    while ($row = $selectCustomer->fetch()) :
                    ?>
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $row['customer_name'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $row['customer_email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone">Phone (Optional)</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?= $row['customer_address'] ?>" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="apt-no">Apartment</label>
                                <input type="text" class="form-control" id="apt-no" name="apartment">
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="payment" id="radio-btn" value="cash" checked>
                        <label class="form-check-label" for="radio-btn">
                            Cash
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="payment" id="radio-btn" value="card">
                        <label class="form-check-label" for="radio-btn">
                            Card
                        </label>
                    </div>
                    <?php
                    foreach ($_SESSION['cart'] as $cartItem) :
                    ?>
                        <input type="hidden" class="form-control" name="total" value="<?= sprintf('%.2f', $_SESSION['total_price']) ?>">
                    <?php endforeach; ?>
                    <hr class="mb-4">
                    <button class="btn buy-btn" type="submit" name="order">Submit</button>
                </form>
            </div>
        </div>
    </body>
<?php
    if (isset($_POST['order'])) {
        if ($_POST['payment'] == 'cash') {
            $qb->create_order();
        } elseif ($_POST['payment'] == 'card') {
            redirect("card-validation.php");
        }
    }
} else {
    redirect("index.php");
}
?>

</html>