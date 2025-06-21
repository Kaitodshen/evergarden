<?php
require_once '../functions.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$products = products();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <link rel="stylesheet" href="../main.css">

    <style>
        .add-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            position: relative;
        }

        .modal-content input,
        .modal-content button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 8px;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <nav class="navbar">
        <div class="logo"><img src="../img/evergarden_logo.png" alt=""></div>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="../logout.php" style="color: red;">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Galeri Produk</h2>
        <button class="add-btn" onclick="openModal()">+ Tambah Produk</button>

        <div id="addProductModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Tambah Produk</h3>
                <form id="addProductForm" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="text" name="name" placeholder="Nama Produk" required>
                    <input type="number" name="price" placeholder="Harga" required>
                    <input type="file" name="image" accept="image/*" required>
                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>

        <div class="product-grid">
            <?php
            // Menampilkan produk
            if ($products) {
                foreach ($products as $product) {
                    echo '<div class="product-card">';
                    echo '<img src="../uploads/' . $product['image'] . '" alt="' . htmlspecialchars($product['name']) . '">';
                    echo '<h4>' . htmlspecialchars($product['name']) . '</h4>';
                    echo '<p>Rp ' . number_format($product['price'], 0, ',', '.') . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Produk tidak ditemukan.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() {
            document.getElementById('addProductModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('addProductModal')) {
                closeModal();
            }
        }

        document.getElementById("addProductForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            formData.append("action", "addproduct");

            fetch("../functions.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Berhasil!", data.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Gagal", data.message, "error");
                    }
                })
                .catch(() => {
                    Swal.fire("Error", "Terjadi kesalahan sistem.", "error");
                });
        });
    </script>

</body>

</html>