<?php
include_once('../../autoload.php');
$siswa = new Siswa();
$c_kelas = new Kelas();
if (!isset($_GET['kelas']) || !isset($_GET['bulan']) || !isset($_GET['tahun'])) {
    echo "<script type='text/javascript'>alert('URL tidak valid anda akan dikembalikan ke halaman laporan!'); window.location.href = 'index.php';</script>";
} else {
    $kelas = $_GET['kelas'];
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>dist/css/adminlte.min.css">

</head>

<body>
    <div class="container">
        <br>
        <h2 align="center"><i>Tagihan Pembayaran</i></h2>
        <hr>
        <div class="row">
            <div class="col-sm-2"><b><i>Bulan Bayar</i></b> : <?= $bulan ?></div>
            <div class="col-sm-2"><b><i>Tahun Bayar</i></b> : <?= $tahun ?></div>
            <div class="col-sm-8 text-right"><b><i>Kelas</i></b> : <?php
                if($kelas == -1) echo "Semua kelas";
                else{
                    $q = $c_kelas->getDataById($kelas);
                    $data = $c_kelas->fetch_asc($q);
                    echo $data['nama_kelas'] . " - " . $data['jurusan'];
                }
            ?></div>
        </div>
        <br>
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = $siswa->getTagihanUntukLaporan($kelas, $bulan, $tahun);
                while ($row = $siswa->fetch_asc($query)) {
                    echo "<tr>
                        <td>" . $no++ .  "</td>
                        <td>{$row['nisn_siswa']}</td>
                        <td>{$row['nama']}</td>
                        <td>" . ($row['id_pembayaran'] != "" ? "Lunas" : "-") . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>