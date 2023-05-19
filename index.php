<?php

include 'header2.php';

?>

<?php
include 'koneksi/koneksi.php';
// menampilkan data dari tabel teks_promo
$sql = "SELECT * FROM teks_promo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='container' style='margin-top: 100px; margin-bottom: 100px;'>
      <h4 class='text-center heading' style='font-family: Arisal, sans-seri; font-size: 32px; padding: 20px; background-color: #f2f2f2; border-radius: 10px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); position: relative;'>
        " . $row["deskripsi"] . "
        <span class='promo-badge' style='position: absolute; top: -10px; right: -10px; background-color: #8a2be2; color: #fff; font-size: 14px; padding: 5px 10px; border-radius: 50%;'>
          Hadir!
        </span>
      </h4>
    </div>";
  }
}
?>


<!-- Carousel -->

<div id="carousel-example" class="carousel slide" data-ride="carousel" style="margin-top: 19px">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example" data-slide-to="1"></li>
    <li data-target="#carousel-example" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="item active">
      <img src="image/carousel/carousel2.jpg" alt="Carousel Image 1" style="width: 100%;">
      <div class="carousel-caption">
        <h2>JoFe - Bakery</h2>
        <p>JoFe - Bakery menawarkan beragam jenis kue kering yang lezat dan berkualitas tinggi. Kue-kue kering kami
          dibuat dengan menggunakan bahan-bahan berkualitas dan diracik dengan resep yang teruji, sehingga memberikan
          pengalaman rasa yang istimewa bagi setiap pelanggan.
          Kami selalu berusaha memberikan yang terbaik bagi pelanggan kami, sehingga Anda akan mendapatkan produk yang
          berkualitas tinggi dan layanan yang ramah dari tim kami. Jangan ragu untuk menghubungi kami melalui WhatsApp
          di nomor +62 821-1615-4550 untuk pemesanan dan informasi lebih lanjut. Terima kasih telah mempercayakan
          kebutuhan kue kering Anda kepada kami di JoFe - Bakery.</p>
      </div>
    </div>
    <div class="item">
      <img src="image/carousel/carousel1.jpg" alt="Carousel Image 2" style="width: 100%;">
      <div class="carousel-caption">
        <h2>Kue Kering</h2>
        <p>Beraneka macam kue kering, seperti kue nastar, salju, coklat, kacang, keju, dll.</p>
      </div>
    </div>
    <div class="item">
      <img src="image/carousel/carousel3.jpg" alt="Carousel Image 3" style="width: 100%;">
      <div class="carousel-caption">
        <h2>Kunjungan Mahasiswa IT DEL</h2>
        <p>Melakukan Observasi mengenai produk kue di JoFe - Bakery.</p>
      </div>
    </div>
  </div>

  <a class="left carousel-control" href="#carousel-example" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

  <style>
    .carousel-indicators li {
      background-color: #333;
      border-radius: 50%;
      width: 15px;
      height: 15px;
      margin: 0 5px;
      cursor: pointer;
    }

    .carousel-indicators .active {
      background-color: #fff;
    }

    .carousel-caption {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translate(-50%, 0);
      background-color: rgba(0, 0, 0, 0.5);
      padding: 15px;
      border-radius: 5px 5px 0 0;
      width: 100%;
      margin: 0;
    }

    .carousel-caption h2 {
      font-size: 36px;
      color: #fff;
      text-transform: uppercase;
      margin-bottom: 15px;
    }

    .carousel-caption p {
      font-size: 18px;
      color: #fff;
      margin-bottom: 0;
    }
  </style>
</div>

<!-- Produk Kami -->

<div class="container" style="margin-top: 100px; margin-bottom: 100px;">
  <h2 class="text-center pb-4 pt-5 mb-0"
    style="border-bottom: 2px solid #6C5B7B; font-size: 3.9rem; padding: 10px; margin-bottom: 100px;font-weight: bold; text-shadow: 2px 2px #ccc; width: 100%;">
    <b>Produk Kami</b>
  </h2>

  <?php
  $result = mysqli_query($conn, "SELECT * FROM produk LIMIT 3");
  while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="col-sm-6 col-md-4">
      <div class="thumbnail" style="border: 2px solid #ddd; padding: 10px;">
        <img src="image/produk/<?= $row['image']; ?>" style="width:300%; height: 400px; object-fit: cover;">
        <div class="caption">
          <h3 style="font-size: 1.5rem; font-weight: bold;">
            <?= $row['nama']; ?>
          </h3>
          <h4 style="font-size: 1.2rem; font-weight: bold; color: black;">
            <?= 'Rp. ' . number_format($row['harga']); ?>
          </h4>
          <div class="row">
            <div class="col-md-6">
              <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-primary btn-block">
                <span class="glyphicon glyphicon-eye-open"></span> Detail
              </a>
            </div>
            <div class="col-md-6">
              <?php if (isset($_SESSION['kd_cs'])) { ?>
                <a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1"
                  class="btn btn-success btn-block" type="button" role="button">
                  <i class="glyphicon glyphicon-shopping-cart"></i> Masukkan Keranjang
                </a>
              <?php } else { ?>
                <a href="keranjang.php" class="btn btn-success btn-block" role="button">
                  <i class="glyphicon glyphicon-shopping-cart"></i> Masukkan Keranjang
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>



  <?php } ?>

