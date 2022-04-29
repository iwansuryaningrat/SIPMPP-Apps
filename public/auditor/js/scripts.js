// change button carousel index video
// sidebar open-close
$(document).click((e) => {
  if (e.target.id === "sidebar-main-icon" || e.target.nodeName === "path") {
    $("#sidebar-content").removeClass("minimize__sidebar");
    $("#main-content").removeClass("minimize__sidebar");
    $(".header__mini").removeClass("active");
    $(".header__big").removeClass("active");
  }
});

$("#header-main-nav-btn-i").click(() => {
  $("#sidebar-content").toggleClass("minimize__sidebar");
  $("#main-content").toggleClass("minimize__sidebar");
  $(".header__mini").toggleClass("active");
  $(".header__big").toggleClass("active");
  $(".collapse.collapse__dropside").removeClass("show");
  $("html").toggleClass("nav__open");
});
