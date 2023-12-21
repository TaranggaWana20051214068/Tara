<?php

/**
 * FUngsi koneksi database.
 */
function conn($host, $username, $password, $database)
{
    $conn = new mysqli($host, $username, $password, $database);

    // Menampilkan pesan error jika database tidak terhubung
    return ($conn) ? $conn : "Koneksi database gagal: " . mysqli_connect_error();
}

// Fungsi mengambil database.
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Mengembalikan pesan error jika kueri gagal dijalankan
        return "Kesalahan dalam menjalankan kueri: " . mysqli_error($conn);
    }

    $rows = [];
    while ($row = mysqli_fetch_object($result)) {
        $rows[] = $row;
    }

    // Membebaskan hasil kueri
    mysqli_free_result($result);

    return $rows;
}
