<?php
require '../functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$current_user_id = $_SESSION['user']['id'];
$orders = getOrders($current_user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Saya</title>
    <link rel="stylesheet" href="../main.css">
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
        <h2>Riwayat Order</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>Produk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $index => $order): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $order['date'] ?></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td><?= htmlspecialchars($order['address']) ?></td>
                        <td><?= htmlspecialchars($order['products']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>