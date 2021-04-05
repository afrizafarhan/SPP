<?php

class Kelas extends Koneksi
{

    /**
     * $this->escapeString() ini merupakan function yang terdapat pada kelas koneksi
     * yang befungsi menangani sql injection
     */
    private $nama_tabel = 'kelas';
    function inputKelas($nama_kelas, $kompetensi_keahlian)
    {
        /**
         * Ini bagian yang menangani sql
         */
        $nama_kelas = $this->escapeString($nama_kelas);
        $kompetensi_keahlian = $this->escapeString($kompetensi_keahlian);

        $sql = "INSERT INTO {$this->nama_tabel}(nama_kelas,kompetensi_keahlian) VALUES('{$nama_kelas}','{$kompetensi_keahlian}')";
        $query = $this->query($sql);
        return $query;
    }

    function deleteKelas($id)
    {
        /**
         * Ini bagian yang menangani sql injection
         */
        $id = $this->escapeString($id);
        /**
         * Proses Delete data kelas berdasarkan id_kelas
         */
        $sql = "DELETE FROM {$this->nama_tabel} WHERE id_kelas = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function updateKelas($nama_kelas,$kompetensi_keahlian,$id)
    { 
        /**
         * Ini bagian yang menangani sql injection
         */
        $nama_kelas = $this->escapeString($nama_kelas);
        $kompetensi_keahlian = $this->escapeString($kompetensi_keahlian);
        $id = $this->escapeString($id);
        /**
         * Ini merupakan bagian proses update data kelas
         * yang mana ada akan diupdate berdasarkan id_kelas
         */
        $sql = "UPDATE {$this->nama_tabel} SET nama_kelas = '{$nama_kelas}',kompetensi_keahlian = '{$kompetensi_keahlian}'  WHERE id_kelas = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function getDataById($id)
    {
        /**
         * Ini bagian yang menangani sql injection
         */
        $id = $this->escapeString($id);
        $sql = "SELECT * FROM {$this->nama_tabel} LEFT JOIN jurusan ON {$this->nama_tabel}.kompetensi_keahlian = jurusan.id WHERE id_kelas = '{$id}'";
        $query = $this->query($sql);
        return $query;
    }

    function getKelas()
    {
        $sql = "SELECT * FROM {$this->nama_tabel}";
        $query = $this->query($sql);
        return $query;
    }

    function getKelasJoinJurusan()
    {
        $sql = "SELECT kelas.*,jurusan.inisial FROM {$this->nama_tabel}
                JOIN jurusan ON {$this->nama_tabel}.kompetensi_keahlian = jurusan.id
                ORDER BY kelas.nama_kelas,jurusan.inisial ASC
        ";
        $query = $this->query($sql);
        return $query;
    }

}
