<?php
$servername = "localhost"; // Sesuaikan dengan server Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "phpdasar"; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if (isset($_REQUEST['submit'])) {


    // Mendapatkan nilai dari elemen input
    $name = $_POST['name'];
    $kelas = $_POST['kelas'];
    $orderType = $_POST['orderType'];
    $keterangan = $_POST['keterangan'];


    $ekstensi = array('jpg', 'png', 'jpeg', 'doc', 'docx', 'pdf');
    $file = $_FILES['file']['name'];
    $x = explode('.', $file);
    $eks = strtolower(end($x));
    $nfile = uniqid() . "-" . $file;
    $ukuran = $_FILES['file']['size'];
    $target_dir = "upload/user/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (in_array($eks, $ekstensi) == true) {
        if ($ukuran < 2500000) {
            // upload file
            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $nfile);
            // Membuat dan mengeksekusi query
            $sql = "INSERT INTO tb_pesanan (nama, kelas, jenis_kertas, unggah_file, keterangan) VALUES ('$name', '$kelas', '$orderType', '$nfile', '$keterangan')";
            $result = mysqli_query($conn, $sql);
            if ($result === TRUE) {
                echo "Data pesanan berhasil disimpan.";
?>
                <script language="javascript">
                    window.location.href = "coba_a.php";
                </script>
<?php
                die();
            } else {
                echo "Error: " . $$result . "<br>" . $conn->error;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/materialize.min.css">
    <title>Document</title>
</head>

<body>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .sidebar {
            width: 30%;
            padding: 20px;
            background-color: #eee;
            border-radius: 5px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .sidebar .head {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .head h3 {
            margin: 0;
        }

        .user-input label {
            display: block;
            margin-bottom: 5px;
        }

        .user-input input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            margin-left: -12.5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        #submitButton {
            background-color: #262a56;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        #submitButton:hover {
            background-color: #000;
        }

        .head {
            background-color: orange;
            border-radius: 4px;
            height: 40px;
            padding: 10px;
            margin-bottom: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .foot {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0px;
            padding: 10px 0px;
            border-top: 1px solid #333;
            gap: 10px;
        }
    </style>

    <div class="sidebar">
        <div class="head">
            <h3>Order</h3>
        </div>
        <div class="user-input">
            <form method="post" enctype="multipart/form-data">
                <label for="name">Nama:</label>
                <input type="text" name="name" id="name" placeholder="Masukkan nama Anda">

                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" placeholder="Masukkan kelas Anda">

                <label for="orderType">Jenis Kertas/Ukuran:</label>
                <input type="text" name="orderType" id="orderType" placeholder="Masukkan jenis kertas atau ukuran kertas">

                <label for="file">Unggah File:</label>
                <input type="file" name="file" id="file">

                <label for="keterangan">Keterangan Pesanan:</label>
                <input type="text" name="keterangan" id="keterangan" placeholder="Masukkan keterangan Anda">

                <input type="submit" name="submit" id="submitButton">
            </form>
        </div>
    </div>



</body>

</html>