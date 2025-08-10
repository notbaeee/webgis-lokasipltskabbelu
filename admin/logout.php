<?php
// Mulai session
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Tampilkan alert sebelum redirect
echo "<script>
        alert('Anda telah berhasil logout!');
        window.location.href = 'index.php?pesan=logout';
      </script>";
exit;