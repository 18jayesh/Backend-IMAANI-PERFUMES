<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../db/connection.php";

$id = intval($_GET['id'] ?? 0);
$row = null;
if($id){
    $st = $conn->prepare("SELECT * FROM wholesale_products WHERE w_id = ?");
    $st->bind_param("i",$id);
    $st->execute();
    $res = $st->get_result();
    $row = $res->fetch_assoc();
    if(!$row){ echo "Product not found"; exit; }
} else { header("Location: wholesale_products.php"); exit; }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Wholesale Product</title>
<link href="../CSS/bootstrap.min.css" rel="stylesheet">
<link href="../icone/remixicon.css" rel="stylesheet">
<style>.img-preview{width:140px;height:140px;object-fit:cover;border-radius:8px;border:1px solid #ddd;}</style>
</head>
<body>
<div class="container mt-4">
    <a href="wholesale_products.php" class="btn btn-secondary mb-3"><i class="ri-arrow-left-line"></i> Back</a>
    <div class="card p-4">
        <h4>Edit Wholesale Product</h4>
        <form action="wholesale_update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="w_id" value="<?= $row['w_id'] ?>">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($row['image']) ?>">
            <div class="row g-3">
                <div class="col-md-6"><label>Product Name</label>
                    <input name="product_name" class="form-control" value="<?= htmlspecialchars($row['product_name']) ?>" required></div>
                <div class="col-md-6"><label>Size</label>
                    <select name="size" class="form-select" required>
                        <?php
                        $sizes = ['70ml','50ml','30ml','20ml','60ml Exclusive','6ml'];
                        foreach($sizes as $s){
                            $sel = ($row['size']==$s)?'selected':'';
                            echo "<option value=\"{$s}\" {$sel}>{$s}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12"><label>Description</label>
                    <textarea name="description" class="form-control"><?= htmlspecialchars($row['description']) ?></textarea>
                </div>
                <div class="col-md-4"><label>Stock</label>
                    <select name="stock" class="form-select">
                        <option <?= $row['stock']=='Available'?'selected':'' ?>>Available</option>
                        <option <?= $row['stock']=='Out of Stock'?'selected':'' ?>>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-4"><label>Image (optional)</label>
                    <input type="file" name="image" class="form-control" id="imgInput"></div>
                <div class="col-md-4"><label>Current Image</label><br>
                    <img id="preview" class="img-preview" src="../uploads/<?= htmlspecialchars($row['image']) ?>"></div>

                <div class="col-md-2"><label>Price (1)</label><input name="price_1" class="form-control" value="<?= $row['price_1'] ?>" required></div>
                <div class="col-md-2"><label>Price (2)</label><input name="price_2" class="form-control" value="<?= $row['price_2'] ?>" required></div>
                <div class="col-md-2"><label>Price (5)</label><input name="price_5" class="form-control" value="<?= $row['price_5'] ?>" required></div>
                <div class="col-md-2"><label>Price (10)</label><input name="price_10" class="form-control" value="<?= $row['price_10'] ?>" required></div>
                <div class="col-md-2"><label>Price (20)</label><input name="price_20" class="form-control" value="<?= $row['price_20'] ?>" required></div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('imgInput').addEventListener('change', function(e){
    const f=e.target.files[0]; if(!f) return;
    document.getElementById('preview').src = URL.createObjectURL(f);
});
</script>
</body>
</html>
