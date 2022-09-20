<?php
ob_start();
require_once 'QueryBuilder.php';
include_once 'notifications.php';

$qb = new QueryBuilder;

if (isset($_REQUEST['delete_product'])) {
    $productId = $_REQUEST['delete_product'];
    $sqlDelte = $qb->delete('products', 'product_id', $productId);

    if($sqlDelte) {
        "<script>alert('Product successsfully deleted!')</script>";
        redirect("admin.php");
    } else {
        echo "<script>alert('Error occured')</script>";
    }
}

if (isset($_REQUEST['delete_user'])) {
    $userId = $_REQUEST['delete_user'];
    $sqlDelte = $qb->delete('customers', 'customer_id', $userId);

    if($sqlDelte) {
        "<script>alert('User successsfully deleted!')</script>";
        redirect("users.php");
    } else {
        echo "<script>alert('Error occured')</script>";
    }
}

if (isset($_REQUEST['remove_cart_item'])) {
    $k = $_REQUEST['remove_cart_item'];
    unset($_SESSION['cart'][$k]);
    redirect("cart-view.php");
}
?>