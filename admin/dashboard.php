<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../main.css">
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
        <h1>Hello, <?= htmlspecialchars($user['username']) ?>!</h1>
        <p>Wellcome To EVERGARDEN Dashboard.</p>
        <a class="logout-link" href="../logout.php">Logout</a>
    </div>
</body>

</html>