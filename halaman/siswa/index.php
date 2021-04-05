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

$siswa = new Siswa();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        $siswa->hapusSiswa($_GET['nisn']);
        $siswa->redirect("index.php", "Berhasil menghapus data siswa!");
    }
}
?>
<div class="container-fluid p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">DATA SISWA</h3>
            <a href="form.php" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Siswa</a>
        </div>
        <div class="card-body">
            <table id="table-petugas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>SPP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $siswa = new Siswa();
                    $data = $siswa->getSemuaSiswa();

                    $i = 1;

                    while ($val = $siswa->fetch_asc($data)) {
                        echo "<tr>
                    <td>{$i}</td>
                    <td>{$val['nisn']}</td>
                    <td>{$val['nis']}</td>
                    <td>{$val['nama']}</td>
                    <td>{$val['nama_kelas']}</td>
                    <td>{$val['alamat']}</td>
                    <td>{$val['no_telp']}</td>
                    <td> Rp. ".number_format($val['nominal'],0,',','.')."</td>
                    <td class='text-center'><a href='{$BASE_URL}halaman/siswa/form.php?action=edit&nisn={$val['nisn']}' class='btn btn-warning'><i class='fa fa-edit'></i> Edit</a> <a href='{$BASE_URL}halaman/siswa/index.php?action=delete&nisn={$val['nisn']}' class='btn btn-danger' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\");'><i class='fa fa-trash'></i> Hapus</a></td>
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