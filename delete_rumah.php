<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];

$queryResult = $conn->query("DELETE FROM rumah WHERE id='$id'");

if ($queryResult) {
    $_SESSION['pesan'] = 'Data rumah berhasil dihapus';
    echo "<script>
    window.location.href = 'rumah.php';
    </script>";
}
?>