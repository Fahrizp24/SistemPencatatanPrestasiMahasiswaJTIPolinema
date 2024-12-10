<?php

require '../config/database.php';
include 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'updateProfil') {
    $username = htmlspecialchars($_POST['username']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    echo updateProfil($username, $nama, $email, $role);
}

?>