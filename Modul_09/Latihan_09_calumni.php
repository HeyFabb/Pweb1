<h3>FORM DATA ALUMNI</h3>
<hr>
<?php
include 'Latihan_09_config.php'; // Memasukkan file konfigurasi untuk koneksi database

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize input data
    $nama = $conn->real_escape_string($_POST['nama']);
    $tahun_lulus = $conn->real_escape_string($_POST['tahun_lulus']);
    $jurusan = $conn->real_escape_string($_POST['jurusan']);

    // Mengelola Upload Foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Buat folder jika belum ada
        }

        $file_name = basename($_FILES["foto"]["name"]);
        $file_name = str_replace(' ', '_', $file_name); // Ganti spasi dengan underscore
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi apakah file benar-benar gambar
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<div class='alert alert-danger'>File bukan gambar.</div>";
            $uploadOk = 0;
        }

        // Validasi ukuran file (5MB maksimum)
        if ($_FILES["foto"]["size"] > 5000000) {
            echo "<div class='alert alert-danger'>Ukuran file terlalu besar (maksimum 5MB).</div>";
            $uploadOk = 0;
        }

        // Validasi format file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<div class='alert alert-danger'>Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diizinkan.</div>";
            $uploadOk = 0;
        }

        // Cek apakah $uploadOk diatur ke 0 karena error
        if ($uploadOk == 0) {
            echo "<div class='alert alert-danger'>File tidak berhasil diunggah.</div>";
        } else {
            // Rename file jika nama file sudah ada
            if (file_exists($target_file)) {
                $unique_id = time();
                $target_file = $target_dir . $unique_id . "_" . $file_name;
            }

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Jika file berhasil diunggah, masukkan data ke database menggunakan prepared statement
                $stmt = $conn->prepare("INSERT INTO alumni (nama, tahun_lulus, jurusan, foto) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nama, $tahun_lulus, $jurusan, $target_file);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Data berhasil ditambahkan.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                }
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengunggah file.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Tidak ada file yang diunggah atau file terlalu besar.</div>";
    }
    $conn->close();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Tambah Data Alumni</h2>

    <!-- Form tambah data -->
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
        </div>
        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>
