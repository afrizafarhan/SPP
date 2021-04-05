<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$spp = new Spp();

if (isset($_POST['submit'])) {
    /**
     * Ini bagian proses menambhkan data ke dalam database
     */
    if ($spp->inputspp($_POST['tahun'], $_POST['nominal'])) {
        /**
         * Ini bagian pesan yang akan muncul jika data masuk kedalam database
         */
        $spp->redirect($BASE_URL . 'halaman/spp/index.php', 'Berhasil Menambahkan data spp');
    } else {
        /**
         * Ini bagian pesan yang akan muncul jika data gagal masuk kedalam database
         */
        $spp->redirect($BASE_URL . 'halaman/spp/index.php', 'Gagal Menambahkan data spp');
    }
} else if (isset($_POST['update'])) {
    /**
     * Ini bagian proses edit data lalu data dimasukan ke dalam database
     */
    if ($spp->updateSpp($_POST['tahun'], $_POST['nominal'], $_GET['id'])) {
        $spp->redirect($BASE_URL . 'halaman/spp/index.php', 'Berhasil edit data spp');
    } else {
        $spp->redirect($BASE_URL . 'halaman/spp/index.php', 'Gagal edit data spp');
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
    $query = $spp->getDataById($_GET['id']);
    $data = $spp->fetch_asc($query);
}
?>
<div class="wrapper">
    <div class="container p-5">
        <form method="post">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">INPUT DATA SPP</h3>
                    <a href="<?= $BASE_URL ?>halaman/spp/index.php" class="btn float-right btn-sm btn-primary">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <input type="text" name="tahun" id="tahun" class="form-control" value="<?= ($data == '') ? '' : $data['tahun'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="text" name="nominal" id="nominal" class="form-control" value="<?= ($data == '') ? '' : $data['nominal'] ?>">
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