<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once('../../autoload.php');
/* Panggil Header terlebih dahulu */
include_once('../../templates/header.php');

if (!isset($_SESSION['ID'])) {
?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
<?php
}

$siswa = new Siswa();


?>
<div class="container p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Cari Siswa</h3>
            <a href="index.php" class="btn float-right btn-sm btn-primary">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                    <div class="input-group">
                        <input type="text" name="namaSiswa" class="form-control" id="inlineFormInputGroupUsername" placeholder="Nama Siswa">
                        <div class="input-group-prepend">
                            <button name="cari" value="cari" class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_REQUEST['cari'])) {
                        $namaSiswa = $_REQUEST['namaSiswa'];
                        $data = $siswa->cariSiswa($namaSiswa);
                        $no = 1;
                        while ($rows = $siswa->fetch_asc($data)) {
                            $dataKirim = $rows['nisn'].'|'.$rows['nama'].'|'.$rows['nama_kelas'].'|'.$rows['inisial'].'|'.$rows['id_spp'];
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $rows['nama'] . "</td>";
                            echo "<td>" . $rows['nama_kelas'] . "</td>";
                            echo "<td>" . $rows['inisial'] . "</td>";
                            echo "<td><a href='{$BASE_URL}halaman/entri_pembayaran/form.php?data={$dataKirim}' class='btn btn-sm btn-success'><i class='fa fa-plus'></i> Bayar</a></td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<td colspan='5' align='center'>Tidak ada data!!</td>";
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