<?php
ob_start();
require_once 'sidebar.php';
include_once 'notifications.php';

if (isset($_POST['create'])) {
    $createProduct = $qb->create_product();
    
    if ($createProduct) {
        echo "<script>alert('Product added successfully!')</script>";
        redirect("admin.php");
        exit();
    } else {
        echo "<script>alert('Error occurred, try again!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
    if (isset($_SESSION['admin'])) {
?>
<head>
    <title>Admin panel | Add new product</title>
</head>

<body>
    <form class="create-form" method="POST">
        <legend style="color:rgb(5, 94, 91);">Add new product</legend><br>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Product name</label>
                <input type="text" class="form-control" id="inputName" name="product_name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputDescription">Product description</label>
                <input type="text" class="form-control" id="inputDescription" name="product_description" placeholder="Example: pickles, ketchup, mustard..." required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputImage">Image</label>
            <input type="file" class="form-control-file" id="inputImage" name="product_image" accept="image/*">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCategory">Category</label>
                <select id="inputCategory" class="form-control" name="product_category" required>
                    <option disabled selected value="">Choose...</option>
                    <option value="Burgers">Burgers</option>
                    <option value="Pizzas">Pizzas</option>
                    <option value="Salads">Salads</option>
                    <option value="Cakes">Cakes</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputPrice">Price</label>
                <input type="text" class="form-control" id="inputPrice" name="product_price" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="Numbers only" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="create" style="background-color:rgb(5, 94, 91); border-color:rgb(5, 94, 91);">Add product</button>
    </form>
</body>
<?php
    } else {
        redirect("index.php");
    }
?>
</html>