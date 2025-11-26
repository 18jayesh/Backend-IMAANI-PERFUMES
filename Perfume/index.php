<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imaani Perfumes</title>

  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="CSS/bootstrap.min.css">
  
  <!-- Remix Icons -->
   <link rel="stylesheet" href="icone/remixicon.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="CSS/style.css">

  <script type="importmap">
{
  "imports": {
    "react": "https://aistudiocdn.com/react@^19.2.0",
    "react/": "https://aistudiocdn.com/react@^19.2.0/"
  }
}
</script>
<style>
    /* USER DROPDOWN */
    .user-dropdown {
      position: relative;
    }

    .user-menu {
      position: absolute;
      top: 40px;
      left: -50px;
      width: 150px;
      background: white;
      border-radius: 6px;
      padding: 10px 0;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
      opacity: 0;
      visibility: hidden;
      transition: 0.3s;
      z-index: 999;
    }

    .user-dropdown:hover .user-menu {
      opacity: 1;
      visibility: visible;
    }

    .user-menu a {
      display: block;
      padding: 8px 15px;
      color: black;
      text-decoration: none;
    }

    .user-menu a:hover {
      background: #f5f5f5;
    }
</style>



</head>

<body>
  <!-- Navigation -->
  <?php session_start(); ?>

  <header>
      <nav class="navbar navbar-expand-lg fixed-top bg-white transition-all" id="mainNav">
        <div class="container-xl px-4 px-lg-5">

          <!-- Mobile Menu Toggle -->
          <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#mobileMenu" aria-controls="mobileMenu">
            <i class="ri-menu-line fs-4"></i>
          </button>

          <!-- Logo -->
          <a class="navbar-brand mx-auto mx-lg-0 d-flex align-items-center" href="#">
            <img src="Images/logo.png" class="me-1" alt="Imaani" height="30px">
            <div class="logo-text font-serif fw-bold text-uppercase tracking-widest">Imaani</div>
          </a>

          <!-- Icons (Mobile Right) -->
          <div class="d-flex d-lg-none">
            <a href="#" class="nav-link text-dark position-relative">
              <i class="ri-shopping-bag-line fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black text-white"
                style="font-size: 0.6rem;">3</span>
            </a>
          </div>

          <!-- Desktop Menu -->
          <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0 gap-4">
              <li class="nav-item">
                <a class="nav-link text-uppercase tracking-widest fw-medium active" href="#">Home</a>
              </li>

              <li class="nav-item dropdown group-hover">
                <a class="nav-link text-uppercase tracking-widest fw-medium dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown">Products</a>
                <ul class="dropdown-menu border-0 shadow-lg rounded-0 mt-0">
                  <li><a class="dropdown-item py-2" href="products.php">Shop All</a></li>
                  <li><a class="dropdown-item py-2" href="#">70ml Collection</a></li>
                  <li><a class="dropdown-item py-2" href="#">50ml Collection</a></li>
                  <li><a class="dropdown-item py-2" href="#">30ml Collection</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item py-2" href="#">Exclusive Attar</a></li>
                </ul>
              </li>

              <li class="nav-item"><a class="nav-link text-uppercase tracking-widest fw-medium" href="#">Wholesale</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase tracking-widest fw-medium" href="#">About Us</a></li>
              <li class="nav-item"><a class="nav-link text-uppercase tracking-widest fw-medium" href="#">Contact</a></li>
            </ul>
          </div>

          <!-- RIGHT SIDE ICONS (Desktop) -->
          <div class="d-none d-lg-flex align-items-center gap-3">

            <!-- Search Icon -->
            <a href="#" class="nav-link nav-icon">
              <i class="ri-search-line fs-5"></i>
            </a>

            <!-- USER DROPDOWN -->
            <div class="user-dropdown position-relative">
              <a href="#" class="nav-link nav-icon">
                <i class="ri-user-line fs-5"></i>
              </a>

              <div class="user-menu">

                <!-- GUEST (NOT LOGGED IN) -->
                <?php if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])) { ?>
                  <a href="login.php">Login</a>
                  <a href="register.php">Sign Up</a>
                <?php } ?>

                <!-- NORMAL USER -->
                <?php if(isset($_SESSION['user'])) { ?>
                  <span class="px-3 text-muted small">Hello, <?= $_SESSION['name']; ?></span>
                  <a href="user/my_orders.php">My Orders</a>
                  <a href="user/profile.php">My Profile</a>
                  <a href="user/address.php">My Address</a>
                  <a href="logout.php" class="text-danger">Logout</a>
                <?php } ?>

                <!-- ADMIN -->
                <?php if(isset($_SESSION['admin'])) { ?>
                  <span class="px-3 text-muted small">Admin</span>
                  <a href="Admin_Panal/Dashboard.php">Dashboard</a>
                  <a href="logout.php" class="text-danger">Logout</a>
                <?php } ?>

              </div>
            </div>

            <!-- CART ICON -->
            <a href="#" class="nav-link nav-icon position-relative">
              <i class="ri-shopping-bag-line fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black text-white"
                style="font-size: 0.6rem;">3</span>
            </a>
          </div>

        </div>
      </nav>
  </header>


  <!-- Mobile Offcanvas (Menu) -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title font-serif tracking-widest text-uppercase fw-bold" id="mobileMenuLabel">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <ul class="list-group list-group-flush">
        <li class="list-group-item border-0 p-3"><a href="#"
            class="text-decoration-none text-dark text-uppercase tracking-widest fw-medium d-block">Home</a></li>
        <li class="list-group-item border-0 p-3">
          <a class="text-decoration-none text-dark text-uppercase tracking-widest fw-medium d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" href="#productsCollapse" role="button" aria-expanded="false">
            Products <i class="ri-arrow-down-s-line"></i>
          </a>
          <div class="collapse mt-2" id="productsCollapse">
            <div class="ps-3 border-start border-2 ms-2">
              <a href="#" class="d-block py-2 text-decoration-none text-muted hover-gold">Shop All</a>
              <a href="#" class="d-block py-2 text-decoration-none text-muted hover-gold">70ml Collection</a>
              <a href="#" class="d-block py-2 text-decoration-none text-muted hover-gold">50ml Collection</a>
              <a href="#" class="d-block py-2 text-decoration-none text-muted hover-gold">30ml Collection</a>
              <a href="#" class="d-block py-2 text-decoration-none text-muted hover-gold">Exclusive Attar</a>
            </div>
          </div>
        </li>
        <li class="list-group-item border-0 p-3"><a href="#"
            class="text-decoration-none text-dark text-uppercase tracking-widest fw-medium d-block">Wholesale</a></li>
        <li class="list-group-item border-0 p-3"><a href="#"
            class="text-decoration-none text-dark text-uppercase tracking-widest fw-medium d-block">About Us</a></li>
        <li class="list-group-item border-0 p-3"><a href="#"
            class="text-decoration-none text-dark text-uppercase tracking-widest fw-medium d-block">Contact</a></li>
      </ul>
      <div class="p-4 mt-4 border-top">
        <a href="#" class="btn btn-dark w-100 text-uppercase tracking-widest mb-3 py-2 rounded-0">Sign In</a>
        <a href="#" class="btn btn-outline-dark w-100 text-uppercase tracking-widest py-2 rounded-0">Register</a>
      </div>
    </div>
  </div>

  <!-- Hero Carousel -->
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">
    <div class="carousel-indicators mb-4">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <!-- Slide 1 -->
    <div class="carousel-inner h-100">
      <div class="carousel-item active h-100">
        <img src="https://images.unsplash.com/photo-1615634260167-c8cdede054de?auto=format&fit=crop&w=1920&q=80"
          class="d-block w-100 object-fit-cover" alt="Luxury Perfume">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 pb-0">
          <h2 class="display-3 font-serif mb-3 animate-slide-up" style="animation-delay: 0.2s;">Essence of
            Elegance</h2>
          <p class="text-uppercase tracking-widest mb-5 animate-slide-up"
            style="letter-spacing: 0.2em; animation-delay: 0.4s;">Discover the new summer collection</p>
          <a href="#"
            class="btn btn-light rounded-0 px-5 py-3 text-uppercase tracking-widest animate-slide-up"
            style="font-size: 0.8rem; animation-delay: 0.6s;">Explore Collection</a>
        </div>
        <div class="overlay"></div>
      </div>
      <!-- Slide 2 -->
      <div class="carousel-item h-100">
        <img src="https://images.unsplash.com/photo-1615634260167-c8cdede054de?auto=format&fit=crop&w=1920&q=80"
          class="d-block w-100 object-fit-cover" alt="Luxury Perfume">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 pb-0">
          <h2 class="display-3 font-serif mb-3 opacity-0 animate-slide-up" style="animation-delay: 0.2s;">Timeless
            Luxury</h2>
          <p class="text-uppercase tracking-widest mb-5 opacity-0 animate-slide-up"
            style="letter-spacing: 0.2em; animation-delay: 0.4s;">Crafted for the sophisticated soul</p>
          <a href="#"
            class="btn btn-light rounded-0 px-5 py-3 text-uppercase tracking-widest opacity-0 animate-slide-up"
            style="font-size: 0.8rem; animation-delay: 0.6s;">Explore Collection</a>
        </div>
        <div class="overlay"></div>
      </div>
      <!-- Slide 3 -->
      <div class="carousel-item h-100">
        <img src="https://images.unsplash.com/photo-1587017539504-67cfbddac569?auto=format&fit=crop&w=1920&q=80"
          class="d-block w-100 object-fit-cover" alt="Oud Perfume">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 pb-0">
          <h2 class="display-3 font-serif mb-3 opacity-0 animate-slide-up" style="animation-delay: 0.2s;">Pure Oud</h2>
          <p class="text-uppercase tracking-widest mb-5 opacity-0 animate-slide-up"
            style="letter-spacing: 0.2em; animation-delay: 0.4s;">Experience the depth of tradition</p>
          <a href="#"
            class="btn btn-light rounded-0 px-5 py-3 text-uppercase tracking-widest opacity-0 animate-slide-up"
            style="font-size: 0.8rem; animation-delay: 0.6s;">Explore Collection</a>
        </div>
        <div class="overlay"></div>
      </div>
    </div>
  </div>

  <!-- Categories Section -->
  <section class="py-5 my-5 bg-white">
    <div class="container">
      <div class="text-center mb-5">
        <span class="text-gold text-uppercase tracking-widest fw-semibold d-block mb-2"
          style="font-size: 0.8rem; letter-spacing: 0.2em;">Discover Your Scent</span>
        <h2 class="display-5 font-serif text-dark mb-4">Shop by Category</h2>
        <div class="mx-auto bg-light" style="width: 100px; height: 2px;"></div>
        <p class="text-muted mt-4 mx-auto" style="max-width: 600px;">
          From fresh florals to deep musks, explore our curated selection of fragrances designed to evoke emotion and
          memory.
        </p>
      </div>

      <div class="row g-4">
        <!-- Category 1: Man -->
        <div class="col-md-4">
          <a href="#" class="card category-card text-white border-0 h-100 overflow-hidden shadow-sm">
            <div class="img-wrapper h-100 w-100">
              <img src="https://images.unsplash.com/photo-1594035910387-fea4779426e9?auto=format&fit=crop&w=800&q=80"
                class="card-img h-100 w-100 object-fit-cover" alt="For Him">
            </div>
            <div class="card-img-overlay d-flex flex-column justify-content-end align-items-center text-center p-4">
              <div class="category-content">
                <span class="d-block text-gold text-uppercase tracking-widest mb-2 small category-subtitle">Fougere &
                  Woody</span>
                <h3 class="card-title font-serif h2 mb-4">For Him</h3>
                <span class="btn btn-outline-light rounded-0 text-uppercase tracking-widest btn-sm px-4 py-2">View
                  Collection</span>
              </div>
            </div>
          </a>
        </div>

        <!-- Category 2: Woman -->
        <div class="col-md-4 mt-md-0 mt-4">
          <a href="#" class="card category-card text-white border-0 h-100 overflow-hidden shadow-sm"
            style="transform: translateY(-20px) !important;">
            <!-- Staggered Effect via CSS class or inline for simplicity in Grid -->
            <div class="img-wrapper h-100 w-100">
              <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80"
                class="card-img h-100 w-100 object-fit-cover" alt="For Her">
            </div>
            <div class="card-img-overlay d-flex flex-column justify-content-end align-items-center text-center p-4">
              <div class="category-content">
                <span class="d-block text-gold text-uppercase tracking-widest mb-2 small category-subtitle">Floral &
                  Oriental</span>
                <h3 class="card-title font-serif h2 mb-4">For Her</h3>
                <span class="btn btn-outline-light rounded-0 text-uppercase tracking-widest btn-sm px-4 py-2">View
                  Collection</span>
              </div>
            </div>
          </a>
        </div>

        <!-- Category 3: Unisex -->
        <div class="col-md-4">
          <a href="#" class="card category-card text-white border-0 h-100 overflow-hidden shadow-sm">
            <div class="img-wrapper h-100 w-100">
              <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=800&q=80"
                class="card-img h-100 w-100 object-fit-cover" alt="Unisex">
            </div>
            <div class="card-img-overlay d-flex flex-column justify-content-end align-items-center text-center p-4">
              <div class="category-content">
                <span class="d-block text-gold text-uppercase tracking-widest mb-2 small category-subtitle">Shared &
                  Neutral</span>
                <h3 class="card-title font-serif h2 mb-4">Unisex</h3>
                <span class="btn btn-outline-light rounded-0 text-uppercase tracking-widest btn-sm px-4 py-2">View
                  Collection</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Banner -->
  <section class="position-relative py-5 bg-dark text-white">
    <div class="banner-bg position-absolute inset-0 w-100 h-100"
      style="background-image: url('https://images.unsplash.com/photo-1605651202724-1300977a452f?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; opacity: 0.2; top: 0; left: 0;">
    </div>
    <div class="container position-relative py-5 text-center">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 class="display-4 font-serif mb-4">The Art of Perfumery</h2>
          <p class="lead fw-light text-light mb-5" style="line-height: 1.8;">
            "Perfume is the key to our memories. The scent of a fragrance can take you back to a moment in time, evoke
            an emotion, or simply make you feel beautiful."
          </p>
          <a href="#"
            class="btn btn-outline-light rounded-0 px-5 py-3 text-uppercase tracking-widest hover-bg-white text-hover-dark transition-all">Read
            Our Story</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-primary-dark text-white pt-5 pb-4">
    <div class="container">
      <div class="row g-5 mb-5">
        <!-- Brand -->
        <div class="col-lg-3 col-md-6">
          <div class="font-serif fw-bold text-uppercase h4 mb-4 tracking-widest">Imaani</div>
          <p class="text-secondary small mb-4" style="line-height: 1.8;">
            Crafting scents that tell a story. Experience the essence of luxury with our hand-picked ingredients and
            timeless blends.
          </p>
          <div class="d-flex gap-3">
            <a href="#"
              class="social-icon rounded-circle border border-secondary d-flex align-items-center justify-content-center text-secondary text-decoration-none transition-all">
              <i class="ri-instagram-line"></i>
            </a>
            <a href="#"
              class="social-icon rounded-circle border border-secondary d-flex align-items-center justify-content-center text-secondary text-decoration-none transition-all">
              <i class="ri-facebook-fill"></i>
            </a>
            <a href="#"
              class="social-icon rounded-circle border border-secondary d-flex align-items-center justify-content-center text-secondary text-decoration-none transition-all">
              <i class="ri-twitter-x-line"></i>
            </a>
          </div>
        </div>

        <!-- Collections -->
        <div class="col-lg-3 col-md-6">
          <h5 class="font-serif text-gold mb-4">Collections</h5>
          <ul class="list-unstyled text-secondary small d-flex flex-column gap-2">
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">New
                Arrivals</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Best
                Sellers</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Men's
                Fragrance</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Women's
                Fragrance</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Gift Sets</a>
            </li>
          </ul>
        </div>

        <!-- Customer Care -->
        <div class="col-lg-3 col-md-6">
          <h5 class="font-serif text-gold mb-4">Customer Care</h5>
          <ul class="list-unstyled text-secondary small d-flex flex-column gap-2">
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Contact
                Us</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Shipping
                Policy</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Returns &
                Exchanges</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">FAQ</a></li>
            <li><a href="#" class="text-decoration-none text-secondary hover-text-white transition-colors">Track
                Order</a></li>
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="col-lg-3 col-md-6">
          <h5 class="font-serif text-gold mb-4">Newsletter</h5>
          <p class="text-secondary small mb-3">Subscribe to receive updates, access to exclusive deals, and more.</p>
          <form>
            <div class="mb-3">
              <input type="email" class="form-control bg-dark border-secondary text-white rounded-0 py-2"
                placeholder="Enter your email">
            </div>
            <button type="submit"
              class="btn btn-light w-100 rounded-0 text-uppercase tracking-widest fw-bold text-sm">Subscribe</button>
          </form>
        </div>
      </div>

      <div
        class="border-top border-secondary pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center text-secondary small">
        <p class="mb-2 mb-md-0">&copy; 2024 Imaani Perfumes. All rights reserved.</p>
        <div class="d-flex gap-4">
          <a href="#" class="text-decoration-none text-secondary hover-text-white">Privacy Policy</a>
          <a href="#" class="text-decoration-none text-secondary hover-text-white">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Navbar Scroll Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.getElementById('mainNav');

      function updateNavbar() {
        if (window.scrollY > 50) {
          navbar.classList.add('navbar-scrolled', 'shadow-sm');
        } else {
          navbar.classList.remove('navbar-scrolled', 'shadow-sm');
        }
      }

      window.addEventListener('scroll', updateNavbar);
      updateNavbar(); // Check on load
    });
  </script>
</body>

</html>