<?php
include_once("../../../config/functions.php");
session_start();
$pegawai_id = $_SESSION['id_pegawai'];
if (!isset($_SESSION["username"])) {
  header("Location: ../../../index.php?error=4");
}
if (($_SESSION['jabatan'] != 'pelayan') && ($_SESSION['jabatan'] == 'admin')) {
  header("Location: ../../../admin/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'pelayan') && ($_SESSION['jabatan'] == 'kasir')) {
  header("Location: ../../kasir/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'pelayan') && ($_SESSION['jabatan'] == 'koki')) {
  header("Location: ../../koki/dashboard.php?error=1");
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
  <!-- <link rel="stylesheet" href="./../../../css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="./../../../css/theme.css" type="text/css">
  <link rel="stylesheet" href="./../../../css/main.css" type="text/css">
  <title>Restokuy</title>
</head>

<body>
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg--four">
      <div class="container-fluid">
        <button class="btn btn-sm" id="btn-sidebar">
          <img src="../../../img/hamburger-menu.svg" alt="Menu" class="font-primary">
        </button>
        <div class="d-flex">
          <a href="./../dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
        </div>
        <form method="post">
          <div class="dropdown">
            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../../img/icon-profile.svg" alt="profile">
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
              <img src="./../../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="./pesanan.php" class="nav-link font-primary">
              <img src="./../../../img/icon-pemesanan-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Pesanan</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col m-4">
        <h2 class="font-primary">Informasi Pesanan</h2>
        <a href="./pesanan.php" class="btn font-btn bg--third font-white my-4">Pesanan</a>
        <?php tambahPesanan(); ?>
        <!-- Alert -->

        <?php $nopesanan = getNoPesanan(); ?>
        <div class="row">
          <div class="col-5">
            <form method="post" action="">
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleNoPesanan" class="form-label">No Pesanan</label>
                </div>
                <div class="col-auto">
                  <input value="<?php echo $nopesanan; ?>" type="text" class="form-control" id="exampleNoPesanan" name="id_pegawai" required readonly>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleTanggalLahir" class="form-label">Tanggal</label>
                </div>
                <div class="col-auto">
                  <input type="date" class="form-control" id="exampleTanggalLahir" name="tgl" value="<?php echo date('Y-m-d'); ?>" required readonly>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleNoMeja" class="form-label">No Meja</label>
                </div>
                <div class="col-auto">
                  <input type="text" class="form-control" id="exampleNoMeja" name="no_meja">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <table class="table table-hover table-borderless">
                    <thead class="table-light">
                      <tr>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th colspan="2" class="text-center">Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Foreach -->
                      <?php tambahDetailPesanan(); ?>
                      <?php hapusDetailPesanan(); ?>
                      <!-- Foreach -->
                      <?php $data = tampilDetailPesananTerbaru(); ?>
                      <?php foreach ($data as $datadetailpesanan) { ?>
                        <tr>
                          <td><?php echo $datadetailpesanan['nama_menu']; ?></td>
                          <td>
                            <input class="form-control form-control-sm" type="number" value="0" min="0" max="100" style="width: 5em;" id="jumlah<?= $datadetailpesanan['id_menu'];; ?>" onchange="return operasi()" autofocus>
                          </td>
                          <td class="text-end">
                            <form action="" method="post">
                              <input type="text" class="form-control form-control-sm fs-5" readonly value="<?= $datadetailpesanan['no_pesanan']; ?>" name="no_pesanan" hidden>
                              <input type="text" class="form-control form-control-sm fs-5" readonly value="<?= $datadetailpesanan['id_menu']; ?>" name="id_menu" hidden>
                              <input type="text" class="form-control form-control-sm fs-5" readonly value="<?= $pegawai_id; ?>" name="id_pegawai" hidden>

                              <input type="text" class="form-control form-control-sm fs-5" readonly value="<?= $datadetailpesanan['harga_menu']; ?>" id="harga<?= $datadetailpesanan['id_menu']; ?>" hidden>

                              <span id="hargaMenu<?= $datadetailpesanan['id_menu']; ?>">0</span>

                              <button name="hapus_list_pesanan" class="btn btn-sm font-btn bg--secondary font-white">hapus</button>
                            </form>
                          </td>
                        </tr>
                      <?php } ?>
                      <!-- Batas -->
                    </tbody>
                    <tfoot class="table-light">
                      <tr>
                        <td>Total</td>
                        <td colspan="2" class="text-end">
                          <input type="text" class="form-control-plaintext form-control-sm text-end fs-5" readonly id="total" value="0">
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <button type="submit" class="btn font-btn bg--primary font-white" name="btn_tambah">Tambah</button>
            </form>
          </div>
          <div class="col border border-3 rounded overflow-auto" style="height: 400px;">
            <div class="row row-cols-2 gy-3 py-3">
              <!-- List Pegawai -->
              <?php $data = getListMenu(); ?>

              <?php
              foreach ($data as $datamenu) {
              ?>
                <div class="col-6 mx-auto">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-auto">
                          <h5 class="card-title"><?php echo $datamenu['nama_menu']; ?></h5>
                          <p class="card-text">Rp. <?php echo $datamenu['harga_menu']; ?></p>
                          <!-- <h6 class="card-subtitle mb-2 text-muted">Stok 100</h6> -->
                        </div>
                        <div class="col d-flex justify-content-end align-items-center">
                          <form action="" method="post">
                            <input type="hidden" name="no_pesanan" value="<?php echo $nopesanan; ?>">
                            <input type="hidden" name="id_menu" value="<?php echo $datamenu['id_menu']; ?>">
                            <button name="btn_tambah_menu" type="submit" class="btn bg--primary" id="btn_tambah_menu">
                              <img src="../../../img/icon-tambah-pesanan.svg" alt="plus">
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <!-- Batas -->
            </div>
          </div>
  </main>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="./../../js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    // $('#btn-sidebar').click(function () {
    //   $('#sidebar').hide();
    // })
    document.getElementById('btn-sidebar').addEventListener('click', function() {
      document.getElementById('sidebars').classList.toggle('side');
    })

    function operasi() {
      let pesan = new Array();
      let jumlah = new Array();
      let total_harga = 0;
      let total = 0;
      for (let a = 0; a <= 100; a++) {
        pesan[a] = $("#harga" + a).val();
        jumlah[a] = $("#jumlah" + a).val();
      }

      for (let a = 0; a < pesan.length; a++) {
        if (pesan[a] == null || pesan[a] == "") {
          pesan[a] = 0;
          jumlah[a] = 0;
        }
        total_harga += Number(pesan[a] * jumlah[a]);
        total = Number(pesan[a] * jumlah[a]);
        $("#hargaMenu" + a).text(total);
      }
      $("#total").val(total_harga);
      return $("#totalHarga").text(total_harga);
    }
    // document.getElementsByName('hapus_list_pesanan').forEach(element => {
    //   element.addEventListener('click', function(e) {
    //     e.preventDefault();
    //     e.stopPropagation();
    //   });
    // });

    // document.getElementsByName('btn_tambah_menu').forEach(element => {
    //   element.addEventListener('click', function(e) {
    //     e.preventDefault();
    //   });
    // });
  </script>
</body>

</html>