<?php
    $conn = new mysqli("localhost", "root", "", "uas_gis2praktikum");

    if (!$conn) {
        echo 'koneksi gagal';
    }
?>