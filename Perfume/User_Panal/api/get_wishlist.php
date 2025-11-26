<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user_id'])) { echo json_encode([]); exit; }
require('../db.php');

$stmt = $pdo->prepare("SELECT id,product_id,product_name,created_at FROM wishlist WHERE user_id=? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
echo json_encode($stmt->fetchAll());
