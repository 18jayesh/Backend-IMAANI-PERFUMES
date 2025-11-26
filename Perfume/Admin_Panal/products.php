<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}
include "../db/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Admin Panel</title>
    <link href="../CSS/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background: #f4f6f9;
        }
        .card{
            border-radius: 12px;
            border: none;
            box-shadow: 0px 3px 12px rgba(0,0,0,0.08);
        }
        .btn-add{
            background:#4CAF50;
            color:white;
            border-radius:8px;
        }
        .product-img{
            width:60px;
            height:60px;
            object-fit:cover;
            border-radius:6px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Products</h2>
        <a href="product_add.php" class="btn btn-add px-3">+ Add Product</a>
    </div>

    <div class="card p-3">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Date</th>
                    <th width="160px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM products ORDER BY product_id DESC");

                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['product_id'] ?></td>

                    <td>
                        <img src="../uploads/<?= $row['image'] ?>" class="product-img">
                    </td>

                    <td><?= $row['name'] ?></td>

                    <td>₹<?= $row['price'] ?></td>

                    <td style="max-width:250px;"><?= $row['description'] ?></td>

                    <td>
                        <?php if($row['stock_status'] == 'Available'): ?>
                            <span class="badge bg-success">Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Out of Stock</span>
                        <?php endif; ?>
                    </td>

                    <td><?= $row['created_at'] ?></td>

                    <td>
                        <a href="product_edit.php?id=<?= $row['product_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="product_delete.php?id=<?= $row['product_id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
