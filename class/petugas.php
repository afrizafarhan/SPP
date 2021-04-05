<?php
class Petugas extends Koneksi
{
    private $nama_table = 'petugas';

    function login($username, $password)
    {

        $sql = "SELECT * FROM {$this->nama_table} WHERE username = '{$this->escapeString($username)}'  AND password = '{$this->escapeString(MD5($password))}'";
        $query = $this->query($sql);
        $data = $this->fetch_arr($query);
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['ID'] = $data['id_petugas'];
            $_SESSION['LEVEL'] = $data['level'];
            $_SESSION['nama_petugas'] = $data['nama_petugas'];
            header('location:halaman/dashboard.php');
            return true;
        }else{
            return false;
        }
    }

    function getSemuaPetugas(){
        $sql = "SELECT * FROM {$this->nama_table}";
        $query = $this->query($sql);
        return $query;
    }

    function tambahPetugas($username, $password, $nama, $level){
        $query = "INSERT INTO petugas(username, password, nama_petugas, level) VALUES('{$this->escapeString($username)}', '{$this->escapeString(md5($password))}', '{$this->escapeString($nama)}', '{$this->escapeString($level)}')";
        return $this->query($query);
    }

    function hapusPetugas($id){
        $query = "DELETE FROM petugas WHERE id_petugas = '{$this->escapeString($id)}'";
        return $this->query($query);
    }

    function getPetugasById($id){
        $sql = "SELECT * FROM petugas WHERE id_petugas = '{$this->escapeString($id)}'";
        $query = $this->query($sql);
        return $this->fetch_asc($query);
    }

    function updatePetugasById($id, $username, $nama, $level, $password = null){
        $optional = "";
        if($password != null) $optional = ", password = '{$this->escapeString(md5($password))}'";

        $query = "UPDATE petugas SET username = '{$this->escapeString($username)}', nama_petugas = '{$this->escapeString($nama)}', level = '{$this->escapeString($level)}' {$optional} WHERE id_petugas = '{$this->escapeString($id)}'";

        return $this->query($query);
    }

    function isExistUsername($username){
        $sql = "SELECT * FROM {$this->nama_table} WHERE username = '{$this->escapeString($username)}'";
        $query = $this->query($sql);
        return $this->num_row($query) > 0;
    }
}
