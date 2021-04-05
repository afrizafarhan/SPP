<?php
include_once('../../autoload.php');
$pembayaran = new Pembayaran();

if (isset($_REQUEST['kelas'])) {
    $data = $pembayaran->getSemuaPembayaranByKelas($_REQUEST['kelas']);
} else if (isset($_REQUEST['id'])) {
    $data = $pembayaran->getSemuaPembayaranByNisn($_SESSION['ID']);
} else {
    $data = $pembayaran->getSemuaPembayaran();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>dist/css/adminlte.min.css">

</head>

<body>
    <div class="container">
        <br>
        <h2 align="center"><i>Histori Pembayaran</i></h2>
        <hr>
        <br>
        <table class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <?= $_SESSION['LEVEL'] != 'siswa' ? '<th>Nama Siswa</th>' : '<th>Nama Siswa</th>' ?>
                    <th>Tgl. Bayar</th>`
                    <th>Bln. Bayar</th>
                    <th>Thn. Bayar</th>
                    <th>SPP</th>
                    <th>Jumlah Bayar</th>
                    <th>Petugas Entri</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($val = $pembayaran->fetch_asc($data)) {
                    echo "<tr>
                    <td>{$i}</td>
                    <td>{$val['nisn']}</td>" .
                        ($_SESSION['LEVEL'] != 'siswa' ? "<td>{$val['nama']}</td>" : "<td>{$val['nama']}</td>") .
                        "<td>" . date("d-m-Y", strtotime($val['tgl_bayar']))  . "</td>
                    <td>" . $pembayaran->ubahBulan($val['bulan_bayar']) . "</td>
                    <td>{$val['tahun_bayar']}</td>
                    <td>Rp. " . number_format($val['nominal'], 0, ',', '.') . "</td>
                    <td>Rp. " . number_format($val['jumlah_bayar'], 0, ',', '.') . "</td>
                    <td>{$val['nama_petugas']}</td>
                    </tr>";
                    $i++;
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