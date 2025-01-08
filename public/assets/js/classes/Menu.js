export default class Menu {
  /**
   * The button used to open the menu.
   * @type {HTMLButtonElement}
   */
  #activator;
  /**
   * The container for the menu content.
   * @type {HTMLElement}
   */
  #content;
  /**
   * The first focusable element in the menu content.
   * @type {HTMLElement}
   */
  #firstFocus;
  /**
   * The last focusable element in the menu content.
   */
  #lastFocus;

  /**
   * @param {HTMLButtonElement} activator
   * @param {HTMLElement} content
   * @param {HTMLElement} firstFocus
   * @param {HTMLElement} lastFocus
   */
  constructor(activator, content, firstFocus, lastFocus) {
    this.#activator = activator;
    this.#content = content;
    this.#firstFocus = firstFocus;
    this.#lastFocus = lastFocus;
  }

  /**
   * Opens the menu.
   */
  #open() {
    this.#content.classList.remove("hidden");
    this.#activator.ariaExpanded = "true";
    this.#firstFocus.focus();
  }

  /**
   * Closes the menu.
   */
  #close() {
    this.#content.classList.add("hidden");
    this.#activator.ariaExpanded = "false";
    this.#activator.focus();
  }

  /**
   * Toggles the menu.
   */
  #toggle() {
    const isClosed = this.#content.classList.contains("hidden");
    if (isClosed) {
      this.#open();
    } else {
      this.#close();
    }
  }

  /**
   * Handles tab key interactions on the last focusable element.
   *
   * @param {KeyboardEvent} e
   */
  #handleTab(e) {
    if (e.key !== "Tab") return;
    if (e.shiftKey) return;
    e.preventDefault();
    this.#firstFocus.focus();
  }

  /**
   * Handles Shift+Tab key interactions on the first focusable element.
   *
   * @param {KeyboardEvent} e
   */
  #handleShiftTab(e) {
    if (e.key !== "Tab") return;
    if (!e.shiftKey) return;
    e.preventDefault();
    this.#lastFocus.focus();
  }

  /**
   * Handles escape key interactions inside the menu content.
   *
   * @param {KeyboardEvent} e
   */
  #handleEscape(e) {
    if (e.key !== "Escape") return;
    e.preventDefault();
    this.#close();
  }

  /**
   * Initialises the menu's event listeners.
   */
  init() {
    this.#content.addEventListener("keydown", (e) => {
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
