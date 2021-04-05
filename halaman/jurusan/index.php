<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$jurusan = new Jurusan();
if (isset($_GET['id'])) {
    if ($jurusan->deleteJurusan($_GET['id'])) {
        ?>
        <script>
            alert("Berhasil menghapus data jurusan");
            window.location = '<?= $BASE_URL ?>halaman/index.php';
        </script>
<?php
    }else{
        ?>
        <script>
            alert("Gagal menghapus data kelas");
            window.location = '<?= $BASE_URL ?>halaman/index.php';
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
                    DATA JURUSAN
                </h3>
                <a href="<?= $BASE_URL ?>halaman/jurusan/form.php" class="btn float-right btn-sm btn-success">
                    <i class="fa fa-plus"></i> Tambah Jurusan
                </a>
            </div>
            <div class="card-body">
                <table id="data_spp" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Inisial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i = 0;
                        $query = $jurusan->getJurusan();
                        while ($val = $jurusan->fetch_asc($query)) {
                            ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $val['jurusan'] ?></td>
                                <td><?php echo $val['inisial'] ?></td>
                                <td>
                                    <a href="<?= $BASE_URL ?>halaman/jurusan/form.php?id=<?= $val['id'] ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= $BASE_URL ?>halaman/jurusan/index.php?id=<?= $val['id'] ?>" onclick="confirm('Apakah ingin menghapus data ini ?');" class="btn btn-danger">
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