<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header('Location: login.php'); exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>My Dashboard - Perfume</title>
  <link href="../CSS/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">PerfumeShop</a>
      <div class="ms-auto">
        <button id="logoutBtn" class="btn btn-outline-secondary btn-sm">Logout</button>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <div class="row">
      <!-- Left nav -->
      <div class="col-md-3">
        <div class="card p-3">
          <div class="text-center">
            <img id="userAvatar" src="images/default-avatar.png" class="rounded-circle mb-2" width="100" height="100" alt="avatar">
            <h5 id="userName">User Name</h5>
            <p id="userEmail" class="text-muted small">email</p>
          </div>
          <hr>
          <ul class="nav flex-column" id="sideMenu">
            <li class="nav-item"><a class="nav-link active" href="#" data-tab="profile">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="orders">My Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="wishlist">Wishlist</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="addresses">Addresses</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="reviews">My Reviews</a></li>
          </ul>
        </div>
      </div>

      <!-- Right content -->
      <div class="col-md-9">
        <div class="card p-4">
          <div id="tabContent">
            <!-- Profile tab -->
            <div id="profile" class="tab-pane active">
              <h4>Profile</h4>
              <form id="profileForm">
                <div class="row">
                  <div class="col-md-4 text-center">
                    <img id="profileAvatar" src="images/default-avatar.png" class="rounded-circle mb-2" width="120" height="120">
                    <input type="file" id="avatarInput" class="form-control form-control-sm mt-2">
                  </div>
                  <div class="col-md-8">
                    <div class="mb-2">
                      <label>Name</label>
                      <input type="text" id="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label>Email</label>
                      <input type="email" id="email" class="form-control" readonly>
                    </div>
                    <div class="mb-2">
                      <label>Phone</label>
                      <input type="text" id="phone" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Orders tab -->
            <div id="orders" class="tab-pane d-none">
              <h4>My Orders</h4>
              <div id="ordersList">Loading orders...</div>
            </div>

            <!-- Wishlist -->
            <div id="wishlist" class="tab-pane d-none">
              <h4>Wishlist</h4>
              <div id="wishlistList">Loading wishlist...</div>
            </div>

            <!-- Addresses -->
            <div id="addresses" class="tab-pane d-none">
              <h4>Addresses</h4>
              <div id="addressesList">Loading addresses...</div>
            </div>

            <!-- Reviews -->
            <div id="reviews" class="tab-pane d-none">
              <h4>My Reviews</h4>
              <div id="reviewsList">Loading reviews...</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
