<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user_id'])) { echo json_encode([]); exit; }
require('../db.php');

$stmt = $pdo->prepare("SELECT id,order_no,status,total,created_at FROM orders WHERE user_id=? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();
echo json_encode($orders);
