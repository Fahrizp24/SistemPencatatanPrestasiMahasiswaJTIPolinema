<?php

namespace src;

use framework\Model;
use PDO;
use PDOException;

class MahasiswaModel extends Model
{

    function getStatus($username)
    {
        $stmt = $this->_dbConnection->prepare(
            "SELECT nimMahasiswa,
            COUNT(CASE WHEN status = 'diterimaAdmin' THEN 1 END) AS diterima ,
            COUNT(CASE WHEN status = 'diproses' OR status = 'diterimaDosen' THEN 1 END) AS diproses,
            COUNT(CASE WHEN status = 'ditolak' THEN 1 END) AS ditolak
            FROM
                prestasi
            WHERE
                nimMahasiswa = :nim
            GROUP BY
                nimMahasiswa;"
        );
        $stmt->bindParam(":nim", $username);
        $stmt->execute();

        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($status != NULL || !empty($status)) {
            return $status;
        } else {
            $status[0]['ditolak'] = '0';
            $status[0]['diterima'] = '0';
            $status[0]['diproses'] = '0';
        }

        return $status;
    }

    function getTableMahasiswa()
    {
        $stmt = $this->_dbConnection->prepare("SELECT tanggalPengajuan, namaLomba, bidang, d.nama , poin, status, idPrestasi 
                        FROM prestasi p INNER JOIN dosen d ON p.nipDosenPembimbing=d.nip WHERE nimMahasiswa = ? ORDER BY idPrestasi ASC");
        $stmt->bindParam(1, $_SESSION['session_username']);
        $stmt->execute();
        return $stmt->fetchAll();
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

    function pengajuan($namaLomba, $tingkat, $jenis, $waktu, $penyelenggara, $bidang, $nipDosenPembimbing, $nimMahasiswa)
    {
        $baseDir = "assets/filemedia/";
        $targetDirs = [
            'sertifikat' => $baseDir . "sertifikat/",
            'dokumentasi' => $baseDir . "dokumentasi/",
            'suratTugas' => $baseDir . "suratTugas/"
        ];

        // Check and create directories if they do not exist
        foreach ($targetDirs as $dirName => $path) {
            if (!is_dir($path)) {
                mkdir($path, 0777, true); // Create directory with permissions
            }
        }

        if ($_FILES['sertifikatLomba']['name'] && $_FILES['suratTugas']['name'] && $_FILES['dokumentasiLomba']['name']) {
            $sql = "INSERT INTO prestasi (namaLomba,tanggalPengajuan,tingkat,jenis,waktu, penyelenggara, bidang, nipDosenPembimbing, nimMahasiswa,poin, sertifikatPath, dokumentasiPath, suratTugasPath, status)
                VALUES ('$namaLomba',GETDATE(),'$tingkat','$jenis','$waktu', '$penyelenggara', '$bidang', '$nipDosenPembimbing', '$nimMahasiswa', 0,' ', ' ', ' ', 'diproses') ";
            $this->_dbConnection->query($sql);

            $sqlIdPrestasi = "SELECT TOP 1 idPrestasi FROM prestasi WHERE nimMahasiswa=$nimMahasiswa ORDER BY idPrestasi DESC";
            $hasil = $this->_dbConnection->query($sqlIdPrestasi);
            $hasilIdPrestasi = $hasil->fetch(PDO::FETCH_ASSOC);
            $hasilIdPrestasi = $hasilIdPrestasi['idPrestasi'];

            $targetfileSertifikat = $targetDirs['sertifikat'] . $hasilIdPrestasi . '_' . $_SESSION['session_username'] . '.jpg';
            $targetfileDokumentasi = $targetDirs['dokumentasi'] . $hasilIdPrestasi . '_' . $_SESSION['session_username'] . '.jpg';
            $targetfileSuratTugas = $targetDirs['suratTugas'] . $hasilIdPrestasi . '_' . $_SESSION['session_username'] . '.jpg';

            move_uploaded_file($_FILES['sertifikatLomba']['tmp_name'], $targetfileSertifikat);
            move_uploaded_file($_FILES['dokumentasiLomba']['tmp_name'], $targetfileDokumentasi);
            move_uploaded_file($_FILES['suratTugas']['tmp_name'], $targetfileSuratTugas);

            $sqlInputPath = "UPDATE prestasi SET sertifikatPath='$targetfileSertifikat',dokumentasiPath='$targetfileDokumentasi',suratTugasPath='$targetfileSuratTugas' WHERE idPrestasi='$hasilIdPrestasi';";

            if ($this->_dbConnection->query($sqlInputPath)) {
                return json_encode(["status" => "success", "message" => "pengajuan berhasil"]);
            } else {
                return json_encode(["status" => "error", "message" => "Input tidak sesuai"]);
            }
        } else {
            return json_encode(["status" => "failed", "message" => "Input tidak tidak lengkap"]);
        }
    }
    function getDosen($nip)
    {
        $query = "SELECT nama FROM dosen WHERE nip = '$nip'";
        $result = $this->_dbConnection->query($query);

        if ($result) {
            $row = $result->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(["status" => "success", "data" => $row[0]['nama']]);
        } else {
            echo "Cek Kembali Input NIP";
        }

    }

    function getMahasiswa($nim)
    {
        $stmt = $this->_dbConnection->prepare("SELECT nama,nim,email,namaProdi,profilPath FROM mahasiswa m INNER JOIN akun a ON m.nim=a.username WHERE m.nim = :value1");
        $stmt->bindParam(':value1', $nim);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPrestasi($idPrestasi)
    {
        $stmt = $this->_dbConnection->prepare("SELECT * FROM prestasi WHERE idPrestasi = :value1");
        $stmt->bindParam(':value1', $idPrestasi);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateProfil($username, $nama, $email)
    {
        // Validasi apakah email sudah digunakan oleh dosen lain
        $sql = "SELECT * FROM mahasiswa WHERE email = :email AND nim <> :nim";

        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nim', $username);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            return json_encode(["status" => "error", "message" => "Email Telah Digunakan!"]);
        }

        $sql = "UPDATE mahasiswa SET nama = :nama, email = :email WHERE nim = :username";

        $stmt = $this->_dbConnection->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $result = $stmt->execute();

        if ($result) {
            return json_encode(["status" => "success", "message" => "Profil Berhasil Diubah"]);
        } else {
            return json_encode(["status" => "error", "message" => "Perubahan Profil Gagal!"]);
        }
    }
}