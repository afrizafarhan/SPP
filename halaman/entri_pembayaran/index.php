<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');
/* Panggil Header terlebih dahulu */
include_once('../../templates/header.php');

if (!isset($_SESSION['ID'])) {
    ?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
<?php
}

$pembayaran = new Pembayaran();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        $pembayaran->hapusPembayaran($_GET['id']);
        $pembayaran->redirect("index.php", "Berhasil menghapus transaksi pembayaran!");
    }
}
?>
<div class="container-fluid p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">DATA PEMBAYARAN</h3>
            <a href="form.php" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Pembayaran</a>
        </div>
        <div class="card-body">
            <table id="table-petugas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tgl. Bayar</th>
                        <th>Bln. Bayar</th>
                        <th>Thn. Bayar</th>
                        <th>SPP</th>
                        <th>Jumlah Bayar</th>
                        <th>Petugas Entri</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $pembayaran->getSemuaPembayaran();

                    $i = 1;

                    while ($val = $pembayaran->fetch_asc($data)) {
                        echo "<tr>
                    <td>{$i}</td>
                    <td>{$val['nisn']}</td>
                    <td>{$val['nama']}</td>
                    <td>" . date("d-m-Y", strtotime($val['tgl_bayar']))  . "</td>
                    <td>".$pembayaran->ubahBulan($val['bulan_bayar'])."</td>
                    <td>{$val['tahun_bayar']}</td>
                    <td>Rp. " . number_format($val['nominal'], 0,',','.') . "</td>
                    <td>Rp. " . number_format($val['jumlah_bayar'], 0,',','.') . "</td>
                    <td>{$val['nama_petugas']}</td>
                    <td class='text-center'>" . ($_SESSION['LEVEL'] == 'admin' ? "
                        <a href='{$BASE_URL}halaman/entri_pembayaran/form.php?action=edit&id={$val['id_pembayaran']}' class='btn btn-sm btn-warning'><i class='fa fa-edit'></i> Edit</a>" : "") . "
                        <a href='{$BASE_URL}halaman/entri_pembayaran/cetak.php?id={$val['id_pembayaran']}' class='btn btn-sm btn-success' target='_blank'><i class='fa fa-print'></i> Cetak</a>". "
                        <a href='{$BASE_URL}halaman/entri_pembayaran/index.php?action=delete&id={$val['id_pembayaran']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\");'><i class='fa fa-trash'></i> Hapus</a>
                    </td>
                    </tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php
include_once('../../templates/footer.php');
?>