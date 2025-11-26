<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Admin Dashboard</title>
<link rel="stylesheet" href="../CSS/bootstrap.min.css"> 
<!-- icone link -->
<link rel="stylesheet" href="../icone/remixicon.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Poppins", sans-serif;
}

/* Layout */
body{
    display:flex;
    background:#f5f7fa;
}

/* Sidebar */
.sidebar{
    width:250px;
    height:100vh;
    background:#111827;
    color:white;
    position:fixed;
    left:0;
    top:0;
    padding:20px;
    transition:0.3s;
    z-index:1000;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    font-size:22px;
}

/* CLOSE BUTTON INSIDE SIDEBAR */
.close-btn{
    display:none;
    position:absolute;
    top:12px;
    right:12px;
    background:#ef4444;
    border:none;
    color:white;
    padding:6px 10px;
    font-size:18px;
    border-radius:6px;
    cursor:pointer;
}

.sidebar a{
    display:block;
    padding:12px 20px;
    color:#d1d5db;
    text-decoration:none;
    border-radius:8px;
    margin-bottom:8px;
    transition:0.2s;
}

.sidebar a:hover,
.sidebar a.active{
    background:#1f2937;
    color:white;
}

/* Main content */
.main{
    margin-left:250px;
    width:100%;
    padding:20px;
    transition:0.3s;
}

/* Toggle button */
.menu-btn{
    display:none;
    font-size:28px;
    margin-bottom:15px;
    cursor:pointer;
}

/* Cards */
.cards{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
    gap:20px;
    margin-top:20px;
}

.card{
    padding:20px;
    background:white;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    text-align:center;
}

.card h3{
    font-size:25px;
    margin-bottom:5px;
}

.card p{
    color:#555;
}

/* Table */
.table-box{
    margin-top:30px;
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:black;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

.badge{
    padding:5px 10px;
    border-radius:6px;
    color:white;
}

.success{ background:green; }
.pending{ background:orange; }

/* Responsive */
@media (max-width:768px){

    .menu-btn{
        display:block;
    }

    .sidebar{
        left:-260px;
        position:absolute;
    }

    .close-btn{
        display:block;
    }

    .main{
        margin-left:0;
    }
}

</style>

</head>
<body>


<!-- Sidebar -->
<div class="sidebar" id="sidebar">

    <button class="close-btn" onclick="closeSidebar()"><i class="ri-close-fill"></i></button>

    <h2>Admin Panel</h2>

    <!-- Dashboard -->
    <a href="#" class="active">
        <i class="ri-dashboard-line" style="margin-right:8px;"></i>
        Dashboard
    </a>

    <!-- Products -->
    <a href="products.php">
        <i class="ri-shopping-bag-3-line" style="margin-right:8px;"></i>
        Products
    </a>

    <!-- Wholesale Products -->
    <a href="wholesale_products.php">
        <i class="ri-store-2-line" style="margin-right:8px;"></i>
        Wholesale Products
    </a>

    <!-- Orders -->
    <a href="#">
        <i class="ri-file-list-3-line" style="margin-right:8px;"></i>
        Orders
    </a>

    <!-- Users -->
    <a href="#">
        <i class="ri-user-star-line" style="margin-right:8px;"></i>
        Users
    </a>

    <!-- Payments -->
    <a href="#">
        <i class="ri-money-rupee-circle-line" style="margin-right:8px;"></i>
        Payments
    </a>

    <!-- Settings -->
    <a href="#">
        <i class="ri-settings-3-line" style="margin-right:8px;"></i>
        Settings
    </a>

</div>


<!-- Main Content -->
<div class="main">

    <span class="menu-btn" onclick="toggleSidebar()"><i class="ri-menu-line"></i></span>

    <h1>Dashboard Overview</h1>

    <!-- Cards -->
    <div class="cards">
        <div class="card">
            <h3>150</h3>
            <p>Total Products</p>
        </div>
        <div class="card">
            <h3>80</h3>
            <p>Total Orders</p>
        </div>
        <div class="card">
            <h3>₹70,500</h3>
            <p>Total Revenue</p>
        </div>
        <div class="card">
            <h3>24</h3>
            <p>New Users</p>
        </div>
    </div>

    <!-- Table -->
    <div class="table-box">
        <h2 style="margin-top:20px;margin-bottom:10px;">Recent Orders</h2>

        <table>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <tr>
                <td>01</td>
                <td>Jayesh</td>
                <td>Dior</td>
                <td>₹1999</td>
                <td><span class="badge success">Paid</span></td>
                <td>2025-02-10</td>
            </tr>

            <tr>
                <td>02</td>
                <td>Aakash</td>
                <td>Versace</td>
                <td>₹2499</td>
                <td><span class="badge pending">Pending</span></td>
                <td>2025-02-12</td>
            </tr>

        </table>
    </div>

</div>

<script>

/* OPEN SIDEBAR */
function toggleSidebar(){
    let bar = document.getElementById("sidebar");
    bar.style.left = "0px";
}

/* CLOSE SIDEBAR */
function closeSidebar(){
    let bar = document.getElementById("sidebar");
    bar.style.left = "-260px";
}

</script>

</body>
</html>
