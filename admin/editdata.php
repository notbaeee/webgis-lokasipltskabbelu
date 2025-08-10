<?php
include '../konektor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $nama = mysqli_real_escape_string($konektor, $_POST['nama']);
  $detaillokasi = mysqli_real_escape_string($konektor, $_POST['detaillokasi']);
  $latitude = mysqli_real_escape_string($konektor, $_POST['latitude']);
  $longitude = mysqli_real_escape_string($konektor, $_POST['longitude']);

  // Ambil data lama
  $query = mysqli_query($konektor, "SELECT gambar FROM lokasi WHERE id = $id");
  $data = mysqli_fetch_assoc($query);
  $gambarLama = $data['gambar'];

  // Cek apakah ada file gambar yang diunggah
  if (!empty($_FILES['gambar']['name'])) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
      mkdir($targetDir, 0777, true);
    }

    $filename = uniqid() . "_" . basename($_FILES["gambar"]["name"]);
    $targetFile = $targetDir . $filename;

    // Pindahkan file baru ke folder uploads
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
      // Hapus gambar lama jika ada
      if (!empty($gambarLama) && file_exists($targetDir . $gambarLama)) {
        unlink($targetDir . $gambarLama);
      }

      // Update database dengan gambar baru
      $query = "UPDATE lokasi SET nama='$nama', detaillokasi='$detaillokasi', latitude='latiude, longitude='$longitude','gambar='$filename' WHERE id=$id";
    } else {
      header("Location: lokasi.php?pesan=upload_gagal");
      exit;
    }
  } else {
    // Jika tidak ada gambar baru yang diunggah, hanya update teks
    $query = "UPDATE lokasi SET nama='$nama' , latitude='$latitude', longitude='$longitude', detaillokasi='$detaillokasi' WHERE id=$id";
  }

  if (mysqli_query($konektor, $query)) {
    header("Location: lokasi.php?pesan=edit_sukses");
  } else {
    header("Location: lokasi.php?pesan=edit_gagal");
  }
} else {
  echo "Akses ditolak!";
}