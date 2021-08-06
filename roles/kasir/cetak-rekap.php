<?php
include_once("../../config/functions.php");
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../../index.php?error=4");
}
if (($_SESSION['jabatan'] != 'kasir') && ($_SESSION['jabatan'] == 'admin')) {
    header("Location: ../../admin/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'kasir') && ($_SESSION['jabatan'] == 'koki')) {
    header("Location: ../koki/dashboard.php?error=1");
} else if (($_SESSION['jabatan'] != 'kasir') && ($_SESSION['jabatan'] == 'pelayan')) {
    header("Location: ../pelayan/dashboard.php?error=1");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <title>RestoKuy</title>
</head>

<body>
    <div class="container">
        <header class="border-bottom mb-3">
            <nav class="navbar navbar-light bg-white py-4">
                <div class="row w-100 justify-content-between">
                    <div class="col-6">
                        <a href="transaksi.php">
                            <h1 class="navbar-brand font-primary navbar-title">RestoKuy</h1>
                        </a>
                    </div>
                    <div class="col-6 px-0 text-end">
                        <p class="m-0">Jalan Raya Cipocok Serang-Banten</p>
                        <p>SMS : 0885 5240 7302</p>
                    </div>
                </div>
            </nav>
        </header>
        <!-- INI BUAT PRINT, KALO DAH FIX CSS NYA, NONAKTIFIN KOMEN window.print() nya -->
        <script>
            // window.print();
        </script>
        <?php
        $data = getDataRekap();
        foreach ($data as $rekap) {
        ?>
            <div class="mb-5 container">
                <div class="card-body">
                    <table class="">
                        <tr>
                            <td width=150>
                                <h5>No. Transaksi</h5>
                            </td>
                            <td width=10%>
                                <h5>:</h5>
                            </td>
                            <td>
                                <h5><?php echo $rekap["no_transaksi"]; ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Pesanan</td>
                            <td>:</td>
                            <td><?php echo $rekap["no_pesanan"]; ?></td>
                        </tr>
                        <tr>
                            <td>No. Meja</td>
                            <td>:</td>
                            <td><?php echo $rekap["no_meja"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pesan</td>
                            <td>:</td>
                            <td><?php echo $rekap["tanggal_pesanan"]; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-striped mb-3">
                        <tr>
                            <th>Total Bayar</th>
                            <td>Rp <?php echo number_format($rekap["total_bayar"], 0, ",", "."); ?></td>
                        </tr>
                    </table>
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col">
                                <p class="text-center">Tanda Terima,</p>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <p class="text-center">Hormat Kami,</p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <p class="text-center">( .............................................. )</p>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <p class="text-center">( .............................................. )</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        // INI CERITANYA KLO DAH BERES PRINT, BALIK LAGI KE HALAMAN SEBELUMNYA, ABIS CSS FIX NTAR NONAKTIFIN JUGA KOMENNYA
        // echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';


        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>

</html>