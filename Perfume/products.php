<?php
session_start();
include "db/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .product-img {
            height: 280px;
            object-fit: cover;
        }

        .quick-view-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: all .3s ease;
        }

        .product-card:hover .quick-view-btn {
            opacity: 1;
            transform: translateX(-50%) translateY(-250px);
        }

    </style>
</head>

<body>

 <!-- OPTIONAL: If you have a header -->

<div class="container py-5">
    <h2 class="text-center mb-4">Our Products</h2>

    <div class="row g-4">

        <?php
        $query = "SELECT * FROM products WHERE stock_status='available' ORDER BY product_id DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                ?>

            <div class="col-md-3 col-sm-6">
                <div class="card product-card position-relative">

                    <!-- Product Image -->
                    <img src="uploads/<?php echo $product['image']; ?>" 
                        class="card-img-top product-img" 
                        alt="<?php echo $product['name']; ?>">

                    <!-- QUICK VIEW BUTTON (HOVER EFFECT) -->
                    <button class="quick-view-btn btn btn-outline-dark px-3 py-2"
                            data-bs-toggle="modal" 
                            data-bs-target="#quickView<?php echo $product['product_id']; ?>">
                        Quick View
                    </button>

                    <div class="card-body text-center">

                        <h5 class="card-title mb-1"><?php echo $product['name']; ?></h5>

                        <p class="text-muted small" style="height: 40px; overflow: hidden;">
                            <?php echo $product['description']; ?>
                        </p>

                        <p class="fw-bold text-dark mb-3">₹<?php echo $product['price']; ?></p>

                        <div class=" gap-2">

                            <a href="add_to_cart.php?id=<?php echo $product['product_id']; ?>" 
                            class="btn btn-outline-dark w-100 mb-2">
                                Add to Cart
                            </a>

                            <a href="buy_now.php?id=<?php echo $product['product_id']; ?>" 
                            class="btn btn-dark w-100">
                                Buy Now
                            </a>

                        </div>
                    </div>

                </div>
            </div>
       <!-- QUICK VIEW MODAL -->
        <div class="modal fade" id="quickView<?php echo $product['product_id']; ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?php echo $product['name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row">

                <!-- IMAGE -->
                <div class="col-md-6">
                    <img src="uploads/<?php echo $product['image']; ?>" class="img-fluid rounded">
                </div>

                <!-- DETAILS -->
                <div class="col-md-6">
                    
                    <h4 class="mb-2"><?php echo $product['name']; ?></h4>

                    <h5 class="text-dark fw-bold mb-3">
                    ₹<?php echo $product['price']; ?>
                    </h5>

                    <p><?php echo $product['description']; ?></p>

                    <div class=" gap-2 mt-3">
                    <a href="add_to_cart.php?id=<?php echo $product['product_id']; ?>" 
                        class="btn btn-outline-dark w-100 mb-2">
                        Add to Cart
                    </a>

                    <a href="buy_now.php?id=<?php echo $product['product_id']; ?>" 
                        class="btn btn-dark w-100">
                        Buy Now
                    </a>
                    </div>

                </div>

                </div>

            </div>

            </div>
        </div>
        </div>



        <?php
            }
        } else {
            echo "<h4 class='text-center text-muted'>No Products Available</h4>";
        }
        ?>

 

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
