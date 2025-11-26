<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../db/connection.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: wholesale_add.php");
    exit;
}

// sanitize
$product_name = trim($_POST['product_name']);
$size = $_POST['size'];
$description = trim($_POST['description']);
$stock = $_POST['stock'];

$price_1 = floatval($_POST['price_1']);
$price_2 = floatval($_POST['price_2']);
$price_5 = floatval($_POST['price_5']);
$price_10 = floatval($_POST['price_10']);
$price_20 = floatval($_POST['price_20']);

// image upload
if(!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK){
    echo "<script>alert('Image upload error'); window.history.back();</script>"; exit;
}
$img = $_FILES['image'];
$ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','webp'];
if(!in_array($ext, $allowed)){
    echo "<script>alert('Invalid image format'); window.history.back();</script>"; exit;
}
$filename = time()."_".rand(1000,9999).".".$ext;
$target = realpath(__DIR__ . "/..") . "../uploads/" . $filename;
if(!move_uploaded_file($img['tmp_name'], $target)){
    echo "<script>alert('Failed to move uploaded file. Ensure uploads folder exists and is writable.'); window.history.back();</script>"; exit;
}

// insert using prepared stmt
$stmt = $conn->prepare("INSERT INTO wholesale_products
    (product_name,size,description,image,stock,price_1,price_2,price_5,price_10,price_20)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssddddd",
    $product_name, $size, $description, $filename, $stock,
    $price_1, $price_2, $price_5, $price_10, $price_20
);

if($stmt->execute()){
    header("Location: wholesale_products.php?msg=added");
    exit;
} else {
    // remove uploaded file if DB failed
    if(file_exists($target)) unlink($target);
    echo "<script>alert('Database error while inserting'); window.history.back();</script>";
    exit;
}
