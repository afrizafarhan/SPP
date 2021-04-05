<?php

class Jurusan extends Koneksi
{

    /**
     * $this->escapeString() ini merupakan function yang terdapat pada kelas koneksi
     * yang befungsi menangani sql injection
     */
    private $nama_tabel = 'jurusan';
    function inputJurusan($jurusan,$inisial)
    {
        /**
         * Ini bagian yang menangani sql
         */
        $jurusan = $this->escapeString($jurusan);
        $inisial = $this->escapeString($inisial);

        $sql = "INSERT INTO {$this->nama_tabel}(jurusan,inisial) VALUES('{$jurusan}','{$inisial}')";
        $query = $this->query($sql);
        return $query;
    }

    function deleteJurusan($id)
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

    function updateJurusan($jurusan,$inisial,$id)
    { 
        /**
         * Ini bagian yang menangani sql injection
         */
        $jurusan = $this->escapeString($jurusan);
        $inisial = $this->escapeString($inisial);
        $id = $this->escapeString($id);
        /**
         * Ini merupakan bagian proses update data Jurusan
         * yang mana ada akan diupdate berdasarkan id_Jurusan
         */
        $sql = "UPDATE {$this->nama_tabel} SET jurusan = '{$jurusan}',inisial = '{$inisial}' WHERE id = '{$id}'";
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

    function getJurusan()
    {
        $sql = "SELECT * FROM {$this->nama_tabel}";
        $query = $this->query($sql);
        return $query;
    }
}
