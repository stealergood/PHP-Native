<?php
include '../koneksi/koneksi.php';

// Jika form submit diisi
if(isset($_POST['submit'])) {
  $content = $_POST['content'];

  // Upload gambar
  $target_dir = "image/teks_about/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $uploadOk = 1;

  // Check apakah file gambar atau bukan
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File yang diupload bukan gambar.";
      $uploadOk = 0;
    }
  }

 // Check apakah file sudah ada di folder
if (file_exists($target_file)) {
  echo "Maaf, file gambar tersebut sudah ada di folder.";
  $uploadOk = 0;
  }
  
  // Check ukuran file
  if ($_FILES["image"]["size"] > 500000) {
  echo "Maaf, ukuran file gambar terlalu besar.";
  $uploadOk = 0;
  }
  
  // Check format file
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
  echo "Maaf, hanya file gambar dengan format JPG, JPEG, PNG, dan GIF yang diizinkan.";
  $uploadOk = 0;
  }
  
  // Jika semua syarat terpenuhi, upload gambar
  if ($uploadOk == 1) {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  // Query untuk update data pada tabel "about_us"
  $sql = "UPDATE about SET image='$target_file', content='$content' WHERE id=1";
  if (mysqli_query($conn, $sql)) {
    echo "Data berhasil diubah.";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
} else {
  echo "Maaf, terjadi kesalahan saat mengupload gambar.";
}
}
}

// Query untuk mengambil data dari tabel "about_us"
$sql = "SELECT * FROM about";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
?>

<?php include 'header.php'?>

<div class="container-fluid py-5">
  <div class="row">
    <div class="col-md-6">
      <img src="../<?= $row['image']; ?>" style="width:100%; height: 320px; object-fit: cover; border-radius: 5px;">
    </div>
    <div class="col-md-6">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="content">Teks Tentang Kami:</label>
          <textarea class="form-control" name="content" id="content" rows="10"><?= $row['content']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="image">Gambar:</label>
          <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
      </form>
    </div>
  </div>
</div>
<?php
}
?>

<?php

include 'footer.php';
?>
