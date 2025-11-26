<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Wholesale Product</title>
<link href="../CSS/bootstrap.min.css" rel="stylesheet">
<link href="../icone/remixicon.css" rel="stylesheet">
<style>
.card{border-radius:12px;box-shadow:0 4px 18px rgba(0,0,0,0.06);}
.img-preview{width:140px;height:140px;object-fit:cover;border-radius:8px;border:1px solid #ddd;}
</style>
</head>
<body>
<div class="container mt-4">
    <a href="wholesale_products.php" class="btn btn-secondary mb-3"><i class="ri-arrow-left-line"></i> Back to Wholesale List</a>
    <div class="card p-4">
        <h4 class="mb-3">Add Wholesale Product</h4>
        <form action="wholesale_insert.php" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Product Name</label>
                    <input name="product_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Size</label>
                    <select name="size" class="form-select" required>
                        <option value="70ml">70ml</option>
                        <option value="50ml">50ml</option>
                        <option value="30ml">30ml</option>
                        <option value="20ml">20ml</option>
                        <option value="60ml Exclusive">60ml Exclusive</option>
                        <option value="6ml">6ml</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Stock</label>
                    <select name="stock" class="form-select" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control" id="imageInput" required>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <img id="preview" class="img-preview ms-2" src="../uploads/no-image.png" alt="preview">
                </div>

                <hr class="my-3">

                <div class="col-12">
                    <h5>Slab Prices (enter total price for slab)</h5>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Price (qty 1)</label>
                    <input name="price_1" class="form-control" type="number" step="0.01" >
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price (qty 2)</label>
                    <input name="price_2" class="form-control" type="number" step="0.01" >
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price (qty 5)</label>
                    <input name="price_5" class="form-control" type="number" step="0.01" >
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price (qty 10)</label>
                    <input name="price_10" class="form-control" type="number" step="0.01" >
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price (qty 20)</label>
                    <input name="price_20" class="form-control" type="number" step="0.01" >
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Add Wholesale Product</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById('preview').src = url;
});
</script>
</body>
</html>
