<?php


//cek session
if (isset($_SESSION['admin'])) {
    header("Location: ./home.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">


<style>
    body {
        padding: 0;
        margin: 0;
    }


    /* login Form */
    .wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Menengahkan secara horizontal */
        justify-content: center;
        /* Menengahkan secara vertikal */
        height: 100vh;
    }

    .formm {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: white;
        padding: 1rem;
        border-radius: 25px;
        transition: 0.4s ease-in-out;
        box-shadow: rgba(0, 0, 0, 0.4) 1px 2px 2px;
        width: 350px;
    }

    .formm:hover {
        transform: translateX(-0.5em) translateY(-0.5em);
        border: 1px solid #171717;
        box-shadow: 10px 10px 0px #666666;
    }

    .heading {
        color: black;
        font-family: "merriweather", sans-serif;
        padding-bottom: 0em;
        text-align: center;
        font-weight: bold;
    }

    .inputt {
        border-radius: 5px !important;
        border: 1px solid whitesmoke !important;
        background-color: whitesmoke !important;
        outline: none;
        padding: 0.7em;
        transition: 0.4s ease-in-out;
    }

    .inputt:hover {
        box-shadow: 6px 6px 0px #969696, -3px -3px 10px #ffffff !important;
    }

    .inputt:focus {
        background: #ffffff;
        box-shadow: inset 2px 5px 10px rgba(0, 0, 0, 0.3) !important;
    }

    .formm .btnn {
        margin-top: 2em;
        align-self: center;
        padding: 0.7em;
        padding-left: 1em;
        padding-right: 1em;
        border-radius: 10px;
        border: none;
        color: white;
        background-color: var(--Dblue);
        transition: 0.4s ease-in-out;
        box-shadow: var(--shadow) 1px 1px 1px;
    }

    .formm .btnn:hover {
        background-color: #344e67;
        box-shadow: 6px 6px 0px #969696, -3px -3px 10px #ffffff;
        transform: translateX(-0.5em) translateY(-0.5em);
    }

    .formm .btnn:active {
        transition: 0.2s;
        transform: translateX(0em) translateY(0em);
        box-shadow: none;
    }

    #alert-message {
        border-radius: 3px;
        color: #f44336;
        font-size: 1.15rem;
    }

    .error {
        padding: 10px;
    }

    .upss {
        font-size: 1.2rem;
        margin-left: 20px;
    }

    @media only screen and (max-width: 600px) {
        #login .formm {
            width: 300px;
        }
    }
</style>

<body class="login">


    <!-- Container START -->
    <div class="container">

        <!-- Row START -->
        <div class="row valign-wrapper">


            <!-- Col START -->
            <div class="col s12 m6 offset-m3">

                <!-- Box START -->
                <div class="wrapper black-text" id="regis">
                    <?php
                    if (isset($_POST['submit'])) {

                        if ($_REQUEST['username'] == "" || $_REQUEST['password'] == "" || $_REQUEST['email'] == "") {
                            echo '<div class="upss red-text"><i class="material-icons">error_outline</i> <strong>ERROR!</strong> Username, Password, dan Email wajib diisi.
                                <a class="btn-large waves-effect waves-light blue-grey col s11" href="" style="margin: 20px 0 0 5px;"><i class="material-icons md-24">arrow_back</i> Kembali ke halaman pendaftaran</a></div>';
                        } else {

                            $username = trim(htmlspecialchars(mysqli_real_escape_string($config, $_POST['username'])));
                            $password = trim(htmlspecialchars(mysqli_real_escape_string($config, $_POST['password'])));
                            $email = trim(htmlspecialchars(mysqli_real_escape_string($config, $_POST['email'])));
                            $nama = trim(htmlspecialchars(mysqli_real_escape_string($config, $_POST['nama'])));

                            // Lakukan validasi tambahan jika diperlukan

                            // Periksa apakah username atau email sudah terdaftar dalam database
                            $checkUserEmailQuery = mysqli_query($config, "SELECT id_user FROM tbl_user WHERE username = BINARY '$username' OR email = BINARY '$email'");

                            if (mysqli_num_rows($checkUserEmailQuery) > 0) {
                                // Jika username atau email sudah terdaftar
                                $_SESSION['errReg'] = '<center>Username atau Email sudah terdaftar!</center>';
                                header("Location: #");
                                die();
                            } else {
                                // Jika username dan email belum terdaftar, lakukan pendaftaran
                                $hashedPassword = md5($password); // Menggunakan md5() untuk mengenkripsi kata sandi
                                $insertQuery = mysqli_query($config, "INSERT INTO tbl_user (nama, username, password, email, admin) VALUES ('$nama', '$username', '$hashedPassword', '$email', '2')");;

                                if ($insertQuery) {
                                    // Jika pendaftaran berhasil
                                    $_SESSION['successReg'] = '<center>Registrasi berhasil! Silakan login.</center>';
                                    header("Location: ./");
                                    die();
                                } else {
                                    // Jika terjadi kesalahan saat pendaftaran
                                    $_SESSION['errReg'] = '<center>Registrasi gagal! Silakan coba lagi.</center>';
                                    header("Location: ./");
                                    die();
                                }
                            }
                        }
                    } else {
                    ?>

                        <form class="formm" method="POST">
                            <h5 class="heading">Registrasi</h5>
                            <div class="row">
                                <?php
                                if (isset($_SESSION['errReg'])) {
                                    $errReg = $_SESSION['errReg'];
                                    echo '<div id="alert-message" class="error red lighten-5"><div class="center"><i class="material-icons">error_outline</i> ' . $errReg . '</div></div>';
                                    unset($_SESSION['errReg']);
                                }
                                ?>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix md-prefix">person</i>
                                <input class="inputt validate" id="nama" placeholder="nama" name="nama" type="text" autocomplete="nama" required>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix md-prefix">email</i>
                                <input class="inputt validate" id="email" placeholder="Email" name="email" type="email" autocomplete="email" required>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix md-prefix">account_circle</i>
                                <input class="inputt validate" id="username" placeholder="Username" name="username" type="text" autocomplete="additional-name" required>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix md-prefix">lock</i>
                                <input class="inputt validate" id="password" placeholder="Password" name="password" type="password" required>
                            </div>
                            <a href="./">Sudah punya akun? Login</a>
                            <button class="btnn" name="submit">Daftar</button>
                        </form>

                </div>
            </div>
        </div>
    <?php
                    }
    ?>
    </div>




    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript">
        $("#alert-message").alert().delay(3000).slideUp('slow');
        var message = "Ngapain?";

        function clickIE4() {

            if (event.button == 2) {

                alert(message);

                return false;

            }

        }

        function clickNS4(e) {

            if (document.layers || document.getElementById && !document.all) {

                if (e.which == 2 || e.which == 3) {

                    alert(message);

                    return false;

                }

            }

        }

        if (document.layers) {

            document.captureEvents(Event.MOUSEDOWN);

            document.onmousedown = clickNS4;

        } else if (document.all && !document.getElementById) {

            document.onmousedown = clickIE4;

        }

        document.oncontextmenu = new Function("alert(message);return false");
    </script><!--IE=internet explorer 4+ dan NS=netscape 4+0-->
    <!-- Javascript END -->

    <noscript>
        <meta http-equiv="refresh" content="0;URL='/enable-javascript.html'" />
    </noscript>
</body>

</html>