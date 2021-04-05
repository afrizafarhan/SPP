<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$jurusan = new Jurusan();

if (isset($_POST['submit'])) {
    /**
     * Ini bagian proses menambhkan data ke dalam database
     */
    if ($jurusan->inputJurusan($_POST['jurusan'],$_POST['inisial'])) {
        /**
         * Ini bagian pesan yang akan muncul jika data masuk kedalam database
         */
        $jurusan->redirect($BASE_URL . 'halaman/jurusan/index.php', 'Berhasil Menambahkan data jurusan',);
    } else {
        /**
         * Ini bagian pesan yang akan muncul jika data gagal masuk kedalam database
         */
        $jurusan->redirect($BASE_URL . 'halaman/jurusan/index.php', 'Gagal Menambahkan data jurusan');
    }
} else if (isset($_POST['update'])) {
    /**
     * Ini bagian proses edit data lalu data dimasukan ke dalam database
     */
    if ($jurusan->updateJurusan($_POST['jurusan'],$_POST['inisial'],$_GET['id'])) {
        $jurusan->redirect($BASE_URL . 'halaman/jurusan/index.php', 'Berhasil edit data jurusan',);
    } else {
        $jurusan->redirect($BASE_URL . 'halaman/jurusan/index.php', 'Gagal edit data jurusan',);
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
    $query = $jurusan->getDataById($_GET['id']);
    $data = $jurusan->fetch_asc($query);
}
?>
<div class="wrapper">
    <div class="container p-5">
        <form method="post">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">INPUT JURUSAN</h3>
                    <a href="<?= $BASE_URL ?>halaman/jurusan/index.php" class="btn float-right btn-sm btn-primary">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                <div class="form-group">
                        <label for="">Inisial</label>
                        <input type="text" name="inisial" id="inisial" placeholder="contoh : RPL" class="form-control" value="<?= ($data == '') ? '' : $data['inisial'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" placeholder="Nama Jurusan" class="form-control" value="<?= ($data == '') ? '' : $data['jurusan'] ?>">
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