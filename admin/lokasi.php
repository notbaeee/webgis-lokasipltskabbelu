<?php
include '../konektor.php';
include 'restrict.php';

$stmt = mysqli_prepare($konektor, "SELECT * FROM admin WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $_SESSION['usernameadmin']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$d = mysqli_fetch_assoc($result);
if ($d) {
  $id = $d['id'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Lokasi PLTS</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
  <link rel="icon" href="../gambar/belu.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
  <style>
  .navbar {
    background-color: #8c2522;
  }

  .navbar-brand {
    color: white;
  }

  .navbar-brand img {
    height: 80px;
    width: auto;
  }

  .nav-link {
    color: white;
    font-weight: bold;
  }

  .nav-link:hover {
    color: #f8f9fa;
    text-decoration: underline;
  }
  </style>
</head>

<body>
  <div class="container border border-1">
    <nav class="navbar navbar-expand-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="beranda.php">
          <img src="../gambar/logo.png" alt="Logo Kabupaten Belu">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
      <!-- Tombol Tambah Data -->
      <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
      <div class="table-responsive">
        <!-- Tabel Data Lokasi -->
        <table id="tables" class="table table-bordered table-hover text-center">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th style="max-width: 300px;">Detail Lokasi</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = mysqli_query($konektor, "SELECT * FROM lokasi");
            while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td class="text-center align-middle"><?= $row['id']; ?></td>
              <td class="align-middle"><?= htmlspecialchars($row['nama']); ?></td>
              <td class="align-middle"><?= nl2br(htmlspecialchars($row['detaillokasi'])); ?></td>
              <td class="text-center align-middle"><?= htmlspecialchars($row['latitude']); ?></td>
              <td class="text-center align-middle"><?= htmlspecialchars($row['longitude']); ?></td>
              <td class="text-center align-middle">
                <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" width="150">
              </td>
              <td class="text-center align-middle">
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                  data-id="<?= $row['id']; ?>" data-nama="<?= htmlspecialchars($row['nama']); ?>"
                  data-detail="<?= htmlspecialchars($row['detaillokasi']); ?>" data-latitude="<?= $row['latitude']; ?>"
                  data-longitude="<?= $row['longitude']; ?>" data-gambar="<?= htmlspecialchars($row['gambar']); ?>">
                  Edit
                </button>
                <a href="hapusdata.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')"
                  class="btn btn-danger btn-sm mt-1">
                  Hapus
                </a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>

        <br>
      </div>
      <!-- Modal Tambah Data -->
      <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Lokasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="tambahdata.php" method="post" enctype="multipart/form-data">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" required>

                <label>Detail Lokasi:</label>
                <textarea name="detaillokasi" class="form-control" required></textarea>

                <label>Latitude:</label>
                <input type="text" name="latitude" class="form-control" required>

                <label>Longitude:</label>
                <input type="text" name="longitude" class="form-control" required>

                <label>Upload Gambar:</label>
                <input type="file" name="gambar" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal Edit Data (Dibuat Sekali Saja) -->
      <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data Lokasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="editdata.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="edit-id" name="id">
                <label>Nama:</label>
                <input type="text" id="edit-nama" name="nama" class="form-control" required>
                <label>Detail Lokasi:</label>
                <textarea id="edit-detail" name="detaillokasi" class="form-control" required></textarea>
                <label>Latitude:</label>
                <input type="text" id="edit-latitude" name="latitude" class="form-control" required>
                <label>Longitude:</label>
                <input type="text" id="edit-longitude" name="longitude" class="form-control" required>
                <label>Gambar Lama:</label><br>
                <img id="edit-gambar-preview" src="" width="100"><br>
                <label>Upload Gambar Baru (Opsional):</label>
                <input type="file" name="gambar" class="form-control">
                <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Script untuk Mengisi Modal Edit Secara Dinamis -->
      <script>
      document.addEventListener("DOMContentLoaded", function() {
        var editModal = document.getElementById("editModal");
        editModal.addEventListener("show.bs.modal", function(event) {
          var button = event.relatedTarget;
          document.getElementById("edit-id").value = button.getAttribute("data-id");
          document.getElementById("edit-nama").value = button.getAttribute("data-nama");
          document.getElementById("edit-detail").value = button.getAttribute("data-detail");
          document.getElementById("edit-latitude").value = button.getAttribute("data-latitude");
          document.getElementById("edit-longitude").value = button.getAttribute("data-longitude");
          document.getElementById("edit-gambar-preview").src = "uploads/" + button.getAttribute("data-gambar");
        });
      });
      </script>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </div>

  <script>
  $(document).ready(function() {
    $('#tables').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
  </script>
</body>

</html>