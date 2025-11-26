<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../db/connection.php";
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Wholesale Products</title>
<link href="../CSS/bootstrap.min.css" rel="stylesheet">
<link href="../icone/remixicon.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Wholesale Products</h3>
        <a href="wholesale_add.php" class="btn btn-success"><i class="ri-add-line"></i> Add New</a>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success">Action completed</div>
    <?php endif; ?>

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr><th>ID</th><th>Image</th><th>Name</th><th>Size</th><th>Stock</th>
                        <th>1</th><th>2</th><th>5</th><th>10</th><th>20</th>
                        <th>Created</th><th>Action</th></tr>
                </thead>
                <tbody>
                <?php
                $res = $conn->query("SELECT * FROM wholesale_products ORDER BY w_id DESC");
                while($r = $res->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $r['w_id'] ?></td>

                    <td>
                        <img src="../uploads/<?= htmlspecialchars($r['image']) ?>" 
                            style="width:70px;height:70px;object-fit:cover;border-radius:6px;">
                    </td>

                    <td><?= htmlspecialchars($r['product_name']) ?></td>
                    <td><?= htmlspecialchars($r['size']) ?></td>

                    <!-- ⭐ UPDATED STOCK UI -->
                    <td>
                        <?php if($r['stock'] == 'Available'): ?>
                            <span class="badge bg-success">Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Out of Stock</span>
                        <?php endif; ?>
                    </td>


                    <td><?= $r['price_1'] ?></td>
                    <td><?= $r['price_2'] ?></td>
                    <td><?= $r['price_5'] ?></td>
                    <td><?= $r['price_10'] ?></td>
                    <td><?= $r['price_20'] ?></td>

                    <td><?= $r['created_at'] ?></td>

                    <td>
                        <a class="btn btn-sm btn-warning" href="wholesale_edit.php?id=<?= $r['w_id'] ?>">
                            <i class="ri-edit-2-line"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" 
                        href="wholesale_delete.php?id=<?= $r['w_id'] ?>" 
                        onclick="return confirm('Delete?')">
                        <i class="ri-delete-bin-line"></i>
                        </a>
                    </td>
                </tr>

                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
