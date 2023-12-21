<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {
    if (isset($_REQUEST['submit'])) {
        if (empty($_REQUEST['nama_game']) || empty($_REQUEST['kategori']) || empty($_REQUEST['nama_akun'])) {
            echo 'ERROR! Semua form wajib diisi';
?>
            <script language="javascript">
                window.history.back();
            </script>
    <?php
        } else {
            $nama_game = $_POST['nama_game'];
            $kategori = $_POST['kategori'];
            $nama_akun = $_POST['nama_akun'];
            $username = $_POST['username'];
            $pass_game = $_POST['pass_game'];
            $keterangan = $_POST['keterangan'];

            $ekstensi = array('jpg', 'png', 'jpeg', 'doc', 'docx', 'pdf', "jfif");
            $file = $_FILES['file']['name'];
            $x = explode('.', $file);
            $eks = strtolower(end($x));

            $ukuran = $_FILES['file']['size'];
            $target_dir = "upload/user/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (!empty($file)) {
                $nfile = uniqid() . "-" . $file;
                //validasi file
                if (in_array($eks, $ekstensi) == true) {
                    if ($ukuran < 2500000) {
                        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $nfile);
                        $query = mysqli_query($config, "INSERT INTO tbl_game(nama_game,kategori,nama_akun,username,pass_game,keterangan,file)
                                            VALUES('$nama_game','$kategori','$nama_akun','$username','$pass_game','$keterangan','$nfile')");

                        if ($query == true) {
                            $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                            header("Location: ./home.php?hal=game");
                            die();
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">window.history.back();</script>';
                        }
                    } else {
                        $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                        echo '<script language="javascript">window.history.back();</script>';
                    }
                } else {
                    $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                    echo '<script language="javascript">window.history.back();</script>';
                }
            } else {

                //jika form file kosong akan mengeksekusi script dibawah ini
                $query = mysqli_query($config, "INSERT INTO tbl_game(nama_game,kategori,nama_akun,username,pass_game,keterangan,file)
    VALUES('$nama_game','$kategori','$nama_akun','$username','$pass_game','$keterangan','$file')");
                if ($query == true) {
                    $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                    header("Location: ./home.php?hal=game");
                    die();
                } else {
                    $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                    echo '<script language="javascript">window.history.back();</script>';
                }
            }
        }
    }
    ?>
    <div class="row">
        <div class="form-container">
            <form class="form" method="post" enctype="multipart/form-data">
                <div class="col s12">
                    <div class="form-group">
                        <label for="nama_game">Nama Game</label>
                        <input required name="nama_game" id="nama_game" type="text">
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="form-group">
                        <select required name="kategori" id="kategori">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                        <label for="kategori">Kategori</label>
                    </div>
                </div>
                <div class="col s12">
                    <div class="form-group">
                        <label for="nama_akun">Nama Akun</label>
                        <input required name="nama_akun" id="nama_akun" type="text">
                    </div>
                </div>
                <div class="col s12">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input required name="username" id="username" type="text">
                    </div>
                </div>
                <div class="col s12">
                    <div class="form-group">
                        <label for="pass_game">password</label>
                        <input required name="pass_game" id="pass_game" type="password">
                    </div>
                </div>
                <div class="col s12">
                    <div class="form-group">
                        <label for="textarea">Jelaskan Tentang Game</label>
                        <textarea required cols="50" rows="10" id="textarea" name="keterangan">     </textarea>
                    </div>
                </div>
                <div class="container_form">
                    <div class="header">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M7 10C7.43285 10 7.84965 10.0688 8.24006 10.1959M12 12V21M12 12L15 15M12 12L9 15" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <!-- <p>Browse File to upload!</p> -->
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <label for="file" class="footer">
                        <svg fill="#000000" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M15.331 6H8.5v20h15V14.154h-8.169z"></path>
                                <path d="M18.153 6h-.009v5.342H23.5v-.002z"></path>
                            </g>
                        </svg>
                        <p>Not selected file</p>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M5.16565 10.1534C5.07629 8.99181 5.99473 8 7.15975 8H16.8402C18.0053 8 18.9237 8.9918 18.8344 10.1534L18.142 19.1534C18.0619 20.1954 17.193 21 16.1479 21H7.85206C6.80699 21 5.93811 20.1954 5.85795 19.1534L5.16565 10.1534Z" stroke="#000000" stroke-width="2"></path>
                                <path d="M19.5 5H4.5" stroke="#000000" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M10 3C10 2.44772 10.4477 2 11 2H13C13.5523 2 14 2.44772 14 3V5H10V3Z" stroke="#000000" stroke-width="2"></path>
                            </g>
                        </svg>
                    </label>
                </div>
                <!-- <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div> -->
                <button type="submit" name="submit" class="form-submit-btn">Submit</button>
            </form>
        </div>
    </div>

<?php
}
