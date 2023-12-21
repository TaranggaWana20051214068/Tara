<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    if ($_SESSION['admin'] != 1) {
        $_SESSION['err'] = '<center>ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini</center>';
        header("Location: ./logout.php");
        die();
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
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Nama Pemerima</th>
                                <th>Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $query1 = "SELECT a.*,
                    b.nama_k,nama_penerima,tgl_k,buku_k
                    FROM tbl_buku_pinjam a
                    LEFT JOIN tbl_buku_kembali b
                    ON a.buku = b.buku_k";
                            // DESC LIMIT " . ($pg - 1) * $limit . ", $limit
                            $result = query($query1);

                            if (!empty($result)) {
                                $no = 1;
                                foreach ($result as $row) {
                                    // $id = $row->id_game;
                            ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->buku ?></td>
                                        <td><?= $row->tgl_p ?></td>
                                        <td><?= $row->nama_penerima ?></td>
                                        <td><?= $row->tgl_k ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                            } else {

                                ?><div class="container">
                                    <div>
                                        <center>
                                            <p class="add">Tidak ada data untuk ditampilkan. <u><a href="?page=master_kendaraan&act=add">Tambah data baru</a></u></p>
                                        </center>
                                    </div>
                                </div>
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
