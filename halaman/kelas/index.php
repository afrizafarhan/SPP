<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$jurusan = new Jurusan();
$kelas = new Kelas();
if (isset($_GET['id'])) {
    if ($kelas->deleteKelas($_GET['id'])) {
        ?>
        <script>
            alert("Berhasil menghapus data kelas");
            window.location = '<?= $BASE_URL ?>halaman/kelas/index.php';
        </script>
<?php
    }else{
        ?>
        <script>
            alert("Gagal menghapus data kelas");
            window.location = '<?= $BASE_URL ?>halaman/kelas/index.php';
        </script>
<?php
    }
}
?>
<div class="wrapper">
    <div class="container p-5">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    DATA KELAS
                </h3>
                <a href="<?= $BASE_URL ?>halaman/kelas/form.php" class="btn float-right btn-sm btn-success">
                    <i class="fa fa-plus"></i> Tambah Kelas
                </a>
            </div>
            <div class="card-body">
                <table id="data_spp" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i = 0;
                        $query = $kelas->getKelas();
                        while ($val = $kelas->fetch_asc($query)) {
                            ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $val['nama_kelas'] ?></td>
                                <td><?php $datajr = $jurusan->fetch_asc($jurusan->getDataById($val['kompetensi_keahlian'])); echo $datajr['jurusan'] ?></td>
                                <td>
                                    <a href="<?= $BASE_URL ?>halaman/kelas/form.php?id=<?= $val['id_kelas'] ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= $BASE_URL ?>halaman/kelas/index.php?id=<?= $val['id_kelas'] ?>" onclick="confirm('Apakah ingin menghapus data ini ? Jika menghapus data ini maka akan menghapus data siswa dan juga pembayaran');" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../../templates/footer.php');
?>