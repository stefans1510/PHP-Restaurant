<?php
include_once 'sidebar.php';
include_once 'notifications.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
    if (isset($_SESSION['admin'])) {
?>
<head>
    <title>Admin panel | Stats</title>
</head>

<body>
<ol class="list-group list-group-light list-group-numbered" style="margin-left: 35% !important; margin-top: 10%; width: 40%">
<legend style="color: rgb(5, 94, 91);">Top selling products:</legend><br>
<?php
$sql = "SELECT order_details.product_id, products.product_name, products.product_description, SUM(order_details.quantity) as total FROM order_details
JOIN products ON order_details.product_id = products.product_id GROUP BY product_id ORDER BY total DESC LIMIT 5";
$result = $db->conn->query($sql);
while ($row = $result->fetch()):
?>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><?= $row['product_name'] ?></div>
      <?= $row['product_description'] ?>
    </div>
    <span class="badge badge-pill" id="ord-det-qty"><?= $row['total'] ?></span>
  </li>
  <?php endwhile ?>
</ol>
</body>
<?php
    } else {
        redirect("index.php");
    }
?>
</html>