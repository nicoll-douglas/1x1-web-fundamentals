import Menu from "../classes/Menu.js";

const mobileMenu = new Menu(
  document.querySelector("#mobile-menu-button"),
  document.querySelector("#mobile-menu-content"),
  document.querySelector("#mobile-menu-first-focus"),
  document.querySelector("#mobile-menu-last-focus")
);

mobileMenu.init();
