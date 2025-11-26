<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include "../db/connection.php";

// Get product id
$id = $_GET['id'];

// Fetch product data
$sql = "SELECT * FROM products WHERE product_id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if(!$product){
    die("Product Not Found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="../CSS/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }
        .card{
            border-radius:12px;
            border:none;
            box-shadow:0px 3px 12px rgba(0,0,0,0.1);
        }
        .form-control{
            border-radius:8px;
        }
        .btn-save{
            background:#4CAF50;
            color:#fff;
        }
        .product-img{
            width:120px;
            height:120px;
            object-fit:cover;
            border-radius:10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="card p-4">
        <h3 class="fw-bold mb-4">Edit Product</h3>

        <form action="product_update.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
            <input type="hidden" name="old_image" value="<?= $product['image'] ?>">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" value="<?= $product['name'] ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="<?= $product['price'] ?>" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="4" name="description" required><?= $product['description'] ?></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Stock Status</label>
                    <select class="form-control" name="stock" required>
                        <option value="Available" <?= ($product['stock_status'] == 'Available') ? 'selected' : '' ?>>Available</option>
                        <option value="Out of Stock" <?= ($product['stock_status'] == 'Out of Stock') ? 'selected' : '' ?>>Out of Stock</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="../uploads/<?= $product['image'] ?>" class="product-img">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Upload New Image (Optional)</label>
                    <input type="file" class="form-control" name="image">
                </div>

            </div>

            <button type="submit" class="btn btn-save px-4 mt-3">Update Product</button>
            <a href="products.php" class="btn btn-secondary px-4 mt-3">Cancel</a>

        </form>

    </div>

</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
