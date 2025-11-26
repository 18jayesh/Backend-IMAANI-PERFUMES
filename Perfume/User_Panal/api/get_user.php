<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user_id'])) { echo json_encode(['error'=>'not_logged_in']); exit; }
require('../db.php');

$stmt = $pdo->prepare("SELECT id,name,email,phone,avatar,created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
if(!$user) { echo json_encode(['error'=>'user_not_found']); exit; }

// avatar full path
if($user['avatar']) $user['avatar'] = 'images/' . $user['avatar'];
echo json_encode($user);
