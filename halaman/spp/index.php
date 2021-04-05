<?php
include_once('../../autoload.php');
include_once('../../templates/header.php');
$spp = new Spp();
if(isset($_GET['id'])){
    if($spp->deleteSpp($_GET['id'])){
        $spp->redirect($BASE_URL.'/halaman/spp/index.php','Berhasil hapus data spp');
    }else{
        $spp->redirect($BASE_URL.'/halaman/spp/index.php','Gagal hapus data spp');
    }
}
?>
<div class="wrapper">
    <div class="container p-5">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    DATA SPP
                </h3>
                <a class="btn float-right btn-sm btn-success" href="<?= $BASE_URL ?>halaman/spp/form.php">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <table id="data_spp" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            $i = 0;
                            $query = $spp->getSpp();
                            while($val = $spp->fetch_asc($query)){
                        ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $val['tahun'] ?></td>
                                <td><?php echo 'Rp. '.number_format($val['nominal'],0,',','.') ?></td>
                                <td>
                                    <a href="<?= $BASE_URL ?>halaman/spp/form.php?id=<?= $val['id_spp'] ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= $BASE_URL ?>halaman/spp/index.php?id=<?= $val['id_spp']?>" onclick="confirm('Ingin menghapus data spp ini ? Jika menghapus data ini maka akan menghapus data siswa dan juga pembayaran')" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../../templates/footer.php');
?>