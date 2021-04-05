<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');
/* Panggil Header terlebih dahulu */
include_once('../../templates/header.php');

$pecahData = explode('|', $_REQUEST['data']);
if (!isset($_SESSION['ID'])) {
?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
<?php
}
/* Proses Update Atau Create */
$pembayaran = new Pembayaran();
if (isset($_POST['simpan'])) {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'edit') {
            $explode = explode("~", $_POST['nisn']);
            if ($pembayaran->updatePembayaranById($_GET['id'], $_POST['nisn'], $_POST['bulan'], $_POST['tahun'], $_POST['id_spp'], $_POST['jumlah'])) {
                $pembayaran->redirect("index.php", "Berhasil mengedit entri pembayaran!");
            } else {
                $pembayaran->redirect("form.php?action=edit&id=" . $_GET['id'], "Gagal mengedit data silahkan ulangi kembali!");
            }
        } else {
            $pembayaran->redirect("index.php");
        }
    } else {
        $explode = explode("~", $_POST['nisn']);
        if ($pembayaran->tambahPembayaran($_SESSION['ID'], $_POST['nisn'], $_POST['bulan'], $_POST['tahun'], $_POST['id_spp'], $_POST['jumlah'])) {
            $pembayaran->redirect("index.php", "Berhasil menambahkan entri pembayaran!");
        } else {
            $pembayaran->redirect("form.php", "Gagal menambahkan data silahkan ulangi kembali!");
        }
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $data = $pembayaran->getPembayaranById($_GET['id']);
    } else {
        $pembayaran->redirect("index.php");
    }
}

?>
<div class="container p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">INPUT PEMBAYARAN</h3>
            <a href="index.php" class="btn float-right btn-sm btn-primary">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="nisn">NISN</label>
                            <input type="hidden" name="id_spp" value="<?= $pecahData[4] ?>">
                            <input type="text" name="nisn" id="nisn" class="form-control" value="<?= $pecahData[0] ?>" readonly>
                        </div>
                        <div class="col-6">
                            <label for="nisn">Nama Siswa</label>
                            <input type="text" class="form-control" value="<?= $pecahData[1] ?>" readonly>
                        </div>
                        <div class="col-6">
                            <label for="nisn">Kelas</label>
                            <input type="text" class="form-control" value="<?= $pecahData[2] ?>" readonly>
                        </div>
                        <div class="col-6">
                            <label for="nisn">Jurusan</label>
                            <input type="text" class="form-control" value="<?= $pecahData[3] ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select class="form-control" name="bulan" id="bulan">
                        <option value="1" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "1" ? "selected" : "" : "" ?>>Januari</option>
                        <option value="2" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "2" ? "selected" : "" : "" ?>>Februari</option>
                        <option value="3" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "3" ? "selected" : "" : "" ?>>Maret</option>
                        <option value="4" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "4" ? "selected" : "" : "" ?>>April</option>
                        <option value="5" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "5" ? "selected" : "" : "" ?>>Mei</option>
                        <option value="6" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "6" ? "selected" : "" : "" ?>>Juni</option>
                        <option value="7" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "7" ? "selected" : "" : "" ?>>Juli</option>
                        <option value="8" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "8" ? "selected" : "" : "" ?>>Agustus</option>
                        <option value="9" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "9" ? "selected" : "" : "" ?>>September</option>
                        <option value="10" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "10" ? "selected" : "" : "" ?>>Oktober</option>
                        <option value="11" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "11" ? "selected" : "" : "" ?>>November</option>
                        <option value="12" <?= isset($_GET['action']) ? $data['bulan_bayar'] == "12" ? "selected" : "" : "" ?>>Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" maxlength="4" placeholder="Tahun" name="tahun" value="<?= isset($_GET['action']) ? $data['tahun_bayar'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Bayar</label>
                    <input type="text" class="form-control" id="jumlah" placeholder="Jumlah Bayar" name="jumlah" value="<?= isset($_GET['action']) ? $data['jumlah_bayar'] : '' ?>">
                </div>
                <button type="submit" name="simpan" value="simpan" class="btn btn-sm btn-success">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>

<?php
include_once('../../templates/footer.php');
?>