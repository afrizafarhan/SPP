<?php
class Spp extends Koneksi
{
    private $nama_tabel = 'spp';
    function inputSpp($tahun, $nominal)
    {
        /**
         * Ini bagian yang menangani sql injection
         */
        $tahun = $this->escapeString($tahun);
        $nominal = $this->escapeString($nominal);

        /**
         * Ini bagian  proses menambahkan data ke dalam database
         */
        $sql = "INSERT INTO {$this->nama_tabel}(tahun,nominal) VALUES('{$tahun}','{$nominal}')";
        $query = $this->query($sql);
        return $query;
    }

    function deleteSpp($id)
    {
        $id = $this->escapeString($id);
        $sql = "DELETE FROM {$this->nama_tabel} WHERE id_spp = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function updateSpp($tahun,$nominal,$id)
    {
        $id = $this->escapeString($id);
        $tahun = $this->escapeString($tahun);
        $nominal = $this->escapeString($nominal);

        $sql = "UPDATE {$this->nama_tabel} SET tahun = '{$tahun}',nominal='{$nominal}' WHERE id_spp = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function getSpp()
    {
        /**
         * Ini bagian yang berfungsi mengambil data dari database
         */
        $sql = "SELECT * FROM {$this->nama_tabel}";
        $query = $this->query($sql);
        return $query;
    }

    function getDataById($id)
    {
        $id = $this->escapeString($id);
        $sql = "SELECT * FROM {$this->nama_tabel} WHERE id_spp = $id";
        $query = $this->query($sql);
        return $query;
    }
}
