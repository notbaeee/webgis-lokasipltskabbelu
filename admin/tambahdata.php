<?php
include '../konektor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = mysqli_real_escape_string($konektor, $_POST['nama']);
  $detaillokasi = mysqli_real_escape_string($konektor, $_POST['detaillokasi']);
  $latitude = mysqli_real_escape_string($konektor, $_POST['latitude']);
  $longitude = mysqli_real_escape_string($konektor, $_POST['longitude']);

  // Proses upload gambar
  $targetDir = "uploads/";
  $filename = uniqid() . "_" . basename($_FILES["gambar"]["name"]);
  $targetFile = $targetDir . $filename;

  if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
    $query = "INSERT INTO lokasi (nama, detaillokasi, latitude, longitude, gambar) VALUES ('$nama', '$detaillokasi', '$latitude', '$longitude', '$filename')";

    if (mysqli_query($konektor, $query)) {
      header("Location:lokasi.php?pesan=tambah_sukses");
    } else {
      echo "Gagal menambahkan data: " . mysqli_error($konektor);
    }
  } else {
    echo "Gagal mengunggah gambar.";
  }
}