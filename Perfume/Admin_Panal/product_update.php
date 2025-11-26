<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

include "../db/connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$old_image = $_POST['old_image'];

$new_image = $old_image;  // default = old image

// IMAGE UPLOAD CHECK
if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

    $img_name = time() . "_" . rand(1000,9999) . "_" . $_FILES['image']['name'];
    $target = "../uploads/" . $img_name;

    // Upload new image
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

        // Delete old image
        if(file_exists("../uploads/" . $old_image)){
            unlink("../uploads/" . $old_image);
        }

        $new_image = $img_name;
    } else {
        echo "<script>alert('Image Upload Failed!'); window.location.href='products.php';</script>";
        exit;
    }
}

// UPDATE QUERY
$update = "UPDATE products SET 
            name='$name',
            price='$price',
            description='$description',
            stock_status='$stock',
            image='$new_image'
           WHERE product_id=$id";

if(mysqli_query($conn, $update)){
    echo "<script>alert('Product Updated Successfully!'); window.location.href='products.php';</script>";
} else {
    echo "<script>alert('Error Updating Product'); window.location.href='products.php';</script>";
}
?>
