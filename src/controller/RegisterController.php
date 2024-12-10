<?php

namespace src;

use framework\Controller;
use framework\View;

require_once 'src/model/RegisterModel.php';

class RegisterController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new RegisterModel();
    }

    public function index()
    {
        $data = $_POST;
        if (isset($data['action']) && $data['action'] === 'register') {
            $username = htmlspecialchars($data['username']);
            $password = htmlspecialchars($data['password']);
            $role = $data['role'];
            $nama = htmlspecialchars($data['nama']);
            $prodi = $data['prodi'];
            $email = htmlspecialchars($data['email']);
            
            $this->_model->register(
                $data['username'],
                $data['password'], 
                $data['role'],         
                $data['nama'],
                $data['prodi'],
                $data['email']      
            );
        }

        // Data untuk ditampilkan di tabel. Terlepas ada submit atau tidak
        // $daftarKontak = $this->_model->ambilSemuaKontak();

        $this->view->setTemplate('template/register_template.php');
        // $this->view->setData(['daftarKontak' => $daftarKontak]);
        $this->view->render();
    }
}

