<?php
include '../konektor.php';

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($konektor, $_GET['id']);

  // Ambil nama file gambar sebelum menghapus data
  $query = mysqli_query($konektor, "SELECT gambar FROM lokasi WHERE id = $id");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    $gambar = $data['gambar'];
    $targetDir = "uploads/";

    // Hapus gambar jika ada
    if (!empty($gambar) && file_exists($targetDir . $gambar)) {
      unlink($targetDir . $gambar);
    }

    // Hapus data dari database
    $delete = mysqli_query($konektor, "DELETE FROM lokasi WHERE id = $id");

    if ($delete) {
      header("Location: lokasi.php?pesan=hapus_sukses");
    } else {
      header("Location: lokasi.php?pesan=hapus_gagal");
    }
  } else {
    header("Location: lokasi.php?pesan=data_tidak_ditemukan");
  }
} else {
  header("Location: lokasi.php?pesan=akses_ditolak");
}
exit;
