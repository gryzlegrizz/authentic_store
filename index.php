<?php
session_start();
require_once("config.php");

// Mendapatkan daftar kategori produk
$query = "SELECT DISTINCT category FROM product";
$stmt = $db->query($query);
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Mengambil data produk berdasarkan kategori
$productsByCategory = [];
foreach ($categories as $category) {
    $query = "SELECT * FROM product WHERE category = :category";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $productsByCategory[$category] = $products;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../auth_store/asset/main.css">
    <link rel="stylesheet" href="../auth_store/asset/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="../auth_store/asset/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../auth_store/asset/bootstrap/tooplate-crispy-kitchen.css">
    <title>Authentic Store</title>
</head>
<body>
    <!-- Bar Navigasi -->
    <nav class="navbar navbar-expand-lg bg-white shadow-lg">

        <!-- Logo Website -->
        <div class="container">            
            <a class="navbar-brand" href="index.html">
                Authentic Store
            </a>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="#product">Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart <i class="bi-cart-check-fill"></i></a>
                    </li>
                </ul>
            </div>

            <div class="d-none d-lg-block">
                <?php if(isset($_SESSION['user'])) { ?>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['user']['username']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a href="signup.php" class="btn btn-primary">User</a>
                <?php } ?>
            </div>



        </div>
    </nav>

    <main>
        <!-- Banner Website -->
        <header class="site-header site-menu-header">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 mx-auto">
                        <h1 class="text-white">Produk kami</h1>

                        <strong class="text-white">Mengembangkan Budaya Indonesia ke Kancah Dunia</strong>
                    </div>

                </div>
            </div>
            <div class="overlay"></div>
        </header>

        <!-- Product List -->
        <?php foreach ($categories as $category) { ?>
            <section id="<?php echo $category; ?>" class="product-list section-padding">
                <div class="container">
                    <h2><?php echo $category; ?></h2>
                    <div class="row">
                        <?php foreach ($productsByCategory[$category] as $product) { ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card mb-4">
                                    <img class="card-img-top" src="<?php echo $product['img_url']; ?>" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Rp.<?php echo $product['price']; ?>,-</h6>
                                        <form action="add_to_cart.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $product['id_product']; ?>">
                                            <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    </main>

    <!-- Footer -->
    <footer class="site-footer section-padding">
            
            <div class="container">
                
                <div class="row">

                    <div class="col-12">
                        <h4 class="text-white mb-4 me-5">Authentic Store</h4>
                    </div>

                    <div class="col-lg-4 col-md-7 col-xs-12 tooplate-mt30">
                        <h6 class="text-white mb-lg-4 mb-3">Lokasi Terkini</h6>

                        <p>Jawa Barat, Kota Bandung, Kecamatan Sukajadi</p>

                        <a href="https://www.google.com/maps/place/Kec.+Sukajadi,+Kota+Bandung,+Jawa+Barat/@-6.8892545,107.5768458,15z/data=!3m1!4b1!4m6!3m5!1s0x2e68e662c0cb8881:0x487870020c4f8b2c!8m2!3d-6.8922842!4d107.5909487!16s%2Fg%2F11b_2mtn5y?entry=ttu" class="custom-btn btn btn-dark mt-2">Lokasi</a>
                    </div>

                    <div class="col-lg-4 col-md-6 col-xs-12 tooplate-mt30">
                        <h6 class="text-white mb-lg-4 mb-3">Sosial Media</h6>

                        <ul class="social-icon">
                            <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                            <<li><a href="https://twitter.com/search?q=tooplate.com&src=typed_query&f=live" target="_blank"
                            	 class="social-icon-link bi-twitter"></a></li>

                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                        </ul>
                    
                        <p class="copyright-text tooplate-mt60">Copyright © 2023 Authentic Store
                        <br> <a rel="nofollow" href="https://www.tooplate.com/" target="_blank"></a></p>
                        
                    </div>

                </div><!-- row ending -->
                
             </div><!-- container ending -->
             
        </footer>
</body>
</html>
