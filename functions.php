<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'evergarden');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'registerprocess') {
    header('Content-Type: application/json');

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    $role = 2;

    if ($username === '' || $password === '' || $confirm === '') {
        echo json_encode(["success" => false, "message" => "Semua field harus diisi."]);
        exit;
    }

    if ($password !== $confirm) {
        echo json_encode(["success" => false, "message" => "Konfirmasi password tidak cocok."]);
        exit;
    }

    $check = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(["success" => false, "message" => "Username sudah terdaftar."]);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username', '$hash', '$role')");

    if ($insert) {
        echo json_encode(["success" => true, "message" => "Registrasi berhasil!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data."]);
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'loginprocess') {
    header('Content-Type: application/json');

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        echo json_encode(["success" => false, "message" => "Semua field harus diisi."]);
        exit;
    }

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        echo json_encode(["success" => true, "message" => "Login berhasil!", 'role' => $user['role']]);
    } else {
        echo json_encode(["success" => false, "message" => "Username atau password salah."]);
    }

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'deleteuser') {
    header('Content-Type: application/json');

    $id = (int) ($_POST['id'] ?? 0);

    $current_user_id = $_SESSION['user']['id'] ?? 0;

    if ($id === $current_user_id) {
        echo json_encode(["success" => false, "message" => "Kamu tidak bisa menghapus akunmu sendiri."]);
        exit;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($success) {
        echo json_encode(["success" => true, "message" => "User berhasil dihapus."]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menghapus user."]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'addproduct') {
    header('Content-Type: application/json');

    $name  = trim($_POST['name'] ?? '');
    $price = (int) ($_POST['price'] ?? 0);
    $image = $_FILES['image'] ?? null;

    if ($name === '' || $price <= 0 || !$image) {
        echo json_encode(["success" => false, "message" => "Semua field wajib diisi."]);
        exit;
    }

    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_ext)) {
        echo json_encode(["success" => false, "message" => "Format gambar tidak didukung."]);
        exit;
    }

    $filename = uniqid("produk_") . '.' . $ext;
    $target_path = "uploads/" . $filename;

    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (!move_uploaded_file($image['tmp_name'], $target_path)) {
        echo json_encode(["success" => false, "message" => "Gagal mengunggah gambar."]);
        exit;
    }

    $name = mysqli_real_escape_string($conn, $name);
    $query = "INSERT INTO product (name, price, image) VALUES ('$name', $price, '$filename')";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["success" => true, "message" => "Produk berhasil ditambahkan."]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan produk."]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'neworder') {
    header('Content-Type: application/json');

    if (!isset($_POST['products']) || !isset($_POST['address'])) {
        echo json_encode(['success' => false, 'message' => 'Data produk atau alamat tidak valid.']);
        exit;
    }

    $productsString = $_POST['products'];
    $productsString = trim($productsString, '[]"');
    $productIds = explode(',', $productsString);
    $productIds = array_map(function ($id) {
        return intval(trim($id, '"'));
    }, $productIds);
    $address = $_POST['address'];
    $userId = $_SESSION['user']['id'];
    $orderDetails = [];
    $totalPrice = 0;

    foreach ($productIds as $productId) {
        $productId = intval($productId);

        $query = mysqli_query($conn, "SELECT price FROM product WHERE id = $productId");
        $data = mysqli_fetch_assoc($query);

        if ($data) {
            $productPrice = $data['price'];
            $totalPrice += $productPrice;

            $orderDetails[] = [
                'product_id' => $productId
            ];
        }
    }
    mysqli_begin_transaction($conn);

    try {
        $query = "INSERT INTO `order` (user_id, total_price, address, date) 
                  VALUES ('" . intval($userId) . "', '" . intval($totalPrice) . "', '" . mysqli_real_escape_string($conn, $address) . "', NOW())";
        if (!mysqli_query($conn, $query)) {
            throw new Exception('Gagal membuat pesanan.');
        }

        $orderId = mysqli_insert_id($conn);

        foreach ($orderDetails as $orderDetail) {
            $query = "INSERT INTO order_detail (order_id, product_id) 
                      VALUES ('" . intval($orderId) . "', '" . intval($orderDetail['product_id']) . "')";
            if (!mysqli_query($conn, $query)) {
                throw new Exception('Gagal memasukkan detail pesanan.');
            }
        }

        mysqli_commit($conn);

        echo json_encode(['success' => true, 'message' => 'Pesanan berhasil dibuat.']);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    exit;
}

function users()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT id, username FROM user ORDER BY id ASC");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function products()
{
    global $conn;
    $query = "SELECT * FROM product ORDER BY id ASC";
    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $products;
}

function getOrders($userId)
{
    global $conn;
    $orders = [];

    $query = "SELECT o.id, o.date, o.address, o.user_id, u.username 
              FROM `order` o 
              JOIN user u ON o.user_id = u.id 
              WHERE o.user_id = " . intval($userId) . " 
              ORDER BY o.date DESC";
    $result = mysqli_query($conn, $query);

    while ($order = mysqli_fetch_assoc($result)) {
        $orderId = $order['id'];

        $productsQuery = "SELECT p.name 
                          FROM order_detail od 
                          JOIN product p ON od.product_id = p.id 
                          WHERE od.order_id = $orderId";
        $productsResult = mysqli_query($conn, $productsQuery);

        $productNames = [];
        while ($prod = mysqli_fetch_assoc($productsResult)) {
            $productNames[] = $prod['name'];
        }

        $order['products'] = implode(', ', $productNames);
        $orders[] = $order;
    }

    return $orders;
}
