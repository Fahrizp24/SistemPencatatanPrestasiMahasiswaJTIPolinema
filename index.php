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
require_once 'src/controller/LandingPageController.php';
require_once 'src/controller/MahasiswaController.php';
require_once 'src/controller/DosenController.php';
require_once 'src/controller/AdminController.php';

use framework\App;

$app = new App();

// Atur routes-nya
$app->setRoutes([
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/' => 'LandingPageController@index',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/logout' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/LoginController' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/index' => 'LoginController@index',   
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/login' => 'LoginController@index',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/register' => 'RegisterController@index',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/registerAkun' => 'RegisterController@register',

    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaMahasiswa' => 'MahasiswaController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/detailPrestasiMahasiswa' => 'MahasiswaController@detailPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanMahasiswa' => 'MahasiswaController@pengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/getDosen' => 'MahasiswaController@getDosen',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/submitPengajuan' => 'MahasiswaController@submitPengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/profilMahasiswa' => 'MahasiswaController@profil',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/updateProfilMhs' => 'MahasiswaController@updateProfil',


    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaDosen' => 'DosenController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/profilDosen' => 'DosenController@profil',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/permintaanDosen' => 'DosenController@permintaan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/riwayatPrestasiDosen' => 'DosenController@riwayatPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/teruskanDosen' => 'DosenController@updateStatusByDosen',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/tolakDosen' => 'DosenController@updateStatusByDosen',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/updateProfilDsn' => 'DosenController@updateProfil',

    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/berandaAdmin' => 'AdminController@beranda',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/detailPrestasiAdmin' => 'AdminController@detailPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/informasiAdmin' => 'AdminController@informasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanAdmin' => 'AdminController@pengajuan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengajuanAdmin/kelolaPrestasi' => 'AdminController@kelolaPrestasi',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/kontrolAkunAdmin' => 'AdminController@kontrolAkun',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/kontrolAkunAdmin/kelolaAkun' => 'AdminController@kelolaAkun',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/pengaturanAdmin' => 'AdminController@pengaturan',
    '/SistemPencatatanPrestasiMahasiswaJTIPolinema/editTingkatAndKategori' => 'AdminController@editTable'

    
]);


$app->run();