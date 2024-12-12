<?php

namespace src;

use framework\Controller;
use framework\View;

require_once 'src/model/DosenModel.php';

class DosenController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new DosenModel();
    }


    public function beranda()
    {
        $table = $this->_model->getTablePrestasiNotInDiproses();
        $this->view->setData(['table' => $table]);

        $this->view->setTemplate('template/dosen/berandaDosen_template.php');
        $this->view->render();
    }

    public function profil()
    {
        $profile = $this->_model->getDosen($_SESSION['session_username']);
        $foto = $this->_model->getPhotoProfilePath($_SESSION['session_username']);
        $this->view->setData([
            'profile' => $profile,
            'foto' => $foto
        ]);
        $this->view->setTemplate('template/dosen/profilDosen_template.php');
        $this->view->render();
    }

    public function permintaan()
    {
        $prestasi = $this->_model->getTablePrestasiDiproses($_SESSION['session_username']);
        $this->view->setData(['prestasi' => $prestasi]);
        $this->view->setTemplate('template/dosen/permintaanDosen_template.php');
        $this->view->render();
    }

    public function riwayatPrestasi()
    {
        $prestasi = $this->_model->getRiwayatPrestasi($_GET['idPrestasi']);
        $this->view->setData(['prestasi' => $prestasi]);
        $this->view->setTemplate('template/dosen/riwayatPrestasiDosen_template.php');
        $this->view->render();
    }

    public function updateStatusByDosen(){   
        $data = $_POST;
        $idPrestasi = htmlspecialchars($data['idPrestasi']);
        $status = htmlspecialchars($data['status']);
        $keterangan = htmlspecialchars($data['keterangan']);
        echo $this->_model->updateStatusByDosen($idPrestasi,$status,$keterangan);
    
    }

    public function updateProfil() {
        $data = $_POST;
        if ($data['updateProfil']) {
            $nip = $_SESSION['session_username'];
            $nama = htmlspecialchars($data['nama']);
            $email = htmlspecialchars($data['email']);        
            echo $this->_model->updateProfil($nip, $nama, $email);
        }
    }
}

?>