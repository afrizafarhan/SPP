<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');
/* Panggil Header terlebih dahulu */
include_once('../../templates/header.php');

/**
 * ambil data kelas
 */
$kelas = new Kelas();
$dataKelas = $kelas->getKelasJoinJurusan();

if (!isset($_SESSION['ID'])) {
    ?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
<?php
}

?>
<div class="container-fluid p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">LAPORAN BULANAN</h3>
        </div>
        <div class="card-body">
            <form method="get" action="print.php" target="_blank">
                <div class="form-group">
                    <label for="">Kelas</label>
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="-1">Semua Kelas</option>
                        <?php while ($val = $kelas->fetch_asc($dataKelas)) {
                            ?>
                            <option value="<?= $val['id_kelas'] ?>">
                                <?= $val['nama_kelas'] . ' - ' . $val['inisial'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select class="form-control" name="bulan" id="bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10" >Oktober</option>
                        <option value="11" >November</option>
                        <option value="12" >Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" maxlength="4" placeholder="Tahun" name="tahun" required>
                </div>
                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Cetak</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once('../../templates/footer.php');
?>