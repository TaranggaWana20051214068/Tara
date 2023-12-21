<?php
ob_start();
//cek session
session_start();
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    // ambil data dari database


?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include('include/head.php');

    ?>

    <body>

        <header>

            <!-- Include Navigation START -->
            <?php include('include/menu.php'); ?>
            <!-- Include Navigation END -->

        </header>
        <main>
            <div class="container">
                <?php
                if (isset($_REQUEST['hal'])) {
                    $page = $_REQUEST['hal'];
                    switch ($page) {
                        case 'pro':
                            include "pofile.php";
                            break;
                        case 'game':
                            include "game.php";
                            break;
                        case 'buku':
                            include "buku.php";
                            break;
                    }
                } else {


                ?>
            </div>
        </main>
        <div class="row">
            <!-- Bagian Header -->
            <div class="parallax-container" style="height: 100vh;">
                <div class="parallax center-align center-block"><img class="img-bg" src="img/bg-simple-6.png"></div>
                <div class="center-align center black-text">
                    <h5>hey, I'm </h5>
                    <h2><?= $_SESSION['nama'] ?></h2>

                </div>
            </div>

            <div class="container">
                <!-- Bagian Tentang Saya -->
                <section class="center">
                    <h3 style="font-family:var(--merriweather);">My Journey</h3>
                    <h5>"saya, web developer muda yang bercita-cita menjadi pemimpin perusahaan yang sukses."</h5>
                </section>
                <!-- Tambahkan lebih banyak kartu proyek di sini -->
                <div class="container h-j">
                    <img class="img-j brand-logo" src="img/logo_grahapena.png" alt="pengalaman-1">
                    <div class="t-awal">
                        <h4 class="header">Graha Pena Jawa Pos</h4>
                        <p> 14 agustus 2023 - 14 december 2023
                            <hr>
                            Selama magang di Graha Pena Jawa Pos, saya bertanggung jawab untuk mengembangkan aplikasi webbase bernama Smartech. Aplikasi ini merupakan aplikasi internal untuk manajemen sistem
                            informasi Graha Pena. Saya mengembangkan aplikasi ini menggunakan bahasa pemrograman PHP, framework Laravel, dan alat pengembangan Visual Studio Code.
                            Saya bekerja sama dengan tim IT Graha Pena untuk memastikan aplikasi berjalan dengan lancar dan sesuai dengan
                            kebutuhan pengguna. Saya juga bertanggung jawab untuk melakukan pemeliharaan dan pengembangan aplikasi secara berkelanjutan.
                            Melalui magang ini, saya mendapatkan pengalaman berharga dalam mengembangkan aplikasi web. Saya juga
                            belajar bekerja sama dalam tim dan memahami kebutuhan pengguna.<br>

                        </p>
                    </div>
                </div>
                <div class="container h-j">
                    <img class="img-j brand-logo" src="img/logo_startup-campus.png" alt="pengalaman-1">
                    <div class="t-awal">
                        <h4 class="header">Startup Campus - Founder</h4>
                        <p> 16 Februari 2023 - 30 Juni 2023
                            <hr>

                            <span style="border: 400;">Berani Menantang Diri untuk Menjadi CTO di Startup Campus</span>
                            <br>
                            Saya, mengikuti kegiatan studi independen di Startup Campus pada bidang founder. Dalam kegiatan ini, saya ditunjuk sebagai CTO startup FARMACY, yang bertujuan membantu para peternak di Indonesia. Saya bertanggung jawab untuk membuat website yang menghubungkan peternak dengan dokter.
                            <br>
                            Melalui proyek ini, saya belajar banyak hal baru, termasuk tentang dunia peternakan, cara bekerja sama dalam tim, dan bagaimana membuat website yang berkualitas. Saya juga belajar untuk berani menantang diri sendiri dan mengambil tanggung jawab yang besar.
                            <br>
                            Website yang saya buat berhasil membantu para peternak untuk mendapatkan layanan kesehatan yang berkualitas dan meningkatkan kualitas dan kuantitas ternak mereka.
                            <br>
                            Kegiatan studi independen di Startup Campus merupakan pengalaman yang sangat berharga bagi saya. Saya belajar banyak hal baru dan tumbuh sebagai seorang individu. Saya juga mendapatkan kesempatan untuk berkontribusi dalam membangun startup yang bermanfaat bagi masyarakat.<br>

                        </p>
                    </div>
                </div>
                <!-- Bagian Portofolio -->



                <!-- Bagian Kontak -->
                <section class="section">
                    <h2>Hubungi Saya</h2>
                    <p>Jangan ragu untuk menghubungi saya:</p>
                    <ul>
                        <li>Email: taranggawana49@gmail.com</li>
                        <li>Telepon: 08979175096</li>
                        <!-- Tambahkan informasi kontak lainnya di sini -->
                    </ul>
                </section>
            </div>
        </div>



        <?php include('include/footer.php'); ?>

    </body>

    </html>
<?php
                }
            } ?>