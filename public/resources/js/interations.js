/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/interations.js ***!
  \*************************************/
var showf = document.getElementById("showbut");
showf.addEventListener("click", function () {
  var showd = document.getElementById("show");

  if (showd.style.display === "none") {
    alert("Escolha um tema válido para o seu Post!");
    showd.style.display = "block";
  } else {
    showd.style.display = "none";
  }
});
/******/ })()
;