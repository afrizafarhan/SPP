<?php
$BASE_URL = "http://{$_SERVER['HTTP_HOST']}/spp/";
include_once '../autoload.php';
if (!isset($_SESSION['ID'])) {
    ?>
    <script>
        alert('Silahkan login terlebih dahulu :)');
        window.location = <?= $BASE_URL ?>;
    </script>
    <?php
}
include_once('../templates/header.php');
?>
<div class="wrapper"><br>
    <div class="container">
        <div class="jumbotron jumbotron-fluid bg-dark" style="border-radius: 10px;">
            <div class="container text-center">
                <h1 class="display-4">Selamat datang kembali</h1>
                <h1 class="display-4"><?= $_SESSION['nama_petugas'] ?></h1>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../templates/footer.php');
?>