<?php
ob_start();
include_once 'sidebar.php';
include_once 'notifications.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_SESSION['admin'])) {
    if (isset($_REQUEST['edit'])) {
        $id = $_REQUEST['edit'];
        $sqlSelect = $qb->select("products", "product_id", " = $id");
?>

            <head>
                <title>Admin panel | Edit product</title>
            </head>

            <body>
                
                <form class="create-form" method="POST">
                    <legend style="color:rgb(5, 94, 91);">Update product</legend><br>

                    <?php while ($row = $sqlSelect->fetch()) { ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Product name</label>
                            <input type="hidden" class="form-control" name="product_id" value="<?= $row['product_id'] ?>">
                            <input type="text" class="form-control" id="inputName" name="product_name" value="<?= $row['product_name'] ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDescription">Product description</label>
                            <input type="text" class="form-control" id="inputDescription" name="product_description" placeholder="Example: pickles, ketchup, mustard..." value="<?= $row['product_description'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImage">Image</label>
                        <input type="file" class="form-control-file" id="inputImage" name="product_image" accept="image/*" value="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCategory">Category</label>
                            <select id="inputCategory" class="form-control" name="product_category">
                                <option selected value="<?= $row['product_category'] ?>"><?= $row['product_category'] ?></option>
                                <option value="Burgers">Burgers</option>
                                <option value="Pizzas">Pizzas</option>
                                <option value="Salads">Salads</option>
                                <option value="Cakes">Cakes</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPrice">Price</label>
                            <input type="text" class="form-control" id="inputPrice" name="product_price" value="<?= sprintf('%.2f', $row['product_price']); }} ?>" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" title="Numbers only" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update" style="background-color:rgb(5, 94, 91); border-color:rgb(5, 94, 91);">Update</button>
                </form>

            </body>
        <?php
        if (isset($_POST['update'])) {
            $updateProduct = $qb->update_product();

            if($updateProduct) {
                echo "<script>alert('Product updated successfully')</script>";
                redirect("admin.php");
                exit();
            } else {
                echo "<script>alert('Error occured')</script>";
            }
        }
    } else {
        redirect("admin.php");
    }
        ?>

</html>