<?php

namespace framework;
class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View('');
    }

    public function echoPre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
?>