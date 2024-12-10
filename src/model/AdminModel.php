<?php

namespace src;

use framework\Model;
use PDO;

class AdminModel extends Model
{
    function getTablePrestasiNotInDiprosesAdmin()
    {
        $sql = "SELECT p.idPrestasi, p.tanggalPengajuan,m.nama AS mahasiswa ,p.namaLomba,p.bidang,p.jenis,d.nama as dosen,p.tingkat,p.poin,p.status FROM prestasi p INNER JOIN mahasiswa m ON m.nim=p.nimMahasiswa INNER JOIN dosen d ON d.nip=p.nipDosenPembimbing
                WHERE p.status = 'ditolak' OR p.status='diterimaAdmin' ORDER BY idPrestasi ASC";
        $stmt = $this->_dbConnection->prepare($sql);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    function getTableDiterimaDosen()
    {
        $stmt = $this->_dbConnection->prepare("SELECT p.idPrestasi, p.tanggalPengajuan, p.waktu,m.nama AS mahasiswa ,p.namaLomba,p.bidang,p.jenis,d.nama as dosen,p.tingkat,p.poin,p.status,p.sertifikatPath,p.suratTugasPath,p.dokumentasiPath FROM prestasi p 
                INNER JOIN mahasiswa m ON m.nim=p.nimMahasiswa INNER JOIN dosen d ON d.nip=p.nipDosenPembimbing
                WHERE p.status='diterimaDosen' ORDER BY idPrestasi ASC");
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }


    function getDataChart()
    {
        $chart = $this->_dbConnection->prepare(("SELECT 
            COUNT(CASE WHEN m.namaProdi = 'Teknik Informatika' THEN 1 END) AS TeknikInformatika,
            COUNT(CASE WHEN m.namaProdi = 'Sistem Informasi Bisnis' THEN 1 END) AS SistemInformasiBisnis
            FROM prestasi p INNER JOIN mahasiswa m ON p.nimMahasiswa = m.nim;"));
        $success = $chart->execute();
        if ($success) {
            return $chart->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    function getDetailPrestasi($idPrestasi)
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM prestasi WHERE idPrestasi = :value1");
        $stmt->bindParam(':value1', $idPrestasi);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];

    }

    function getTingkat()
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM tingkat");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getKategori()
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM kategori");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editKategoriAndTingkat($table, $process, $name, $id = 0)
    {   
        if ($process == 'tambah') {
            $nameColumn = 'nama'.ucwords($table); 
            $sql = "INSERT INTO $table ($nameColumn) VALUES (:nama)";
            $stmt = $this->_dbConnection->prepare($sql);
            $stmt->bindParam(':nama', $name);
        } else if ($process == 'hapus') {
            $nameColumn = 'id'.$table; 
            $sql = "DELETE FROM $table WHERE $nameColumn = :id";
            $stmt = $this->_dbConnection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            return json_encode(["status" => "error", "message" => "Proses tidak valid"]);
        }

        $result = $stmt->execute();

        if ($result) {
            $message = $process == 'tambah' ? "Opsi berhasil ditambah" : "Opsi berhasil dihapus";
            return json_encode(["status" => "success", "message" => $message]);
        } else {
            $message = $process == 'tambah' ? "Tambah opsi gagal!" : "Hapus opsi gagal!";
            return json_encode(["status" => "error", "message" => $message]);
        }
    }

    function kelolaPrestasi($idPrestasi, $poin, $status, $keterangan)
    {
        if ($status === 'diterimaAdmin') {
            $sql = "UPDATE prestasi SET poin = ($poin), status='diterimaAdmin' WHERE idPrestasi = ($idPrestasi)";
            $result = $this->_dbConnection->query($sql);

            if ($result->rowCount() != 0) {
                return json_encode(["status" => "success", "message" => "Prestasi Berhasil Diterima"]);
            } else {
                return json_encode(["status" => "error", "message" => "Prestasi Gagal Diterima"]);
            }
        } else if ($status === 'ditolak') {
            $sql = "UPDATE prestasi SET poin = ($poin), status='ditolak', keterangan = ('$keterangan') WHERE idPrestasi = ($idPrestasi)";
            $result = $this->_dbConnection->query($sql);

            if ($result->rowCount() != 0) {
                return json_encode(["status" => "success", "message" => "Prestasi Berhasil Ditolak"]);
            } else {
                return json_encode(["status" => "error", "message" => "Prestasi Gagal Ditolak"]);
            }
        }
    }


}