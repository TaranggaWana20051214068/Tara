document.addEventListener("DOMContentLoaded", function () {
  M.AutoInit();
  // Inisialisasi Dropdown
  var dropdowns = document.querySelectorAll(".dropdown-button");
  var dropdownInstances = M.Dropdown.init(dropdowns);

  // Inisialisasi Parallax (jika diperlukan)
  var parallaxElems = document.querySelectorAll(".parallax");
  var parallaxInstances = M.Parallax.init(parallaxElems);

  // Inisialisasi Collapsible Accordion
  var collapsibles = document.querySelectorAll(".collapsible");
  var collapsibleInstances = M.Collapsible.init(collapsibles, {});

  // Inisialisasi Sidenav
  var sidenavElems = document.querySelectorAll(".sidenav");
  var sidenavInstances = M.Sidenav.init(sidenavElems, {});

  // Inisialisasi scrollspy
  var scrollspys = document.querySelectorAll(".scrollspy");
  var instances = M.ScrollSpy.init(scrollspys);

  // Pastikan Anda tidak menggunakan variabel yang sama untuk instances Collapsible dan Sidenav
});
