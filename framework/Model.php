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
            $serverName = "LAPTOP-0H3EPKAS\SQLEXPRESS"; 
            // $serverName = "LAPTOP-MLPOEBU2\SQLEXPRESS";
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

    public function getTingkat()
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM tingkat");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKategori()
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM kategori");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrestasi($idPrestasi)
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM prestasi WHERE idPrestasi = :value1");
        $stmt->bindParam(':value1', $idPrestasi);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

