<?php
include_once("../../config/functions.php");
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../../index.php?error=4");
}
if (($_SESSION['jabatan'] != 'admin') && ($_SESSION['jabatan'] == 'pelayan')) {
  header("Location: ../../roles/pelayan/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'admin') && ($_SESSION['jabatan'] == 'kasir')) {
  header("Location: ../../roles/kasir/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'admin') && ($_SESSION['jabatan'] == 'koki')) {
  header("Location: ../../roles/koki/dashboard.php?error=1");
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../../css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="../../css/theme.css" type="text/css">
  <link rel="stylesheet" href="../../css/main.css" type="text/css">
  <title>Restokuy</title>
</head>

<body>
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg--four">
      <div class="container-fluid">
        <button class="btn btn-sm" id="btn-sidebar">
          <img src="../../img/hamburger-menu.svg" alt="Menu" class="font-primary">
        </button>
        <div class="d-flex">
          <a href="./../dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
        </div>
        <form method="post">
          <div class="dropdown">
            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../img/icon-profile.svg" alt="profile">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-color" aria-labelledby="dropdownMenuLink">
              <li><span class="dropdown-item-text font-primary fw-normal"><?php echo ucfirst($_SESSION["username"]); ?></span></li>
              <li><a href="../logout.php" class="dropdown-item font-primary fw-normal" name="btn-keluar">Keluar</a></li>
            </ul>
          </div>
        </form>
      </div>
    </nav>
  </header>

  <main class="container-fluid">
    <div class="row">
      <div class="col-2 bg--third side" id="sidebars">
        <ul class="nav flex-column my-3 nav-sidebar">
          <li>
            <a href="./../dashboard.php" class="nav-link font-primary">
              <img src="../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="" class="nav-link disabled"><span class="font-four fw-bold">Master File</span></a>
          </li>
          <li>
            <a href="./pegawai.php" class="nav-link font-primary">
              <img src="../../img/icon-pegawai-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Pegawai</span>
            </a>
          </li>
          <li>
            <a href="../menu/menu.php" class="nav-link font-primary">
              <img src="../../img/icon-menu-sidebar.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Menu</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col m-5">
        <h2 class="font-primary">Edit Data Pegawai</h2>
        <a href="./pegawai.php" class="btn font-btn bg--third font-white my-4">Pegawai</a>
        <!-- Alert -->
        <?php updateDataPegawai(); ?>

        <!-- Form Ubah Data Pegawai -->
        <?php
        if (isset($_GET["id_pegawai"]) && isset($_GET["id_akun"])) {
          $db = dbConnect();
          $id_pegawai = $db->escape_string($_GET["id_pegawai"]);
          $id_akun = $db->escape_string($_GET["id_akun"]);
          if ($dataPegawai = getDataPegawai($id_pegawai, $id_akun)) { // cari data merk, kalau ada simpan di $data
        ?>
            <form method="post" action="">
              <input type="hidden" name="id_akun" value="<?php echo $dataPegawai['id_akun']; ?>">
              <input type="hidden" name="id_pegawai" value="<?php echo $dataPegawai['id_pegawai']; ?>">
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleName" class="form-label">Nama Lengkap</label>
                </div>
                <div class="col">
                  <input value="<?php echo $dataPegawai["nama_pegawai"]; ?>" type="text" class="form-control" id="exampleName" name="nama_pegawai" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleTempat" class="form-label">Tempat</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $dataPegawai["tempat_lahir"]; ?>" type="text" class="form-control" id="exampleTempat" name="tempat_lahir" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleTanggalLahir" class="form-label">Tanggal Lahir</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $dataPegawai["tgl_lahir"]; ?>" type="Date" class="form-control" id="exampleTanggalLahir" name="tgl_lahir" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleTanggalLahir" class="form-label">Nomor Handphone</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $dataPegawai["no_hp"]; ?>" type="text" class="form-control" id="exampleNoHp" name="no_hp" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleAlamat" class="form-label">Alamat</label>
                </div>
                <div class="col">
                  <textarea class="form-control" id="exampleAlamat" cols="1" rows="3" name="alamat" required><?php echo $dataPegawai["alamat"]; ?></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleJabatan" class="form-label">Jabatan</label>
                </div>
                <div class="col-auto">
                  <select class="form-select" name="jabatan" id="exampleJabatan" required>
                    <option disabled>~ Pilih Jabatan ~</option>
                    <?php
                    $jabatan = ["pelayan", "kasir", "koki"];
                    foreach ($jabatan as $data) {
                      echo "<option value=\"" . ucfirst($data) . "\"";
                      if ($data == $dataPegawai["jabatan"])
                        echo " selected"; // default sesuai kategori sebelumnya
                      echo ">" . ucfirst($data) . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="exampleUsername" class="form-label">Username</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $dataPegawai["username"]; ?>" type="text" class="form-control" id="exampleUsername" name="username" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label for="examplePassword" class="form-label">Password</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $dataPegawai["password"]; ?>" type="password" class="form-control" id="examplePassword" name="password" required>
                </div>
              </div>
              <button type="submit" class="btn font-btn bg--primary font-white me-2" name="btn_edit">Simpan</button>
              <button refresh class="btn font-btn bg--four font-white">Reset</button>
            </form>
          <?php
          } else
            echo "Akun dengan Id : $id_pegawai dan $id_akun tidak ada. Pengeditan dibatalkan";
          ?>
        <?php
        } else
          echo "id_pegawai dan id_akun tidak ada. Pengeditan dibatalkan.";
        ?>

      </div>
    </div>
  </main>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="./../../js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    // $('#btn-sidebar').click(function () {
    //   $('#sidebar').hide();
    // })
    document.getElementById('btn-sidebar').addEventListener('click', function() {
      document.getElementById('sidebars').classList.toggle('side');
    })
  </script>
</body>

</html>