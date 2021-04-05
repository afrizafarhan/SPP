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

/* Proses Update Atau Create */
$siswa = new Siswa();
if (isset($_POST['simpan'])) {
    if ($_POST['password'] == $_POST['repassword']) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'edit') {
                if ($_POST['password'] == "") {
                    if ($siswa->updateSiswaByNisn($_GET['nisn'], $_POST['nis'], $_POST['nama'], $_POST['kelas'], $_POST['alamat'], $_POST['no_telp'], $_POST['spp'])) {
                        $siswa->redirect("index.php", "Berhasil mengedit data siswa!");
                    } else {
                        $siswa->redirect("form.php?action=edit&nisn=" . $_GET['nisn'], "Gagal mengedit data silahkan ulangi kembali!");
                    }
                } else {
                    if ($siswa->updateSiswaByNisn($_GET['nisn'], $_POST['nis'], $_POST['nama'], $_POST['kelas'], $_POST['alamat'], $_POST['no_telp'], $_POST['spp'], $_POST['password'])) {
                        $siswa->redirect("index.php", "Berhasil mengedit data siswa!");
                    } else {
                        $siswa->redirect("form.php?action=edit&nisn=" . $_GET['nisn'], "Gagal mengedit data silahkan ulangi kembali!");
                    }
                }
            } else {
                $siswa->redirect("index.php");
            }
        } else {
            if ($siswa->isExistNISN($_POST['nisn'])) {
                $siswa->redirect("form.php", "Siswa dengan NISN {$_POST['nisn']} telah terdaftar!");
            } else {
                if ($siswa->tambahSiswa($_POST['nisn'], $_POST['nis'], $_POST['nama'], $_POST['kelas'], $_POST['alamat'], $_POST['no_telp'], $_POST['spp'], $_POST['password'])) {
                    $siswa->redirect("index.php", "Berhasil menambahkan data siswa!");
                } else {
                    $siswa->redirect("form.php", "Gagal menambahkan data silahkan ulangi kembali!");
                }
            }
        }
    } else {
        $path = "form.php";
        if($_GET['action'] == 'edit') $path = "form.php?action=edit&nisn=" . $_GET['nisn'];

        $siswa->redirect($path, "Password anda tidak sama dengan password konfirmasi!");
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $data = $siswa->getSiswaByNisn($_GET['nisn']);
    } else {
        $siswa->redirect("index.php");
    }
}

?>
<div class="container p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                INPUT DATA SISWA
            </h3>
            <a href="index.php" class="btn btn-sm float-right btn-primary">
                Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group" <?= isset($_GET['action']) ? "style='display: none;'" : "" ?>>
                    <label for="nisn">NISN</label>
                    <input type="text" maxlength="10" class="form-control" id="nisn" placeholder="NISN" name="nisn" value="<?= isset($_GET['action']) ? $data['nisn'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="nis" placeholder="NIS" name="nis" value="<?= isset($_GET['action']) ? $data['nis'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?= isset($_GET['action']) ? $data['nama'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    <?= isset($_GET['action']) ? "<small class='text-red'><i>Kosongkan jika tidak ingin di edit!</i></small>" : "" ?>
                </div>
                <div class="form-group">
                    <label for="repassword">Ulangi Password</label>
                    <input type="password" class="form-control" id="repassword" placeholder="Masukan Password Kembali" name="repassword">
                    <?= isset($_GET['action']) ? "<small class='text-red'><i>Kosongkan jika tidak ingin di edit!</i></small>" : "" ?>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" name="kelas" id="kelas">
                        <?php
                        $kelas = new Kelas();
                        $query = $kelas->getKelasJoinJurusan();
                        while ($val = $kelas->fetch_asc($query)) {
                            $selected = isset($_GET['action']) ? $data['id_kelas'] == $val['id_kelas'] ? 'selected' : '' : '';
                            $html = "<option value='" . $val["id_kelas"] . "' " . $selected . ">" . $val['nama_kelas'] . " - " . $val['inisial'] . "</option>";
                            echo $html;
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" rows="3"><?= isset($_GET['action']) ? $data['alamat'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp.</label>
                    <input type="text" class="form-control" id="no_telp" placeholder="No Telp." name="no_telp" value="<?= isset($_GET['action']) ? $data['no_telp'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="spp">SPP</label>
                    <select class="form-control" name="spp" id="spp">
                        <?php
                        $spp = new Spp();
                        $query = $spp->getSpp();
                        while ($val = $spp->fetch_asc($query)) {
                            $selected = isset($_GET['action']) ? $data['id_spp'] == $val['id_spp'] ? "selected" : "" : "";
                            echo '<option value="' . $val["id_spp"] . '" ' . $selected . '>' . $val['nominal'] . ' - ' . $val['tahun'] . '</option>';
                        }
                        ?>
                    </select>
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