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

    public function beranda()
    {
        $status = $this->_model->getStatus($_SESSION['session_username']);
        $daftarPrestasi = $this->_model->getTableMahasiswa();

        $this->view->setData([
            'status' => $status[0],
            'daftarPrestasi' => $daftarPrestasi
        ]);

        $this->view->setTemplate('template/mahasiswa/berandaMahasiswa_template.php');
        $this->view->render();
    }

    public function pengajuan()
    {
        $kategori = $this->_model->getKategori();
        $tingkat = $this->_model->getTingkat();

        $this->view->setData([
            'kategori' => $kategori,
            'tingkat' => $tingkat
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
        $profile = $this->_model->getMahasiswa($_SESSION['session_username']);
        $this->view->setData(['profile' => $profile]);
        $this->view->setTemplate('template/mahasiswa/profilMahasiswa_template.php');
        $this->view->render();
    }

    public function detailPrestasi()
    {
        $prestasi = $this->_model->getPrestasi($_GET['idPrestasi']);
        $this->view->setData(['prestasi' => $prestasi]);
        $this->view->setTemplate('template/mahasiswa/detailPrestasi_template.php');
        $this->view->render();
    }

    public function updateProfil() {
        $data = $_POST;
        if ( $data['updateProfil']) {
            $username = htmlspecialchars($data['username']);
            $nama = htmlspecialchars($data['nama']);
            $email = htmlspecialchars($data['email']);        
            echo  $this->_model->updateProfil($username, $nama, $email);
        }
    }

}

