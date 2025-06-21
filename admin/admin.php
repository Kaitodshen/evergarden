<?php
require '../functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$current_user_id = $_SESSION['user']['id'];
$users = users();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
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
        <h2>Data Admin</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td>
                            <?php if ($user['id'] != $current_user_id): ?>
                                <button class="delete-btn" type="button" onclick="confirmDelete(<?= $user['id'] ?>)">Delete</button>
                            <?php else: ?>
                                <em>Aktif</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin?',
                text: "User akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#999',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append("action", "deleteuser");
                    formData.append("id", id);

                    fetch("functions.php", {
                            method: "POST",
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Berhasil", data.message, "success").then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire("Gagal", data.message, "error");
                            }
                        })
                        .catch(() => {
                            Swal.fire("Error", "Terjadi kesalahan sistem.", "error");
                        });
                }
            });
        }
    </script>
</body>

</html>