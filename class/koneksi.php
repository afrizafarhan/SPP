<?php
class Koneksi
{

    /**
     * Protected adalah variabel scope
     */
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db = "db_spp";
    protected $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->db) or die(" Koneksi ke database gagal! : <br>" . mysqli_connect_error());
    }

    function escapeString($value)
    {
        return mysqli_real_escape_string($this->koneksi, $value);
    }

    function query($query)
    {
        $data = mysqli_query($this->koneksi, $query) or die("Ada error di database! : <br>" . mysqli_error($this->koneksi));
        return $data;
    }

    function fetch_arr($query){
        $data = mysqli_fetch_array($query);
        return $data;
    }

    function fetch_asc($query){
        $data = mysqli_fetch_assoc($query);
        return $data;
    }

    function num_row($query)
    {
        return mysqli_num_rows($query);
    }

    /**
     * Fungsi Tambahan
     */

    function redirect($url, $alert = null){
        $alert_script = $alert != null ? "alert('{$alert}');" : "";
        $script = '
        <script type="text/javascript">
            ' . $alert_script . '
            window.location = "' . $url . '";
        </script>
        ';
        echo $script;
    }

    function ubahBulan($bulan){
        if($bulan == 1){
            return 'Januari';
        }else if($bulan == 2){
            return 'Februari';
        }else if($bulan == 3){
            return 'Maret';
        }else if($bulan == 4){
            return 'April';
        }else if($bulan == 5){
            return 'Mei';
        }else if($bulan == 6){
            return 'Juni';
        }else if($bulan == 7){
            return 'Juli';
        }else if($bulan == 8){
            return 'Agustus';
        }else if($bulan == 9){
            return 'September';
        }else if($bulan == 10){
            return 'Oktober';
        }else if($bulan == 11){
            return 'November';
        }else if($bulan == 12){
            return 'Desember';
        }
    }

}
