<?php
include_once 'autoload.php';

// Proses
if (isset($_POST['login'])) {
    $petugas = new Petugas();
    $siswa = new Siswa();
    if (!($petugas->login($_POST['username'], $_POST['password']) || $siswa->login($_POST['username'], $_POST['password']))) {
        ?>
        <script>
            alert('Username atau Password yang anda masukan salah');
            window.location = 'index.php';
        </script>
        <?php
    }
}
if (isset($_SESSION['ID'])) {
    header('location:halaman/dashboard.php');
}
$BASE_URL = 'http://' . $_SERVER['HTTP_HOST'] . '/spp/';
include_once('templates/header_login.php');
?>
<div class="login-box">
    <div class="login-logo">
        <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
        <h3 style="color: black; font-weight:600">APLIKASI PEMBAYARAN SPP</h3>
    </div>
    <!-- /.login-logo -->
    <div class="card" style="box-shadow: 0px 0px 15px #666;">
        <div class="card-body rounded text-center">
            <!-- <br><br>
            <img src="<?= $BASE_URL ?>dist/img/fees.png" class="img-login" alt="">
            <br><br><br> -->
            <p style="font-size: 18px;color:black"><b>SIGN IN<b></p>
            <form name="form1" method="post">
                <div class="input-group mb-3">
                    <input class="border border-info form-control" type="text" class="form-control" name="username" placeholder="Masukan username/nisn" required autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input class="border border-info form-control" type="password" class="form-control form-login" name="password" placeholder="Password" required autocomplete="off">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <button name="login" style="color:white;font-weight:bold" type="submit" class="btn btn-info btn-block"><i class="fa fa-sign-in-alt"></i> Sign In</button>
                <!-- /.col -->
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<?php
include_once('templates/footer_login.php');
?>