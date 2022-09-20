<?php 
require_once 'QueryBuilder.php';
require_once 'Server.php';
$qb = new QueryBuilder;
$db = new Server;
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/f82ddd9a92.js" crossorigin="anonymous"></script>
</head>
<header>
    <div class="wrapper d-flex">
        <div class="sidebar">
            <ul>
                <li><a href="admin.php"><i class="fas fa-list" aria-hidden="true"></i>Products</a></li>
                <li><a href="users.php"><i class='fas fa-users'></i>Users</a></li>
                <li><a href="create.php"><i class="fas fa-external-link-alt"></i>Add New Product</a></li>
                <li><a href="orders.php"><i class="fas fa-list"></i>Orders</a></li>
                <li><a href="stats.php"><i class="fas fa-chart-bar"></i>Stats</a></li>
                <li><a href="UserController.php?q=logout"><i class="fas fa-power-off"></i>Log Out</a></li>
            </ul>
        </div>
    </div>
</header>

</html>