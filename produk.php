<?php

include 'header.php'

  ?>

<!-- PRODUK -->
<div class="container" style="margin-top: 100px;">
  <h2 class="text-center pb-4 pt-5 mb-0"
    style="border-bottom: 2px solid #6C5B7B; padding: 10px; margin-bottom: 100px; font-family: 'Helvetica Neue', sans-serif; color: #333; text-shadow: 2px 2px #ccc; width: 100%;">
    <b>PRODUK</b>
  </h2>
  <div class="alert alert-warning" role="alert">
    <b>Penting! : </b>Seluruh pesanan produk adalah pre-order.
  </div>
  <div class="row">

    <?php

    $result = mysqli_query($conn, "SELECT * FROM produk");
    while ($row = mysqli_fetch_assoc($result)) {

      ?>

      <div class="col-sm-6 col-md-4">
        <div class="thumbnail" style="border: 2px solid #ddd; padding: 10px;">
          <img src="image/produk/<?= $row['image']; ?>" style="width:100%; height: 300px; object-fit: cover;">
          <div class="caption">
            <h3 style="font-size: 1.5rem; font-weight: bold;">
              <?= $row['nama']; ?>
            </h3>
            <h4 style="font-size: 1.2rem; font-weight: bold; color: black;">
              <?= 'Rp. ' . number_format($row['harga']) . '/ Kg'; ?>
            </h4>
            <div class="row">
              <div class="col-md-6">
                <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>"
                  class="btn btn-primary btn-block" role="button"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
              </div>

              <?php if (isset($_SESSION['kd_cs'])) {

                ?>

                <div class="col-md-6">
                  <a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1"
                    class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i>
                    Beli </a>
                </div>

              <?php } else {

                ?>
                <div class="col-md-6">
                  <a href="keranjang.php" class="btn btn-success btn-block" role="button"><i
                      class="glyphicon glyphicon-shopping-cart"></i> Beli</a>
                </div>

              <?php }

              ?>
            </div>
          </div>
        </div>
      </div>
      <?php

    }

    ?>
  </div>
</div>
</div>

<?php

include 'footer.php'

  ?>