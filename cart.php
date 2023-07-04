<?php
session_start();
require_once("config.php");

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id_user'];

    if (isset($_POST['update'])) {
        $cartId = $_POST['id_cart'];
        $quantity = $_POST['quantity'];

        // Perbarui quantity dalam tabel cart
        $query = "UPDATE cart SET quantity = :quantity WHERE id_cart = :id_cart AND id_user = :id_user";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':id_cart', $cartId);
        $stmt->bindParam(':id_user', $userId);
        $stmt->execute();
    }

    if (isset($_POST['delete'])) {
        $cartId = $_POST['id_cart'];

        // Hapus item dari tabel cart
        $query = "DELETE FROM cart WHERE id_cart = :id_cart AND id_user = :id_user";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_cart', $cartId);
        $stmt->bindParam(':id_user', $userId);
        $stmt->execute();
    }

    // Mengambil daftar produk yang ada di keranjang pengguna
    $query = "SELECT cart.*, product.product_name, product.price FROM cart 
              INNER JOIN product ON cart.id_product = product.id_product
              WHERE cart.id_user = :id_user";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_user', $userId);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
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
    <title>Cart - Authentic Store</title>
</head>
<body>
    <!-- Bar Navigasi -->
    <nav class="navbar navbar-expand-lg bg-white shadow-lg">
        <!-- Logo Website -->
        <div class="container">            
            <a class="navbar-brand" href="index.php">
                Authentic Store
            </a>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#product">Product</a>
                    </li>
                    <li class="nav-item active">
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

    <!-- Daftar Produk di Cart -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Keranjangmu</h2>
                <?php if (count($cartItems) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td><?php echo $item['price']; ?></td>
                                        <td>
                                            <form action="" method="POST" class="form-inline">
                                                <input type="hidden" name="id_cart" value="<?php echo $item['id_cart']; ?>">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control" required>
                                                    <div class="input-group-append">
                                                        <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td><?php echo $item['price'] * $item['quantity']; ?></td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id_cart" value="<?php echo $item['id_cart']; ?>">
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p>Masih kosong</p>
                <?php } ?>
            </div>
        </div>

        <?php if (count($cartItems) > 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <!-- ... kode sebelumnya ... -->
            </table>
        </div>
        
        <div class="text-right">
            <form action="" method="POST">
                <button type="submit" name="beli" class="btn btn-primary">Beli</button>
            </form>
        </div>
    <?php } else { ?>
        <p>Pilih barang pada "Product" lalu masukkan ke dalam keranjang</p>
    <?php } ?>
    </div>

    <script src="../auth_store/asset/jquery/jquery-3.6.0.min.js"></script>
    <script src="../auth_store/asset/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['beli'])) {
    // Mendapatkan ID pengguna dari sesi
    $userId = $_SESSION['user']['id_user'];

    // Menghapus semua item di keranjang pengguna dari database
    $query = "DELETE FROM cart WHERE id_user = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    // Menampilkan notifikasi pembelian berhasil
    echo '<div class="alert alert-success mt-4">Barang sudah dibeli.</div>';
}
?>

