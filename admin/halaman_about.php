<?php
session_start();
include '../koneksi/koneksi.php';

// Ambil data tentang dari database
$query = "SELECT * FROM about WHERE id_about = 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$target_dir = "../image/teks_about/";


// Jika tombol 'Simpan' ditekan
if (isset($_POST['simpan'])) {
  // Ambil data dari form
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  // Update data tentang ke database
  $query = "UPDATE about SET content = '$content' WHERE id_about = 1";
  mysqli_query($conn, $query);

  // Jika gambar diupload
  if ($_FILES['image']['name'] != '') {
    $target_dir = "../image/teks_about/";
    $image = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar atau bukan
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
      $uploadOk = 0;
    }

    // Cek apakah file sudah ada
    if (file_exists($target_file)) {
      $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["image"]["size"] > 500000) {
      $uploadOk = 0;
    }

    // Cek tipe file
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      $uploadOk = 0;
    }

    // Jika tidak ada masalah dengan upload file, simpan file
    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Hapus gambar lama jika ada
        if ($row['image'] != '') {
          unlink($target_dir . $row['image']);
        }
        $query = "UPDATE about SET image = '$image' WHERE id_about = 1";
        mysqli_query($conn, $query);
      }
    }
  }

  // Refresh halaman setelah data berhasil diupdate
  header('Location: halaman_about.php');
}

// Jika tombol 'Hapus' ditekan
if (isset($_POST['hapus'])) {

  // Hapus data tentang dari database
  $query = "DELETE FROM about WHERE id_about = 1";
  mysqli_query($conn, $query);

  // Hapus gambar tentang dari folder
  $target_dir = "../image/teks_about/";
  $image = $row['image'];
  if ($image != '') {
    unlink($target_dir . $image);
  }

  // Refresh halaman setelah data berhasil dihapus
  header('Location: halaman_about.php');
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
            <a href="halaman_utama.php" class="site_title"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
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
                <li><a><i class="fa fa-bar-chart-o"></i> Detail Pesanan <span class="fa fa-chevron-down"></span></a>
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
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                  data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user"></i> JoFe
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="proses/logout.php"><i class="fa fa-sign-out pull-right"></i>Keluar</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="container mt-5" style="margin-bottom:13%;">
          <div class="row">
            <div class="col-md-12" style="color :  #6C5B7B">
              <h2 class="text-center mb-5">Edit Tentang Toko</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="col-md-8 mx-auto">
              <div class="form-group">
                <label for="content">Isi Tentang</label>
                <textarea name="content" id="content" class="form-control"
                  rows="10"><?php echo $row['content']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <small class="form-text text-muted">* Format gambar yang diperbolehkan: JPG, JPEG, PNG, GIF. Ukuran
                  maksimum: 500 KB.</small>
              </div>
              <?php if ($row['image'] != '') {
                if (file_exists($target_dir . "1.jpg")) {
                  unlink($target_dir . "1.jpg");
                }
                ?>
                <div class="form-group">
                  <label for="current-image">Gambar Saat Ini</label>
                  <div>
                    <img src="../image/teks_about/<?php echo $row['image']; ?>" alt="Current Image"
                      style="max-width: 200px;">
                  </div>
                </div>
              <?php } ?>
              <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary"
                  onclick="return confirm('Anda yakin ingin menyimpan data tentang ini?')">Simpan</button>
                <button type="submit" name="hapus" class="btn btn-danger"
                  onclick="return confirm('Anda yakin ingin menghapus data tentang ini?')">Hapus</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->

    <!-- /footer content -->
  </div>
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