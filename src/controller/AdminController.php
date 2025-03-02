<?php

namespace src;

use framework\Controller;
use framework\View;
require_once 'src/model/AdminModel.php';

class AdminController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new AdminModel();
    }

    public function beranda()
    {
        $table = $this->_model->getTablePrestasiNotInDiprosesAdmin();
        $chart = $this->_model->getDataChart();
        $TAChart = $this->_model->getTAChart();
        $this->view->setData(['prestasi' => $table, 'chart' => $chart, 'TAChart' => $TAChart]);

        $this->view->setTemplate('template/admin/berandaAdmin_template.php');
        $this->view->render();
    }

    public function informasi()
    {
        $this->view->setTemplate('template/admin/informasiAdmin_template.php');
        $this->view->render();
    }

    public function detailPrestasi()
    {
        $prestasi = $this->_model->getPrestasi($_GET['idPrestasi']);
        $this->view->setData(['prestasi' => $prestasi]);
        $this->view->setTemplate('template/admin/detailPrestasiAdmin_template.php');
        $this->view->render();
    }

    public function pengajuan()
    {
        $prestasi = $this->_model->getTableDiterimaDosen();
        $this->view->setData(['prestasi' => $prestasi]);
        $this->view->setTemplate('template/admin/pengajuanAdmin_template.php');
        $this->view->render();
    }

    public function kelolaPrestasi()
    {   
        $data = $_POST;
        if (isset($data['action'])) {
            $poin = htmlspecialchars($data['poin']);
            $idPrestasi = htmlspecialchars($data['idPrestasi']);
            $status = htmlspecialchars($data['status']);
            $keterangan = htmlspecialchars($data['keterangan']);
            echo $this->_model->kelolaPrestasi($idPrestasi,$poin,$status,$keterangan);
        }
        exit;
    }

    public function pengaturan()
    {
        $tingkat = $this->_model->getTingkat();

        $kategori = $this->_model->getKategori();
        $this->view->setData(['tingkat' => $tingkat, 'kategori' => $kategori]);
        $this->view->setTemplate('template/admin/pengaturanAdmin_template.php');
        $this->view->render();
    }

    public function editKategoriAndTingkat() {
        $data=$_POST;

        if (isset($data['process'])) {
            $table = htmlspecialchars($data['table']);
            $process = htmlspecialchars($data['process']);
            $name = htmlspecialchars($data['name']);
            $id = htmlspecialchars($data['id']);
            $poin = isset($data['poin']) ? htmlspecialchars($data['poin']) : NULL;
            echo $this->_model->editKategoriAndTingkat( $table,$process,$name,$id, $poin);
        }
        exit;
    }

    public function kontrolAkun() {
        $antrian = $this->_model->getAkunPending();

        $this->view->setData(['antrian' => $antrian]);
        $this->view->setTemplate('template/admin/kontrolAkun_template.php');
        $this->view->render();
    }

    public function kelolaAkun()
    {   
        $data = $_POST;
        if (isset($data['action'])) {
            $username = htmlspecialchars($data['username']);
            $status = htmlspecialchars($data['status']);
            echo $this->_model->kelolaAkun($username,$status);
        }
        exit;
    }
}

?>