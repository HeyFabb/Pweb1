<?php
include 'Latihan_09_config.php'; // Koneksi database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validasi ID (hanya angka yang diperbolehkan)
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        echo "ID tidak valid.";
        exit();
    }

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("DELETE FROM alumni WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus";
        // Redirect ke halaman utama
        header("Location: Latihan_09_index.php?menu=alumni");
        exit(); // Pastikan untuk menghentikan eksekusi lebih lanjut
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close(); // Tutup prepared statement
} else {
    echo "ID tidak ditemukan.";
}

$conn->close(); // Tutup koneksi
?>
