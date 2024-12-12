<?php

if (!isset($_SESSION['session_username']) || 
    !in_array($_SESSION['session_role'], ['mahasiswa', 'admin', 'dosen']) || 
    ($_SESSION['session_status'] != 'aktif' &&
    $_SESSION['session_status'] != 'lulus/pindah')) 
{ 
    header("Location: index"); 
    exit(); 
}
?>