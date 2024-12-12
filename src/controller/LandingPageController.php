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
        $newsData = $this->_model->getNewsData();
        $leaderboard = $this->_model->getLeaderboard();

        $this->view->setData([
            'newsData' => $newsData,
            'leaderboard'=> $leaderboard
        ]);

        $this->view->setTemplate('template/landingPage_template.php');
        $this->view->render();
    }
}
