<?php
require_once '../functions.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$products = products();
$current_user_id = $_SESSION['user']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .product-card img {
            max-width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-card input[type="checkbox"] {
            display: none;
        }

        .product-card.selected {
            border-color: #28a745;
            background-color: #eaffea;
        }

        .add-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container {
            padding: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo"><img src="../img/evergarden_logo.png" alt=""></div>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="order.php">Order</a></li>
            <li><a href="../logout.php" style="color: red;">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Galeri Produk</h2>
        <button class="add-btn" onclick="submitCart()">Keranjang</button>

        <div class="product-grid">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card" data-id="<?= $product['id'] ?>">
                        <input type="checkbox" name="cart[]" value="<?= $product['id'] ?>">
                        <img src="../uploads/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <h4><?= htmlspecialchars($product['name']) ?></h4>
                        <p>Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p>Produk tidak ditemukan.</p>
            <?php endif ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', () => {
                card.classList.toggle('selected');
                const checkbox = card.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            });
        });

        function submitCart() {
            const checked = document.querySelectorAll('input[name="cart[]"]:checked');
            if (checked.length === 0) {
                Swal.fire("Keranjang Kosong", "Silakan pilih minimal satu produk.", "warning");
                return;
            }

            const selectedIds = Array.from(checked).map(cb => cb.value);

            const form = document.createElement('form');
            form.method = 'GET';
            form.action = 'cart.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'products';
            input.value = JSON.stringify(selectedIds);
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    </script>


</body>

</html>