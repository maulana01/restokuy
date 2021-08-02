<?php
include_once("../../config/functions.php");
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../../index.php?error=4");
}
if (($_SESSION['jabatan'] != 'koki') && ($_SESSION['jabatan'] == 'admin')) {
  header("Location: ../../admin/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'koki') && ($_SESSION['jabatan'] == 'kasir')) {
  header("Location: ../kasir/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'koki') && ($_SESSION['jabatan'] == 'pelayan')) {
  header("Location: ../pelayan/dashboard.php?error=1");
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="./../../css/bootstrap.min.css">
  <link rel="stylesheet" href="./../../css/theme.css" type="text/css">
  <link rel="stylesheet" href="./../../css/main.css" type="text/css">
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
          <a href="dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
        </div>
        <form method="post">
          <div class="dropdown">
            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../img/icon-profile.svg" alt="profile">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-color" aria-labelledby="dropdownMenuLink">
              <li><span class="dropdown-item-text font-primary fw-normal"><?php echo ucfirst($_SESSION["username"]); ?></span></li>
              <li><a href="logout.php" class="dropdown-item font-primary fw-normal" name="btn-keluar">Keluar</a>
              </li>
            </ul>
          </div>
        </form>
      </div>
    </nav>
  </header>

  <main class="container-fluid">
    <div class="row">
      <div class="col-2 bg--third side" id="sidebars">
        <ul class="nav flex-column my-3 nav-sidebar position-fixed">
          <li>
            <a href="./dashboard.php" class="nav-link font-primary">
              <img src="./../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="./pemesanan.php" class="nav-link font-primary">
              <img src="./../../img/icon-pemesanan.svg" alt="Dashboard" class="pb-2">
              <span class="fw-bold"> Pemesanan</span>
            </a>
          </li>
          <li>
            <a href="./cek-menu.php" class="nav-link font-primary">
              <img src="./../../img/icon-ketersediaan-menu.svg" alt="Dashboard" class="pb-2">
              <span class="fw-bold">Cek Menu</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="col m-5">
        <h2 class="font-primary">Informasi Ketersediaan Menu</h2>
        <a href="dashboard.php" class="btn btn-sm bg--four font-btn font-white mt-3 mb-3">DASHBOARD</a>
        <!-- Alert -->
        <?php ubahStatusKetersediaanMenu(); ?>

        <!-- List Menu -->
        <?php $data = getListMenuTersediaDanTidakTersedia(); ?>
        <table class="mt-3 table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>ID Menu</th>
              <th>Nama Menu</th>
              <th>Kategori Menu</th>
              <th>Jenis Menu</th>
              <th>Harga Menu</th>
              <th>Gambar Menu</th>
              <th>Status Menu</th>
              <th colspan="2" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Foreach -->
            <?php
            $nomkn = 1;
            $nomnn = 1;
            foreach ($data as $datamenu) {
            ?>
              <tr>
                <?php
                if ($datamenu['kategori_menu'] == 'makanan') {
                  $idmenu = 'MKN00' . $nomkn++;
                } else if ($datamenu['kategori_menu'] == 'minuman') {
                  $idmenu = 'MNN00' . $nomnn++;
                }
                ?>
                <td><?php echo $idmenu; ?></td>
                <td><?php echo $datamenu['nama_menu']; ?></td>
                <td><?php echo ucfirst($datamenu['kategori_menu']); ?></td>
                <td><?php echo ucfirst($datamenu['jenis_menu']); ?></td>
                <td><?php echo $datamenu['harga_menu']; ?></td>
                <td><?php echo '<img width="250" src="data:image/jpeg;base64,' . base64_encode($datamenu['gambar_menu']) . '"/>'; ?></td>
                <td><?php echo ucfirst($datamenu['status']); ?></td>
                <td class="text-center">
                  <button class="btn btn-sm bg--four font-btn font-white" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $datamenu['id_menu']; ?>"><?php echo ($datamenu['status'] == 'tersedia') ? 'Tidak Tersedia' : 'Tersedia'; ?></button>
                </td>
              </tr>
              <!-- Modal -->
              <form action="" method="post">
                <div class="modal fade" id="hapusModal<?= $datamenu['id_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <input type="hidden" name="id_menu" value="<?= $datamenu['id_menu']; ?>">
                  <input type="hidden" name="status" value="<?= ($datamenu['status'] == 'tersedia') ? 'tidak tersedia' : 'tersedia'; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <img src="../../img/question-circle-fill.svg" alt="question">
                        <h5 class="modal-title ms-2" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Merubah Status Ketersediaan Menu?</p>
                      </div>
                      <div class="modal-footer">
                        <button name="ubahStatusKetersediaanMenu" type="submit" class="btn btn-font bg--primary font-white" data-bs-dismiss="modal">Ya</button>
                        <button type="button" class="btn btn-font bg--four font-white" data-bs-dismiss="modal">Tidak</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </main>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="./../../js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
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