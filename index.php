<?php

// Kode untuk menampilkan semua error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'framework/App.php';
require_once 'framework/Controller.php';
require_once 'framework/View.php';
require_once 'framework/Model.php';

require_once 'src/controller/LoginController.php';
require_once 'src/controller/RegisterController.php';
require_once 'src/controller/MahasiswaController.php';
require_once 'src/controller/DosenController.php';
require_once 'src/controller/AdminController.php';

use framework\App;

$app = new App();

// Atur routes-nya
$app->setRoutes([
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/' => 'LoginController@index',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/logout' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/LoginController.php' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/index.php' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/login.php' => 'LoginController@index',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/register.php' => 'RegisterController@index',

    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaMahasiswa.php' => 'MahasiswaController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/detailPrestasiMahasiswa.php' => 'MahasiswaController@detailPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanMahasiswa.php' => 'MahasiswaController@pengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/getDosen' => 'MahasiswaController@getDosen',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/submitPengajuan' => 'MahasiswaController@submitPengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/profilMahasiswa.php' => 'MahasiswaController@profil',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/updateProfil' => 'MahasiswaController@updateProfil',


    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaDosen.php' => 'DosenController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/profilDosen.php' => 'DosenController@profil',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/permintaanDosen.php' => 'DosenController@permintaan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/riwayatPrestasiDosen.php' => 'DosenController@riwayatPrestasi',

    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaAdmin.php' => 'AdminController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/detailPrestasiAdmin.php' => 'AdminController@detailPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/informasiAdmin.php' => 'AdminController@informasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanAdmin.php' => 'AdminController@pengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanAdmin/kelolaPrestasi' => 'AdminController@kelolaPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengaturanAdmin.php' => 'AdminController@pengaturan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/editTingkatAndKategori' => 'AdminController@editTable'

    
]);


$app->run();