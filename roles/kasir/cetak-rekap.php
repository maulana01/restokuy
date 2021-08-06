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

$data = getDataRekap();

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
    <div class="container-fluid">
        <header class="border-bottom mb-3">
            <nav class="navbar navbar-light bg-white py-4">
                <div class="row w-100 justify-content-between">
                    <div class="col-6">
                        <a href="transaksi.php">
                            <a class="navbar-brand fs-1">RestoKuy</a>
                        </a>
                    </div>
                    <div class="col-6 px-0 text-end">
                        <?php $tanggal = getPeriodeCetak(); ?>
                        <h5>Periode <?= date('d F Y', strtotime($tanggal['awal'])) ." - " . date('d F Y', strtotime($tanggal['akhir'])); ?></h5>
                    </div>
                </div>
            </nav>
        </header>
        <!-- INI BUAT PRINT, KALO DAH FIX CSS NYA, NONAKTIFIN KOMEN window.print() nya -->
        <script>
            window.print();
        </script>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No Transaksi</th>
                            <th>No Pesanan</th>
                            <th>No Meja</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Foreach -->
                        <?php foreach ($data as $rekap) { ?>
                            <tr>
                                <td><?= $rekap['no_transaksi']; ?></td>
                                <td><?= $rekap['no_pesanan']; ?></td>
                                <td><?= $rekap['no_meja']; ?></td>
                                <td><?= $rekap['tgl_pesanan']; ?></td>
                                <td class="text-end"><?= "Rp " . number_format($rekap['total_bayar'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                        <!-- foreach -->
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="fw-bold text-end">Total</td>
                            <?php $total = getTotalPendapatan(); ?>
                            <td class="fw-bold text-end fs-5">Rp <?php echo number_format($total['total'], 0, ",", "."); ?></td>
                        </tr>
                    </tfoot>
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
                            <p class="text-center">(..............................................)</p>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                            <p class="text-center">(..............................................)</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <?php
        // INI CERITANYA KLO DAH BERES PRINT, BALIK LAGI KE HALAMAN SEBELUMNYA, ABIS CSS FIX NTAR NONAKTIFIN JUGA KOMENNYA
        echo '<meta http-equiv="refresh" content="0; url=rekapitulasi.php">';
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>

</html>