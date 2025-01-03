$(document).ready(function () {
  // Efek fade-in untuk semua gambar saat halaman dimuat
  $(".gallery img").fadeIn(1000);

  // Event klik untuk menampilkan modal
  $(".gallery img").click(function () {
    const imgSrc = $(this).attr("src"); // Mendapatkan sumber gambar
    $(".modal img").attr("src", imgSrc); // Mengisi gambar di modal
    $(".modal").fadeIn(); // Menampilkan modal dengan efek fade-in
  });

  // Event klik untuk menutup modal (tombol "Close")
  $(".modal .close").click(function () {
    $(".modal").fadeOut(); // Menutup modal dengan efek fade-out
  });

  // Menutup modal ketika area di luar gambar diklik
  $(".modal").click(function (event) {
    if ($(event.target).is(".modal img") || $(event.target).is(".close")) {
      return; // Jangan tutup modal jika gambar atau tombol close diklik
    }
    $(".modal").fadeOut(); // Menutup modal
  });
});
