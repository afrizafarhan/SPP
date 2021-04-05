<!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= $BASE_URL ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= $BASE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTable -->
<script src="<?= $BASE_URL ?>plugins/datatables/jquery.dataTables.js"></script>

<script src="<?= $BASE_URL ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- AdminLTE App -->
<script src="<?= $BASE_URL ?>dist/js/adminlte.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#table-petugas').DataTable();
});
$(document).ready(function(){
        $("#data_spp").DataTable();
    });
</script>
</body>
</html>
