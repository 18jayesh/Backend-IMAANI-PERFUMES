<?php
session_start();
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
include "../db/connection.php";

$id = intval($_GET['id'] ?? 0);
if(!$id){ header("Location: wholesale_products.php"); exit; }

// get image
$st = $conn->prepare("SELECT image FROM wholesale_products WHERE w_id=?");
$st->bind_param("i",$id); $st->execute();
$res = $st->get_result();
if($res->num_rows==0){ header("Location: wholesale_products.php"); exit; }
$row = $res->fetch_assoc();
if(!empty($row['image'])){
    $path = realpath(__DIR__ . "/..") . "../uploads/" . $row['image'];
    if(file_exists($path)) @unlink($path);
}
$del = $conn->prepare("DELETE FROM wholesale_products WHERE w_id=?");
$del->bind_param("i",$id);
$del->execute();
header("Location: wholesale_products.php?msg=deleted");
