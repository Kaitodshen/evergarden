<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="auth.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="auth-container">
        <form class="auth-form" id="loginForm" autocomplete="off">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            <p><a href="index.php">Beranda</a></p>
        </form>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append("action", "loginprocess");

            fetch("functions.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Berhasil!", data.message, "success").then(() => {
                            if (data.role == 1) {
                                window.location.href = "admin/dashboard.php";
                            } else {
                                window.location.href = "user/dashboard.php";
                            }
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