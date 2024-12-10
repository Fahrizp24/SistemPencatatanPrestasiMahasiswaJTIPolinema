<?php




// login password_verify($password, $row['password'])
// register $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



function updateProfil($username, $nama, $email, $role)
{
    global $conn;
    if ($role === 'Mahasiswa') {
        $sql = "SELECT * FROM mahasiswa WHERE email = '$email' AND NOT nim = '$username'";
    } else {
        $sql = "SELECT * FROM dosen WHERE email = '$email' AND NOT nip = '$username'";
    }

    $result = $conn->query($sql);

    if ($result->rowCount() != 0) {
        return json_encode(["status" => "error", "message" => "Email Telah Digunakan!"]);
    }

    if ($role === 'Mahasiswa') {
        $sql = "UPDATE mahasiswa SET nama = '$nama', email = '$email' WHERE nim = '$username'";
    } else {
        $sql = "UPDATE dosen SET nama = '$nama', email = '$email' WHERE nip = '$username'";
    }

    $result = $conn->query($sql);

    if ($result->rowCount() != 0) {
        return json_encode(["status" => "success", "message" => "Profil Berhasil Diubah"]);
    } else {
        return json_encode(["status" => "error", "message" => "Perubahan Profil Gagal!"]);
    }
}





