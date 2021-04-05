<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');

if (!isset($_SESSION['ID'])) {
    ?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
<?php
}
$bulan = [
    'Januari',
    'Pebruari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'Nopember',
    'Desember'
];
$pembayaran = new Pembayaran();
$siswa = new Siswa();
$data = $pembayaran->getPembayaranById($_REQUEST['id']);
$namaSiswa = $siswa->getSiswaByNisn($data['nisn']);
?>
<style>
table{
    border-collapse: collapse;
}
</style>
<table border="1" width="500px">
    <tr>
        <th colspan="4">KWITANSI</th>
    </tr>
    <tr>
        <th align="left"  style="border-right: none;border-bottom:none">Telah di terima dari : </th>
        <td style="border-left: none;border-bottom:none"><?= $namaSiswa['nama'] ?></td>
    </tr>
    <tr>
        <th align="left" style="border-right: none;border-top:none;border-bottom:none;">Uang Sejumlah : </th>
        <td style="border-left: none;border-top:none;border-bottom:none;">Rp. <?= number_format($data['jumlah_bayar'], 0,',','.') ?></td>
    </tr>
    <tr>
        <th align="left"  style="border-right: none;border-top:none">Untuk Pembayaran : </th>
        <td style="border-left: none;border-top:none">Pembayaran Uang Sekolah <?= $bulan[$data['bulan_bayar'] - 1] ?> <?= $data['tahun_bayar'] ?></td>
    </tr>
</table>
<script>
    window.print();
</script>