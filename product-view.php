<?php include 'navbar.php'; ?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<?php
$id = $_REQUEST['select'];

$selectProduct = $qb->select("products", "product_id", " = $id");

while ($row = $selectProduct->fetch()) {
    $name = $row['product_name'];
    $image = $row['product_image'];
    $description = $row['product_description'];
    $price = $row['product_price'];
?>

    <body>
        <div class="product-container">
            <img src="images/<?= $image ?>" class="product-image">
            <div class="product-info">
                <p class="product-name"><b><?= $name ?></b></p>
                <p class="product-description"><?= $description ?></p>
                <p class="product-price"><b><?= sprintf('%.2f', $price); } ?>&euro;</b></p><br>
                <form action="cart-view.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $id ?>">
                    <input type="number" class="quantity-counter" name="quantity" min="1" value="1">
                    <button type="submit" class="btn add-to-cart" style="font-size:small" name="add_to_cart">Add to cart</button>
                </form>
            </div>
        </div>
    </body>