<?php

namespace src;

use framework\Model;
use PDO;

class RegisterModel extends Model
{

    public function register($username, $password, $role, $name, $prodi, $email)
    {
        $sql = "SELECT * FROM akun WHERE username = '$username'";
        $statement = $this->_dbConnection->prepare($sql);
        $success = $statement->execute();

        if ($success) {
            return json_encode(["status" => "error", "message" => "NIM/NIP Telah Terdaftar!"]);
        }

        $sql = "SELECT * FROM mahasiswa WHERE email = '$email'";
        $statement = $this->_dbConnection->prepare($sql);
        $successMhs = $statement->execute();

        $sql = "SELECT * FROM dosen WHERE email = '$email'";
        $statement = $this->_dbConnection->prepare($sql);
        $successDsn = $statement->execute();

        if ($successMhs || $successDsn) {
            return json_encode(["status" => "error", "message" => "Email Telah Terdaftar!"]);
        }

        $sql = "INSERT INTO akun (username, password, role, status)
            VALUES ('$username', '$password', '$role', 'aktif')";
        $statement = $this->_dbConnection->prepare($sql);
        $success = $statement->execute();

        if ($role === 'mahasiswa') {
            $sql = "INSERT INTO mahasiswa (nim ,nama, email, namaProdi)
                VALUES ('$username', '$name', '$email', '$prodi')";
        } elseif ($role === 'dosen') {
            $sql = "INSERT INTO dosen (nip, nama, namaJurusan, email)
                VALUES ('$username', '$name', 'Teknologi Informasi', '$email')";
        }

        $statement=$this->_dbConnection->prepare($sql);
        $success = $statement->execute();

        if ($success) {
            return json_encode(["status" => "success", "message" => "Register successful"]);
        } else {
            return json_encode(["status" => "error", "message" => "Input Register tidak sesuai"]);
        }
    }

}