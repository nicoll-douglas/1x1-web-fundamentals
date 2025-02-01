/**
 * Component class that functionality for a menu.
 */
export default class Menu {
  #activator;
  #container;
  #firstFocus;
  #lastFocus;

  /**
   * Gets the necessary elements for the components from the DOM and loads them into the class.
   * @param {string} activatorSelector The selector for the activator element (button).
   * @param {string} containerSelector The selector for the menu container element (the element to hide and show).
   * @param {string} firstFocusSelector The selector of the first focusable element of the container.
   * @param {string} lastFocusSelector The selector of the last focusable element of the container.
   */
  constructor(
    activatorSelector,
    containerSelector,
    firstFocusSelector,
    lastFocusSelector
  ) {
    this.#activator = document.querySelector(activatorSelector);
    this.#container = document.querySelector(containerSelector);
    this.#firstFocus = document.querySelector(firstFocusSelector);
    this.#lastFocus = document.querySelector(lastFocusSelector);
  }

  /**
   * Reveals the container and focuses the first element (opens the menu).
   */
  #open() {
    this.#container.classList.remove("hidden");
    this.#activator.ariaExpanded = "true";
    this.#firstFocus.focus();
  }

  /**
   * Hides the container and returns focus to the activator (closes the menu).
   */
  #close() {
    this.#container.classList.add("hidden");
    this.#activator.ariaExpanded = "false";
    this.#activator.focus();
  }

  /**
   * Toggles the menu (opens if closed, closes if open).
   */
  #toggle() {
    const isClosed = this.#container.classList.contains("hidden");
    if (isClosed) {
      this.#open();
    } else {
      this.#close();
    }
  }

  /**
   * Event handler functions that handles Tab key presses within the menu.
   * @param {KeyboardEvent} e The keyboard event.
   */
  #handleTab(e) {
    if (e.key !== "Tab") return;
    if (e.shiftKey) return;
    e.preventDefault();
    this.#firstFocus.focus();
  }

  /**
   * Event handler function that handles Shift + Tab key presses within the menu.
   * @param {KeyboardEvent} e The keyboard event.
   */
  #handleShiftTab(e) {
    if (e.key !== "Tab") return;
    if (!e.shiftKey) return;
    e.preventDefault();
    this.#lastFocus.focus();
  }

  /**
   * Event handler function that handles Escape key presses within the menu.
   * @param {KeyboardEvent} e The keyboard event.
   */
  #handleEscape(e) {
    if (e.key !== "Escape") return;
    e.preventDefault();
    this.#close();
  }

  /**
   * Component initialiser functions which adds the necessary event listener.
   */
  init() {
    this.#container.addEventListener("keydown", (e) => {
      this.#handleEscape(e);
    });
    this.#firstFocus.addEventListener("keydown", (e) => {
      this.#handleShiftTab(e);
    });
    this.#lastFocus.addEventListener("keydown", (e) => {
      this.#handleTab(e);
    });
    this.#activator.addEventListener("click", (e) => {
      this.#toggle();
    });
  }
}
