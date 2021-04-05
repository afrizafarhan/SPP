<?php
$BASE_URL = 'http://' . $_SERVER['HTTP_HOST'] . '/spp/';
if (!isset($_SESSION['LEVEL'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Aplikasi Pembayaran SPP</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);font-weight:600">
            <div class="container">
                <a href="<?= $BASE_URL ?>" class="navbar-brand">
                    <span class="brand-text font-weight-light"><b>Aplikasi SPP</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>halaman/dashboard.php" class="nav-link">Home</a>
                        </li>
                        <?php if ($_SESSION['LEVEL'] == 'admin') { ?>
                            <li class="nav-item dropdown" style="color:black">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Data</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/siswa/index.php" class="nav-link">Data Siswa</a>
                                    </li>
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/petugas/index.php" class="nav-link">Data Petugas</a>
                                    </li>
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/kelas/index.php" class="nav-link">Data Kelas</a>
                                    </li>
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/spp/index.php" class="nav-link">Data Spp</a>
                                    </li>
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/jurusan/index.php" class="nav-link">Data Jurusan</a>
                                    </li>
                                    <li>
                                        <a style="color:black" href="<?= $BASE_URL ?>halaman/jenis_pembayaran/index.php" class="nav-link">Jns Pembayaran</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/entri_pembayaran/index.php" class="nav-link">Entri Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/history_bayar/index.php" class="nav-link">History Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/laporan/index.php" class="nav-link">Laporan</a>
                            </li>
                        <?php } else if ($_SESSION['LEVEL'] == 'petugas') { ?>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/entri_pembayaran/index.php" class="nav-link">Entri Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/history_bayar/index.php" class="nav-link">History Pembayaran</a>
                            </li>
                        <?php } else if ($_SESSION['LEVEL'] == 'siswa') { ?>
                            <li class="nav-item">
                                <a href="<?= $BASE_URL ?>halaman/history_bayar/index.php" class="nav-link">History Pembayaran</a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>halaman/logout.php" class="btn mt-1 btn-sm btn-outline-danger"><i class="fas fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->