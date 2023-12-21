<?php
ob_start();
session_start();

//cek session
if (isset($_SESSION['admin'])) {
    header("Location: ./home.php");
    die();
}
// koneksi Database 
require_once 'include/config.php';


?>

<!DOCTYPE html>
<html lang="en">

<?php include('include/head.php'); ?>
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
        padding: 2rem;
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
        padding-bottom: 2em;
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
        margin: 15px 15px -15px;
    }

    .error {
        padding: 10px;
    }

    .upss {
        font-size: 1.2rem;
        margin-left: 20px;
    }

    .pace {
        -webkit-pointer-events: none;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        -webkit-transform: translate3d(0, -50px, 0);
        -ms-transform: translate3d(0, -50px, 0);
        transform: translate3d(0, -50px, 0);
        -webkit-transition: -webkit-transform .5s ease-out;
        -ms-transition: -webkit-transform .5s ease-out;
        transition: transform .5s ease-out;
    }

    .pace.pace-active {
        -webkit-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .pace .pace-progress {
        display: block;
        position: fixed;
        z-index: 2000;
        top: 0;
        right: 100%;
        width: 100%;
        height: 3px;
        background: #2196f3;
        pointer-events: none;
    }

    @media only screen and (max-width: 600px) {
        #login .formm {
            width: 300px;
        }
    }
</style>
<?php
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    switch ($page) {
        case 'regis':
            include "registrasi.php";
            break;
    }
} else {
?>

    <body class="login">



        <!-- Container START -->
        <div class="container">

            <!-- Row START -->
            <div class="row valign-wrapper">


                <!-- Col START -->
                <div class="col s12 m6 offset-m3">

                    <!-- Box START -->
                    <div class="wrapper" id="login">
                        <?php

                        if (isset($_REQUEST['submit'])) {

                            if ($_REQUEST['username'] == "" || $_REQUEST['password'] == "") {
                                echo '<div class="upss red-text"><i class="material-icons">error_outline</i> <strong>ERROR!</strong> Username dan Password wajib diisi.
                                <a class="btn-large waves-effect waves-light blue-grey col s11" href="" style="margin: 20px 0 0 5px;"><i class="material-icons md-24">arrow_back</i> Kembali ke login form</a></div>';
                            } else {

                                $username = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['username'])));
                                $password = trim(htmlspecialchars(mysqli_real_escape_string($config, $_REQUEST['password'])));

                                $query = mysqli_query($config, "SELECT id_user, nama, username, password, admin FROM tbl_user WHERE username=BINARY'$username' AND password=MD5('$password')");


                                if (mysqli_num_rows($query) > 0) {
                                    list($id_user, $nama, $username, $password, $admin) = mysqli_fetch_array($query);

                                    $_SESSION['id_user'] = $id_user;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['nama'] = $nama;
                                    $_SESSION['admin'] = $admin;


                                    header("Location: ./home.php");
                                    die();
                                } else {

                                    //session error
                                    $_SESSION['errLog'] = '<center>Username & Password tidak ditemukan!</center>';
                                    header("Location: ./");
                                    die();
                                }
                            }
                        } else {


                        ?>
                            <form class="formm" method="POST">
                                <h5 class="heading">Login</h5>
                                <div class="row">
                                    <?php
                                    if (isset($_SESSION['successReg'])) {
                                        echo '<div id="alert-message" class="success green lighten-5"><div class="center"><i class="material-icons">check_circle</i> ' . $_SESSION['successReg'] . '</div></div>';
                                        unset($_SESSION['successReg']);
                                    }
                                    if (isset($_SESSION['errLog'])) {
                                        $errLog = $_SESSION['errLog'];
                                        echo '<div id="alert-message" class="error red lighten-5 green-text"><div class="center"><i class="material-icons">error_outline</i> <strong>LOGIN GAGAL!</strong></div>' . $errLog . '</div>';
                                        unset($_SESSION['errLog']);
                                    }
                                    if (isset($_SESSION['err'])) {
                                        $err = $_SESSION['err'];
                                        echo '<div id="alert-message" class="error red lighten-5"><div class="center"><i class="material-icons">error_outline</i> <strong>ERROR!</strong></div>' . $err . '</div>';
                                        unset($_SESSION['err']);
                                    }
                                    ?>

                                </div>
                                <div class="input-field">
                                    <i class="material-icons prefix md-prefix">account_circle</i>
                                    <input class="inputt validate" id="username" placeholder="Username" name="username" type="text" autocomplete="additional-name" required>
                                </div>
                                <div class="input-field">
                                    <i class="material-icons prefix md-prefix">lock</i>
                                    <input class="inputt validate" id="password" placeholder="Password" name="password" type="password" required>
                                </div>
                                <a href="?page=regis">Registrasi</a>
                                <button class="btnn" name="submit">Submit</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
    }
        ?>
        </div>




        <!--JavaScript at end of body for optimized loading-->
        <script src="./js/materialize.min.js"></script>
        <script src="./js/script.js"></script>
        <script src="./js/materialize.js"></script>
        <script data-pace-options='{ "ajax": false }' src='./js/pace.min.js'></script>
        <script type="text/javascript">
            $("#alert-message").alert().delay(3000).slideUp('slow');
        </script>
        <!-- Javascript END -->

        <noscript>
            <meta http-equiv="refresh" content="0;URL='/enable-javascript.html'" />
        </noscript>
    </body>

</html>