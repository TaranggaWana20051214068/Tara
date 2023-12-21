<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {
    include 'include/config.php';
    if ($_SESSION['admin'] != 1) {
?><script language="javascript">
            window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
            window.location.href = "./logout.php";
        </script>
        <?php
    } else {
        if (isset($_REQUEST['and'])) {
            $page = $_REQUEST['and'];
            switch ($page) {
                case 'add':
                    include "tambah_game.php";
                    break;
                case 'edit':
                    include "edit_game.php";
                    break;
                case 'del':
                    include "del_game.php";
                    break;
            }
        } else {


            // Menjalankan kueri SQL untuk mendapatkan jumlah data game yang ada di database
            $query = mysqli_query($conn, "SELECT COUNT(*) FROM tbl_game");
            $cdata = mysqli_fetch_array($query)[0];
            $limit = 20;
            // Menghitung jumlah halaman
            $num_pages = ceil($cdata / $limit);

            // Mendapatkan halaman saat ini
            $pg = @$_GET['pg'];
            if (empty($pg)) {
                $pg = 1;
            }

        ?>

            <div class="row">
                <div class="col s12 header">
                    <div class="nav-wrapper">
                        <ul class="left">
                            <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons md-3">directions_car</i>Daftar Game</a></li>
                            <li class="waves-effect waves-light">
                                <a href="?hal=game&and=add"><i class="material-icons md-30">add_circle</i>Tambah Game</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="container">
                    <article class="article-wrapper">
                        <div class="rounded-lg container-project">
                            <img class="img-card" src="./img/luffy.jpg" alt="">
                        </div>
                        <div class="project-info">
                            <div class="flex-pr">
                                <div class="project-title text-nowrap">Project</div>
                                <div class="project-hover">
                                    <svg style="color: black;" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" color="black" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor">
                                        <line y2="12" x2="19" y1="12" x1="5"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="types">
                                <span style="background-color: rgba(165, 96, 247, 0.43); color: rgb(85, 27, 177);" class="project-type">• Analytics</span>
                                <span class="project-type">• Dashboards</span>
                            </div>
                        </div>
                    </article>
                    <table class="striped centered">
                        <thead>
                            <th>No</th>
                            <th>Nama Game</th>
                            <th>Kategori</th>
                            <th>Nama Akun</th>
                            <th>Username</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Nama Foto</th>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM tbl_game ORDER by id_game DESC LIMIT " . ($pg - 1) * $limit . ", $limit";

                            $result = query($query);

                            if (!empty($result)) {
                                $no = 1;
                                foreach ($result as $row) {
                                    $id = $row->id_game;
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->nama_game ?></td>
                                        <td><?= $row->kategori ?></td>
                                        <td><?= $row->nama_akun ?></td>
                                        <td><?= $row->username ?></td>
                                        <td><?= $row->keterangan ?></td>
                                        <td>
                                            <?php
                                            if (!empty($row->file)) {
                                            ?>
                                                <a href="upload/user/<?= $row->file ?>" target="_blank"><img src="upload/user/<?= $row->file  ?>" alt="" width="50px"></a>
                                            <?php
                                            } else {
                                            ?>
                                                <em>Tidak ada file yang di upload</em>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row->file  ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                            } else {

                                ?><tr colspan="5">
                                    <td>
                                        <center>
                                            <p class="add">Tidak ada data untuk ditampilkan. <u><a href="?page=master_kendaraan&act=add">Tambah data baru</a></u></p>
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
            <br>
            <ul class="pagination">
                <?php
                if ($cdata > $limit) {

                    //first and previous pagging
                    if ($pg > 1) {
                        $prev = $pg - 1;
                ?>
                        <li><a href="?page=master_kendaraan&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                        <li><a href="?page=master_kendaraan&pg=<?= $prev ?>"><i class="material-icons md-48">chevron_left</i></a></li>
                    <?php
                    } else {
                    ?>
                        <li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                        <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>
                        <?php
                    }

                    //perulangan pagging
                    for ($i = 1; $i <= $num_pages; $i++) {
                        if ((($i >= $pg - 3) && ($i <= $pg + 3)) || ($i == 1) || ($i == $num_pages)) {
                            if ($i == $pg) {
                        ?>
                                <li class="active waves-effect waves-dark"><a href="?page=master_kendaraan&pg=<?= $i ?>"><?= $i ?> </a></li>
                            <?php
                            } else {
                            ?>
                                <li class="waves-effect waves-dark"><a href="?page=master_kendaraan&pg=<?= $i ?>"><?= $i ?> </a></li>
                        <?php
                            }
                        }
                    }
                    //last and next pagging
                    if ($pg < $num_pages) {
                        $next = $pg + 1;
                        ?>
                        <li><a href="?page=master_kendaraan&pg=<?= $next ?>"><i class="material-icons md-48">chevron_right</i></a></li>
                        <li><a href="?page=master_kendaraan&pg=<?= $num_pages ?>"><i class="material-icons md-48">last_page</i></a></li>
                    <?php
                    } else {
                    ?>
                        <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_right</i></a></li>
                        <li class="disabled"><a href="#"><i class="material-icons md-48">last_page</i></a></li>
                    <?php
                    }
                    ?>
            </ul>
<?php
                } else {
                    echo '';
                }
            }
        }
    }
