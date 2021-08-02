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
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
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
          <a href="dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
        </div>
        <form method="post">
          <div class="dropdown">
            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../../img/icon-profile.svg" alt="profile">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-color" aria-labelledby="dropdownMenuLink">
              <li><span class="dropdown-item-text font-primary fw-normal"><?php echo ucfirst($_SESSION["username"]); ?></span></li>
              <li><button class="dropdown-item font-primary fw-normal" name="btn-keluar">Keluar</button></li>
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
            <a href="../dashboard.php" class="nav-link font-primary">
              <img src="../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="" class="nav-link disabled"><span class="font-four fw-bold">Master File</span></a>
          </li>
          <li>
            <a href="../pegawai/pegawai.php" class="nav-link font-primary">
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
        <h2 class="font-primary">Edit Data Menu</h2>
        <a href="./menu.php" class="btn font-btn bg--third font-white my-4">Menu</a>
        <!-- Alert -->
        <?php updateDataMenu(); ?>

        <!-- Form Tambah Menu -->
        <?php
        if (isset($_GET["id_menu"])) {
          $db = dbConnect();
          $id_menu = $db->escape_string($_GET["id_menu"]);
          if ($dataMenu = getDataMenu($id_menu)) { // cari data merk, kalau ada simpan di $data
        ?>
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_menu" value="<?php echo $dataMenu['id_menu']; ?>">
              <div class="row">
                <div class="row pt-3">
                  <div class="col-2 pb-4">
                    <h5>Nama</h5>
                  </div>

                  <div class="col-10 pb-4">
                    <input type="text" name="nama_menu" value="<?= $dataMenu['nama_menu']; ?>">
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 pb-4">
                    <h5>Kategori</h5>
                  </div>

                  <div class="col-auto pb-4">
                    <select class="form-select" name="kategori_menu" id="kategori" onchange="updateJenisMenu()" required>
                      <option selected disabled>~ Pilih Kategori Menu ~</option>
                      <option value="makanan">Makanan</option>
                      <option value="minuman">Minuman</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 pb-4">
                    <h5>Jenis</h5>
                  </div>

                  <div class="col-auto pb-4">
                    <select class="form-select" name="jenis_menu" id="jenis" required>
                      <option selected disabled>~ Pilih Jenis Menu ~</option>
                      <!-- <option value="mie">Mie</option>
                      <option value="soda">Soda</option>
                      <option value="jus">Jus</option>
                      <option value="sayuran">Sayuran</option>
                      <option value="seafood">Seafood</option>
                      <option value="olahan daging">Olahan Daging</option>
                      <option value="diet">Diet</option> -->
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 pb-4">
                    <h5>Harga</h5>
                  </div>

                  <div class="col-10 pb-4">
                    <input type="text" name="harga_menu" value="<?= $dataMenu['harga_menu']; ?>">
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 pb-4">
                    <h5>Gambar Menu</h5>
                  </div>

                  <div class="col-10 pb-4">
                    <div class="col-sm-2">
                      <?php echo '<img class="img-thumbnail img-preview" width="250" src="data:image/jpeg;base64,' . base64_encode($dataMenu['gambar_menu']) . '"/>'; ?>
                    </div>
                    <div class="col-sm-8">
                      <input src="data:image/jpeg;base64,<?= base64_encode($dataMenu['gambar_menu']); ?>" type="file" class="form-control" id="inputGroupFile02" accept="image/*" name="gambar_menu">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-4 pb-4">
                <button name="btn_edit" type="submit" class="btn font-btn bg--primary font-white">Edit</button>
                <button refresh class="btn font-btn bg--third font-white ms-2">Reset</button>
              </div>

      </div>
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
  <script src="../../js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <script>
    // $('#btn-sidebar').click(function () {
    //   $('#sidebar').hide();
    // })
    document.getElementById('btn-sidebar').addEventListener('click', function() {
      document.getElementById('sidebars').classList.toggle('side');
    })

    function updateJenisMenu() {
      var kategori = document.getElementById("kategori").value;
      var jenis = document.getElementById("jenis");
      var length = jenis.options.length;
      // var mkn = ['mie', 'sayuran', 'seafood', 'daging olahan',];
      while (jenis.length > 1)
        jenis.remove(1);
      if (kategori == 'makanan') {
        jenis.appendChild(new Option('Mie', 'mie')).value;
        jenis.appendChild(new Option('Sayuran', 'sayuran')).value;
        jenis.appendChild(new Option('Seafood', 'seafood')).value;
        jenis.appendChild(new Option('Olahan Daging', 'olahan daging')).value;
        jenis.appendChild(new Option('Diet', 'diet')).value;
      } else if (kategori == 'minuman') {
        jenis.appendChild(new Option('Soda', 'soda')).value;
        jenis.appendChild(new Option('Jus', 'jus')).value;
      }
    }
  </script>
</body>

</html>