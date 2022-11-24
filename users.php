<?php
include_once 'sidebar.php';
include_once 'notifications.php';

$selectAdmin = $qb->select("customers", "customer_username", " = 'admin'");
$row = $selectAdmin->fetch();

$adminEmail = $row['customer_email'];

$selectCustomers = $qb->select("customers", "customer_email", " <> '$adminEmail'");
?>
<!DOCTYPE html>
<html lang="en">
<?php
    if (isset($_SESSION['admin'])) {
?>
<head>
    <title>Admin panel | Users</title>
</head>

<body>
    <div class="outer-wrapper users">
        <div class="table-wrapper">
            <table>
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email address</th>
                    <th>Home address</th>
                    <th></th>
                </thead>
                <?php
                while ($row = $selectCustomers->fetch()) :
                ?>
                    <tbody>
                        <tr>
                            <td><?= $row['customer_id'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['customer_username'] ?></td>
                            <td><?= $row['customer_email'] ?></td>
                            <td><?= $row['customer_address'] ?></td>
                            <td>
                                <a href="delete.php?delete_user=<?= $row['customer_id'] ?>" style="background-color:#D2122E" class="btn"><i class="fas fa-trash" style="color: white;"></i></a>
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