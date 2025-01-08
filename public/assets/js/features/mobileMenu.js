import Menu from "../classes/Menu.js";

try {
  const elements = [
    "#mobile-menu-button",
    "#mobile-menu-content",
    "#mobile-menu-first-focus",
    "#mobile-menu-last-focus",
  ].map((selector) => {
    const el = document.querySelector(selector);
    if (!el) {
      throw new Error(`Element not present in the DOM: ${selector}`);
    }
    return el;
  });

  const mobileMenu = new Menu(...elements);
  mobileMenu.init();
} catch (e) {
  console.error(e);
}
