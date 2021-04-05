<?php

class JenisPembayaran extends Koneksi
{

    /**
     * $this->escapeString() ini merupakan function yang terdapat pada kelas koneksi
     * yang befungsi menangani sql injection
     */
    private $nama_tabel = 'jenis_pembayaran';
    function inputJenisPembayaran($jenis_pembayaran)
    {
        /**
         * Ini bagian yang menangani sql
         */
        $jenis_pembayaran = $this->escapeString($jenis_pembayaran);

        $sql = "INSERT INTO {$this->nama_tabel}(jenis_pembayaran) VALUES('{$jenis_pembayaran}')";
        $query = $this->query($sql);
        return $query;
    }

    function deleteJenisPembayaran($id)
    {
        /**
         * Ini bagian yang menangani sql injection
         */
        $id = $this->escapeString($id);
        /**
         * Proses Delete data Jurusan berdasarkan id_Jurusan
         */
        $sql = "DELETE FROM {$this->nama_tabel} WHERE id = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function updateJenisPembayaran($jenis_pembayaran,$id)
    { 
        /**
         * Ini bagian yang menangani sql injection
         */
        $jenis_pembayaran = $this->escapeString($jenis_pembayaran);
        $id = $this->escapeString($id);
        /**
         * Ini merupakan bagian proses update data Jurusan
         * yang mana ada akan diupdate berdasarkan id_Jurusan
         */
        $sql = "UPDATE {$this->nama_tabel} SET jenis_pembayaran = '{$jenis_pembayaran}' WHERE id = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function getDataById($id)
    {
        /**
         * Ini bagian yang menangani sql injection
         */
        $id = $this->escapeString($id);
        $sql = "SELECT * FROM {$this->nama_tabel} WHERE id = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function getJenisPembayaran()
    {
        $sql = "SELECT * FROM {$this->nama_tabel}";
        $query = $this->query($sql);
        return $query;
    }
}
