<?php
require_once 'QueryBuilder.php';
require_once 'Server.php';
$qb = new QueryBuilder;
$db = new Server;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?= time() ?>">
    <link rel="shortcut icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/f82ddd9a92.js" crossorigin="anonymous"></script>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: lightseagreen; display: inline-block;">
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="float: right">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mx-auto pt-3 pb-1">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?burgers">Burgers</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?pizzas">Pizzas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?salads">Salads</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?cakes">Cakes</a>
                </li>
            </ul>
            <ul class="float-right navbar-nav pt-3 pb-1" style="padding-right: 10px;">
                <?php
                if (isset($_SESSION['id'])) :
                ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?= explode(" ", $_SESSION['username'])[0]; ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="UserController.php?q=logout">Log Out</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Log in</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item active">
                    <?php
                    if (isset($_SESSION['cart'])) :
                        $productQuantity = array_column($_SESSION['cart'], 'quantity'); ?>
                        <span id="product-counter" class="text-danger bg-light"><?= array_sum($productQuantity) ?></span>
                        <a class="nav-link float-right cursor-pointer" id="cart-link" href="cart-view.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <?php else : ?>
                        <span id="product-counter" class="text-danger bg-light">0</span>
                        <a class="nav-link float-right cursor-pointer" id="cart-link" href="cart-view.php"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                </li>
            <?php endif ?>
            </ul>
        </div>
    </nav>
</header>

</html>