<?php
require_once '../functions.php';

if (!isset($_GET['products'])) {
    echo "Keranjang kosong atau akses tidak valid.";
    exit;
}

$productIds = json_decode($_GET['products'], true);

if (!$productIds || !is_array($productIds)) {
    echo "Data produk tidak valid.";
    exit;
}

$ids = array_map('intval', $productIds);
$idList = implode(',', $ids);
$query = "SELECT * FROM product WHERE id IN ($idList)";
$result = mysqli_query($conn, $query);

$products = [];
$totalPrice = 0; // Initialize total price

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    $totalPrice += $row['price']; // Add product price to total
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .add-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
        }

        .product-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
        }

        .total-price {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }

        .payment-info {
            margin-top: 20px;
            font-size: 16px;
        }

        .address-input {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .pay-btn {
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #e75480;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .pay-btn:hover {
            background-color: rgb(235, 65, 116);
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo"><img src="../img/evergarden_logo.png" alt=""></div>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="../logout.php" style="color: red;">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Keranjang Produk</h2>
        <a class="add-btn" href="product.php">Kembali</a>

        <div class="product-grid">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="../uploads/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <h4><?= htmlspecialchars($product['name']) ?></h4>
                        <p>Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p>Tidak ada produk ditemukan.</p>
            <?php endif ?>
        </div>

        <div class="total-price">
            <p>Total Harga: Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
        </div>

        <div class="payment-info">
            <p>Transfer ke Rekening BCA: 00000000 atas nama Evergarden</p>
            <p>Setelah melakukan pembayaran, kirimkan bukti pembayaran ke WhatsApp: <a href="https://wa.me/6281812344321">081812344321</a></p>
        </div>

        <!-- Input Alamat -->
        <div>
            <label for="address">Alamat Pengiriman:</label>
            <textarea id="address" class="address-input" rows="4" placeholder="Masukkan alamat pengiriman"></textarea>
        </div>

        <!-- Bayar Button -->
        <button class="pay-btn" onclick="submitPayment()">Kirim</button>
    </div>

    <script>
        function submitPayment() {
            const address = document.getElementById('address').value.trim();

            if (!address) {
                Swal.fire("Alamat Kosong", "Harap masukkan alamat pengiriman.", "warning");
                return;
            }

            const productIds = <?= json_encode($productIds); ?>;
            const totalPrice = <?= $totalPrice; ?>;
            const userId = <?php echo $_SESSION['user']['id']; ?>;

            const formData = new FormData();
            formData.append("action", "process_payment");
            formData.append("user_id", userId);
            formData.append("products", JSON.stringify(productIds));
            formData.append("total_price", totalPrice);
            formData.append("address", address);
            formData.append("action", 'neworder');

            fetch("../functions.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Pembayaran Berhasil", data.message, "success").then(() => {
                            window.location.href = "product.php";
                        });
                    } else {
                        Swal.fire("Gagal", data.message, "error");
                    }
                })
                .catch(() => {
                    Swal.fire("Error", "Terjadi kesalahan saat mengirim data.", "error");
                });
        }
    </script>

</body>

</html>