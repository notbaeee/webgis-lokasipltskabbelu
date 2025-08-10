<?php
//Script ini diletakan pada halaman cekLogin.php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../konektor.php';

//Fungsi untuk mencegah inputan karakter yang tidak sesuai
include 'cekinput.php';

// menangkap data yang dikirim dari form
$username = input($_POST['username']);
$password = input($_POST['password']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($konektor, "select * from admin where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
  $_SESSION['usernameadmin'] = $username;
  $_SESSION['statusadmin'] = "login";
  header("location:lokasi.php");
} else {
  echo "<script>
          alert('Gagal Login! Periksa kembali username dan password Anda.');
          window.location.href = 'index.php?pesan=gagal';
        </script>";
}