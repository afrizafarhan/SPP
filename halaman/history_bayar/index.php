<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');
/* Panggil Header terlebih dahulu */
include_once('../../templates/header.php');
/**
 * ambil data kelas
 */
$pembayaran = new Pembayaran();
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

if(isset($_POST['filter'])){
    $data = $pembayaran->getSemuaPembayaranByKelas($_POST['kelas']);
}else{
    $data = $pembayaran->getSemuaPembayaran();
}

if($_SESSION['LEVEL'] == 'siswa'){
    $data = $pembayaran->getSemuaPembayaranByNisn($_SESSION['ID']);
}

?>
<div class="container-fluid p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">HISTORY PEMBAYARAN SPP SISWA</h3>
        </div>
        <div class="card-body">
        <?php if($_SESSION['LEVEL'] != 'siswa'): ?>
            <form method="post">
                <div class="form-group">
                    <label for="">Filter Kelas</label>
                    <select name="kelas" id="kelas" class="form-control">
                        <?php while($val = $kelas->fetch_asc($dataKelas)){
                        ?>
                            <option <?= (isset($_POST['kelas']) && $_POST['kelas'] == $val['id_kelas']) ? "selected" : "" ?> value="<?= $val['id_kelas'] ?>">
                                <?= $val['nama_kelas'].' - '.$val['inisial'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" name="filter" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Filter</button>
            </form>
            <?php endif; ?>
            <br>
            <table id="table-petugas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <?= $_SESSION['LEVEL'] != 'siswa' ? '<th>Nama Siswa</th>' : '' ?>
                        <th>Tgl. Bayar</th>
                        <th>Bln. Bayar</th>
                        <th>Thn. Bayar</th>
                        <th>SPP</th>
                        <th>Jumlah Bayar</th>
                        <th>Petugas Entri</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    while ($val = $pembayaran->fetch_asc($data)) {
                        echo "<tr>
                    <td>{$i}</td>
                    <td>{$val['nisn']}</td>" . 
                    ($_SESSION['LEVEL'] != 'siswa' ? "<td>{$val['nama']}</td>" : ""). 
                    "<td>" . date("d-m-Y", strtotime($val['tgl_bayar']))  . "</td>
                    <td>".$pembayaran->ubahBulan($val['bulan_bayar'])."</td>
                    <td>{$val['tahun_bayar']}</td>
                    <td>Rp. " . number_format($val['nominal'], 0,',','.') . "</td>
                    <td>Rp. " . number_format($val['jumlah_bayar'], 0,',','.') . "</td>
                    <td>{$val['nama_petugas']}</td>
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