</div>
</div>
</div>
<center>
  <a href="produk.php">
    <button type="button" class="btn btn-primary">
      <span class="glyphicon glyphicon-chevron-right"></span> Lihat Lebih Banyak
    </button>
  </a>
</center>

<hr style="border-top: 2.3px solid #ccc; margin-top: 50px; margin-bottom: 50px;">

<?php
// Query untuk mengambil data dari tabel "about"
$sql = "SELECT * FROM about";
$result = mysqli_query($conn, $sql);

// Periksa apakah query berhasil dieksekusi
if (!$result) {
  die("Query gagal: " . mysqli_error($conn));
}
?>

<?php
// Tampilkan gambar dan teks dari tabel "about"
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  ?>

  <div style="max-width: 1000px; margin: 50px auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
      <div style="width: 100%; text-align: center;">
        <h2 style="font-size: 3.5rem; font-weight: bold; margin-bottom: 20px;">Sejarah Toko Jofe - Bakery</h2>
        <p style="font-size: 1.9rem; color: #666; margin-bottom: 20px; margin-top: 6px;">
          <?= substr($row['content'], 860, 1511) . '...'; ?>
        </p>
        <center>
          <a href="about.php">
            <button type="button" class="btn btn-primary">
              <span class="glyphicon glyphicon-chevron-right"></span> Baca Lebih Banyak
            </button>
          </a>
        </center>
      </div>
      <div style="width: 100%; text-align: center; margin-bottom: -3%; margin-top: 2%;">
        <img src="./image/teks_about/<?= $row['image']; ?>" alt="Gambar About" style="max-width: 100%; height: auto;">
      </div>
    </div>
  </div>



  <?php
}
?>





<section class="location">
  <h2 style="font-size: 3.5rem; font-weight: bold; margin-bottom: 20px;">Lokasi Toko Kami</h2>
  <div class="map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7973.0080315270125!2d99.0537582697754!3d2.335540200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0466d4af5ef7%3A0x82931087a70bca84!2sPLN%20Ranting%20Balige!5e0!3m2!1sid!2sid!4v1680680148682!5m2!1sid!2sid"
      width="100%" height="700" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
  <div class="info" style="margin-top: 17%;">
    <img src="image/carousel/carousel3.jpg" alt="Toko Kami">
    <img src="image/carousel/carousel3.jpg" alt="Toko Kami">
    <img src="image/carousel/carousel3.jpg" alt="Toko Kami">
    <img src="image/carousel/carousel3.jpg" alt="Toko Kami">
    <img src="image/carousel/carousel3.jpg" alt="Toko Kami">

    <p style="margin-top: 16px;">
      Toko Kami merupakan toko yang menyediakan Kue Kering dengan harga yang terjangkau.
      Terletak di jalan Dr. Td. Pardede No.14, Komplek PLN Balige. Membuat Toko Kami mudah dijangkau oleh semua
      orang.
      Kami buka setiap hari mulai pukul 08.00 - 22.00 WIB.
    </p>
    <a href="https://www.google.com/maps/dir//PLN+Ranting+Balige/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x302e0466d4af5ef7:0x82931087a70bca84?sa=X&ved=2ahUKEwiO_8HY8Yv3AhXQaCsKHfZlDQwQ9Rd6BAh3EAQ"
      target="_blank" class="button">Petunjuk Arah</a>
  </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
  .btn-success {
    font-size: 1.2rem;
    padding: 8px;
  }

  .location {
    max-width: 1750px;
    margin: 0 auto;
    padding: 50px 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    height: 10%+3;
  }

  .location h2 {
    font-size: 36px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
  }

  .map {
    width: 100%;
    height: 400px;
    margin-bottom: 20px;
  }

  .info {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
  }

  .info img {
    width: 300px;
    height: 200px;
    margin-right: 20px;
    object-fit: cover;
  }

  .info p {
    flex-grow: 1;
    font-size: 18px;
    line-height: 1.5;
    margin: 0;
    text-align: center;
  }

  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    margin-top: 20px;
    transition: all 0.3s ease-in-out;
  }

  .button:hover {
    background-color: #3e8e41;
    color: white;
    transform: scale(1.1);
  }
</style>

<?php

include 'footer.php'

  ?>