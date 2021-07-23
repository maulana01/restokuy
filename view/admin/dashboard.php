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
  <header>
    <nav class="navbar sticky-top fixed-top navbar-expand-lg navbar-light bg--four">
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
            <a href="./dashboard.php" class="nav-link font-primary">
              <img src="./../../img/icon-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="" class="nav-link disabled"><span class="font-four fw-bold">Master File</span></a>
          </li>
          <li>
            <a href="#" class="nav-link font-primary">
              <img src="./../../img/icon-pegawai-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Pegawai</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link font-primary">
              <img src="./../../img/icon-menu-sidebar.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Menu</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col">
        <h1 class="text-center my-5 font-primary">Selamat Datang, Admin</h1>
        <div class="row justify-content-evenly">
          <div class="col-2 bg--four p-3">
            <div class="row">
              <div class="col text-center m-auto">
                <span class="fs-1 fw-bold font-secondary">5</span>
              </div>
              <div class="col text-center">
                <div class="row">
                  <div class="col">
                    <img src="./../../img/icon-pegawai.svg" alt="Pegawai" class="icon-dashboard">
                  </div>
                </div>
                <div class="row">
                  <div class="col gy-2">
                    <span class="fs-5 fw-bold font-secondary">Pelayan</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-2 bg--four p-3">
            <div class="row">
              <div class="col text-center m-auto">
                <span class="fs-1 fw-bold font-secondary">5</span>
              </div>
              <div class="col text-center">
                <div class="row">
                  <div class="col">
                    <img src="./../../img/icon-menu.svg" alt="Menu" class="icon-dashboard">
                  </div>
                </div>
                <div class="row">
                  <div class="col gy-2">
                    <span class="fs-5 fw-bold font-secondary">Menu</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-2 bg--four p-3">
            <div class="row">
              <div class="col text-center m-auto">
                <span class="fs-1 fw-bold font-secondary">5</span>
              </div>
              <div class="col text-center">
                <div class="row">
                  <div class="col">
                    <img src="./../../img/icon-koki.svg" alt="Koki" class="icon-dashboard">
                  </div>
                </div>
                <div class="row">
                  <div class="col gy-2">
                    <span class="fs-5 fw-bold font-secondary">Koki</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-2 bg--four p-3">
            <div class="row">
              <div class="col text-center m-auto">
                <span class="fs-1 fw-bold font-secondary">5</span>
              </div>
              <div class="col text-center">
                <div class="row">
                  <div class="col">
                    <img src="./../../img/icon-kasir.svg" alt="Kasir" class="icon-dashboard">
                  </div>
                </div>
                <div class="row">
                  <div class="col gy-2">
                    <span class="fs-5 fw-bold font-secondary">Kasir</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-5">
          <div class="col">
            <h3 class="text-center font-secondary mb-4">Master File</h2>
              <div class="row justify-content-center">
                <div class="col-4">
                  <div class="card cards p-3 card-shadow">
                    <img src="./../../img/bg_pegawai.png" class="card-img-top m-auto" alt="Pegawai">
                    <div class="card-body">
                      <h5 class="card-title text-center font-primary mb-3">Pegawai</h5>
                      <p class="card-text font-primary fw-normal">Informasi Tentang Pegawai</p>
                      <br>
                      <a href="#" class="btn bg--third font-btn font-primary d-block col-6 mx-auto">lihat</a>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="card cards p-3 card-shadow">
                    <img src="./../../img/bg_menu.png" class="card-img-top m-auto" alt="Menu">
                    <div class="card-body">
                      <h5 class="card-title text-center font-primary mb-3">Menu</h5>
                      <p class="card-text font-primary fw-normal">Informasi Tentang Menu Makanan dan Minuman</p>
                      <a href="#" class="btn bg--third font-btn font-primary d-block col-6 mx-auto">lihat</a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
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