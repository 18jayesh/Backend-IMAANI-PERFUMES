<?php
session_start();
include "db/connection.php";

$email = $_POST['email'];
$password = md5($_POST['password']);

// Prevent SQL Injection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);

    // COMMON SESSIONS FOR ALL
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['role'] = $row['role'];

    // SEPARATE SESSION FOR ADMIN ONLY
    if($row['role'] === 'admin'){
        $_SESSION['admin'] = true;   // IMPORTANT FIX
        header("Location: index.php");
    } 
    else {
        $_SESSION['user'] = true;    // for user dashboard
        header("Location: index.php");
    }
}
else{
    echo "<script>alert('Invalid Email or Password'); window.location.href='login.php';</script>";
}
?>
