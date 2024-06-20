function toggleMenu() {
  var navbarMenu = document.getElementById("navbarMenu");
  navbarMenu.classList.toggle("show");
}
function ShowPassword() {
  var x = document.getElementById("ShowPassW");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}