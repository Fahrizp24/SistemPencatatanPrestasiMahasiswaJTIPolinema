<?php

if (!isset($_SESSION['session_username']) || 
    !in_array($_SESSION['session_role'], ['mahasiswa', 'admin', 'dosen']) || 
    $_SESSION['session_status'] != 'login') 
{ 
    header("Location: index.php"); 
    exit(); 
}
?>