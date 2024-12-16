<?php

namespace src;

use framework\Model;
use PDO;

class DosenModel extends Model
{
    
    function getAkun($username)
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM akun WHERE username = :value1");
        $stmt->bindParam(':value1', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    function getTablePrestasiNotInDiproses()
    {
        $sql = "SELECT p.idPrestasi,p.tanggalPengajuan,m.nama,p.namaLomba,p.bidang,p.jenis,p.tingkat,p.status FROM prestasi p INNER JOIN mahasiswa m ON m.nim=p.nimMahasiswa WHERE p.nipDosenPembimbing = :value1 AND p.status <> 'diproses' ORDER BY idPrestasi ASC";
        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->bindParam(':value1', $_SESSION['session_username']);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    function getTablePrestasiDiproses($nip)
    {
        $stmt = $this->_dbConnection->prepare("SELECT p.idPrestasi,p.tanggalPengajuan,m.nama,p.namaLomba,p.bidang,p.jenis,p.tingkat,p.status,p.sertifikatPath, p.dokumentasiPath, p.suratTugasPath FROM prestasi p INNER JOIN mahasiswa m ON m.nim=p.nimMahasiswa WHERE p.nipDosenPembimbing = :value1 AND p.status = 'diproses' ORDER BY idPrestasi ASC");
        $stmt->bindParam(':value1', $nip);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    function getDosen($nip)
    {
        $stmt = $this->_dbConnection->prepare("SELECT nama,nip,email,profilPath,namaJurusan FROM dosen d INNER JOIN akun a ON d.nip=a.username WHERE d.nip = :value1");
        $stmt->bindParam(':value1', $nip);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];
    }

    function getRiwayatPrestasi($idPrestasi)
    {
        $stmt = $this->_dbConnection->prepare("SELECT p.*, d.nama namaDosen FROM prestasi p INNER JOIN dosen d ON p.nipDosenPembimbing = d.nip WHERE idPrestasi = :value1");
        $stmt->bindParam(':value1', $idPrestasi);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];

    }

    function updateStatusByDosen($idPrestasi, $status, $keterangan = null)
    {
        if ($status === 'diterimaDosen') {
            $sql = "UPDATE prestasi SET status = :status WHERE idPrestasi = :idPrestasi";
            $stmt = $this->_dbConnection->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':idPrestasi', $idPrestasi, PDO::PARAM_INT);

        } else if ($status === 'ditolak') {
            $sql = "UPDATE prestasi SET status = :status, keterangan = :keterangan WHERE idPrestasi = :idPrestasi";
            $stmt = $this->_dbConnection->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':keterangan', $keterangan);
            $stmt->bindParam(':idPrestasi', $idPrestasi, PDO::PARAM_INT);
        } else {
            return json_encode(["status" => "error", "message" => "Status tidak valid"]);
        }

        $result = $stmt->execute();

        if ($result) {
            $message = $status === 'diterimaDosen' ? "Prestasi Berhasil Diterima" : "Prestasi Berhasil Ditolak";
            return json_encode(["status" => "success", "message" => $message]);
        } else {
            $message = $status === 'diterimaDosen' ? "Prestasi Gagal Diterima" : "Prestasi Gagal Ditolak";
            return json_encode(["status" => "error", "message" => $message]);
        }
    }

    function updateProfil($nip, $nama, $email)
    {
        // Validasi apakah email sudah digunakan oleh dosen lain
        $sql = "SELECT * FROM dosen WHERE email = :email AND nip <> :nip";

        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nip', $nip);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            return json_encode(["status" => "error", "message" => "Email Telah Digunakan!"]);
        }

        if ($_FILES['profilePicture']['name']) {
            $profilePath = 'assets/filemedia/fotoprofil/' . $nip . '.jpg';
    
            move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePath);

            $sql = "UPDATE akun SET profilPath = :profilePath";

            $stmt = $this->_dbConnection->prepare($sql);
            $stmt->bindParam(':profilePath', $profilePath);
            $result = $stmt->execute();
        }

        $sql = "UPDATE dosen SET nama = :nama, email = :email WHERE nip = :nip";

        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nip', $nip);
        $result = $stmt->execute();

        if ($result) {
            return json_encode(["status" => "success", "message" => "Profil Berhasil Diubah"]);
        } else {
            return json_encode(["status" => "error", "message" => "Perubahan Profil Gagal!"]);
        }
    }

    function getPhotoProfilePath($username) {
        $profilePath = 'assets/filemedia/fotoprofil/';
    
        if (is_file($profilePath . $username .'.jpg')) {
            $profilePath = $profilePath . $username .'.jpg';
        } else {
            $profilePath = $profilePath . 'default.jpg';
        }
        return $profilePath;
    }

}