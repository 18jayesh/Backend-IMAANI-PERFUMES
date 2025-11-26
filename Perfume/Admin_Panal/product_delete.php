<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include "../db/connection.php";

if(isset($_GET['id'])){

    $id = intval($_GET['id']); // secure

    // Fetch Image
    $getImg = mysqli_query($conn, "SELECT image FROM products WHERE product_id=$id");

    if(mysqli_num_rows($getImg) == 0){
        echo "<script>alert('Product Not Found!'); window.location.href='products.php';</script>";
        exit;
    }

    $row = mysqli_fetch_assoc($getImg);
    $image = $row['image'];

    // Image path
    $imgPath = "../uploads/" . $image;

    // Delete Image If Exists
    if(!empty($image) && file_exists($imgPath)){
        unlink($imgPath);
    }

    // Delete Product
    $delete = mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");

    if($delete){
        echo "<script>alert('Product Deleted Successfully!'); window.location.href='products.php';</script>";
    } else {
        echo "<script>alert('Database Error: Cannot delete!'); window.location.href='products.php';</script>";
    }

} else {
    echo "<script>alert('Invalid Request!'); window.location.href='products.php';</script>";
}
