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
          <img src="./../../../img/hamburger-menu.svg" alt="Menu" class="font-primary">
        </button>
        <div class="d-flex">
          <a href="./../dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
        </div>
        <form method="post">
          <div class="dropdown">
            <a role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="./../../../img/icon-profile.svg" alt="profile">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-color" aria-labelledby="dropdownMenuLink">
              <li><span class="dropdown-item-text font-primary fw-normal">Dandi</span></li>
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
        <ul class="nav flex-column my-3 nav-sidebar">
          <li>
            <a href="./../dashboard.php" class="nav-link font-primary">
              <img src="./../../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="" class="nav-link disabled"><span class="font-four fw-bold">Master File</span></a>
          </li>
          <li>
            <a href="./pegawai.php" class="nav-link font-primary">
              <img src="./../../../img/icon-pegawai-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Pegawai</span>
            </a>
          </li>
          <li>
            <a href="./../menu/menu.html" class="nav-link font-primary">
              <img src="./../../../img/icon-menu-sidebar.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Menu</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col m-5">
        <h2 class="font-primary">Edit Data Pegawai</h2>
        <a href="./pegawai.php" class="btn font-btn bg--third font-white my-4">Pegawai</a>
        <form method="post" action="">
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleIDPegawai" class="form-label">ID Pegawai</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="exampleIDPegawai" name="id_pegawai" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleName" class="form-label">Nama Lengkap</label>
            </div>
            <div class="col">
              <input type="text" class="form-control" id="exampleName" name="nama" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleTempat" class="form-label">Tempat</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="exampleTempat" name="tempat" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleTanggalLahir" class="form-label">Tanggal Lahir</label>
            </div>
            <div class="col-auto">
              <input type="Date" class="form-control" id="exampleTanggalLahir" name="tgl_lahir" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleAlamat" class="form-label">Alamat</label>
            </div>
            <div class="col">
              <textarea class="form-control" id="exampleAlamat" cols="1" rows="3" name="alamat" required></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleJabatan" class="form-label">Jabatan</label>
            </div>
            <div class="col-auto">
              <select class="form-select" name="jabatan" id="exampleJabatan" required>
                <option selected>~ Pilih Jabatan ~</option>
                <option value="Pelayan">Pelayan</option>
                <option value="Kasir">Kasir</option>
                <option value="Koki">Koki</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="exampleUsername" class="form-label">Username</label>
            </div>
            <div class="col-auto">
              <input type="text" class="form-control" id="exampleUsername" name="username" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-2">
              <label for="examplePassword" class="form-label">Password</label>
            </div>
            <div class="col-auto">
              <input type="password" class="form-control" id="examplePassword" name="password" required>
            </div>
          </div>
          <button type="submit" class="btn font-btn bg--primary font-white me-2" name="btn_tambah">Simpan</button>
          <button type="reset" class="btn font-btn bg--four font-white" name="btn_reset">Reset</button>
        </form>

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