<?php

namespace framework;

use PDO;
use PDOException;
class Model
{
    protected $_dbConnection;

    public function __construct()
    {
        try {
            //$serverName = "REEE\\sqlexpress";
            //$serverName = "LAPTOP-0H3EPKAS\SQLEXPRESS"; 
            $serverName = "LAPTOP-MLPOEBU2\SQLEXPRESS";
            //$serverName = "DESKTOP-RF6CM3D\SQLEXPRESS";
            //$serverName = "ABDUL\SQLEXPRESS";
            $database = "SistemPrestasi";

            // DSN (Data Source Name) untuk koneksi PDO
            $dsn = "sqlsrv:Server=$serverName;Database=$database";
            // koneksi menggunakan PDO
            $this->_dbConnection = new PDO($dsn);
            // PDO agar melempar exception jika terjadi error
            $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Koneksi Gagal.<br />";
            die("Error: " . $e->getMessage());
        }
    }
}

