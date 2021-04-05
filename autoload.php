<?php
session_start();
$BASE_URL = 'http://' . $_SERVER['HTTP_HOST'] . '/spp/';
$folder = 'class/';
include_once $folder.'koneksi.php';
include_once $folder.'petugas.php';
include_once $folder.'siswa.php';
include_once $folder.'spp.php';
include_once $folder.'kelas.php';
include_once $folder.'jurusan.php';
include_once $folder.'jenis_pembayaran.php';
include_once $folder.'pembayaran.php';
?>