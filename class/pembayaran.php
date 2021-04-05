<?php
class Pembayaran extends Koneksi
{
    private $nama_tabel = 'pembayaran';
    function tambahPembayaran($id_petugas, $nisn, $bulan, $tahun, $id_spp, $jumlah_bayar)
    {
        /**
         * Dapatkan Tanggal Hari ini
         */
        date_default_timezone_set('Asia/Jakarta');
        $tgl_bayar = date('Y-m-d');

        /**
         * Ini bagian yang menangani sql injection
         */
        $id_petugas = $this->escapeString($id_petugas);
        $nisn = $this->escapeString($nisn);
        $bulan = $this->escapeString($bulan);
        $tahun = $this->escapeString($tahun);
        $jumlah_bayar = $this->escapeString($jumlah_bayar);

        /**
         * Ini bagian  proses menambahkan data ke dalam database
         */
        $sql = "INSERT INTO {$this->nama_tabel}(id_petugas, nisn, tgl_bayar, bulan_bayar, tahun_bayar, id_spp, jumlah_bayar) VALUES('{$id_petugas}','{$nisn}','{$tgl_bayar}','{$bulan}','{$tahun}', '{$id_spp}', '{$jumlah_bayar}')";
        $query = $this->query($sql);
        return $query;
    }

    function hapusPembayaran($id)
    {
        $id = $this->escapeString($id);
        $sql = "DELETE FROM {$this->nama_tabel} WHERE id_pembayaran = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function updatePembayaranById($id_pembayaran, $nisn, $bulan, $tahun, $id_spp, $jumlah_bayar)
    {
        $id_pembayaran = $this->escapeString($id_pembayaran);
        $nisn = $this->escapeString($nisn);
        $bulan = $this->escapeString($bulan);
        $tahun = $this->escapeString($tahun);
        $id_spp = $this->escapeString($id_spp);
        $jumlah_bayar = $this->escapeString($jumlah_bayar);

        $sql = "UPDATE {$this->nama_tabel} SET nisn = '{$nisn}', bulan_bayar = '{$bulan}', tahun_bayar = '{$tahun}', jumlah_bayar = '{$jumlah_bayar}', id_spp = '{$id_spp}' WHERE id_pembayaran = '{$id_pembayaran}'";
        $query = $this->query($sql);
        return $query;
    }

    function getSemuaPembayaran()
    {
        /**
         * Ini bagian yang berfungsi mengambil data dari database
         */
        $sql = "SELECT * FROM {$this->nama_tabel} 
                LEFT JOIN petugas ON {$this->nama_tabel}.id_petugas = petugas.id_petugas
                LEFT JOIN siswa ON {$this->nama_tabel}.nisn = siswa.nisn
                LEFT JOIN spp ON {$this->nama_tabel}.id_spp = spp.id_spp";
        $query = $this->query($sql);
        return $query;
    }

    function getSemuaPembayaranByKelas($id_kelas)
    {
        /**
         * Ini bagian yang berfungsi mengambil data dari database
         */
        $sql = "SELECT * FROM {$this->nama_tabel} 
                LEFT JOIN petugas ON {$this->nama_tabel}.id_petugas = petugas.id_petugas
                LEFT JOIN siswa ON {$this->nama_tabel}.nisn = siswa.nisn
                LEFT JOIN spp ON {$this->nama_tabel}.id_spp = spp.id_spp 
                LEFT JOIN kelas on kelas.id_kelas = siswa.id_kelas
                WHERE siswa.id_kelas = {$id_kelas}
            ";
        $query = $this->query($sql);
        return $query;
    }

    function getPembayaranById($id)
    {
        $id = $this->escapeString($id);
        $sql = "SELECT * FROM {$this->nama_tabel} WHERE id_pembayaran = $id";
        $query = $this->query($sql);
        return $this->fetch_asc($query);
    }

    /**
     * Mendapatkan data pembayaran siswa sesuai NISN
     */
    function getSemuaPembayaranByNisn($nisn)
    {
        $sql = "SELECT * FROM {$this->nama_tabel} 
                LEFT JOIN petugas ON {$this->nama_tabel}.id_petugas = petugas.id_petugas
                LEFT JOIN spp ON {$this->nama_tabel}.id_spp = spp.id_spp 
                WHERE {$this->nama_tabel}.nisn = {$nisn}
            ";
        $query = $this->query($sql);
        return $query;
    }
}
