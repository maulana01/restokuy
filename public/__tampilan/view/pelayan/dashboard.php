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
          <a href="./dashboard.php" class="navbar-brand font-primary navbar-title">RestoKuy</a>
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
            <a href="./pesanan/pesanan.php" class="nav-link font-primary">
              <img src="./../../img/icon-pemesanan-dashboard.svg" alt="Dashboard" class="pb-2">
              <span class="mx-2 fw-bold">Pesanan</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="col">
        <h1 class="text-center my-5 font-primary">Selamat Datang, Pelayan</h1>
        <div class="row my-5">
          <div class="col">
            <div class="row justify-content-center">
              <div class="col-4">
                <div class="card cards p-3 card-shadow">
                  <img src="./../../img/bg_pesanan.png" class="card-img-top m-auto" alt="Pegawai">
                  <div class="card-body">
                    <h5 class="card-title text-center font-primary mb-3">Pesanan</h5>
                    <p class="card-text font-primary fw-normal">Informasi Tentang Pesanan</p>
                    <br>
                    <a href="./pesanan/pesanan.php" class="btn bg--third font-btn font-primary d-block col-6 mx-auto">lihat</a>
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