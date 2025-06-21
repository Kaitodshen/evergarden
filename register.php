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
    <title>Register</title>
    <link rel="stylesheet" href="auth.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="auth-container">
        <form class="auth-form" id="registerForm" autocomplete="off">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" autocomplete="off">
            <input type="password" name="password" placeholder="Password" autocomplete="new-password">
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" autocomplete="new-password">
            <button type="submit">Register</button>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            formData.append("action", "registerprocess");

            fetch("functions.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Berhasil!", data.message, "success").then(() => {
                            window.location.href = "login.php";
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