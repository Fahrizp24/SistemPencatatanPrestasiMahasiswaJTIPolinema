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
        $this->view->setTemplate('template/register_template.php');
        $this->view->render();
    }

    public function register()
    {
        $data = $_POST;
        if (isset($data['action'])) {
            $username = htmlspecialchars($data['username']);
            $password = htmlspecialchars($data['password']);
            $role = $data['role'];
            $nama = htmlspecialchars($data['nama']);
            $prodi = $data['prodi'];
            $email = htmlspecialchars($data['email']);
            
            echo $this->_model->register(
                $data['username'],
                $data['password'], 
                $data['role'],         
                $data['nama'],
                $data['prodi'],
                $data['email']      
            );
        }
    }
}

