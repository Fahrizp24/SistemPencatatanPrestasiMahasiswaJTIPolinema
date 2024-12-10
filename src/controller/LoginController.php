<?php

namespace src;

use framework\Controller;
use framework\View;
require_once 'src/model/LoginModel.php';
class LoginController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new LoginModel();
    }

    public function index()
    {
        $data = $_POST;

        if (isset($data['login'])) {
            $username = htmlspecialchars($data['username']);
            $password = htmlspecialchars($data['password']);

            echo $this->_model->login($username, $password);
            exit;
        }

        // Data untuk ditampilkan di tabel. Terlepas ada submit atau tidak
        // $daftarKontak = $this->_model->ambilSemuaKontak();
        // $this->view->setData(['daftarKontak' => $daftarKontak]);

        $this->view->setTemplate('template/login_template.php');
        $this->view->render();
    }

    public function logout() {
        echo $this->_model->logout();
        exit;
    }
    
}
