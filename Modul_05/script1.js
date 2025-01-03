$(document).ready(function () {
  //dasar selektor
  $("header").css("text-align", "center"); //ubah align txt pada header
  $("li").css("margin", "5px"); //beri margin pada semuan li

  //selektor atribut
  $('img[alt="Alumni Photo 1"]').css("border", "2px solid red"); //mengubah border pada gambar dengan alt="Alumni Photo 1"

  //selektor hirarki
  $("#alumniList li").css("font-size", "18px"); //mengubah font size pada semua li di dalam alumni list

  //selektor filter
  $("li:even").css("color", "blue"); //mengubah warna txt pada elemen li genap
  $(".featured").addClass("highlight"); //menambahkan class highlight pada elemen dengan class featured

  //event handling untuk galeri photo
  $(".gallery img").on("click", function () {
    var src = $(this).attr("src");
    $("#modalImage").attr("src", src);
    $("#myModal").fadeIn();
  });
  $(".modal.close").on("click", function () {
    $("#myModal").fadeOut();
  });
  $(window).on("click", function (event) {
    if ($(event.target).is("#myModal")) {
      $("#myModal").fadeOut();
    }
  });
});
