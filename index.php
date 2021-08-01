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
                        showError(alertLogin('username atau password tidak sesuai.'));
                    } else if ($error == 2) {
                        showError(alertLogin('Error database. Silahkan hubungi administrator.'));
                    } else if ($error == 3) {
                        showError(alertLogin('Koneksi ke Database gagal. Autentikasi gagal.'));
                    } else if ($error == 4) {
                        showError(alertLogin('Anda tidak boleh mengakses halaman sebelumnya karena belum login.
        Silahkan login terlebih dahulu.'));
                    } else {
                        showError(alertLogin('Unknown Error.'));
                    }
                }
                ?>
                <!-- Alert -->

                <!-- function Alert
                // $color : success, danger, warning, info
                // $Color : Success, Danger, Warning, Info
                // $icon : check-circle, info, exclamation-triangle
                // $message : isi pesan 
                function showMessage($color, $Color, $icon, $message) {
                    echo "<svg xmlns=\"http://www.w3.org/2000/svg\" style=\"display: none;\">
                    <symbol id=\"check-circle-fill\" fill=\"currentColor\" viewBox=\"0 0 16 16\">
                        <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z\" />
                    </symbol>
                    <symbol id=\"info-fill\" fill=\"currentColor\" viewBox=\"0 0 16 16\">
                        <path d=\"M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z\" />
                    </symbol>
                    <symbol id=\"exclamation-triangle-fill\" fill=\"currentColor\" viewBox=\"0 0 16 16\">
                        <path d=\"M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z\" />
                    </symbol>
                </svg>";
                echo "<div class=\"alert alert-$color d-flex align-items-center alert-dismissible fade show\" role=\"alert\">
                    <svg class=\"bi flex-shrink-0 me-2\" width=\"24\" height=\"24\" role=\"img\" aria-label=\"$Color:\">
                        <use xlink:href=\"#$icon-fill\" />
                    </svg>
                    <div>
                        $message
                    </div>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>";
            }
            -->

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