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
$petugas = new Petugas();
if (isset($_POST['simpan'])) {
    if ($_POST['password'] == $_POST['repassword']) {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'edit') {
                if ($_POST['password'] == "") {
                    if ($petugas->updatePetugasById($_GET['id'], $_POST['username'], $_POST['nama_petugas'], $_POST['level'])) {
                        $petugas->redirect("index.php", "Berhasil mengedit data petugas!");
                    } else {
                        $petugas->redirect("form.php?action=edit&id=" . $_GET['id'], "Gagal mengedit data silahkan ulangi kembali!");
                    }
                } else {
                    if ($petugas->updatePetugasById($_GET['id'], $_POST['username'], $_POST['nama_petugas'], $_POST['level'], $_POST['password'])) {
                        $petugas->redirect("index.php", "Berhasil mengedit data petugas!");
                    } else {
                        $petugas->redirect("form.php?action=edit&id=" . $_GET['id'], "Gagal mengedit data silahkan ulangi kembali!");
                    }
                }
            } else {
                $petugas->redirect("index.php");
            }
        } else {
            if ($petugas->isExistUsername($_POST['username'])) {
                $petugas->redirect("form.php", "Petugas dengan username {$_POST['username']} telah terdaftar!");
            } else {
                if ($petugas->tambahPetugas($_POST['username'], $_POST['password'], $_POST['nama_petugas'], $_POST['level'])) {
                    $petugas->redirect("index.php", "Berhasil menambahkan data petugas!");
                } else {
                    $petugas->redirect("form.php", "Gagal menambahkan data silahkan ulangi kembali!");
                }
            }
        }
    } else {
        $path = "form.php";
        if($_GET['action'] == 'edit') $path = "form.php?action=edit&id=" . $_GET['id'];

        $petugas->redirect($path, "Password anda tidak sama dengan password konfirmasi!");
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "edit") {
        $data = $petugas->getPetugasById($_GET['id']);
    } else {
        $petugas->redirect("index.php");
    }
}

?>
<div class="container p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">INPUT USER</h3>
            <a href="index.php" class="btn float-right btn-sm btn-primary">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= isset($_GET['action']) ? $data['username'] : '' ?>">
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
                    <label for="nama_petugas">Nama Petugas</label>
                    <input type="text" class="form-control" id="nama_petugas" placeholder="Nama Petugas" name="nama_petugas" value="<?= isset($_GET['action']) ? $data['nama_petugas'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control" name="level" id="level">
                        <option value="petugas" <?= isset($_GET['action']) ? $data['level'] == "petugas" ? "selected" : "" : "" ?>>Petugas</option>
                        <option value="admin" <?= isset($_GET['action']) ? $data['level'] == "admin" ? "selected" : "" : "" ?>>Admin</option>
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