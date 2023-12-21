<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/materialize.min.css">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="container">
            <table>
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Ketas</th>
                    <th>File</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost"; // Sesuaikan dengan server Anda
                    $username = "root"; // Sesuaikan dengan username database Anda
                    $password = ""; // Sesuaikan dengan password database Anda
                    $dbname = "phpdasar"; // Sesuaikan dengan nama database Anda

                    // Membuat koneksi ke database
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $query = mysqli_query($conn, "SELECT * FROM tb_pesanan ORDER BY id DESC");
                    $num_rows = mysqli_num_rows($query);

                    if ($num_rows > 0) {


                        $no = 0;
                        while ($row = mysqli_fetch_assoc($query)) {
                            $no++;
                    ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['kelas'] ?></td>
                                <td><?= $row['jenis_kertas'] ?></td>
                                <td>
                                    <?php
                                    if (!empty($row['unggah_file'])) {
                                    ?>
                                        <a href="upload/user/<?= $row['unggah_file'] ?>" target="_blank"><img src="upload/user/<?= $row['unggah_file'] ?>" alt="" width="50px"></a>
                                    <?php
                                    } else {
                                    ?>
                                        <em>Tidak ada file yang di upload</em>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?= $row['unggah_file'] ?></td>
                            </tr>
                        <?php

                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">
                                <center>
                                    <p class="add">Tidak ada data untuk ditampilkan. <u><a href="#!">Tidak ada Cuti</a></u></p>
                                </center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>