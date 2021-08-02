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
        <ul class="nav flex-column my-3 nav-sidebar position-fixed">
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
      <div class="col m-4">
        <h2 class="font-primary">Informasi Pegawai</h2>
        <a href="./pegawai-tambah.php" class="btn font-btn bg--third font-white my-4">Tambah</a>
        <!-- Alert -->
        <?php hapusDataPegawai(); ?>

        <!-- List Pegawai -->
        <?php $data = getListPegawai(); ?>
        <table class="table table-bordered table-hover table-sm">
          <thead class="table-light">
            <tr>
              <th>ID Pegawai</th>
              <th>Nama</th>
              <th>Tempat, Tanggal Lahir</th>
              <th>Nomor Telepon</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Username</th>
              <th colspan="2" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <!-- Foreach -->
            <?php
            $no = 1;
            foreach (array_slice($data, $no) as $datapegawai) {
            ?>
              <tr>
                <td><?php echo 'P000' . $no++; ?></td>
                <td><?php echo $datapegawai['nama_pegawai']; ?></td>
                <td><?php echo $datapegawai['tempat_lahir'] . ', ' . $datapegawai['tgl_lahir']; ?></td>
                <td><?php echo $datapegawai['no_hp']; ?></td>
                <td><?php echo $datapegawai['alamat']; ?></td>
                <td><?php echo $datapegawai['jabatan']; ?></td>
                <td><?php echo $datapegawai['username']; ?></td>
                <td class="text-center">
                  <a href="./pegawai-edit.php?id_pegawai=<?php echo $datapegawai['id_pegawai']; ?>&id_akun=<?php echo $datapegawai['id_akun']; ?>" class="btn btn-sm bg--four font-btn font-white">Edit</a>
                  <button class="btn btn-sm bg--primary font-btn font-white" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $datapegawai['id_akun']; ?>">Hapus</button>
                </td>
              </tr>
              <!-- Modal -->
              <form action="" method="post">
                <div class="modal fade" id="hapusModal<?= $datapegawai['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <input type="hidden" name="id_akun" value="<?= $datapegawai['id_akun']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <img src="../../img/question-circle-fill.svg" alt="question">
                        <h5 class="modal-title ms-2" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus ?</p>
                      </div>
                      <div class="modal-footer">
                        <button name="hapusPegawai" type="submit" class="btn btn-font bg--primary font-white" data-bs-dismiss="modal">Ya</button>
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