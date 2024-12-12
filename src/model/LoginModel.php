<?php

namespace src;

use framework\Model;
use PDO;
use PDOException;

class LoginModel extends Model
{
    function login($username, $password)
    {
        try {
            $stmt = $this->_dbConnection->prepare("SELECT * FROM akun WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $hasil = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($hasil) {
                if ($hasil['status']=="aktif") {
                    $_SESSION["session_username"] = $hasil['username'];
                    $_SESSION["session_role"] = $hasil['role'];
                    $_SESSION["session_status"] = 'aktif';
                    return json_encode(["role" => $hasil['role'], "status" => "success", "message" => "Login successful"]);
                } else if($hasil['status']=="lulus/pindah"){
                    $_SESSION["session_username"] = $hasil['username'];
                    $_SESSION["session_role"] = $hasil['role'];
                    $_SESSION["session_status"] = 'lulus/pindah';
                    return json_encode(["role" => $hasil['role'], "status" => "success", "message" => "Login successful"]);
                }else{
                    return json_encode(["status" => "error", "message" => "Username atau Password tidak sesuai"]);
                }
            } else if($hasil['status']=="pending"){
                return json_encode(["status" => "error", "message" => "Akun anda belum dikonfirmasi admin"]);
            }else{
                return json_encode(["status" => "error", "message" => "Akun anda inaktif"]);
            }
        } catch (PDOException $e) {
            return json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    }

    function logout()
    {
        session_unset();
        session_destroy();
    }

}