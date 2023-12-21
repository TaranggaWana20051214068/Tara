<?php
$host     = "localhost";    // Nama host
$username = "root";         // Username database
$password = "tarangga";   // Password database
$database = "phpdasar";   // Nama database
$port = '4306';
$conn = conn($host, $username, $password, $database, $port);

if (is_string($conn)) {
    // Tampilkan pesan kesalahan jika koneksi gagal
    die($conn);
}

function conn($host, $username, $password, $database, $port)
{
    $conn = mysqli_connect($host, $username, $password, $database, $port);

    // Mengembalikan koneksi atau pesan kesalahan jika koneksi gagal
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
