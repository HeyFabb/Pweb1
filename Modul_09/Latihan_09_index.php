<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Template</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <style>
    body {
      margin: 0;
    }

    .jumbotron-bg {
      background-image: url('Header-Home.jpg');
      background-size: cover;
      background-position: center;
      color: white;
      background-color: #343a40; /* Fallback color */
    }
  </style>
</head>

<body>
  <!-- Bagian Atas: Jumbotron -->
  <header class="jumbotron-bg text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">Selamat Datang di Website Kami</h1>
      <p class="lead">Portal Alumni Dengan Fitur Bursa Kerja dan Penelusuran Alumni</p>
    </div>
  </header>

  <div class="container-fluid my-4">
    <div class="row">
      <!-- Bagian Kiri: Menu -->
      <aside class="col-md-2 bg-light p-3">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="?menu=home" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="?menu=about" class="nav-link">About</a></li>
          <li class="nav-item"><a href="?menu=ralumni" class="nav-link">Daftar Alumni</a></li>
          <li class="nav-item"><a href="?menu=calumni" class="nav-link">Tambah Alumni</a></li>
          <li class="nav-item"><a href="?menu=bursakerja" class="nav-link">Bursa Kerja</a></li>
        </ul>
      </aside>

      <!-- Bagian Tengah: Artikel -->
      <main class="col-md-10">
        <article>
          <!-- Form Pencarian Alumni -->
          <form method="GET" action="cari_alumni.php" class="mb-4">
            <div class="form-group mb-3">
              <label for="nama">Nama:</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group mb-3">
              <label for="jurusan">Jurusan:</label>
              <input type="text" class="form-control" id="jurusan" name="jurusan">
            </div>
            <div class="form-group mb-3">
              <label for="tahun_lulus">Tahun Lulus:</label>
              <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus">
            </div>
            <button type="submit" class="btn btn-primary">Cari Alumni</button>
          </form>

          <?php
          if (isset($_GET['menu'])) {
              $menu = htmlspecialchars($_GET['menu']); // Hindari XSS
              $allowed_menus = ['home', 'about', 'ralumni', 'calumni', 'ualumni', 'bursakerja'];
              if (in_array($menu, $allowed_menus)) {
                  include "Latihan_09_$menu.php";
              } else {
                  include "Latihan_09_index.php";
              }
          } else {
              include "Latihan_09_index.php";
          }
          ?>
        </article>
      </main>
    </div>
  </div>

  <!-- Bagian Bawah: Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <p>&copy; 2024 Website Kami. All rights reserved.</p>
    <div>
      <a href="#" class="text-white mx-2">Facebook</a>
      <a href="#" class="text-white mx-2">Twitter</a>
      <a href="#" class="text-white mx-2">Instagram</a>
    </div>
  </footer>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
