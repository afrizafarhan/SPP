<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$jenisPembayaran = new JenisPembayaran();

if (isset($_POST['submit'])) {
    /**
     * Ini bagian proses menambhkan data ke dalam database
     */
    if ($jenisPembayaran->inputJenisPembayaran($_POST['jenis_pembayaran'])) {
        /**
         * Ini bagian pesan yang akan muncul jika data masuk kedalam database
         */
        $jenisPembayaran->redirect($BASE_URL . 'halaman/jenis_pembayaran/index.php', 'Berhasil Menambahkan data jenis_pembayaran',);
    } else {
        /**
         * Ini bagian pesan yang akan muncul jika data gagal masuk kedalam database
         */
        $jenisPembayaran->redirect($BASE_URL . 'halaman/jenis_pembayaran/index.php', 'Gagal Menambahkan data jenis_pembayaran');
    }
} else if (isset($_POST['update'])) {
    /**
     * Ini bagian proses edit data lalu data dimasukan ke dalam database
     */
    if ($jenisPembayaran->updateJenisPembayaran($_POST['jenis_pembayaran'],$_GET['id'])) {
        $jenisPembayaran->redirect($BASE_URL . 'halaman/jenis_pembayaran/index.php', 'Berhasil edit data jenis_pembayaran',);
    } else {
        $jenisPembayaran->redirect($BASE_URL . 'halaman/jenis_pembayaran/index.php', 'Gagal edit data jenis_pembayaran',);
    }
}



$data = '';
/**
 * isset artinya jika ada 
 */
if (isset($_GET['id'])) {
    /**
     * Ini bagian yang berfungsi untuk get data berdasarkan id
     * yang mana id nya itu berasal dari url
     */
    $query = $jenisPembayaran->getDataById($_GET['id']);
    $data = $jenisPembayaran->fetch_asc($query);
}
?>
<div class="wrapper">
    <div class="container p-5">
        <form method="post">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">INPUT JURUSAN</h3>
                    <a href="<?= $BASE_URL ?>halaman/jenis_pembayaran/index.php" class="btn float-right btn-sm btn-primary">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Jenis Pembayaran</label>
                        <input type="text" name="jenis_pembayaran" id="jenis_pembayaran" placeholder="Nama Jenis Pembayaran" class="form-control" value="<?= ($data == '') ? '' : $data['jenis_pembayaran'] ?>">
                    </div>
                    <div class="form-group">
                        <button name="<?= ($data == '') ? 'submit' : 'update' ?>" class="btn btn-sm btn-success" type="submit">
                            <?= ($data == '') ? '<i class="fa fa-save"></i> Simpan' : '<i class="fa fa-edit"></i> Edit' ?>
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

</div>

<?php
include_once('../../templates/footer.php');
?>