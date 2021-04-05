<?php

class Siswa extends Koneksi
{
    private $nama_table = 'siswa';


    function login($username, $password)
    {
        $sql = "SELECT * FROM {$this->nama_table} WHERE nisn = '{$this->escapeString($username)}'  AND password = '{$this->escapeString(MD5($password))}'";
        $query = $this->query($sql);
        $data = $this->fetch_arr($query);
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['ID'] = $data['nisn'];
            $_SESSION['LEVEL'] = 'siswa';
            $_SESSION['nama_petugas'] = $data['nama'];
            header('location:halaman/dashboard.php');
            return true;
        } else {
            return false;
        }
    }


    function getSemuaSiswa()
    {
        $sql = "SELECT * FROM {$this->nama_table} LEFT JOIN spp ON spp.id_spp = {$this->nama_table}.id_spp LEFT JOIN kelas ON kelas.id_kelas = {$this->nama_table}.id_kelas";
        $query = $this->query($sql);
        return $query;
    }

    function tambahSiswa($nisn, $nis, $nama, $id_kelas, $alamat, $no_telp, $id_spp, $password)
    {
        $query = "INSERT INTO {$this->nama_table} VALUES('{$this->escapeString($nisn)}', '{$this->escapeString($nis)}', '{$this->escapeString($nama)}', '{$this->escapeString(md5($password))}', '{$this->escapeString($id_kelas)}', '{$this->escapeString($alamat)}', '{$this->escapeString($no_telp)}', '{$this->escapeString($id_spp)}')";
        return $this->query($query);
    }

    function hapusSiswa($nisn)
    {
        $query = "DELETE FROM {$this->nama_table} WHERE nisn = '{$this->escapeString($nisn)}'";
        return $this->query($query);
    }

    function getSiswaByNisn($nisn)
    {
        $sql = "SELECT * FROM {$this->nama_table} LEFT JOIN spp ON spp.id_spp = {$this->nama_table}.id_spp LEFT JOIN kelas ON kelas.id_kelas = {$this->nama_table}.id_kelas WHERE nisn = '{$this->escapeString($nisn)}'";
        $query = $this->query($sql);
        return $this->fetch_asc($query);
    }

    function updateSiswaByNisn($nisn, $nis, $nama, $id_kelas, $alamat, $no_telp, $id_spp, $password = null)
    {
        $optional = "";
        if ($password != null) $optional = ", password = '{$this->escapeString(md5($password))}'";

        $query = "UPDATE {$this->nama_table} SET nis = '{$this->escapeString($nis)}', nama = '{$this->escapeString($nama)}', id_kelas = '{$this->escapeString($id_kelas)}', alamat = '{$this->escapeString($alamat)}', no_telp = '{$this->escapeString($no_telp)}', id_spp = '{$this->escapeString($id_spp)}' {$optional} WHERE nisn = '{$this->escapeString($nisn)}' ";

        return $this->query($query);
    }

    function isExistNISN($nisn)
    {
        $sql = "SELECT * FROM {$this->nama_table} WHERE nisn = '{$this->escapeString($nisn)}'";
        $query = $this->query($sql);
        return $this->num_row($query) > 0;
    }

    /**
     * Generate laporan tagihan berdasarkan kelas, bulan, tahun
     */
    function getTagihanUntukLaporan($kelas, $bulan, $tahun)
    {
        $optional = "";
        if($kelas != -1) $optional = " WHERE {$this->nama_table}.id_kelas = '{$kelas}'";

        $sql = "SELECT *, {$this->nama_table}.nisn AS nisn_siswa FROM {$this->nama_table} 
                LEFT JOIN pembayaran ON {$this->nama_table}.nisn = pembayaran.nisn AND pembayaran.bulan_bayar = '{$bulan}' AND pembayaran.tahun_bayar = '{$tahun}' 
                {$optional} ORDER BY siswa.nama
            ";
        $query = $this->query($sql);
        return $query;
    }

    function cariSiswa($namSiswa)
    {
        $sql = "SELECT 
                    siswa.*,
                    kelas.nama_kelas,
                    jurusan.inisial,
                    spp.id_spp 
                FROM 
                    siswa 
                    LEFT JOIN kelas ON kelas.id_kelas = siswa.id_kelas 
                    LEFT JOIN jurusan ON jurusan.id = kelas.kompetensi_keahlian
                    LEFT JOIN spp ON spp.id_spp = siswa.id_spp 
                WHERE 
                    nama like '{$namSiswa}%'";
        $query = $this->query($sql);
        return $query;
    }
}
