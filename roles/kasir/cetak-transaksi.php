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
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <title>RestoKuy</title>
</head>

<body>
    <div class="container">
        <header class="border-bottom mb-3">
            <nav class="navbar navbar-light bg-white py-4">
                <div class="row w-100 justify-content-between">
                    <div class="col-6">
                        <a href="transaksi.php">
                            <a class="navbar-brand fs-1">RestoKuy</a>
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- INI BUAT PRINT, KALO DAH FIX CSS NYA, NONAKTIFIN KOMEN window.print() nya -->
        <script>
            window.print();
        </script>
        <?php
        if (isset($_GET["no_transaksi"])) {
            $db = dbConnect();
            $no_transaksi = $db->escape_string($_GET["no_transaksi"]);
            if ($dataTransaksi = getDataTransaksi($no_transaksi)) { // cari data transaksi, kalau ada simpan di $datatransaksi
        ?>
                <div class="mb-5 container">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>NOMOR TRANSAKSI</td>
                                <td>:</td>
                                <td><?php echo $dataTransaksi["no_transaksi"]; ?></td>
                            </tr>
                            <tr>
                                <td>NOMOR PESANAN</td>
                                <td>:</td>
                                <td><?php echo $dataTransaksi["no_pesanan"]; ?></td>
                            </tr>
                            <tr>
                                <td>NOMOR MEJA</td>
                                <td>:</td>
                                <td><?php echo $dataTransaksi["no_meja"]; ?></td>
                            </tr>
                            <tr>
                                <td>TANGGAL</td>
                                <td>:</td>
                                <td><?php echo date('d-m-Y', strtotime($dataTransaksi["tgl_pesanan"])); ?></td>
                            </tr>
                            <tr>
                                <td>LIST PESANAN</td>
                                <td colspan="2">:</td>
                            </tr>
                        </table>
                        <table class="table">
                            <?php $list = getDataMenuByNoPesanan($dataTransaksi['no_pesanan']); ?>
                            <?php foreach ($list as $t) { ?>
                                <tr>
                                    <td><?php echo $t['nama_menu']; ?></td>
                                    <td><?php echo $t['jumlah_pesanan']; ?></td>
                                    <td>x</td>
                                    <td>Rp <?php echo number_format($t['harga_menu'], 0, ",", ".");?></td>
                                    <td class="text-end">Rp <?php echo number_format($t['harga'], 0, ",", ".");?></td>
                                </tr>
                            <?php } ?>
                        <!-- </table>
                        <table class="table table-striped mb-3"> -->
                            <tr class="table-light">
                                <td class="fw-bold fs-5">Total Bayar</td>
                                <td class="fw-bold fs-5 text-end" colspan="4">Rp <?php echo number_format($dataTransaksi["total_bayar"], 0, ",", "."); ?></td>
                            </tr>
                        </table>
                        <!-- <div class="container">
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
                        </div> -->
                    </div>
                </div>
        <?php
            }
            // INI CERITANYA KLO DAH BERES PRINT, BALIK LAGI KE HALAMAN SEBELUMNYA, ABIS CSS FIX NTAR NONAKTIFIN JUGA KOMENNYA
            echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
        }


        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>

</html>