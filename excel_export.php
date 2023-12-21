<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


require('vendor/autoload.php'); // Sesuaikan dengan path autoloader PhpSpreadsheet

// Buat objek koneksi ke database
include('include/config.php');

// Buat objek Spreadsheet
$spreadsheet = new Spreadsheet();

// Ambil aktifkan lembar kerja pertama
$sheet = $spreadsheet->getActiveSheet();



// Isi header untuk kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Email');

// Loop melalui hasil kueri dan mengisi data ke dalam lembar kerja
$query = mysqli_query($conn, "SELECT * FROM tbl_user");
$rowNumber = 2; // Inisialisasi nomor baris
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $sheet->setCellValue('A' . $rowNumber, $no);
    $sheet->setCellValue('B' . $rowNumber, $row['nama']);
    $sheet->setCellValue('C' . $rowNumber, $row['email']);
    $rowNumber++;
    $no++;
}


// Buat objek writer untuk menyimpan file
$writer = new Xlsx($spreadsheet);

// Tentukan header untuk mengunduh file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="daftar_user.xlsx"');
header('Cache-Control: max-age=0');

// Keluarkan hasil ke browser
$writer->save('php://output');
