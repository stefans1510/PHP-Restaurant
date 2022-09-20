<?php
    include_once 'sidebar.php' ;
    include_once 'notifications.php';

    $sqlSelect = $qb->select_all('products');
?>
<!DOCTYPE html>
<html lang="en">
<?php
    if (isset($_SESSION['admin'])) {
?>
<head>
    <title>Admin panel | Products</title>
</head>

<body>
    <div class="outer-wrapper products">
        <div class="table-wrapper">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Product name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Edit / Delete</th>
                </thead>
                <?php
                while ($row = $sqlSelect->fetch()) :
                ?>
                    <tbody>
                        <tr>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['product_category'] ?></td>
                            <td><?= $row['product_description'] ?></td>
                            <td><?= $row['product_image'] ?></td>
                            <td><?= sprintf('%.2f', $row['product_price']) ?>&euro;</td>
                            <td>
                                <a href="edit.php?edit=<?= $row['product_id'] ?>" style="background-color:rgb(5, 94, 91);" class="btn"><i class="fas fa-pen" style="color: white;"></i></a><br><br>
                                <a href="delete.php?delete_product=<?= $row['product_id'] ?>" style="background-color:#D2122E" class="btn"><i class="fas fa-trash" style="color: white;"></i></a>
                            </td>
                        </tr>
                    </tbody>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
<?php
    } else {
        redirect("index.php");
    }
?>
</html>