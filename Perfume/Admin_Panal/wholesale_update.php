<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../db/connection.php";

if($_SERVER['REQUEST_METHOD']!=='POST'){ header("Location: wholesale_products.php"); exit; }

$w_id = intval($_POST['w_id']);
$product_name = trim($_POST['product_name']);
$size = $_POST['size'];
$description = trim($_POST['description']);
$stock = $_POST['stock'];
$price_1 = floatval($_POST['price_1']);
$price_2 = floatval($_POST['price_2']);
$price_5 = floatval($_POST['price_5']);
$price_10 = floatval($_POST['price_10']);
$price_20 = floatval($_POST['price_20']);
$old_image = $_POST['old_image'];

$new_image = $old_image;
if(isset($_FILES['image']) && $_FILES['image']['error']===UPLOAD_ERR_OK){
    $img = $_FILES['image'];
    $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','webp'];
    if(!in_array($ext,$allowed)){ echo "<script>alert('Invalid image'); window.history.back();</script>"; exit; }
    $filename = time()."_".rand(1000,9999).".".$ext;
    $target = realpath(__DIR__ . "/..") . "../uploads/" . $filename;
    if(move_uploaded_file($img['tmp_name'],$target)){
        // delete old
        if(!empty($old_image) && file_exists(realpath(__DIR__ . "/..") . "../uploads/" . $old_image)){
            @unlink(realpath(__DIR__ . "/..") . "../uploads/" . $old_image);
        }
        $new_image = $filename;
    } else {
        echo "<script>alert('Image upload failed'); window.history.back();</script>"; exit;
    }
}

// update
$stmt = $conn->prepare("UPDATE wholesale_products SET 
    product_name=?, size=?, description=?, image=?, stock=?, 
    price_1=?, price_2=?, price_5=?, price_10=?, price_20=? 
    WHERE w_id=?");

$stmt->bind_param("sssssdddddi",
    $product_name, $size, $description, $new_image, $stock,
    $price_1, $price_2, $price_5, $price_10, $price_20, $w_id
);

if($stmt->execute()){
    header("Location: wholesale_products.php?msg=updated");
} else {
    echo "<script>alert('DB error while updating'); window.history.back();</script>";
}
