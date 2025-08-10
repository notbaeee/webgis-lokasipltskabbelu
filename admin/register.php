<?php include '../konektor.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../gambar/belu.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Login Admin</title>
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
    <nav class="navbar navbar-expand-sm ">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../gambar/logo.png" alt="Logo Kabupaten Belu">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">

            <li class="nav-item">
              <a class="nav-link" href="../index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                  class="bi bi-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <div id="main-wrapper" class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
              <div class="row no-gutters">
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="mb-5">

                      <h3 class="h4 font-weight-bold text-theme">Register</h3>
                    </div>
                    <h6 class="h5 mb-0">Hi Buddy!</h6>
                    <p class="text-muted mt-2 mb-5">Create your username and password</p>
                    <form action="ceklogin.php" method="POST">

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" required>
                      </div>
                      <div class="form-group mb-5">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <!-- <a href="#" class="forgot-link text-primary">Forgot Your Password?</a> -->
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <img src="../gambar/plts2.jpg" alt="Pembangkit Listrik Tenaga Surya" class="img-fluid w-100"
                    style="height: 100%; object-fit: cover; border-radius: 5px;">
                </div>
              </div>
            </div>
          </div>
          <p class="text-muted text-center mt-3 mb-0">
            Do u have an account?
            <a href="login.php" class="text-primary ml-1">Sing in</a>
          </p>
        </div>
        <hr>
      </div>
    </div>
    <footer class="footer text-dark mb-3">
      <div class="container text-center">
        <div class="row">
          <ul class="list-unstyled">
            <li>Address: Jl. Perintis Kemerdekaan I, Kayu Putih, Kec. Oebobo, Kota Kupang, NTT</li>
            <li>Email: info@sigkabelu.com</li>
            <li>Telephone: +1234567890</li>
          </ul>
        </div>
      </div>
      <div class="container text-center mt-3">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> SIG KAbupaten Belu. All rights reserved.</p>
      </div>
    </footer>
  </div>
</body>

</html>