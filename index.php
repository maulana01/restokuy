<?php
include_once('./config/functions.php');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/theme.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Restokuy</title>
</head>

<body class="login">
    <div class="login-page">
        <!-- <div class="container-fluid"> -->
        <div class="card position-absolute top-50 start-50 translate-middle col-4">
            <div class="card-body p-4">
                <h1 class="card-title text-center mb-4">LOGIN</h1>
                <?php
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];
                    if ($error == 1) {
                        alertGagal('Username atau Password tidak sesuai.');
                    } else if ($error == 2) {
                        alertGagal('Error database. Silahkan hubungi administrator.');
                    } else if ($error == 3) {
                        alertGagal('Koneksi ke Database gagal. Autentikasi gagal.');
                    } else if ($error == 4) {
                        alertGagal('Anda tidak boleh mengakses halaman sebelumnya karena belum login.
                        <br>Silahkan login terlebih dahulu.');
                    } else {
                        alertGagal('Unknown Error.');
                    }
                }
                ?>
                <form method="post" action="login.php" name="frm">
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Username</label>
                        <input type="username" class="form-control" name="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="d-grid justify-content-center">
                        <button type="submit" class="btn btn-large bg--primary" name="BtnLogin" value="Login"><span class="font-btn font-white">Login</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src=" ./js/bootstrap.bundle.min.js"></script>

</body>

</html>