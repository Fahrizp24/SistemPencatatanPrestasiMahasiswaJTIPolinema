<?php

namespace src;

use framework\Controller;
use framework\View;
require_once 'src/model/MahasiswaModel.php';
class MahasiswaController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new MahasiswaModel();
    }

    private function addGlobalData()
    {
        return $this->_model->getAkun($_SESSION['session_username']);    
    }

    public function beranda()
    {
        $status = $this->_model->getStatus($_SESSION['session_username']);
        $daftarPrestasi = $this->_model->getTableMahasiswa();

        $info = $this->addGlobalData();
        $this->view->setData([
            'status' => $status[0],
            'daftarPrestasi' => $daftarPrestasi,
            'info' => $info
        ]);

        $this->view->setTemplate('template/mahasiswa/berandaMahasiswa_template.php');
        $this->view->render();
    }

    public function pengajuan()
    {
        $kategori = $this->_model->getKategori();
        $tingkat = $this->_model->getTingkat();
        $info = $this->addGlobalData();

        $this->view->setData([
            'kategori' => $kategori,
            'tingkat' => $tingkat,
            'info' => $info
        ]);

        $this->view->setTemplate('template/mahasiswa/pengajuanMahasiswa_template.php');
        $this->view->render();
    }
    public function getDosen()
    {
        $data = $_POST;

        if (isset($data['nip'])) {
            $nip = htmlspecialchars($data['nip']); // Sanitasi input
            echo $this->_model->getDosen($nip);
        }
        exit;
    }

    public function submitPengajuan()
    {
        $data = $_POST;
        if (isset($data['pengajuan'])) {
            $namaLomba = htmlspecialchars($data['namaLomba']);
            $waktu = htmlspecialchars($data['waktu']);
            $penyelenggara = htmlspecialchars($data['penyelenggara']);
            $bidang = htmlspecialchars($data['bidang']);
            $tingkat = htmlspecialchars($data['tingkat']);
            $nipDosenPembimbing = htmlspecialchars($data['nipDosenPembimbing']);
            $kategori = htmlspecialchars($data['kategori']);
            $nimMahasiswa = $_SESSION['session_username'];

            echo $this->_model->pengajuan($namaLomba, $tingkat, $kategori, $waktu, $penyelenggara, $bidang, $nipDosenPembimbing, $nimMahasiswa);

            // Kembalikan JSON respons ke client
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data pengajuan tidak valid']);
        }
        exit; // Mengakhiri eksekusi setelah memberikan respons
    }



    public function profil()
    {
        $info = $this->addGlobalData();
        $profile = $this->_model->getMahasiswa($_SESSION['session_username']);
        $foto = $this->_model->getPhotoProfilePath($_SESSION['session_username']);
        $this->view->setData([
            'profile' => $profile,
            'foto'=> $foto,
            'info' => $info
        ]);
        $this->view->setTemplate('template/mahasiswa/profilMahasiswa_template.php');
        $this->view->render();
    }

    public function detailPrestasi()
    {
        $info = $this->addGlobalData();
        $prestasi = $this->_model->getPrestasi($_GET['idPrestasi']);
        $this->view->setData([
            'prestasi' => $prestasi,
            'info' => $info    
        ]);
        $this->view->setTemplate('template/mahasiswa/detailPrestasi_template.php');
        $this->view->render();
    }

    public function updateProfil() {
        $data = $_POST;
        if ( $data['updateProfil']) {
            $nim = $_SESSION['session_username'];
            $nama = htmlspecialchars($data['nama']);
            $email = htmlspecialchars($data['email']);     
            echo  $this->_model->updateProfil($nim, $nama, $email);
        }
    }

}

