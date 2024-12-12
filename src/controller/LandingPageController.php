<?php

namespace src;

use framework\Controller;
use framework\View;
require_once 'src/model/LandingPageModel.php';
class LandingPageController extends Controller
{
    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_model = new landingPageModel();
    }

    public function index()
    {
        $this->view->setTemplate('template/landingPage_template.php');
        $this->view->render();
    }

    public function logout() {
        echo $this->_model->logout();
        exit;
    }
    
}
