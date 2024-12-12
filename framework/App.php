<?php

namespace framework;

class App
{
    private $_routes;

    public function __construct()
    {
        $this->_routes = [];
    }

    public function setRoutes($routes)
    {
        $this->_routes = $routes;
    }

    public function run()
    {
        // $controller = new BerandaController();
        // $controller->index();

        $route = $this->_findRoute(); // 'BerandaController@index'

        $split = explode('@', $route); // ['BerandaController', 'index']

        $controllerName = $split[0]; // 'BerandaController'
        $methodName = $split[1]; // 'index'

        // Controller punya namespace
        $controllerName = 'src\\' . $controllerName;

        $controller = new $controllerName();

        $controller->$methodName();
    }

    private function _findRoute()
    {
        // Ambil URL yang diminta user, hanya bagian path tanpa query string
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Cari controller yang sesuai
        foreach ($this->_routes as $route => $controllerMethod) {
            // Cocokkan URL dengan rute yang terdaftar
            if ($route === $url) {
                return $controllerMethod; // Contoh: 'BerandaController@index'
            }
        }

        // Jika rute tidak ditemukan, tampilkan pesan 404
        die('<h1>[FrameWork Kite ni BOSZZZ] 404 Not Found</h1>');
    }

}