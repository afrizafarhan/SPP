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

$petugas = new Petugas();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        $petugas->hapusPetugas($_GET['id']);
        $petugas->redirect("index.php", "Berhasil menghapus petugas!");
    }
    
}

?>

<div class="container p-5">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">DATA PETUGAS</h3>
            <a href="form.php" class="btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Petugas</a>
        </div>
        <div class="card-body">
            <table id="table-petugas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $petugas = new Petugas();
                    $data = $petugas->getSemuaPetugas();

                    $i = 1;

                    while ($val = $petugas->fetch_asc($data)) {
                        echo "<tr>
                    <td>{$i}</td>
                    <td>{$val['nama_petugas']}</td>
                    <td>{$val['username']}</td>
                    <td>{$val['level']}</td>
                    <td class='text-center'><a href='{$BASE_URL}halaman/petugas/form.php?action=edit&id={$val['id_petugas']}' class='btn btn-warning'><i class='fa fa-edit'></i> Edit</a> <a href='{$BASE_URL}halaman/petugas/index.php?action=delete&id={$val['id_petugas']}' class='btn btn-danger' onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\");'><i class='fa fa-trash'></i> Hapus</a></td>
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