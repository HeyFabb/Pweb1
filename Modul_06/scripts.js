document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault(); // Mencegah reload halaman
  alert("Pesan Anda berhasil dikirim!"); // Tampilkan notifikasi
  window.location.href = "Latihan06_01.html"; // Kembali ke halaman beranda
});
