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
        <!-- Alert -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </symbol>
          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
              d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
          </symbol>
          <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
              d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </symbol>
        </svg>
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
          </svg>
          <div>
            Gagal Menambahkan Data!
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
            Data Berhasil Ditambah!
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
        <div class="row">
          <div class="col-5">
            <form method="post" action="">
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleNoPesanan" class="form-label">No Pesanan</label>
                </div>
                <div class="col-auto">
                  <input type="text" class="form-control" id="exampleNoPesanan" name="id_pegawai" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleTanggalLahir" class="form-label">Tanggal</label>
                </div>
                <div class="col-auto">
                  <input type="Date" class="form-control" id="exampleTanggalLahir" name="tgl" value="" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="exampleNoMeja" class="form-label">No Meja</label>
                </div>
                <div class="col-auto">
                  <input type="text" class="form-control" id="exampleNoMeja" name="no_meja" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <table class="table table-hover table-borderless">
                    <thead class="table-light">
                      <tr>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Foreach -->
                      <tr>
                        <td>Nasi Goyeng</td>
                        <td>
                          <input class="form-control form-control-sm" type="number" value="1" min="1" max="100" style="width: 5em;" autofocus>
                        </td>
                        <td class="text-end">Rp 400.000.000</td>
                        <td>
                          <form action="" method="post">
                            <button name="hapus_list_pesanan" class="btn btn-sm font-btn bg--secondary font-white">hapus</button>
                          </form>
                        </td>
                      </tr>
                      <!-- Batas -->
                      <tr>
                        <td>Nasi Goyeng</td>
                        <td class="w-25"><input class="form-control form-control-sm" type="number" value="1" min="1" max="100" style="width: 5em;" autofocus></td>
                        <td class="text-end">Rp 400.000.000</td>
                        <td>
                          <form action="">
                            <button name="hapus_list_pesanan" class="btn btn-sm font-btn bg--secondary font-white">hapus</button>
                          </form>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot class="table-light">
                      <tr>
                        <td>Total</td>
                        <td colspan="2" class="text-end">Rp 800.000.000</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <button type="submit" class="btn font-btn bg--primary font-white" name="btn_tambah">Tambah</button>
            </form>
          </div>
          <div class="col border border-3 rounded">
            <div class="row row-cols-2 gy-3 py-3">
              <!-- Foreach -->
              <div class="col-5 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-auto">
                        <h5 class="card-title">Nasi Goyeng</h5>
                        <p class="card-text">Rp. 400.000.000</p>
                        <h6 class="card-subtitle mb-2 text-muted">Stok 100</h6>
                      </div>
                      <div class="col d-flex justify-content-center align-items-center">
                        <form action="" method="post">
                          <button class="btn bg--primary" id="btn_tambah_menu" name="btn_tambah_menu">
                            <img src="../../../img/icon-tambah-pesanan.svg" alt="plus">
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Batas -->
              <div class="col-5 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-auto">
                        <h5 class="card-title">Nasi Goyeng</h5>
                        <p class="card-text">Rp. 400.000.000</p>
                        <h6 class="card-subtitle mb-2 text-muted">Stok 100</h6>
                      </div>
                      <div class="col d-flex justify-content-center align-items-center">
                        <form action="" method="post">
                          <button class="btn bg--primary" id="btn_tambah_menu" name="btn_tambah_menu">
                            <img src="../../../img/icon-tambah-pesanan.svg" alt="plus">
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-5 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-auto">
                        <h5 class="card-title">Nasi Goyeng</h5>
                        <p class="card-text">Rp. 400.000.000</p>
                        <h6 class="card-subtitle mb-2 text-muted">Stok 100</h6>
                      </div>
                      <div class="col d-flex justify-content-center align-items-center">
                        <form action="" method="post">
                          <button class="btn bg--primary" id="btn_tambah_menu" name="btn_tambah_menu">
                            <img src="../../../img/icon-tambah-pesanan.svg" alt="plus">
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-5 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-auto">
                        <h5 class="card-title">Nasi Goyeng</h5>
                        <p class="card-text">Rp. 400.000.000</p>
                        <h6 class="card-subtitle mb-2 text-muted">Stok 100</h6>
                      </div>
                      <div class="col d-flex justify-content-center align-items-center">
                        <form action="" method="post">
                          <button class="btn bg--primary" id="btn_tambah_menu" name="btn_tambah_menu">
                            <img src="../../../img/icon-tambah-pesanan.svg" alt="plus">
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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

    document.getElementsByName('hapus_list_pesanan').forEach(element => {
      element.addEventListener('click', function(e) {
        e.preventDefault();
      });
    });

    document.getElementsByName('btn_tambah_menu').forEach(element => {
      element.addEventListener('click', function(e) {
        e.preventDefault();
      });
    });
  </script>
</body>

</html>