<?php
session_start();
include '../koneksi/koneksi.php';
if (!isset($_SESSION['admin'])) {
    header('location:halaman_utama.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Admin | JoFe Bakkery</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="assets/img/jofe.png" rel="shortcut icon" />
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="halaman_utama.php" class="site_title"><i class="fa fa-spin fa-1x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                            <span>JoFe Bakery</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Mengelola Informasi</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Teks <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="halaman_beranda.php">Halaman Beranda</a></li>
                                        <li><a href="halaman_about.php">Halaman Tentang Toko</a></li>
                                    </ul>
                                </li><br>

                                <h3>Mengelola Data</h3>
                                <li><a href="m_produk.php"><i class="fa fa-edit"></i>Data Produk</a></li>
                                <li><a href="m_customer.php"><i class="fa fa-user"></i>Data Costumer</a></li><br>

                                <h3>Mengelola Data</h3>
                                <li><a><i class="fa fa-bar-chart-o"></i> Detail Pesanan <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="produksi.php">Pemesanan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- footer content -->
                    <div class="sidebar-footer hidden-small">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="text-muted">© 2023 JoFe Bakery</span>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /footer content -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-right: 100px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> JoFe
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="proses/logout.php"><i
                                            class="fa fa-sign-out pull-right"></i>Keluar</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php
                // jika tombol submit untuk menambah data ditekan
                if (isset($_POST['submit-tambah'])) {
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];

                    // query untuk menambah data ke tabel teks_promo
                    $sql = "INSERT INTO teks_promo (nama, deskripsi) VALUES ('$nama', '$deskripsi')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Data berhasil ditambahkan.')</script>";
                    } else {
                        echo "Terjadi kesalahan: ";
                    }
                }

                // jika tombol submit untuk mengupdate data ditekan
                if (isset($_POST['submit-update'])) {
                    $id = $_POST['id'];
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];

                    // query untuk mengupdate data di tabel teks_promo
                    $sql = "UPDATE teks_promo SET nama='$nama', deskripsi='$deskripsi' WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Data berhasil diupdate.')</script>";
                    } else {
                        echo "Terjadi kesalahan: ";
                    }
                }

                // jika tombol submit untuk menghapus data ditekan
                if (isset($_POST['submit-delete'])) {
                    $id = $_POST['id'];

                    // query untuk menghapus data dari tabel teks_promo
                    $sql = "DELETE FROM teks_promo WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Data berhasil dihapus.')</script>";
                    } else {
                        echo "Terjadi kesalahan: ";
                    }
                }

                // Menampilkan data dari tabel teks_promo -->
                $sql = "SELECT * FROM teks_promo";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='container' style='margin-bottom:4%;'>
        <h2 class='text-center pb-4' style='color :  #6C5B7B'>
            <b>Edit Teks Beranda</b>
        </h2>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<div class='form-group'>";
                        echo "<label for='nama'><i class='mdi mdi-tag-outline'></i> Nama:</label>";
                        echo "<input type='text' class='form-control' name='nama' value='" . $row["nama"] . "'>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='deskripsi'><i class='mdi mdi-pencil-outline'></i> Deskripsi:</label>";
                        echo "<textarea class='form-control' name='deskripsi' rows='8'>" . $row["deskripsi"] . "</textarea>";
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-primary' name='submit-update'><i class='mdi mdi-content-save-outline'></i> Simpan Perubahan </button>";
                        echo "                                        | 
        ";

                        echo "<button type='submit' class='btn btn-danger' name='submit-delete'><i class='mdi mdi-delete-outline'></i>  Hapus</button>";
                        echo "</form>";
                    }
                } else {
                    echo "Tidak ada data.";
                }

                // Menampilkan form untuk menambah data
                echo "<form method='POST' style='margin-top:3%; margin-bottom:10%'>";
                echo "<div class='container' style='margin-bottom: px;'>
                <h2 class='text-center pb-4' style='color :  #6C5B7B'>
                <b>Tambah Teks </b>
                </h2>";
                echo "<div class='form-group'>";
                echo "<label for='nama'><i class='mdi mdi-tag-outline'></i> Nama:</label>";
                echo "<input type='text' class='form-control' name='nama'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='deskripsi'><i class='mdi mdi-pencil-outline'></i> Deskripsi:</label>";
                echo "<textarea class='form-control' name='deskripsi' rows='8'></textarea>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-success' name='submit-tambah'><i class='mdi mdi-plus-circle-outline'></i> Tambah</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";


                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!-- /page content -->

    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

</body>

</html>