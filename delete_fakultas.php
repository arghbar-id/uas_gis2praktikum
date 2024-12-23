<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];

$queryResult = $conn->query("DELETE FROM fakultas WHERE id='$id'");

if ($queryResult) {
    $_SESSION['pesan'] = 'Data fakultas berhasil dihapus';
    echo "<script>
    window.location.href = 'fakultas.php';
    </script>";
}
?>