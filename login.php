<?php include_once("./config/functions.php"); ?>
<?php
$db = dbConnect();
if ($db->connect_errno == 0) {
    if (isset($_POST["BtnLogin"])) {
        $username = $db->escape_string($_POST["username"]);
        $password = $db->escape_string($_POST["password"]);
        $sql = "SELECT a.id_akun as id_akun, a.username as username, p.jabatan as jabatan, p.id_pegawai as id_pegawai FROM akun a
                JOIN pegawai p on a.id_akun = p.id_akun
                WHERE username='$username' AND password='$password'";
        $res = $db->query($sql);
        if ($res) {
            if ($res->num_rows == 1) {
                $data = $res->fetch_assoc();
                echo $data;
                session_start();
                if ($_SESSION['jabatan'] = $data['jabatan'] == "admin") {
                    $_SESSION["id_pegawai"] = $data["id_pegawai"];
                    $_SESSION["id_akun"] = $data["id_akun"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["jabatan"] = $data["jabatan"];
                    header("location: ./admin/dashboard.php");
                } else if ($_SESSION['jabatan'] = $data['jabatan'] == "pelayan") {
                    $_SESSION["id_pegawai"] = $data["id_pegawai"];
                    $_SESSION["id_akun"] = $data["id_akun"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["jabatan"] = $data["jabatan"];
                    header("location: ./roles/pelayan/dashboard.php");
                } else if ($_SESSION['jabatan'] = $data['jabatan'] == "koki") {
                    $_SESSION["id_pegawai"] = $data["id_pegawai"];
                    $_SESSION["id_akun"] = $data["id_akun"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["jabatan"] = $data["jabatan"];
                    header("location: ./roles/koki/dashboard.php");
                } else if ($_SESSION['jabatan'] = $data['jabatan'] == "kasir") {
                    $_SESSION["id_pegawai"] = $data["id_pegawai"];
                    $_SESSION["id_akun"] = $data["id_akun"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["jabatan"] = $data["jabatan"];
                    header("location: ./roles/kasir/dashboard.php");
                }
            } else
                header("Location: index.php?error=1");
        }
    } else
        header("Location: index.php?error=2");
} else
    header("Location: index.php?error=3");
?>


<!-- $sql = "SELECT a.id_akun, a.username, p.jabatan as jabatan FROM akun a
					JOIN pegawai p on a.id_akun = p.id_akun
				  WHERE a.username='$username' and password='$password')"; -->