<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$jenisPembayaran = new JenisPembayaran();
if (isset($_GET['id'])) {
    if ($jenisPembayaran->deleteJenisPembayaran($_GET['id'])) {
        ?>
        <script>
            alert("Berhasil menghapus data jenis pembayaran");
            window.location = '<?= $BASE_URL ?>index.php';
        </script>
<?php
    }else{
        ?>
        <script>
            alert("Gagal menghapus data pembayaran");
            window.location = '<?= $BASE_URL ?>index.php';
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
                    DATA JENIS PEMBAYARAN
                </h3>
                <a href="<?= $BASE_URL ?>halaman/jenis_pembayaran/form.php" class="btn float-right btn-sm btn-success">
                    <i class="fa fa-plus"></i> Tambah Jenis Pembayaran
                </a>
            </div>
            <div class="card-body">
                <table id="data_spp" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i = 0;
                        $query = $jenisPembayaran->getJenisPembayaran();
                        while ($val = $jenisPembayaran->fetch_asc($query)) {
                            ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $val['jenis_pembayaran'] ?></td>
                                <td>
                                    <a href="<?= $BASE_URL ?>halaman/jenis_pembayaran/form.php?id=<?= $val['id'] ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= $BASE_URL ?>halaman/jenis_pembayaran/index.php?id=<?= $val['id'] ?>" onclick="confirm('Apakah ingin menghapus data ini ?');" class="btn btn-danger">
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