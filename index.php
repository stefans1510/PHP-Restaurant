<?php
include_once 'navbar.php';
include_once 'notifications.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <?php notification('success') ?>
    <div id="slider-indicator" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider-indicator" data-slide-to="0" class="active"></li>
            <li data-target="#slider-indicator" data-slide-to="1"></li>
            <li data-target="#slider-indicator" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/stake-salad.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/pepperonipizza.jpg">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/cheesecake.jpg">
            </div>
        </div>
        <a class="carousel-control-prev" href="#slider-indicator" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider-indicator" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br>
    <div class="container py-5">
        <div class="row">
            <?php
            if (isset($_REQUEST['burgers']))
                $selectProducts = $qb->select("products", "product_category", " = 'Burgers'");
            elseif (isset($_REQUEST['pizzas']))
                $selectProducts = $qb->select("products", "product_category", " = 'Pizzas'");
            elseif (isset($_REQUEST['salads']))
                $selectProducts = $qb->select("products", "product_category", " = 'Salads'");
            elseif (isset($_REQUEST['cakes']))
                $selectProducts = $qb->select("products", "product_category", " = 'Cakes'");
            else $selectProducts = $qb->select_all('products');

            while ($row = $selectProducts->fetch()) :
            ?>
                <div class="col-md-4" style="text-align: center">
                    <div class="card mb-5 align-items-center" id="product-card" style="width: 18rem; height: 25rem">
                        <img id="product-img" class="card-img-top" src="images/<?= $row['product_image'] ?>">
                        <div class="card-body">
                            <h4 class="card-title mt-1"><?= $row['product_name'] ?></h4>
                            <h5 class="card-text"><?= sprintf('%.2f', $row['product_price']) ?>&euro;</h5>
                        </div>
                        <a href="product-view.php?select=<?= $row['product_id'] ?>" id="add-btn" class="btn mb-4 mx-auto">Select</a>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
</body>
<?php include_once 'footer.php' ?>

</html>
