<?php
if (!defined('AKTIF')) {
    die("Anda tidak bisa mengakses file ini secara langsung.");
}

session_start();

if (!isset($_SESSION['usernameid'])) {
    header("Location: loginculina.php");
    exit();
}
?>
