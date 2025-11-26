<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include "../db/connection.php";

$name        = $_POST['name'];
$price       = $_POST['price'];
$description = $_POST['description'];
$stock_status = $_POST['stock_status']; // NEW

// IMAGE UPLOAD
$img_name = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$ext = pathinfo($img_name, PATHINFO_EXTENSION);
$allowed = ['jpg','jpeg','png','webp'];

if(!in_array(strtolower($ext), $allowed)){
    die("<script>alert('Invalid Image Format'); window.location='product_add.php';</script>");
}

$newName = time() . "_" . rand(1000,9999) . "." . $ext;

if(!move_uploaded_file($tmp, "../uploads/" . $newName)){
    die("<script>alert('Image Upload Failed! uploads folder missing'); window.location='product_add.php';</script>");
}

// INSERT QUERY (updated)
$query = "INSERT INTO products(name, price, description, image, stock_status)
          VALUES('$name', '$price', '$description', '$newName', '$stock_status')";

if(mysqli_query($conn, $query)){
    echo "<script>alert('Product Added Successfully'); window.location='products.php';</script>";
} else {
    echo "<script>alert('Database Error: Unable to Add Product'); window.location='product_add.php';</script>";
}
?>
