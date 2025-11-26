<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user_id'])) { echo json_encode(['error'=>'not_logged_in']); exit; }
require('../db.php');

$userId = $_SESSION['user_id'];
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';

$avatarName = null;
if(!empty($_FILES['avatar']['name'])){
  $f = $_FILES['avatar'];
  $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
  $avatarName = 'avatar_'.$userId.'_'.time().'.'.$ext;
  move_uploaded_file($f['tmp_name'], __DIR__ . '/../images/'.$avatarName);
}

try {
  if($avatarName){
    $stmt = $pdo->prepare("UPDATE users SET name=?, phone=?, avatar=? WHERE id=?");
    $stmt->execute([$name,$phone,$avatarName,$userId]);
  } else {
    $stmt = $pdo->prepare("UPDATE users SET name=?, phone=? WHERE id=?");
    $stmt->execute([$name,$phone,$userId]);
  }
  echo json_encode(['success'=>true]);
} catch(Exception $e){
  echo json_encode(['error'=>$e->getMessage()]);
}
