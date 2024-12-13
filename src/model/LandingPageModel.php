<?php

namespace src;

use framework\Model;
use PDO;
use PDOException;

class landingPageModel extends Model
{
    function getLeaderBoard() {
        $sql = "SELECT
                    m.nama,
                    m.namaProdi,
                    SUM(p.poin) total_poin
                FROM
                    mahasiswa m
                JOIN
                    prestasi p
                ON
                    m.nim = p.nimMahasiswa
                GROUP BY 
                    nama, namaProdi
                ORDER BY
                    total_poin DESC
                ";
        
        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getNewsData() {
        $sql = "SELECT TOP 1
                    p.namaLomba,
                    m.nama,
                    p.waktu,
                    p.bidang,
                    p.dokumentasiPath
                FROM
                    prestasi p
                JOIN
                    mahasiswa m
                ON
                    p.nimMahasiswa = m.nim
                WHERE
                    p.status = 'diterimaAdmin' AND p.jenis = 'Juara 1'
                ORDER BY
                    p.idPrestasi DESC";

        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}