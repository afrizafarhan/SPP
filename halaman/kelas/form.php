<?php
include_once('../../autoload.php');

include_once('../../templates/header.php');
$kelas = new Kelas();
$jurusan = new Jurusan();
if (isset($_POST['submit'])) {
    /**
     * Ini bagian proses menambhkan data ke dalam database
     */
    if ($kelas->inputKelas($_POST['nama_kelas'], $_POST['k_keahlian'])) {
        /**
         * Ini bagian pesan yang akan muncul jika data masuk kedalam database
         */
        $kelas->redirect($BASE_URL . 'halaman/kelas/index.php', 'Berhasil Menambahkan data kelas');
    } else {
        /**
         * Ini bagian pesan yang akan muncul jika data gagal masuk kedalam database
         */
        $kelas->redirect($BASE_URL . 'halaman/kelas/index.php', 'Gagal Menambahkan data kelas');
    }
} else if (isset($_POST['update'])) {
    /**
     * Ini bagian proses edit data lalu data dimasukan ke dalam database
     */
    if ($kelas->updateKelas($_POST['nama_kelas'], $_POST['k_keahlian'], $_GET['id'])) {
        $kelas->redirect($BASE_URL . 'halaman/kelas/index.php', 'Berhasil edit data kelas');
    } else {
        $kelas->redirect($BASE_URL . 'halaman/kelas/index.php', 'Gagal edit data kelas');
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
    $query = $kelas->getDataById($_GET['id']);
    $data = $kelas->fetch_asc($query);
}
?>
<div class="wrapper">
    <div class="container p-5">
        <form method="post">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">INPUT DATA KELAS</h3>
                    <a href="<?= $BASE_URL ?>halaman/kelas/index.php" class="btn float-right btn-sm btn-primary">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?= ($data == '') ? '' : $data['nama_kelas'] ?>" placeholder="Contoh : XII">
                    </div>
                    <div class="form-group">
                        <label for="">Kompetensi Keahlian</label>
                        <select name="k_keahlian" id="k_keahlian" class="form-control">
                            <?php
                                $query = $jurusan->getJurusan(); 
                                while($val = $jurusan->fetch_asc($query)){ 
                            ?>
                            <option <?= ($data == '' ? '' : ($data['kompetensi_keahlian'] == $val['id'] ? 'selected' : '') )?> value="<?= $val['id'] ?>"><?= $val['jurusan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button name="<?= ($data == '') ? 'submit' : 'update' ?>" class="btn btn-sm btn-success" type="submit">
                            <?= ($data == '' ? '<i class="fa fa-save"></i> Simpan' : '<i class="fa fa-edit"></i> Edit') ?>
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